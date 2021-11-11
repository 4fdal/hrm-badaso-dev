<?php

namespace Uasoft\Badaso\Module\HRM\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\HRM\Models\AccountGroup;
use Uasoft\Badaso\Module\HRM\Schema\Inputs\AccountGroupInput;

class AccountGroupController extends Controller
{
    /**
     * @OA\Post(
     *      path="/module/hrm/v1/account-group",
     *      operationId="AddAccountGroup",
     *      tags={"Account Groups"},
     *      summary="Add new account_groups",
     *      description="Add a new account_groups",
     *      @OA\Parameter(
     *          name="show_belogsto_relation",
     *          in="query",
     *          example=false,
     *          required=false,
     *          @OA\Schema(
     *              type="boolean"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="show_hasmany_relation",
     *          in="query",
     *          example=false,
     *          required=false,
     *          @OA\Schema(
     *              type="boolean"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/AccountGroupInput")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      security={{"bearerAuth" : {}}}
     * )
     */
    public function add(Request $request)
    {
        try {
            $account_groups_input = new AccountGroupInput($request);

            $account_groups = AccountGroup::create([
                  'parent_path' => $account_groups_input->parent_path,
              'name' => $account_groups_input->name,
              'code_prefix_start' => $account_groups_input->code_prefix_start,
              'code_prefix_end' => $account_groups_input->code_prefix_end,
              'company_id' => $account_groups_input->company_id,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $account_groups->company = $account_groups->company ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $account_groups->account_group_accounts = $account_groups->accountGroupAccounts ;
 
            }

            return ApiResponse::success(compact('account_groups'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/account-group",
     *      operationId="BrowseAccountGroup",
     *      tags={"Account Groups"},
     *      summary="Browse account_groups",
     *      description="Browse account_groups",
     *      @OA\Parameter(
     *          name="filter_fields",
     *          in="query",
     *          example="*",
     *          required=false,
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="filter_fields_search",
     *          in="query",
     *          example="*",
     *          required=false,
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="max_page",
     *          in="query",
     *          required=false,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="search",
     *          in="query",
     *          required=false,
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="show_pagination",
     *          in="query",
     *          example=true,
     *          required=false,
     *          @OA\Schema(
     *              type="boolean"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="show_belogsto_relation",
     *          in="query",
     *          example=false,
     *          required=false,
     *          @OA\Schema(
     *              type="boolean"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="show_hasmany_relation",
     *          in="query",
     *          example=false,
     *          required=false,
     *          @OA\Schema(
     *              type="boolean"
     *          )
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      security={{"bearerAuth" : {}}}
     * )
     */
    public function browse(Request $request)
    {
        try {

            $account_groups = new AccountGroup();
            $account_groups_fillable = $account_groups->getFillable();

            $filter_fields = $request->get('filter_fields', '*');
            $filter_fields = explode(',', $filter_fields);
            if (array_search('*', $filter_fields) == false) {
                $new_filter_fields = [];
                foreach ($filter_fields as $index => $field) {
                    if (!in_array($field, $filter_fields)) {
                        $new_filter_fields[] = $field;
                    }
                }
                $account_groups = $account_groups->select($filter_fields);
            }

            $filter_fields_search = $request->get('filter_fields_search', '*');
            $filter_fields_search = explode(',', $filter_fields_search);
            if (isset($request->search)) {
                if (array_search('*', $filter_fields_search) == false) {
                    foreach ($account_groups_fillable as $index => $field) {
                        $account_groups = $account_groups->orWhere($field, "like", "%$request->search%");
                    }
                } else {
                    foreach ($filter_fields_search as $index => $field) {
                        if (in_array($field, $account_groups_fillable)) {
                            $account_groups = $account_groups->orWhere($field, "like", "%$request->search%");
                        }
                    }
                }
            }

            if ($request->get('show_pagination', 'true') == 'true') {
                $max_page = $request->get('max_page', 15);
                $account_groups = $account_groups->paginate($max_page);
            } else {
                $account_groups = $account_groups->get();
            }

            $account_groups->map(function($account_groups) use ($request){

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $account_groups->company = $account_groups->company ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $account_groups->account_group_accounts = $account_groups->accountGroupAccounts ;
 
            }

                return $account_groups ;
            });
            $account_groups = $account_groups->toArray();

            return ApiResponse::success(compact('account_groups'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/account-group/{id}",
     *      operationId="ReadAccountGroup",
     *      tags={"Account Groups"},
     *      summary="Read account_groups",
     *      description="Read account_groups",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="show_belogsto_relation",
     *          in="query",
     *          example=false,
     *          required=false,
     *          @OA\Schema(
     *              type="boolean"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="show_hasmany_relation",
     *          in="query",
     *          example=false,
     *          required=false,
     *          @OA\Schema(
     *              type="boolean"
     *          )
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      security={{"bearerAuth" : {}}}
     * )
     */
    public function read(Request $request, $id)
    {
        try {

            $account_groups = AccountGroup::find($id);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $account_groups->company = $account_groups->company ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $account_groups->account_group_accounts = $account_groups->accountGroupAccounts ;
 
            }

            return ApiResponse::success(compact('account_groups'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Put(
     *      path="/module/hrm/v1/account-group/{id}",
     *      operationId="UpdateAccountGroup",
     *      tags={"Account Groups"},
     *      summary="Update account_groups",
     *      description="Update account_groups",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="show_belogsto_relation",
     *          in="query",
     *          required=false,
     *          example=false,
     *          @OA\Schema(
     *              type="boolean"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="show_hasmany_relation",
     *          in="query",
     *          required=false,
     *          example=false,
     *          @OA\Schema(
     *              type="boolean"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/AccountGroupInput")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      security={{"bearerAuth" : {}}}
     * )
     */
    public function update(Request $request, $id)
    {
        try {
            $account_groups_input = new AccountGroupInput($request);
            $account_groups = AccountGroup::find($id);

            $account_groups->update([
                  'parent_path' => $account_groups_input->parent_path == null ? $account_groups->parent_path : $account_groups_input->parent_path,
              'name' => $account_groups_input->name == null ? $account_groups->name : $account_groups_input->name,
              'code_prefix_start' => $account_groups_input->code_prefix_start == null ? $account_groups->code_prefix_start : $account_groups_input->code_prefix_start,
              'code_prefix_end' => $account_groups_input->code_prefix_end == null ? $account_groups->code_prefix_end : $account_groups_input->code_prefix_end,
              'company_id' => $account_groups_input->company_id == null ? $account_groups->company_id : $account_groups_input->company_id,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $account_groups->company = $account_groups->company ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $account_groups->account_group_accounts = $account_groups->accountGroupAccounts ;
 
            }

            return ApiResponse::success(compact('account_groups'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }


    /**
     * @OA\Delete(
     *      path="/module/hrm/v1/account-group/{id}",
     *      operationId="DeleteAccountGroup",
     *      tags={"Account Groups"},
     *      summary="Delete account_groups",
     *      description="Delete account_groups",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      security={{"bearerAuth" : {}}}
     * )
     */
    public function delete($id)
    {
        try {
            $account_groups = AccountGroup::find($id);

            $account_groups->delete();

            return ApiResponse::success();
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }
}

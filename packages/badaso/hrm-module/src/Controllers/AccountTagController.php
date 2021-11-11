<?php

namespace Uasoft\Badaso\Module\HRM\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\HRM\Models\AccountTag;
use Uasoft\Badaso\Module\HRM\Schema\Inputs\AccountTagInput;

class AccountTagController extends Controller
{
    /**
     * @OA\Post(
     *      path="/module/hrm/v1/account-tag",
     *      operationId="AddAccountTag",
     *      tags={"Account Tags"},
     *      summary="Add new account_tags",
     *      description="Add a new account_tags",
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
     *          @OA\JsonContent(ref="#/components/schemas/AccountTagInput")
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
            $account_tags_input = new AccountTagInput($request);

            $account_tags = AccountTag::create([
                  'name' => $account_tags_input->name,
              'applicability' => $account_tags_input->applicability,
              'is_active' => $account_tags_input->is_active,
              'country_id' => $account_tags_input->country_id,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $account_tags->country = $account_tags->country ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $account_tags->account_tag_tax_current_account_tags = $account_tags->accountTagTaxCurrentAccountTags ;
 
            }

            return ApiResponse::success(compact('account_tags'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/account-tag",
     *      operationId="BrowseAccountTag",
     *      tags={"Account Tags"},
     *      summary="Browse account_tags",
     *      description="Browse account_tags",
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

            $account_tags = new AccountTag();
            $account_tags_fillable = $account_tags->getFillable();

            $filter_fields = $request->get('filter_fields', '*');
            $filter_fields = explode(',', $filter_fields);
            if (array_search('*', $filter_fields) == false) {
                $new_filter_fields = [];
                foreach ($filter_fields as $index => $field) {
                    if (!in_array($field, $filter_fields)) {
                        $new_filter_fields[] = $field;
                    }
                }
                $account_tags = $account_tags->select($filter_fields);
            }

            $filter_fields_search = $request->get('filter_fields_search', '*');
            $filter_fields_search = explode(',', $filter_fields_search);
            if (isset($request->search)) {
                if (array_search('*', $filter_fields_search) == false) {
                    foreach ($account_tags_fillable as $index => $field) {
                        $account_tags = $account_tags->orWhere($field, "like", "%$request->search%");
                    }
                } else {
                    foreach ($filter_fields_search as $index => $field) {
                        if (in_array($field, $account_tags_fillable)) {
                            $account_tags = $account_tags->orWhere($field, "like", "%$request->search%");
                        }
                    }
                }
            }

            if ($request->get('show_pagination', 'true') == 'true') {
                $max_page = $request->get('max_page', 15);
                $account_tags = $account_tags->paginate($max_page);
            } else {
                $account_tags = $account_tags->get();
            }

            $account_tags->map(function($account_tags) use ($request){

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $account_tags->country = $account_tags->country ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $account_tags->account_tag_tax_current_account_tags = $account_tags->accountTagTaxCurrentAccountTags ;
 
            }

                return $account_tags ;
            });
            $account_tags = $account_tags->toArray();

            return ApiResponse::success(compact('account_tags'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/account-tag/{id}",
     *      operationId="ReadAccountTag",
     *      tags={"Account Tags"},
     *      summary="Read account_tags",
     *      description="Read account_tags",
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

            $account_tags = AccountTag::find($id);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $account_tags->country = $account_tags->country ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $account_tags->account_tag_tax_current_account_tags = $account_tags->accountTagTaxCurrentAccountTags ;
 
            }

            return ApiResponse::success(compact('account_tags'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Put(
     *      path="/module/hrm/v1/account-tag/{id}",
     *      operationId="UpdateAccountTag",
     *      tags={"Account Tags"},
     *      summary="Update account_tags",
     *      description="Update account_tags",
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
     *          @OA\JsonContent(ref="#/components/schemas/AccountTagInput")
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
            $account_tags_input = new AccountTagInput($request);
            $account_tags = AccountTag::find($id);

            $account_tags->update([
                  'name' => $account_tags_input->name == null ? $account_tags->name : $account_tags_input->name,
              'applicability' => $account_tags_input->applicability == null ? $account_tags->applicability : $account_tags_input->applicability,
              'is_active' => $account_tags_input->is_active == null ? $account_tags->is_active : $account_tags_input->is_active,
              'country_id' => $account_tags_input->country_id == null ? $account_tags->country_id : $account_tags_input->country_id,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $account_tags->country = $account_tags->country ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $account_tags->account_tag_tax_current_account_tags = $account_tags->accountTagTaxCurrentAccountTags ;
 
            }

            return ApiResponse::success(compact('account_tags'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }


    /**
     * @OA\Delete(
     *      path="/module/hrm/v1/account-tag/{id}",
     *      operationId="DeleteAccountTag",
     *      tags={"Account Tags"},
     *      summary="Delete account_tags",
     *      description="Delete account_tags",
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
            $account_tags = AccountTag::find($id);

            $account_tags->delete();

            return ApiResponse::success();
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }
}

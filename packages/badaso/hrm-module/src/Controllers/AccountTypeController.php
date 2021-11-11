<?php

namespace Uasoft\Badaso\Module\HRM\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\HRM\Models\AccountType;
use Uasoft\Badaso\Module\HRM\Schema\Inputs\AccountTypeInput;

class AccountTypeController extends Controller
{
    /**
     * @OA\Post(
     *      path="/module/hrm/v1/account-type",
     *      operationId="AddAccountType",
     *      tags={"Account Types"},
     *      summary="Add new account_types",
     *      description="Add a new account_types",
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
     *          @OA\JsonContent(ref="#/components/schemas/AccountTypeInput")
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
            $account_types_input = new AccountTypeInput($request);

            $account_types = AccountType::create([
                  'name' => $account_types_input->name,
              'company_id' => $account_types_input->company_id,
              'include_initial_balence' => $account_types_input->include_initial_balence,
              'type' => $account_types_input->type,
              'internal_group' => $account_types_input->internal_group,
              'note' => $account_types_input->note,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $account_types->company = $account_types->company ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $account_types->account_type_accounts = $account_types->accountTypeAccounts ;
            $account_types->group_account_type_tax_account_payables = $account_types->groupAccountTypeTaxAccountPayables ;
 
            }

            return ApiResponse::success(compact('account_types'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/account-type",
     *      operationId="BrowseAccountType",
     *      tags={"Account Types"},
     *      summary="Browse account_types",
     *      description="Browse account_types",
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

            $account_types = new AccountType();
            $account_types_fillable = $account_types->getFillable();

            $filter_fields = $request->get('filter_fields', '*');
            $filter_fields = explode(',', $filter_fields);
            if (array_search('*', $filter_fields) == false) {
                $new_filter_fields = [];
                foreach ($filter_fields as $index => $field) {
                    if (!in_array($field, $filter_fields)) {
                        $new_filter_fields[] = $field;
                    }
                }
                $account_types = $account_types->select($filter_fields);
            }

            $filter_fields_search = $request->get('filter_fields_search', '*');
            $filter_fields_search = explode(',', $filter_fields_search);
            if (isset($request->search)) {
                if (array_search('*', $filter_fields_search) == false) {
                    foreach ($account_types_fillable as $index => $field) {
                        $account_types = $account_types->orWhere($field, "like", "%$request->search%");
                    }
                } else {
                    foreach ($filter_fields_search as $index => $field) {
                        if (in_array($field, $account_types_fillable)) {
                            $account_types = $account_types->orWhere($field, "like", "%$request->search%");
                        }
                    }
                }
            }

            if ($request->get('show_pagination', 'true') == 'true') {
                $max_page = $request->get('max_page', 15);
                $account_types = $account_types->paginate($max_page);
            } else {
                $account_types = $account_types->get();
            }

            $account_types->map(function($account_types) use ($request){

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $account_types->company = $account_types->company ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $account_types->account_type_accounts = $account_types->accountTypeAccounts ;
            $account_types->group_account_type_tax_account_payables = $account_types->groupAccountTypeTaxAccountPayables ;
 
            }

                return $account_types ;
            });
            $account_types = $account_types->toArray();

            return ApiResponse::success(compact('account_types'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/account-type/{id}",
     *      operationId="ReadAccountType",
     *      tags={"Account Types"},
     *      summary="Read account_types",
     *      description="Read account_types",
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

            $account_types = AccountType::find($id);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $account_types->company = $account_types->company ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $account_types->account_type_accounts = $account_types->accountTypeAccounts ;
            $account_types->group_account_type_tax_account_payables = $account_types->groupAccountTypeTaxAccountPayables ;
 
            }

            return ApiResponse::success(compact('account_types'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Put(
     *      path="/module/hrm/v1/account-type/{id}",
     *      operationId="UpdateAccountType",
     *      tags={"Account Types"},
     *      summary="Update account_types",
     *      description="Update account_types",
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
     *          @OA\JsonContent(ref="#/components/schemas/AccountTypeInput")
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
            $account_types_input = new AccountTypeInput($request);
            $account_types = AccountType::find($id);

            $account_types->update([
                  'name' => $account_types_input->name == null ? $account_types->name : $account_types_input->name,
              'company_id' => $account_types_input->company_id == null ? $account_types->company_id : $account_types_input->company_id,
              'include_initial_balence' => $account_types_input->include_initial_balence == null ? $account_types->include_initial_balence : $account_types_input->include_initial_balence,
              'type' => $account_types_input->type == null ? $account_types->type : $account_types_input->type,
              'internal_group' => $account_types_input->internal_group == null ? $account_types->internal_group : $account_types_input->internal_group,
              'note' => $account_types_input->note == null ? $account_types->note : $account_types_input->note,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $account_types->company = $account_types->company ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $account_types->account_type_accounts = $account_types->accountTypeAccounts ;
            $account_types->group_account_type_tax_account_payables = $account_types->groupAccountTypeTaxAccountPayables ;
 
            }

            return ApiResponse::success(compact('account_types'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }


    /**
     * @OA\Delete(
     *      path="/module/hrm/v1/account-type/{id}",
     *      operationId="DeleteAccountType",
     *      tags={"Account Types"},
     *      summary="Delete account_types",
     *      description="Delete account_types",
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
            $account_types = AccountType::find($id);

            $account_types->delete();

            return ApiResponse::success();
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }
}

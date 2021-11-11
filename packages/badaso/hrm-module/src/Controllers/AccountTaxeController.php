<?php

namespace Uasoft\Badaso\Module\HRM\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\HRM\Models\AccountTaxe;
use Uasoft\Badaso\Module\HRM\Schema\Inputs\AccountTaxeInput;

class AccountTaxeController extends Controller
{
    /**
     * @OA\Post(
     *      path="/module/hrm/v1/account-taxe",
     *      operationId="AddAccountTaxe",
     *      tags={"Account Taxes"},
     *      summary="Add new account_taxes",
     *      description="Add a new account_taxes",
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
     *          @OA\JsonContent(ref="#/components/schemas/AccountTaxeInput")
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
            $account_taxes_input = new AccountTaxeInput($request);

            $account_taxes = AccountTaxe::create([
                  'name' => $account_taxes_input->name,
              'type_tax_use' => $account_taxes_input->type_tax_use,
              'tax_scope' => $account_taxes_input->tax_scope,
              'amount_type' => $account_taxes_input->amount_type,
              'is_active' => $account_taxes_input->is_active,
              'company_id' => $account_taxes_input->company_id,
              'sequnce' => $account_taxes_input->sequnce,
              'amount' => $account_taxes_input->amount,
              'description' => $account_taxes_input->description,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $account_taxes->company = $account_taxes->company ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $account_taxes->default_account_tax_tax_account_payables = $account_taxes->defaultAccountTaxTaxAccountPayables ;
 
            }

            return ApiResponse::success(compact('account_taxes'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/account-taxe",
     *      operationId="BrowseAccountTaxe",
     *      tags={"Account Taxes"},
     *      summary="Browse account_taxes",
     *      description="Browse account_taxes",
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

            $account_taxes = new AccountTaxe();
            $account_taxes_fillable = $account_taxes->getFillable();

            $filter_fields = $request->get('filter_fields', '*');
            $filter_fields = explode(',', $filter_fields);
            if (array_search('*', $filter_fields) == false) {
                $new_filter_fields = [];
                foreach ($filter_fields as $index => $field) {
                    if (!in_array($field, $filter_fields)) {
                        $new_filter_fields[] = $field;
                    }
                }
                $account_taxes = $account_taxes->select($filter_fields);
            }

            $filter_fields_search = $request->get('filter_fields_search', '*');
            $filter_fields_search = explode(',', $filter_fields_search);
            if (isset($request->search)) {
                if (array_search('*', $filter_fields_search) == false) {
                    foreach ($account_taxes_fillable as $index => $field) {
                        $account_taxes = $account_taxes->orWhere($field, "like", "%$request->search%");
                    }
                } else {
                    foreach ($filter_fields_search as $index => $field) {
                        if (in_array($field, $account_taxes_fillable)) {
                            $account_taxes = $account_taxes->orWhere($field, "like", "%$request->search%");
                        }
                    }
                }
            }

            if ($request->get('show_pagination', 'true') == 'true') {
                $max_page = $request->get('max_page', 15);
                $account_taxes = $account_taxes->paginate($max_page);
            } else {
                $account_taxes = $account_taxes->get();
            }

            $account_taxes->map(function($account_taxes) use ($request){

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $account_taxes->company = $account_taxes->company ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $account_taxes->default_account_tax_tax_account_payables = $account_taxes->defaultAccountTaxTaxAccountPayables ;
 
            }

                return $account_taxes ;
            });
            $account_taxes = $account_taxes->toArray();

            return ApiResponse::success(compact('account_taxes'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/account-taxe/{id}",
     *      operationId="ReadAccountTaxe",
     *      tags={"Account Taxes"},
     *      summary="Read account_taxes",
     *      description="Read account_taxes",
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

            $account_taxes = AccountTaxe::find($id);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $account_taxes->company = $account_taxes->company ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $account_taxes->default_account_tax_tax_account_payables = $account_taxes->defaultAccountTaxTaxAccountPayables ;
 
            }

            return ApiResponse::success(compact('account_taxes'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Put(
     *      path="/module/hrm/v1/account-taxe/{id}",
     *      operationId="UpdateAccountTaxe",
     *      tags={"Account Taxes"},
     *      summary="Update account_taxes",
     *      description="Update account_taxes",
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
     *          @OA\JsonContent(ref="#/components/schemas/AccountTaxeInput")
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
            $account_taxes_input = new AccountTaxeInput($request);
            $account_taxes = AccountTaxe::find($id);

            $account_taxes->update([
                  'name' => $account_taxes_input->name == null ? $account_taxes->name : $account_taxes_input->name,
              'type_tax_use' => $account_taxes_input->type_tax_use == null ? $account_taxes->type_tax_use : $account_taxes_input->type_tax_use,
              'tax_scope' => $account_taxes_input->tax_scope == null ? $account_taxes->tax_scope : $account_taxes_input->tax_scope,
              'amount_type' => $account_taxes_input->amount_type == null ? $account_taxes->amount_type : $account_taxes_input->amount_type,
              'is_active' => $account_taxes_input->is_active == null ? $account_taxes->is_active : $account_taxes_input->is_active,
              'company_id' => $account_taxes_input->company_id == null ? $account_taxes->company_id : $account_taxes_input->company_id,
              'sequnce' => $account_taxes_input->sequnce == null ? $account_taxes->sequnce : $account_taxes_input->sequnce,
              'amount' => $account_taxes_input->amount == null ? $account_taxes->amount : $account_taxes_input->amount,
              'description' => $account_taxes_input->description == null ? $account_taxes->description : $account_taxes_input->description,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $account_taxes->company = $account_taxes->company ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $account_taxes->default_account_tax_tax_account_payables = $account_taxes->defaultAccountTaxTaxAccountPayables ;
 
            }

            return ApiResponse::success(compact('account_taxes'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }


    /**
     * @OA\Delete(
     *      path="/module/hrm/v1/account-taxe/{id}",
     *      operationId="DeleteAccountTaxe",
     *      tags={"Account Taxes"},
     *      summary="Delete account_taxes",
     *      description="Delete account_taxes",
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
            $account_taxes = AccountTaxe::find($id);

            $account_taxes->delete();

            return ApiResponse::success();
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }
}

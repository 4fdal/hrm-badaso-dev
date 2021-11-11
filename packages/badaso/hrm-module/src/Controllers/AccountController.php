<?php

namespace Uasoft\Badaso\Module\HRM\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\HRM\Models\Account;
use Uasoft\Badaso\Module\HRM\Schema\Inputs\AccountInput;

class AccountController extends Controller
{
    /**
     * @OA\Post(
     *      path="/module/hrm/v1/account",
     *      operationId="AddAccount",
     *      tags={"Accounts"},
     *      summary="Add new accounts",
     *      description="Add a new accounts",
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
     *          @OA\JsonContent(ref="#/components/schemas/AccountInput")
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
            $accounts_input = new AccountInput($request);

            $accounts = Account::create([
                  'name' => $accounts_input->name,
              'currency_id' => $accounts_input->currency_id,
              'code' => $accounts_input->code,
              'is_deprecated' => $accounts_input->is_deprecated,
              'account_type_id' => $accounts_input->account_type_id,
              'internal_type' => $accounts_input->internal_type,
              'internal_global' => $accounts_input->internal_global,
              'is_reconcile' => $accounts_input->is_reconcile,
              'note' => $accounts_input->note,
              'company_id' => $accounts_input->company_id,
              'account_group_id' => $accounts_input->account_group_id,
              'root_id' => $accounts_input->root_id,
              'is_off_balance' => $accounts_input->is_off_balance,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $accounts->currency = $accounts->currency ;
         $accounts->account_type = $accounts->account_type ;
         $accounts->company = $accounts->company ;
         $accounts->account_group = $accounts->account_group ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $accounts->default_account_account_journals = $accounts->defaultAccountAccountJournals ;
            $accounts->payment_debit_account_account_journals = $accounts->paymentDebitAccountAccountJournals ;
            $accounts->payment_credit_account_account_journals = $accounts->paymentCreditAccountAccountJournals ;
            $accounts->suspensi_account_account_journals = $accounts->suspensiAccountAccountJournals ;
            $accounts->profit_account_account_journals = $accounts->profitAccountAccountJournals ;
            $accounts->lost_account_account_journals = $accounts->lostAccountAccountJournals ;
 
            }

            return ApiResponse::success(compact('accounts'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/account",
     *      operationId="BrowseAccount",
     *      tags={"Accounts"},
     *      summary="Browse accounts",
     *      description="Browse accounts",
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

            $accounts = new Account();
            $accounts_fillable = $accounts->getFillable();

            $filter_fields = $request->get('filter_fields', '*');
            $filter_fields = explode(',', $filter_fields);
            if (array_search('*', $filter_fields) == false) {
                $new_filter_fields = [];
                foreach ($filter_fields as $index => $field) {
                    if (!in_array($field, $filter_fields)) {
                        $new_filter_fields[] = $field;
                    }
                }
                $accounts = $accounts->select($filter_fields);
            }

            $filter_fields_search = $request->get('filter_fields_search', '*');
            $filter_fields_search = explode(',', $filter_fields_search);
            if (isset($request->search)) {
                if (array_search('*', $filter_fields_search) == false) {
                    foreach ($accounts_fillable as $index => $field) {
                        $accounts = $accounts->orWhere($field, "like", "%$request->search%");
                    }
                } else {
                    foreach ($filter_fields_search as $index => $field) {
                        if (in_array($field, $accounts_fillable)) {
                            $accounts = $accounts->orWhere($field, "like", "%$request->search%");
                        }
                    }
                }
            }

            if ($request->get('show_pagination', 'true') == 'true') {
                $max_page = $request->get('max_page', 15);
                $accounts = $accounts->paginate($max_page);
            } else {
                $accounts = $accounts->get();
            }

            $accounts->map(function($accounts) use ($request){

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $accounts->currency = $accounts->currency ;
         $accounts->account_type = $accounts->account_type ;
         $accounts->company = $accounts->company ;
         $accounts->account_group = $accounts->account_group ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $accounts->default_account_account_journals = $accounts->defaultAccountAccountJournals ;
            $accounts->payment_debit_account_account_journals = $accounts->paymentDebitAccountAccountJournals ;
            $accounts->payment_credit_account_account_journals = $accounts->paymentCreditAccountAccountJournals ;
            $accounts->suspensi_account_account_journals = $accounts->suspensiAccountAccountJournals ;
            $accounts->profit_account_account_journals = $accounts->profitAccountAccountJournals ;
            $accounts->lost_account_account_journals = $accounts->lostAccountAccountJournals ;
 
            }

                return $accounts ;
            });
            $accounts = $accounts->toArray();

            return ApiResponse::success(compact('accounts'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/account/{id}",
     *      operationId="ReadAccount",
     *      tags={"Accounts"},
     *      summary="Read accounts",
     *      description="Read accounts",
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

            $accounts = Account::find($id);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $accounts->currency = $accounts->currency ;
         $accounts->account_type = $accounts->account_type ;
         $accounts->company = $accounts->company ;
         $accounts->account_group = $accounts->account_group ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $accounts->default_account_account_journals = $accounts->defaultAccountAccountJournals ;
            $accounts->payment_debit_account_account_journals = $accounts->paymentDebitAccountAccountJournals ;
            $accounts->payment_credit_account_account_journals = $accounts->paymentCreditAccountAccountJournals ;
            $accounts->suspensi_account_account_journals = $accounts->suspensiAccountAccountJournals ;
            $accounts->profit_account_account_journals = $accounts->profitAccountAccountJournals ;
            $accounts->lost_account_account_journals = $accounts->lostAccountAccountJournals ;
 
            }

            return ApiResponse::success(compact('accounts'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Put(
     *      path="/module/hrm/v1/account/{id}",
     *      operationId="UpdateAccount",
     *      tags={"Accounts"},
     *      summary="Update accounts",
     *      description="Update accounts",
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
     *          @OA\JsonContent(ref="#/components/schemas/AccountInput")
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
            $accounts_input = new AccountInput($request);
            $accounts = Account::find($id);

            $accounts->update([
                  'name' => $accounts_input->name == null ? $accounts->name : $accounts_input->name,
              'currency_id' => $accounts_input->currency_id == null ? $accounts->currency_id : $accounts_input->currency_id,
              'code' => $accounts_input->code == null ? $accounts->code : $accounts_input->code,
              'is_deprecated' => $accounts_input->is_deprecated == null ? $accounts->is_deprecated : $accounts_input->is_deprecated,
              'account_type_id' => $accounts_input->account_type_id == null ? $accounts->account_type_id : $accounts_input->account_type_id,
              'internal_type' => $accounts_input->internal_type == null ? $accounts->internal_type : $accounts_input->internal_type,
              'internal_global' => $accounts_input->internal_global == null ? $accounts->internal_global : $accounts_input->internal_global,
              'is_reconcile' => $accounts_input->is_reconcile == null ? $accounts->is_reconcile : $accounts_input->is_reconcile,
              'note' => $accounts_input->note == null ? $accounts->note : $accounts_input->note,
              'company_id' => $accounts_input->company_id == null ? $accounts->company_id : $accounts_input->company_id,
              'account_group_id' => $accounts_input->account_group_id == null ? $accounts->account_group_id : $accounts_input->account_group_id,
              'root_id' => $accounts_input->root_id == null ? $accounts->root_id : $accounts_input->root_id,
              'is_off_balance' => $accounts_input->is_off_balance == null ? $accounts->is_off_balance : $accounts_input->is_off_balance,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $accounts->currency = $accounts->currency ;
         $accounts->account_type = $accounts->account_type ;
         $accounts->company = $accounts->company ;
         $accounts->account_group = $accounts->account_group ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $accounts->default_account_account_journals = $accounts->defaultAccountAccountJournals ;
            $accounts->payment_debit_account_account_journals = $accounts->paymentDebitAccountAccountJournals ;
            $accounts->payment_credit_account_account_journals = $accounts->paymentCreditAccountAccountJournals ;
            $accounts->suspensi_account_account_journals = $accounts->suspensiAccountAccountJournals ;
            $accounts->profit_account_account_journals = $accounts->profitAccountAccountJournals ;
            $accounts->lost_account_account_journals = $accounts->lostAccountAccountJournals ;
 
            }

            return ApiResponse::success(compact('accounts'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }


    /**
     * @OA\Delete(
     *      path="/module/hrm/v1/account/{id}",
     *      operationId="DeleteAccount",
     *      tags={"Accounts"},
     *      summary="Delete accounts",
     *      description="Delete accounts",
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
            $accounts = Account::find($id);

            $accounts->delete();

            return ApiResponse::success();
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }
}

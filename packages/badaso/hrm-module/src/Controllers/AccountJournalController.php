<?php

namespace Uasoft\Badaso\Module\HRM\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\HRM\Models\AccountJournal;
use Uasoft\Badaso\Module\HRM\Schema\Inputs\AccountJournalInput;

class AccountJournalController extends Controller
{
    /**
     * @OA\Post(
     *      path="/module/hrm/v1/account-journal",
     *      operationId="AddAccountJournal",
     *      tags={"Account Journals"},
     *      summary="Add new account_journals",
     *      description="Add a new account_journals",
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
     *          @OA\JsonContent(ref="#/components/schemas/AccountJournalInput")
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
            $account_journals_input = new AccountJournalInput($request);

            $account_journals = AccountJournal::create([
                  'name' => $account_journals_input->name,
              'code' => $account_journals_input->code,
              'is_active' => $account_journals_input->is_active,
              'type' => $account_journals_input->type,
              'default_account_id' => $account_journals_input->default_account_id,
              'payment_debit_account_id' => $account_journals_input->payment_debit_account_id,
              'payment_credit_account_id' => $account_journals_input->payment_credit_account_id,
              'suspensi_account_id' => $account_journals_input->suspensi_account_id,
              'sequnce' => $account_journals_input->sequnce,
              'invoice_reference_type' => $account_journals_input->invoice_reference_type,
              'invoice_reference_model' => $account_journals_input->invoice_reference_model,
              'currency_id' => $account_journals_input->currency_id,
              'company_id' => $account_journals_input->company_id,
              'is_refund_squence' => $account_journals_input->is_refund_squence,
              'is_least_one_inbound' => $account_journals_input->is_least_one_inbound,
              'is_least_one_outbound' => $account_journals_input->is_least_one_outbound,
              'profit_account_id' => $account_journals_input->profit_account_id,
              'lost_account_id' => $account_journals_input->lost_account_id,
              'partner_bank_id' => $account_journals_input->partner_bank_id,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $account_journals->default_account = $account_journals->default_account ;
         $account_journals->payment_debit_account = $account_journals->payment_debit_account ;
         $account_journals->payment_credit_account = $account_journals->payment_credit_account ;
         $account_journals->suspensi_account = $account_journals->suspensi_account ;
         $account_journals->currency = $account_journals->currency ;
         $account_journals->company = $account_journals->company ;
         $account_journals->profit_account = $account_journals->profit_account ;
         $account_journals->lost_account = $account_journals->lost_account ;
         $account_journals->partner_bank = $account_journals->partner_bank ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $account_journals->account_journal_tax_current_account_journals = $account_journals->accountJournalTaxCurrentAccountJournals ;
 
            }

            return ApiResponse::success(compact('account_journals'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/account-journal",
     *      operationId="BrowseAccountJournal",
     *      tags={"Account Journals"},
     *      summary="Browse account_journals",
     *      description="Browse account_journals",
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

            $account_journals = new AccountJournal();
            $account_journals_fillable = $account_journals->getFillable();

            $filter_fields = $request->get('filter_fields', '*');
            $filter_fields = explode(',', $filter_fields);
            if (array_search('*', $filter_fields) == false) {
                $new_filter_fields = [];
                foreach ($filter_fields as $index => $field) {
                    if (!in_array($field, $filter_fields)) {
                        $new_filter_fields[] = $field;
                    }
                }
                $account_journals = $account_journals->select($filter_fields);
            }

            $filter_fields_search = $request->get('filter_fields_search', '*');
            $filter_fields_search = explode(',', $filter_fields_search);
            if (isset($request->search)) {
                if (array_search('*', $filter_fields_search) == false) {
                    foreach ($account_journals_fillable as $index => $field) {
                        $account_journals = $account_journals->orWhere($field, "like", "%$request->search%");
                    }
                } else {
                    foreach ($filter_fields_search as $index => $field) {
                        if (in_array($field, $account_journals_fillable)) {
                            $account_journals = $account_journals->orWhere($field, "like", "%$request->search%");
                        }
                    }
                }
            }

            if ($request->get('show_pagination', 'true') == 'true') {
                $max_page = $request->get('max_page', 15);
                $account_journals = $account_journals->paginate($max_page);
            } else {
                $account_journals = $account_journals->get();
            }

            $account_journals->map(function($account_journals) use ($request){

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $account_journals->default_account = $account_journals->default_account ;
         $account_journals->payment_debit_account = $account_journals->payment_debit_account ;
         $account_journals->payment_credit_account = $account_journals->payment_credit_account ;
         $account_journals->suspensi_account = $account_journals->suspensi_account ;
         $account_journals->currency = $account_journals->currency ;
         $account_journals->company = $account_journals->company ;
         $account_journals->profit_account = $account_journals->profit_account ;
         $account_journals->lost_account = $account_journals->lost_account ;
         $account_journals->partner_bank = $account_journals->partner_bank ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $account_journals->account_journal_tax_current_account_journals = $account_journals->accountJournalTaxCurrentAccountJournals ;
 
            }

                return $account_journals ;
            });
            $account_journals = $account_journals->toArray();

            return ApiResponse::success(compact('account_journals'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/account-journal/{id}",
     *      operationId="ReadAccountJournal",
     *      tags={"Account Journals"},
     *      summary="Read account_journals",
     *      description="Read account_journals",
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

            $account_journals = AccountJournal::find($id);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $account_journals->default_account = $account_journals->default_account ;
         $account_journals->payment_debit_account = $account_journals->payment_debit_account ;
         $account_journals->payment_credit_account = $account_journals->payment_credit_account ;
         $account_journals->suspensi_account = $account_journals->suspensi_account ;
         $account_journals->currency = $account_journals->currency ;
         $account_journals->company = $account_journals->company ;
         $account_journals->profit_account = $account_journals->profit_account ;
         $account_journals->lost_account = $account_journals->lost_account ;
         $account_journals->partner_bank = $account_journals->partner_bank ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $account_journals->account_journal_tax_current_account_journals = $account_journals->accountJournalTaxCurrentAccountJournals ;
 
            }

            return ApiResponse::success(compact('account_journals'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Put(
     *      path="/module/hrm/v1/account-journal/{id}",
     *      operationId="UpdateAccountJournal",
     *      tags={"Account Journals"},
     *      summary="Update account_journals",
     *      description="Update account_journals",
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
     *          @OA\JsonContent(ref="#/components/schemas/AccountJournalInput")
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
            $account_journals_input = new AccountJournalInput($request);
            $account_journals = AccountJournal::find($id);

            $account_journals->update([
                  'name' => $account_journals_input->name == null ? $account_journals->name : $account_journals_input->name,
              'code' => $account_journals_input->code == null ? $account_journals->code : $account_journals_input->code,
              'is_active' => $account_journals_input->is_active == null ? $account_journals->is_active : $account_journals_input->is_active,
              'type' => $account_journals_input->type == null ? $account_journals->type : $account_journals_input->type,
              'default_account_id' => $account_journals_input->default_account_id == null ? $account_journals->default_account_id : $account_journals_input->default_account_id,
              'payment_debit_account_id' => $account_journals_input->payment_debit_account_id == null ? $account_journals->payment_debit_account_id : $account_journals_input->payment_debit_account_id,
              'payment_credit_account_id' => $account_journals_input->payment_credit_account_id == null ? $account_journals->payment_credit_account_id : $account_journals_input->payment_credit_account_id,
              'suspensi_account_id' => $account_journals_input->suspensi_account_id == null ? $account_journals->suspensi_account_id : $account_journals_input->suspensi_account_id,
              'sequnce' => $account_journals_input->sequnce == null ? $account_journals->sequnce : $account_journals_input->sequnce,
              'invoice_reference_type' => $account_journals_input->invoice_reference_type == null ? $account_journals->invoice_reference_type : $account_journals_input->invoice_reference_type,
              'invoice_reference_model' => $account_journals_input->invoice_reference_model == null ? $account_journals->invoice_reference_model : $account_journals_input->invoice_reference_model,
              'currency_id' => $account_journals_input->currency_id == null ? $account_journals->currency_id : $account_journals_input->currency_id,
              'company_id' => $account_journals_input->company_id == null ? $account_journals->company_id : $account_journals_input->company_id,
              'is_refund_squence' => $account_journals_input->is_refund_squence == null ? $account_journals->is_refund_squence : $account_journals_input->is_refund_squence,
              'is_least_one_inbound' => $account_journals_input->is_least_one_inbound == null ? $account_journals->is_least_one_inbound : $account_journals_input->is_least_one_inbound,
              'is_least_one_outbound' => $account_journals_input->is_least_one_outbound == null ? $account_journals->is_least_one_outbound : $account_journals_input->is_least_one_outbound,
              'profit_account_id' => $account_journals_input->profit_account_id == null ? $account_journals->profit_account_id : $account_journals_input->profit_account_id,
              'lost_account_id' => $account_journals_input->lost_account_id == null ? $account_journals->lost_account_id : $account_journals_input->lost_account_id,
              'partner_bank_id' => $account_journals_input->partner_bank_id == null ? $account_journals->partner_bank_id : $account_journals_input->partner_bank_id,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $account_journals->default_account = $account_journals->default_account ;
         $account_journals->payment_debit_account = $account_journals->payment_debit_account ;
         $account_journals->payment_credit_account = $account_journals->payment_credit_account ;
         $account_journals->suspensi_account = $account_journals->suspensi_account ;
         $account_journals->currency = $account_journals->currency ;
         $account_journals->company = $account_journals->company ;
         $account_journals->profit_account = $account_journals->profit_account ;
         $account_journals->lost_account = $account_journals->lost_account ;
         $account_journals->partner_bank = $account_journals->partner_bank ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $account_journals->account_journal_tax_current_account_journals = $account_journals->accountJournalTaxCurrentAccountJournals ;
 
            }

            return ApiResponse::success(compact('account_journals'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }


    /**
     * @OA\Delete(
     *      path="/module/hrm/v1/account-journal/{id}",
     *      operationId="DeleteAccountJournal",
     *      tags={"Account Journals"},
     *      summary="Delete account_journals",
     *      description="Delete account_journals",
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
            $account_journals = AccountJournal::find($id);

            $account_journals->delete();

            return ApiResponse::success();
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }
}

<?php

namespace Uasoft\Badaso\Module\HRM\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\HRM\Models\AccountingTaxe;
use Uasoft\Badaso\Module\HRM\Schema\Inputs\AccountingTaxeInput;

class AccountingTaxeController extends Controller
{
    /**
     * @OA\Post(
     *      path="/module/hrm/v1/accounting-taxe",
     *      operationId="AddAccountingTaxe",
     *      tags={"Accounting Taxes"},
     *      summary="Add new accounting_taxes",
     *      description="Add a new accounting_taxes",
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
     *          @OA\JsonContent(ref="#/components/schemas/AccountingTaxeInput")
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
            $accounting_taxes_input = new AccountingTaxeInput($request);

            $accounting_taxes = AccountingTaxe::create([
                  'tax_name' => $accounting_taxes_input->tax_name,
              'tax_computation' => $accounting_taxes_input->tax_computation,
              'is_active' => $accounting_taxes_input->is_active,
              'tax_type' => $accounting_taxes_input->tax_type,
              'tax_score' => $accounting_taxes_input->tax_score,
              'amount' => $accounting_taxes_input->amount,
              'accountig_type' => $accounting_taxes_input->accountig_type,
              'label_invoice' => $accounting_taxes_input->label_invoice,
              'taxes_group_id' => $accounting_taxes_input->taxes_group_id,
              'is_include_price' => $accounting_taxes_input->is_include_price,
              'is_subsequent_tax' => $accounting_taxes_input->is_subsequent_tax,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
    
            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $accounting_taxes->accounting_tax_accounting_distribution_invoices = $accounting_taxes->accountingTaxAccountingDistributionInvoices ;
            $accounting_taxes->accounting_tax_accounting_distribution_credit_notes = $accounting_taxes->accountingTaxAccountingDistributionCreditNotes ;
            $accounting_taxes->accounting_tax_expense_vendor_accounting_tax = $accounting_taxes->accountingTaxExpenseVendorAccountingTax ;
            $accounting_taxes->accounting_tax_expense_customer_accounting_tax = $accounting_taxes->accountingTaxExpenseCustomerAccountingTax ;
 
            }

            return ApiResponse::success(compact('accounting_taxes'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/accounting-taxe",
     *      operationId="BrowseAccountingTaxe",
     *      tags={"Accounting Taxes"},
     *      summary="Browse accounting_taxes",
     *      description="Browse accounting_taxes",
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

            $accounting_taxes = new AccountingTaxe();
            $accounting_taxes_fillable = $accounting_taxes->getFillable();

            $filter_fields = $request->get('filter_fields', '*');
            $filter_fields = explode(',', $filter_fields);
            if (array_search('*', $filter_fields) == false) {
                $new_filter_fields = [];
                foreach ($filter_fields as $index => $field) {
                    if (!in_array($field, $filter_fields)) {
                        $new_filter_fields[] = $field;
                    }
                }
                $accounting_taxes = $accounting_taxes->select($filter_fields);
            }

            $filter_fields_search = $request->get('filter_fields_search', '*');
            $filter_fields_search = explode(',', $filter_fields_search);
            if (isset($request->search)) {
                if (array_search('*', $filter_fields_search) == false) {
                    foreach ($accounting_taxes_fillable as $index => $field) {
                        $accounting_taxes = $accounting_taxes->orWhere($field, "like", "%$request->search%");
                    }
                } else {
                    foreach ($filter_fields_search as $index => $field) {
                        if (in_array($field, $accounting_taxes_fillable)) {
                            $accounting_taxes = $accounting_taxes->orWhere($field, "like", "%$request->search%");
                        }
                    }
                }
            }

            if ($request->get('show_pagination', 'true') == 'true') {
                $max_page = $request->get('max_page', 15);
                $accounting_taxes = $accounting_taxes->paginate($max_page);
            } else {
                $accounting_taxes = $accounting_taxes->get();
            }

            $accounting_taxes->map(function($accounting_taxes) use ($request){

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
    
            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $accounting_taxes->accounting_tax_accounting_distribution_invoices = $accounting_taxes->accountingTaxAccountingDistributionInvoices ;
            $accounting_taxes->accounting_tax_accounting_distribution_credit_notes = $accounting_taxes->accountingTaxAccountingDistributionCreditNotes ;
            $accounting_taxes->accounting_tax_expense_vendor_accounting_tax = $accounting_taxes->accountingTaxExpenseVendorAccountingTax ;
            $accounting_taxes->accounting_tax_expense_customer_accounting_tax = $accounting_taxes->accountingTaxExpenseCustomerAccountingTax ;
 
            }

                return $accounting_taxes ;
            });
            $accounting_taxes = $accounting_taxes->toArray();

            return ApiResponse::success(compact('accounting_taxes'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/accounting-taxe/{id}",
     *      operationId="ReadAccountingTaxe",
     *      tags={"Accounting Taxes"},
     *      summary="Read accounting_taxes",
     *      description="Read accounting_taxes",
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

            $accounting_taxes = AccountingTaxe::find($id);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
    
            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $accounting_taxes->accounting_tax_accounting_distribution_invoices = $accounting_taxes->accountingTaxAccountingDistributionInvoices ;
            $accounting_taxes->accounting_tax_accounting_distribution_credit_notes = $accounting_taxes->accountingTaxAccountingDistributionCreditNotes ;
            $accounting_taxes->accounting_tax_expense_vendor_accounting_tax = $accounting_taxes->accountingTaxExpenseVendorAccountingTax ;
            $accounting_taxes->accounting_tax_expense_customer_accounting_tax = $accounting_taxes->accountingTaxExpenseCustomerAccountingTax ;
 
            }

            return ApiResponse::success(compact('accounting_taxes'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Put(
     *      path="/module/hrm/v1/accounting-taxe/{id}",
     *      operationId="UpdateAccountingTaxe",
     *      tags={"Accounting Taxes"},
     *      summary="Update accounting_taxes",
     *      description="Update accounting_taxes",
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
     *          @OA\JsonContent(ref="#/components/schemas/AccountingTaxeInput")
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
            $accounting_taxes_input = new AccountingTaxeInput($request);
            $accounting_taxes = AccountingTaxe::find($id);

            $accounting_taxes->update([
                  'tax_name' => $accounting_taxes_input->tax_name == null ? $accounting_taxes->tax_name : $accounting_taxes_input->tax_name,
              'tax_computation' => $accounting_taxes_input->tax_computation == null ? $accounting_taxes->tax_computation : $accounting_taxes_input->tax_computation,
              'is_active' => $accounting_taxes_input->is_active == null ? $accounting_taxes->is_active : $accounting_taxes_input->is_active,
              'tax_type' => $accounting_taxes_input->tax_type == null ? $accounting_taxes->tax_type : $accounting_taxes_input->tax_type,
              'tax_score' => $accounting_taxes_input->tax_score == null ? $accounting_taxes->tax_score : $accounting_taxes_input->tax_score,
              'amount' => $accounting_taxes_input->amount == null ? $accounting_taxes->amount : $accounting_taxes_input->amount,
              'accountig_type' => $accounting_taxes_input->accountig_type == null ? $accounting_taxes->accountig_type : $accounting_taxes_input->accountig_type,
              'label_invoice' => $accounting_taxes_input->label_invoice == null ? $accounting_taxes->label_invoice : $accounting_taxes_input->label_invoice,
              'taxes_group_id' => $accounting_taxes_input->taxes_group_id == null ? $accounting_taxes->taxes_group_id : $accounting_taxes_input->taxes_group_id,
              'is_include_price' => $accounting_taxes_input->is_include_price == null ? $accounting_taxes->is_include_price : $accounting_taxes_input->is_include_price,
              'is_subsequent_tax' => $accounting_taxes_input->is_subsequent_tax == null ? $accounting_taxes->is_subsequent_tax : $accounting_taxes_input->is_subsequent_tax,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
    
            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $accounting_taxes->accounting_tax_accounting_distribution_invoices = $accounting_taxes->accountingTaxAccountingDistributionInvoices ;
            $accounting_taxes->accounting_tax_accounting_distribution_credit_notes = $accounting_taxes->accountingTaxAccountingDistributionCreditNotes ;
            $accounting_taxes->accounting_tax_expense_vendor_accounting_tax = $accounting_taxes->accountingTaxExpenseVendorAccountingTax ;
            $accounting_taxes->accounting_tax_expense_customer_accounting_tax = $accounting_taxes->accountingTaxExpenseCustomerAccountingTax ;
 
            }

            return ApiResponse::success(compact('accounting_taxes'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }


    /**
     * @OA\Delete(
     *      path="/module/hrm/v1/accounting-taxe/{id}",
     *      operationId="DeleteAccountingTaxe",
     *      tags={"Accounting Taxes"},
     *      summary="Delete accounting_taxes",
     *      description="Delete accounting_taxes",
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
            $accounting_taxes = AccountingTaxe::find($id);

            $accounting_taxes->delete();

            return ApiResponse::success();
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }
}

<?php

namespace Uasoft\Badaso\Module\HRM\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\HRM\Models\ExpenseCustomerAccountingTa;
use Uasoft\Badaso\Module\HRM\Schema\Inputs\ExpenseCustomerAccountingTaInput;

class ExpenseCustomerAccountingTaxController extends Controller
{
    /**
     * @OA\Post(
     *      path="/module/hrm/v1/expense-customer-accounting-tax",
     *      operationId="AddExpenseCustomerAccountingTa",
     *      tags={"Expense Customer Accounting Tax"},
     *      summary="Add new expense_customer_accounting_tax",
     *      description="Add a new expense_customer_accounting_tax",
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
     *          @OA\JsonContent(ref="#/components/schemas/ExpenseCustomerAccountingTaInput")
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
            $expense_customer_accounting_tax_input = new ExpenseCustomerAccountingTaInput($request);

            $expense_customer_accounting_tax = ExpenseCustomerAccountingTa::create([
                  'expense_product_id' => $expense_customer_accounting_tax_input->expense_product_id,
              'accounting_tax_id' => $expense_customer_accounting_tax_input->accounting_tax_id,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $expense_customer_accounting_tax->expense_product = $expense_customer_accounting_tax->expense_product ;
         $expense_customer_accounting_tax->accounting_tax = $expense_customer_accounting_tax->accounting_tax ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('expense_customer_accounting_tax'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/expense-customer-accounting-tax",
     *      operationId="BrowseExpenseCustomerAccountingTa",
     *      tags={"Expense Customer Accounting Tax"},
     *      summary="Browse expense_customer_accounting_tax",
     *      description="Browse expense_customer_accounting_tax",
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

            $expense_customer_accounting_tax = new ExpenseCustomerAccountingTa();
            $expense_customer_accounting_tax_fillable = $expense_customer_accounting_tax->getFillable();

            $filter_fields = $request->get('filter_fields', '*');
            $filter_fields = explode(',', $filter_fields);
            if (array_search('*', $filter_fields) == false) {
                $new_filter_fields = [];
                foreach ($filter_fields as $index => $field) {
                    if (!in_array($field, $filter_fields)) {
                        $new_filter_fields[] = $field;
                    }
                }
                $expense_customer_accounting_tax = $expense_customer_accounting_tax->select($filter_fields);
            }

            $filter_fields_search = $request->get('filter_fields_search', '*');
            $filter_fields_search = explode(',', $filter_fields_search);
            if (isset($request->search)) {
                if (array_search('*', $filter_fields_search) == false) {
                    foreach ($expense_customer_accounting_tax_fillable as $index => $field) {
                        $expense_customer_accounting_tax = $expense_customer_accounting_tax->orWhere($field, "like", "%$request->search%");
                    }
                } else {
                    foreach ($filter_fields_search as $index => $field) {
                        if (in_array($field, $expense_customer_accounting_tax_fillable)) {
                            $expense_customer_accounting_tax = $expense_customer_accounting_tax->orWhere($field, "like", "%$request->search%");
                        }
                    }
                }
            }

            if ($request->get('show_pagination', 'true') == 'true') {
                $max_page = $request->get('max_page', 15);
                $expense_customer_accounting_tax = $expense_customer_accounting_tax->paginate($max_page);
            } else {
                $expense_customer_accounting_tax = $expense_customer_accounting_tax->get();
            }

            $expense_customer_accounting_tax->map(function($expense_customer_accounting_tax) use ($request){

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $expense_customer_accounting_tax->expense_product = $expense_customer_accounting_tax->expense_product ;
         $expense_customer_accounting_tax->accounting_tax = $expense_customer_accounting_tax->accounting_tax ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

                return $expense_customer_accounting_tax ;
            });
            $expense_customer_accounting_tax = $expense_customer_accounting_tax->toArray();

            return ApiResponse::success(compact('expense_customer_accounting_tax'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/expense-customer-accounting-tax/{id}",
     *      operationId="ReadExpenseCustomerAccountingTa",
     *      tags={"Expense Customer Accounting Tax"},
     *      summary="Read expense_customer_accounting_tax",
     *      description="Read expense_customer_accounting_tax",
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

            $expense_customer_accounting_tax = ExpenseCustomerAccountingTa::find($id);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $expense_customer_accounting_tax->expense_product = $expense_customer_accounting_tax->expense_product ;
         $expense_customer_accounting_tax->accounting_tax = $expense_customer_accounting_tax->accounting_tax ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('expense_customer_accounting_tax'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Put(
     *      path="/module/hrm/v1/expense-customer-accounting-tax/{id}",
     *      operationId="UpdateExpenseCustomerAccountingTa",
     *      tags={"Expense Customer Accounting Tax"},
     *      summary="Update expense_customer_accounting_tax",
     *      description="Update expense_customer_accounting_tax",
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
     *          @OA\JsonContent(ref="#/components/schemas/ExpenseCustomerAccountingTaInput")
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
            $expense_customer_accounting_tax_input = new ExpenseCustomerAccountingTaInput($request);
            $expense_customer_accounting_tax = ExpenseCustomerAccountingTa::find($id);

            $expense_customer_accounting_tax->update([
                  'expense_product_id' => $expense_customer_accounting_tax_input->expense_product_id == null ? $expense_customer_accounting_tax->expense_product_id : $expense_customer_accounting_tax_input->expense_product_id,
              'accounting_tax_id' => $expense_customer_accounting_tax_input->accounting_tax_id == null ? $expense_customer_accounting_tax->accounting_tax_id : $expense_customer_accounting_tax_input->accounting_tax_id,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $expense_customer_accounting_tax->expense_product = $expense_customer_accounting_tax->expense_product ;
         $expense_customer_accounting_tax->accounting_tax = $expense_customer_accounting_tax->accounting_tax ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('expense_customer_accounting_tax'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }


    /**
     * @OA\Delete(
     *      path="/module/hrm/v1/expense-customer-accounting-tax/{id}",
     *      operationId="DeleteExpenseCustomerAccountingTa",
     *      tags={"Expense Customer Accounting Tax"},
     *      summary="Delete expense_customer_accounting_tax",
     *      description="Delete expense_customer_accounting_tax",
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
            $expense_customer_accounting_tax = ExpenseCustomerAccountingTa::find($id);

            $expense_customer_accounting_tax->delete();

            return ApiResponse::success();
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }
}

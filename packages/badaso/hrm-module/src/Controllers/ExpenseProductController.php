<?php

namespace Uasoft\Badaso\Module\HRM\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\HRM\Models\ExpenseProduct;
use Uasoft\Badaso\Module\HRM\Schema\Inputs\ExpenseProductInput;

class ExpenseProductController extends Controller
{
    /**
     * @OA\Post(
     *      path="/module/hrm/v1/expense-product",
     *      operationId="AddExpenseProduct",
     *      tags={"Expense Products"},
     *      summary="Add new expense_products",
     *      description="Add a new expense_products",
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
     *          @OA\JsonContent(ref="#/components/schemas/ExpenseProductInput")
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
            $expense_products_input = new ExpenseProductInput($request);

            $expense_products = ExpenseProduct::create([
                  'name' => $expense_products_input->name,
              'cost' => $expense_products_input->cost,
              'internal_reference' => $expense_products_input->internal_reference,
              'company_id' => $expense_products_input->company_id,
              'invoice_policy' => $expense_products_input->invoice_policy,
              're_invoice_exoense' => $expense_products_input->re_invoice_exoense,
              'image_path' => $expense_products_input->image_path,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
    
            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $expense_products->expense_product_expense_vendor_accounting_tax = $expense_products->expenseProductExpenseVendorAccountingTax ;
            $expense_products->expense_product_expense_customer_accounting_tax = $expense_products->expenseProductExpenseCustomerAccountingTax ;
            $expense_products->expense_product_expense_reports = $expense_products->expenseProductExpenseReports ;
 
            }

            return ApiResponse::success(compact('expense_products'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/expense-product",
     *      operationId="BrowseExpenseProduct",
     *      tags={"Expense Products"},
     *      summary="Browse expense_products",
     *      description="Browse expense_products",
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

            $expense_products = new ExpenseProduct();
            $expense_products_fillable = $expense_products->getFillable();

            $filter_fields = $request->get('filter_fields', '*');
            $filter_fields = explode(',', $filter_fields);
            if (array_search('*', $filter_fields) == false) {
                $new_filter_fields = [];
                foreach ($filter_fields as $index => $field) {
                    if (!in_array($field, $filter_fields)) {
                        $new_filter_fields[] = $field;
                    }
                }
                $expense_products = $expense_products->select($filter_fields);
            }

            $filter_fields_search = $request->get('filter_fields_search', '*');
            $filter_fields_search = explode(',', $filter_fields_search);
            if (isset($request->search)) {
                if (array_search('*', $filter_fields_search) == false) {
                    foreach ($expense_products_fillable as $index => $field) {
                        $expense_products = $expense_products->orWhere($field, "like", "%$request->search%");
                    }
                } else {
                    foreach ($filter_fields_search as $index => $field) {
                        if (in_array($field, $expense_products_fillable)) {
                            $expense_products = $expense_products->orWhere($field, "like", "%$request->search%");
                        }
                    }
                }
            }

            if ($request->get('show_pagination', 'true') == 'true') {
                $max_page = $request->get('max_page', 15);
                $expense_products = $expense_products->paginate($max_page);
            } else {
                $expense_products = $expense_products->get();
            }

            $expense_products->map(function($expense_products) use ($request){

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
    
            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $expense_products->expense_product_expense_vendor_accounting_tax = $expense_products->expenseProductExpenseVendorAccountingTax ;
            $expense_products->expense_product_expense_customer_accounting_tax = $expense_products->expenseProductExpenseCustomerAccountingTax ;
            $expense_products->expense_product_expense_reports = $expense_products->expenseProductExpenseReports ;
 
            }

                return $expense_products ;
            });
            $expense_products = $expense_products->toArray();

            return ApiResponse::success(compact('expense_products'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/expense-product/{id}",
     *      operationId="ReadExpenseProduct",
     *      tags={"Expense Products"},
     *      summary="Read expense_products",
     *      description="Read expense_products",
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

            $expense_products = ExpenseProduct::find($id);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
    
            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $expense_products->expense_product_expense_vendor_accounting_tax = $expense_products->expenseProductExpenseVendorAccountingTax ;
            $expense_products->expense_product_expense_customer_accounting_tax = $expense_products->expenseProductExpenseCustomerAccountingTax ;
            $expense_products->expense_product_expense_reports = $expense_products->expenseProductExpenseReports ;
 
            }

            return ApiResponse::success(compact('expense_products'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Put(
     *      path="/module/hrm/v1/expense-product/{id}",
     *      operationId="UpdateExpenseProduct",
     *      tags={"Expense Products"},
     *      summary="Update expense_products",
     *      description="Update expense_products",
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
     *          @OA\JsonContent(ref="#/components/schemas/ExpenseProductInput")
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
            $expense_products_input = new ExpenseProductInput($request);
            $expense_products = ExpenseProduct::find($id);

            $expense_products->update([
                  'name' => $expense_products_input->name == null ? $expense_products->name : $expense_products_input->name,
              'cost' => $expense_products_input->cost == null ? $expense_products->cost : $expense_products_input->cost,
              'internal_reference' => $expense_products_input->internal_reference == null ? $expense_products->internal_reference : $expense_products_input->internal_reference,
              'company_id' => $expense_products_input->company_id == null ? $expense_products->company_id : $expense_products_input->company_id,
              'invoice_policy' => $expense_products_input->invoice_policy == null ? $expense_products->invoice_policy : $expense_products_input->invoice_policy,
              're_invoice_exoense' => $expense_products_input->re_invoice_exoense == null ? $expense_products->re_invoice_exoense : $expense_products_input->re_invoice_exoense,
              'image_path' => $expense_products_input->image_path == null ? $expense_products->image_path : $expense_products_input->image_path,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
    
            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $expense_products->expense_product_expense_vendor_accounting_tax = $expense_products->expenseProductExpenseVendorAccountingTax ;
            $expense_products->expense_product_expense_customer_accounting_tax = $expense_products->expenseProductExpenseCustomerAccountingTax ;
            $expense_products->expense_product_expense_reports = $expense_products->expenseProductExpenseReports ;
 
            }

            return ApiResponse::success(compact('expense_products'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }


    /**
     * @OA\Delete(
     *      path="/module/hrm/v1/expense-product/{id}",
     *      operationId="DeleteExpenseProduct",
     *      tags={"Expense Products"},
     *      summary="Delete expense_products",
     *      description="Delete expense_products",
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
            $expense_products = ExpenseProduct::find($id);

            $expense_products->delete();

            return ApiResponse::success();
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }
}

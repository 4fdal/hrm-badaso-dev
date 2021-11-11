<?php

namespace Uasoft\Badaso\Module\HRM\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\HRM\Models\ExpenseReport;
use Uasoft\Badaso\Module\HRM\Schema\Inputs\ExpenseReportInput;

class ExpenseReportController extends Controller
{
    /**
     * @OA\Post(
     *      path="/module/hrm/v1/expense-report",
     *      operationId="AddExpenseReport",
     *      tags={"Expense Reports"},
     *      summary="Add new expense_reports",
     *      description="Add a new expense_reports",
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
     *          @OA\JsonContent(ref="#/components/schemas/ExpenseReportInput")
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
            $expense_reports_input = new ExpenseReportInput($request);

            $expense_reports = ExpenseReport::create([
                  'description' => $expense_reports_input->description,
              'expense_product_id' => $expense_reports_input->expense_product_id,
              'unit_price' => $expense_reports_input->unit_price,
              'quantity' => $expense_reports_input->quantity,
              'total' => $expense_reports_input->total,
              'amount_due' => $expense_reports_input->amount_due,
              'paid_by' => $expense_reports_input->paid_by,
              'bill_reference' => $expense_reports_input->bill_reference,
              'expense_date' => $expense_reports_input->expense_date,
              'employee_id' => $expense_reports_input->employee_id,
              'company_id' => $expense_reports_input->company_id,
              'note' => $expense_reports_input->note,
              'state_report' => $expense_reports_input->state_report,
              'register_payment_id' => $expense_reports_input->register_payment_id,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $expense_reports->expense_product = $expense_reports->expense_product ;
         $expense_reports->employee = $expense_reports->employee ;
         $expense_reports->company = $expense_reports->company ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $expense_reports->expense_report_expense_report_items = $expense_reports->expenseReportExpenseReportItems ;
 
            }

            return ApiResponse::success(compact('expense_reports'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/expense-report",
     *      operationId="BrowseExpenseReport",
     *      tags={"Expense Reports"},
     *      summary="Browse expense_reports",
     *      description="Browse expense_reports",
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

            $expense_reports = new ExpenseReport();
            $expense_reports_fillable = $expense_reports->getFillable();

            $filter_fields = $request->get('filter_fields', '*');
            $filter_fields = explode(',', $filter_fields);
            if (array_search('*', $filter_fields) == false) {
                $new_filter_fields = [];
                foreach ($filter_fields as $index => $field) {
                    if (!in_array($field, $filter_fields)) {
                        $new_filter_fields[] = $field;
                    }
                }
                $expense_reports = $expense_reports->select($filter_fields);
            }

            $filter_fields_search = $request->get('filter_fields_search', '*');
            $filter_fields_search = explode(',', $filter_fields_search);
            if (isset($request->search)) {
                if (array_search('*', $filter_fields_search) == false) {
                    foreach ($expense_reports_fillable as $index => $field) {
                        $expense_reports = $expense_reports->orWhere($field, "like", "%$request->search%");
                    }
                } else {
                    foreach ($filter_fields_search as $index => $field) {
                        if (in_array($field, $expense_reports_fillable)) {
                            $expense_reports = $expense_reports->orWhere($field, "like", "%$request->search%");
                        }
                    }
                }
            }

            if ($request->get('show_pagination', 'true') == 'true') {
                $max_page = $request->get('max_page', 15);
                $expense_reports = $expense_reports->paginate($max_page);
            } else {
                $expense_reports = $expense_reports->get();
            }

            $expense_reports->map(function($expense_reports) use ($request){

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $expense_reports->expense_product = $expense_reports->expense_product ;
         $expense_reports->employee = $expense_reports->employee ;
         $expense_reports->company = $expense_reports->company ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $expense_reports->expense_report_expense_report_items = $expense_reports->expenseReportExpenseReportItems ;
 
            }

                return $expense_reports ;
            });
            $expense_reports = $expense_reports->toArray();

            return ApiResponse::success(compact('expense_reports'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/expense-report/{id}",
     *      operationId="ReadExpenseReport",
     *      tags={"Expense Reports"},
     *      summary="Read expense_reports",
     *      description="Read expense_reports",
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

            $expense_reports = ExpenseReport::find($id);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $expense_reports->expense_product = $expense_reports->expense_product ;
         $expense_reports->employee = $expense_reports->employee ;
         $expense_reports->company = $expense_reports->company ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $expense_reports->expense_report_expense_report_items = $expense_reports->expenseReportExpenseReportItems ;
 
            }

            return ApiResponse::success(compact('expense_reports'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Put(
     *      path="/module/hrm/v1/expense-report/{id}",
     *      operationId="UpdateExpenseReport",
     *      tags={"Expense Reports"},
     *      summary="Update expense_reports",
     *      description="Update expense_reports",
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
     *          @OA\JsonContent(ref="#/components/schemas/ExpenseReportInput")
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
            $expense_reports_input = new ExpenseReportInput($request);
            $expense_reports = ExpenseReport::find($id);

            $expense_reports->update([
                  'description' => $expense_reports_input->description == null ? $expense_reports->description : $expense_reports_input->description,
              'expense_product_id' => $expense_reports_input->expense_product_id == null ? $expense_reports->expense_product_id : $expense_reports_input->expense_product_id,
              'unit_price' => $expense_reports_input->unit_price == null ? $expense_reports->unit_price : $expense_reports_input->unit_price,
              'quantity' => $expense_reports_input->quantity == null ? $expense_reports->quantity : $expense_reports_input->quantity,
              'total' => $expense_reports_input->total == null ? $expense_reports->total : $expense_reports_input->total,
              'amount_due' => $expense_reports_input->amount_due == null ? $expense_reports->amount_due : $expense_reports_input->amount_due,
              'paid_by' => $expense_reports_input->paid_by == null ? $expense_reports->paid_by : $expense_reports_input->paid_by,
              'bill_reference' => $expense_reports_input->bill_reference == null ? $expense_reports->bill_reference : $expense_reports_input->bill_reference,
              'expense_date' => $expense_reports_input->expense_date == null ? $expense_reports->expense_date : $expense_reports_input->expense_date,
              'employee_id' => $expense_reports_input->employee_id == null ? $expense_reports->employee_id : $expense_reports_input->employee_id,
              'company_id' => $expense_reports_input->company_id == null ? $expense_reports->company_id : $expense_reports_input->company_id,
              'note' => $expense_reports_input->note == null ? $expense_reports->note : $expense_reports_input->note,
              'state_report' => $expense_reports_input->state_report == null ? $expense_reports->state_report : $expense_reports_input->state_report,
              'register_payment_id' => $expense_reports_input->register_payment_id == null ? $expense_reports->register_payment_id : $expense_reports_input->register_payment_id,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $expense_reports->expense_product = $expense_reports->expense_product ;
         $expense_reports->employee = $expense_reports->employee ;
         $expense_reports->company = $expense_reports->company ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $expense_reports->expense_report_expense_report_items = $expense_reports->expenseReportExpenseReportItems ;
 
            }

            return ApiResponse::success(compact('expense_reports'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }


    /**
     * @OA\Delete(
     *      path="/module/hrm/v1/expense-report/{id}",
     *      operationId="DeleteExpenseReport",
     *      tags={"Expense Reports"},
     *      summary="Delete expense_reports",
     *      description="Delete expense_reports",
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
            $expense_reports = ExpenseReport::find($id);

            $expense_reports->delete();

            return ApiResponse::success();
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }
}

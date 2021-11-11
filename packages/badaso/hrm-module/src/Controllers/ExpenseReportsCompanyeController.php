<?php

namespace Uasoft\Badaso\Module\HRM\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\HRM\Models\ExpenseReportsCompanye;
use Uasoft\Badaso\Module\HRM\Schema\Inputs\ExpenseReportsCompanyeInput;

class ExpenseReportsCompanyeController extends Controller
{
    /**
     * @OA\Post(
     *      path="/module/hrm/v1/expense-reports-companye",
     *      operationId="AddExpenseReportsCompanye",
     *      tags={"Expense Reports Companyes"},
     *      summary="Add new expense_reports_companyes",
     *      description="Add a new expense_reports_companyes",
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
     *          @OA\JsonContent(ref="#/components/schemas/ExpenseReportsCompanyeInput")
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
            $expense_reports_companyes_input = new ExpenseReportsCompanyeInput($request);

            $expense_reports_companyes = ExpenseReportsCompanye::create([
                  'report_summary' => $expense_reports_companyes_input->report_summary,
              'employee_id' => $expense_reports_companyes_input->employee_id,
              'manager_user_id' => $expense_reports_companyes_input->manager_user_id,
              'paid_by' => $expense_reports_companyes_input->paid_by,
              'company_id' => $expense_reports_companyes_input->company_id,
              'expense_journal' => $expense_reports_companyes_input->expense_journal,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
    
            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $expense_reports_companyes->expense_reports_company_expense_report_items = $expense_reports_companyes->expenseReportsCompanyExpenseReportItems ;
 
            }

            return ApiResponse::success(compact('expense_reports_companyes'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/expense-reports-companye",
     *      operationId="BrowseExpenseReportsCompanye",
     *      tags={"Expense Reports Companyes"},
     *      summary="Browse expense_reports_companyes",
     *      description="Browse expense_reports_companyes",
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

            $expense_reports_companyes = new ExpenseReportsCompanye();
            $expense_reports_companyes_fillable = $expense_reports_companyes->getFillable();

            $filter_fields = $request->get('filter_fields', '*');
            $filter_fields = explode(',', $filter_fields);
            if (array_search('*', $filter_fields) == false) {
                $new_filter_fields = [];
                foreach ($filter_fields as $index => $field) {
                    if (!in_array($field, $filter_fields)) {
                        $new_filter_fields[] = $field;
                    }
                }
                $expense_reports_companyes = $expense_reports_companyes->select($filter_fields);
            }

            $filter_fields_search = $request->get('filter_fields_search', '*');
            $filter_fields_search = explode(',', $filter_fields_search);
            if (isset($request->search)) {
                if (array_search('*', $filter_fields_search) == false) {
                    foreach ($expense_reports_companyes_fillable as $index => $field) {
                        $expense_reports_companyes = $expense_reports_companyes->orWhere($field, "like", "%$request->search%");
                    }
                } else {
                    foreach ($filter_fields_search as $index => $field) {
                        if (in_array($field, $expense_reports_companyes_fillable)) {
                            $expense_reports_companyes = $expense_reports_companyes->orWhere($field, "like", "%$request->search%");
                        }
                    }
                }
            }

            if ($request->get('show_pagination', 'true') == 'true') {
                $max_page = $request->get('max_page', 15);
                $expense_reports_companyes = $expense_reports_companyes->paginate($max_page);
            } else {
                $expense_reports_companyes = $expense_reports_companyes->get();
            }

            $expense_reports_companyes->map(function($expense_reports_companyes) use ($request){

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
    
            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $expense_reports_companyes->expense_reports_company_expense_report_items = $expense_reports_companyes->expenseReportsCompanyExpenseReportItems ;
 
            }

                return $expense_reports_companyes ;
            });
            $expense_reports_companyes = $expense_reports_companyes->toArray();

            return ApiResponse::success(compact('expense_reports_companyes'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/expense-reports-companye/{id}",
     *      operationId="ReadExpenseReportsCompanye",
     *      tags={"Expense Reports Companyes"},
     *      summary="Read expense_reports_companyes",
     *      description="Read expense_reports_companyes",
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

            $expense_reports_companyes = ExpenseReportsCompanye::find($id);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
    
            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $expense_reports_companyes->expense_reports_company_expense_report_items = $expense_reports_companyes->expenseReportsCompanyExpenseReportItems ;
 
            }

            return ApiResponse::success(compact('expense_reports_companyes'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Put(
     *      path="/module/hrm/v1/expense-reports-companye/{id}",
     *      operationId="UpdateExpenseReportsCompanye",
     *      tags={"Expense Reports Companyes"},
     *      summary="Update expense_reports_companyes",
     *      description="Update expense_reports_companyes",
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
     *          @OA\JsonContent(ref="#/components/schemas/ExpenseReportsCompanyeInput")
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
            $expense_reports_companyes_input = new ExpenseReportsCompanyeInput($request);
            $expense_reports_companyes = ExpenseReportsCompanye::find($id);

            $expense_reports_companyes->update([
                  'report_summary' => $expense_reports_companyes_input->report_summary == null ? $expense_reports_companyes->report_summary : $expense_reports_companyes_input->report_summary,
              'employee_id' => $expense_reports_companyes_input->employee_id == null ? $expense_reports_companyes->employee_id : $expense_reports_companyes_input->employee_id,
              'manager_user_id' => $expense_reports_companyes_input->manager_user_id == null ? $expense_reports_companyes->manager_user_id : $expense_reports_companyes_input->manager_user_id,
              'paid_by' => $expense_reports_companyes_input->paid_by == null ? $expense_reports_companyes->paid_by : $expense_reports_companyes_input->paid_by,
              'company_id' => $expense_reports_companyes_input->company_id == null ? $expense_reports_companyes->company_id : $expense_reports_companyes_input->company_id,
              'expense_journal' => $expense_reports_companyes_input->expense_journal == null ? $expense_reports_companyes->expense_journal : $expense_reports_companyes_input->expense_journal,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
    
            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $expense_reports_companyes->expense_reports_company_expense_report_items = $expense_reports_companyes->expenseReportsCompanyExpenseReportItems ;
 
            }

            return ApiResponse::success(compact('expense_reports_companyes'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }


    /**
     * @OA\Delete(
     *      path="/module/hrm/v1/expense-reports-companye/{id}",
     *      operationId="DeleteExpenseReportsCompanye",
     *      tags={"Expense Reports Companyes"},
     *      summary="Delete expense_reports_companyes",
     *      description="Delete expense_reports_companyes",
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
            $expense_reports_companyes = ExpenseReportsCompanye::find($id);

            $expense_reports_companyes->delete();

            return ApiResponse::success();
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }
}

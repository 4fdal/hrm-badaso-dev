<?php

namespace Uasoft\Badaso\Module\HRM\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\HRM\Models\ExpenseReportItem;
use Uasoft\Badaso\Module\HRM\Schema\Inputs\ExpenseReportItemInput;

class ExpenseReportItemController extends Controller
{
    /**
     * @OA\Post(
     *      path="/module/hrm/v1/expense-report-item",
     *      operationId="AddExpenseReportItem",
     *      tags={"Expense Report Items"},
     *      summary="Add new expense_report_items",
     *      description="Add a new expense_report_items",
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
     *          @OA\JsonContent(ref="#/components/schemas/ExpenseReportItemInput")
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
            $expense_report_items_input = new ExpenseReportItemInput($request);

            $expense_report_items = ExpenseReportItem::create([
                  'expense_reports_company_id' => $expense_report_items_input->expense_reports_company_id,
              'expense_report_id' => $expense_report_items_input->expense_report_id,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $expense_report_items->expense_reports_company = $expense_report_items->expense_reports_company ;
         $expense_report_items->expense_report = $expense_report_items->expense_report ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('expense_report_items'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/expense-report-item",
     *      operationId="BrowseExpenseReportItem",
     *      tags={"Expense Report Items"},
     *      summary="Browse expense_report_items",
     *      description="Browse expense_report_items",
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

            $expense_report_items = new ExpenseReportItem();
            $expense_report_items_fillable = $expense_report_items->getFillable();

            $filter_fields = $request->get('filter_fields', '*');
            $filter_fields = explode(',', $filter_fields);
            if (array_search('*', $filter_fields) == false) {
                $new_filter_fields = [];
                foreach ($filter_fields as $index => $field) {
                    if (!in_array($field, $filter_fields)) {
                        $new_filter_fields[] = $field;
                    }
                }
                $expense_report_items = $expense_report_items->select($filter_fields);
            }

            $filter_fields_search = $request->get('filter_fields_search', '*');
            $filter_fields_search = explode(',', $filter_fields_search);
            if (isset($request->search)) {
                if (array_search('*', $filter_fields_search) == false) {
                    foreach ($expense_report_items_fillable as $index => $field) {
                        $expense_report_items = $expense_report_items->orWhere($field, "like", "%$request->search%");
                    }
                } else {
                    foreach ($filter_fields_search as $index => $field) {
                        if (in_array($field, $expense_report_items_fillable)) {
                            $expense_report_items = $expense_report_items->orWhere($field, "like", "%$request->search%");
                        }
                    }
                }
            }

            if ($request->get('show_pagination', 'true') == 'true') {
                $max_page = $request->get('max_page', 15);
                $expense_report_items = $expense_report_items->paginate($max_page);
            } else {
                $expense_report_items = $expense_report_items->get();
            }

            $expense_report_items->map(function($expense_report_items) use ($request){

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $expense_report_items->expense_reports_company = $expense_report_items->expense_reports_company ;
         $expense_report_items->expense_report = $expense_report_items->expense_report ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

                return $expense_report_items ;
            });
            $expense_report_items = $expense_report_items->toArray();

            return ApiResponse::success(compact('expense_report_items'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/expense-report-item/{id}",
     *      operationId="ReadExpenseReportItem",
     *      tags={"Expense Report Items"},
     *      summary="Read expense_report_items",
     *      description="Read expense_report_items",
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

            $expense_report_items = ExpenseReportItem::find($id);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $expense_report_items->expense_reports_company = $expense_report_items->expense_reports_company ;
         $expense_report_items->expense_report = $expense_report_items->expense_report ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('expense_report_items'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Put(
     *      path="/module/hrm/v1/expense-report-item/{id}",
     *      operationId="UpdateExpenseReportItem",
     *      tags={"Expense Report Items"},
     *      summary="Update expense_report_items",
     *      description="Update expense_report_items",
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
     *          @OA\JsonContent(ref="#/components/schemas/ExpenseReportItemInput")
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
            $expense_report_items_input = new ExpenseReportItemInput($request);
            $expense_report_items = ExpenseReportItem::find($id);

            $expense_report_items->update([
                  'expense_reports_company_id' => $expense_report_items_input->expense_reports_company_id == null ? $expense_report_items->expense_reports_company_id : $expense_report_items_input->expense_reports_company_id,
              'expense_report_id' => $expense_report_items_input->expense_report_id == null ? $expense_report_items->expense_report_id : $expense_report_items_input->expense_report_id,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $expense_report_items->expense_reports_company = $expense_report_items->expense_reports_company ;
         $expense_report_items->expense_report = $expense_report_items->expense_report ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('expense_report_items'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }


    /**
     * @OA\Delete(
     *      path="/module/hrm/v1/expense-report-item/{id}",
     *      operationId="DeleteExpenseReportItem",
     *      tags={"Expense Report Items"},
     *      summary="Delete expense_report_items",
     *      description="Delete expense_report_items",
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
            $expense_report_items = ExpenseReportItem::find($id);

            $expense_report_items->delete();

            return ApiResponse::success();
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }
}

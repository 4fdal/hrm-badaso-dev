<?php

namespace Uasoft\Badaso\Module\HRM\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\HRM\Models\EmployeeAttendance;
use Uasoft\Badaso\Module\HRM\Schema\Inputs\EmployeeAttendanceInput;

class EmployeeAttendanceController extends Controller
{
    /**
     * @OA\Post(
     *      path="/module/hrm/v1/employee-attendance",
     *      operationId="AddEmployeeAttendance",
     *      tags={"Employee Attendances"},
     *      summary="Add new employee_attendances",
     *      description="Add a new employee_attendances",
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
     *          @OA\JsonContent(ref="#/components/schemas/EmployeeAttendanceInput")
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
            $employee_attendances_input = new EmployeeAttendanceInput($request);

            $employee_attendances = EmployeeAttendance::create([
                  'employee_id' => $employee_attendances_input->employee_id,
              'check_in' => $employee_attendances_input->check_in,
              'check_out' => $employee_attendances_input->check_out,
              'worked_hours' => $employee_attendances_input->worked_hours,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $employee_attendances->employee = $employee_attendances->employee ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('employee_attendances'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/employee-attendance",
     *      operationId="BrowseEmployeeAttendance",
     *      tags={"Employee Attendances"},
     *      summary="Browse employee_attendances",
     *      description="Browse employee_attendances",
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

            $employee_attendances = new EmployeeAttendance();
            $employee_attendances_fillable = $employee_attendances->getFillable();

            $filter_fields = $request->get('filter_fields', '*');
            $filter_fields = explode(',', $filter_fields);
            if (array_search('*', $filter_fields) == false) {
                $new_filter_fields = [];
                foreach ($filter_fields as $index => $field) {
                    if (!in_array($field, $filter_fields)) {
                        $new_filter_fields[] = $field;
                    }
                }
                $employee_attendances = $employee_attendances->select($filter_fields);
            }

            $filter_fields_search = $request->get('filter_fields_search', '*');
            $filter_fields_search = explode(',', $filter_fields_search);
            if (isset($request->search)) {
                if (array_search('*', $filter_fields_search) == false) {
                    foreach ($employee_attendances_fillable as $index => $field) {
                        $employee_attendances = $employee_attendances->orWhere($field, "like", "%$request->search%");
                    }
                } else {
                    foreach ($filter_fields_search as $index => $field) {
                        if (in_array($field, $employee_attendances_fillable)) {
                            $employee_attendances = $employee_attendances->orWhere($field, "like", "%$request->search%");
                        }
                    }
                }
            }

            if ($request->get('show_pagination', 'true') == 'true') {
                $max_page = $request->get('max_page', 15);
                $employee_attendances = $employee_attendances->paginate($max_page);
            } else {
                $employee_attendances = $employee_attendances->get();
            }

            $employee_attendances->map(function($employee_attendances) use ($request){

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $employee_attendances->employee = $employee_attendances->employee ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

                return $employee_attendances ;
            });
            $employee_attendances = $employee_attendances->toArray();

            return ApiResponse::success(compact('employee_attendances'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/employee-attendance/{id}",
     *      operationId="ReadEmployeeAttendance",
     *      tags={"Employee Attendances"},
     *      summary="Read employee_attendances",
     *      description="Read employee_attendances",
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

            $employee_attendances = EmployeeAttendance::find($id);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $employee_attendances->employee = $employee_attendances->employee ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('employee_attendances'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Put(
     *      path="/module/hrm/v1/employee-attendance/{id}",
     *      operationId="UpdateEmployeeAttendance",
     *      tags={"Employee Attendances"},
     *      summary="Update employee_attendances",
     *      description="Update employee_attendances",
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
     *          @OA\JsonContent(ref="#/components/schemas/EmployeeAttendanceInput")
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
            $employee_attendances_input = new EmployeeAttendanceInput($request);
            $employee_attendances = EmployeeAttendance::find($id);

            $employee_attendances->update([
                  'employee_id' => $employee_attendances_input->employee_id == null ? $employee_attendances->employee_id : $employee_attendances_input->employee_id,
              'check_in' => $employee_attendances_input->check_in == null ? $employee_attendances->check_in : $employee_attendances_input->check_in,
              'check_out' => $employee_attendances_input->check_out == null ? $employee_attendances->check_out : $employee_attendances_input->check_out,
              'worked_hours' => $employee_attendances_input->worked_hours == null ? $employee_attendances->worked_hours : $employee_attendances_input->worked_hours,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $employee_attendances->employee = $employee_attendances->employee ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('employee_attendances'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }


    /**
     * @OA\Delete(
     *      path="/module/hrm/v1/employee-attendance/{id}",
     *      operationId="DeleteEmployeeAttendance",
     *      tags={"Employee Attendances"},
     *      summary="Delete employee_attendances",
     *      description="Delete employee_attendances",
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
            $employee_attendances = EmployeeAttendance::find($id);

            $employee_attendances->delete();

            return ApiResponse::success();
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }
}

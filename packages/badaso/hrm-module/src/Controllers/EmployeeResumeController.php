<?php

namespace Uasoft\Badaso\Module\HRM\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\HRM\Models\EmployeeResume;
use Uasoft\Badaso\Module\HRM\Schema\Inputs\EmployeeResumeInput;

class EmployeeResumeController extends Controller
{
    /**
     * @OA\Post(
     *      path="/module/hrm/v1/employee-resume",
     *      operationId="AddEmployeeResume",
     *      tags={"Employee Resumes"},
     *      summary="Add new employee_resumes",
     *      description="Add a new employee_resumes",
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
     *          @OA\JsonContent(ref="#/components/schemas/EmployeeResumeInput")
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
            $employee_resumes_input = new EmployeeResumeInput($request);

            $employee_resumes = EmployeeResume::create([
                  'employee_id' => $employee_resumes_input->employee_id,
              'resume_line_type_id' => $employee_resumes_input->resume_line_type_id,
              'display_type' => $employee_resumes_input->display_type,
              'start' => $employee_resumes_input->start,
              'end' => $employee_resumes_input->end,
              'description' => $employee_resumes_input->description,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $employee_resumes->employee = $employee_resumes->employee ;
         $employee_resumes->resume_line_type = $employee_resumes->resume_line_type ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('employee_resumes'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/employee-resume",
     *      operationId="BrowseEmployeeResume",
     *      tags={"Employee Resumes"},
     *      summary="Browse employee_resumes",
     *      description="Browse employee_resumes",
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

            $employee_resumes = new EmployeeResume();
            $employee_resumes_fillable = $employee_resumes->getFillable();

            $filter_fields = $request->get('filter_fields', '*');
            $filter_fields = explode(',', $filter_fields);
            if (array_search('*', $filter_fields) == false) {
                $new_filter_fields = [];
                foreach ($filter_fields as $index => $field) {
                    if (!in_array($field, $filter_fields)) {
                        $new_filter_fields[] = $field;
                    }
                }
                $employee_resumes = $employee_resumes->select($filter_fields);
            }

            $filter_fields_search = $request->get('filter_fields_search', '*');
            $filter_fields_search = explode(',', $filter_fields_search);
            if (isset($request->search)) {
                if (array_search('*', $filter_fields_search) == false) {
                    foreach ($employee_resumes_fillable as $index => $field) {
                        $employee_resumes = $employee_resumes->orWhere($field, "like", "%$request->search%");
                    }
                } else {
                    foreach ($filter_fields_search as $index => $field) {
                        if (in_array($field, $employee_resumes_fillable)) {
                            $employee_resumes = $employee_resumes->orWhere($field, "like", "%$request->search%");
                        }
                    }
                }
            }

            if ($request->get('show_pagination', 'true') == 'true') {
                $max_page = $request->get('max_page', 15);
                $employee_resumes = $employee_resumes->paginate($max_page);
            } else {
                $employee_resumes = $employee_resumes->get();
            }

            $employee_resumes->map(function($employee_resumes) use ($request){

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $employee_resumes->employee = $employee_resumes->employee ;
         $employee_resumes->resume_line_type = $employee_resumes->resume_line_type ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

                return $employee_resumes ;
            });
            $employee_resumes = $employee_resumes->toArray();

            return ApiResponse::success(compact('employee_resumes'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/employee-resume/{id}",
     *      operationId="ReadEmployeeResume",
     *      tags={"Employee Resumes"},
     *      summary="Read employee_resumes",
     *      description="Read employee_resumes",
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

            $employee_resumes = EmployeeResume::find($id);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $employee_resumes->employee = $employee_resumes->employee ;
         $employee_resumes->resume_line_type = $employee_resumes->resume_line_type ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('employee_resumes'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Put(
     *      path="/module/hrm/v1/employee-resume/{id}",
     *      operationId="UpdateEmployeeResume",
     *      tags={"Employee Resumes"},
     *      summary="Update employee_resumes",
     *      description="Update employee_resumes",
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
     *          @OA\JsonContent(ref="#/components/schemas/EmployeeResumeInput")
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
            $employee_resumes_input = new EmployeeResumeInput($request);
            $employee_resumes = EmployeeResume::find($id);

            $employee_resumes->update([
                  'employee_id' => $employee_resumes_input->employee_id == null ? $employee_resumes->employee_id : $employee_resumes_input->employee_id,
              'resume_line_type_id' => $employee_resumes_input->resume_line_type_id == null ? $employee_resumes->resume_line_type_id : $employee_resumes_input->resume_line_type_id,
              'display_type' => $employee_resumes_input->display_type == null ? $employee_resumes->display_type : $employee_resumes_input->display_type,
              'start' => $employee_resumes_input->start == null ? $employee_resumes->start : $employee_resumes_input->start,
              'end' => $employee_resumes_input->end == null ? $employee_resumes->end : $employee_resumes_input->end,
              'description' => $employee_resumes_input->description == null ? $employee_resumes->description : $employee_resumes_input->description,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $employee_resumes->employee = $employee_resumes->employee ;
         $employee_resumes->resume_line_type = $employee_resumes->resume_line_type ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('employee_resumes'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }


    /**
     * @OA\Delete(
     *      path="/module/hrm/v1/employee-resume/{id}",
     *      operationId="DeleteEmployeeResume",
     *      tags={"Employee Resumes"},
     *      summary="Delete employee_resumes",
     *      description="Delete employee_resumes",
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
            $employee_resumes = EmployeeResume::find($id);

            $employee_resumes->delete();

            return ApiResponse::success();
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }
}

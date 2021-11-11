<?php

namespace Uasoft\Badaso\Module\HRM\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\HRM\Models\EmployeeSkill;
use Uasoft\Badaso\Module\HRM\Schema\Inputs\EmployeeSkillInput;

class EmployeeSkillController extends Controller
{
    /**
     * @OA\Post(
     *      path="/module/hrm/v1/employee-skill",
     *      operationId="AddEmployeeSkill",
     *      tags={"Employee Skills"},
     *      summary="Add new employee_skills",
     *      description="Add a new employee_skills",
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
     *          @OA\JsonContent(ref="#/components/schemas/EmployeeSkillInput")
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
            $employee_skills_input = new EmployeeSkillInput($request);

            $employee_skills = EmployeeSkill::create([
                  'skill_type_id' => $employee_skills_input->skill_type_id,
              'skill_id' => $employee_skills_input->skill_id,
              'skill_level_id' => $employee_skills_input->skill_level_id,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $employee_skills->skill_type = $employee_skills->skill_type ;
         $employee_skills->skill = $employee_skills->skill ;
         $employee_skills->skill_level = $employee_skills->skill_level ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('employee_skills'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/employee-skill",
     *      operationId="BrowseEmployeeSkill",
     *      tags={"Employee Skills"},
     *      summary="Browse employee_skills",
     *      description="Browse employee_skills",
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

            $employee_skills = new EmployeeSkill();
            $employee_skills_fillable = $employee_skills->getFillable();

            $filter_fields = $request->get('filter_fields', '*');
            $filter_fields = explode(',', $filter_fields);
            if (array_search('*', $filter_fields) == false) {
                $new_filter_fields = [];
                foreach ($filter_fields as $index => $field) {
                    if (!in_array($field, $filter_fields)) {
                        $new_filter_fields[] = $field;
                    }
                }
                $employee_skills = $employee_skills->select($filter_fields);
            }

            $filter_fields_search = $request->get('filter_fields_search', '*');
            $filter_fields_search = explode(',', $filter_fields_search);
            if (isset($request->search)) {
                if (array_search('*', $filter_fields_search) == false) {
                    foreach ($employee_skills_fillable as $index => $field) {
                        $employee_skills = $employee_skills->orWhere($field, "like", "%$request->search%");
                    }
                } else {
                    foreach ($filter_fields_search as $index => $field) {
                        if (in_array($field, $employee_skills_fillable)) {
                            $employee_skills = $employee_skills->orWhere($field, "like", "%$request->search%");
                        }
                    }
                }
            }

            if ($request->get('show_pagination', 'true') == 'true') {
                $max_page = $request->get('max_page', 15);
                $employee_skills = $employee_skills->paginate($max_page);
            } else {
                $employee_skills = $employee_skills->get();
            }

            $employee_skills->map(function($employee_skills) use ($request){

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $employee_skills->skill_type = $employee_skills->skill_type ;
         $employee_skills->skill = $employee_skills->skill ;
         $employee_skills->skill_level = $employee_skills->skill_level ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

                return $employee_skills ;
            });
            $employee_skills = $employee_skills->toArray();

            return ApiResponse::success(compact('employee_skills'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/employee-skill/{id}",
     *      operationId="ReadEmployeeSkill",
     *      tags={"Employee Skills"},
     *      summary="Read employee_skills",
     *      description="Read employee_skills",
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

            $employee_skills = EmployeeSkill::find($id);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $employee_skills->skill_type = $employee_skills->skill_type ;
         $employee_skills->skill = $employee_skills->skill ;
         $employee_skills->skill_level = $employee_skills->skill_level ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('employee_skills'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Put(
     *      path="/module/hrm/v1/employee-skill/{id}",
     *      operationId="UpdateEmployeeSkill",
     *      tags={"Employee Skills"},
     *      summary="Update employee_skills",
     *      description="Update employee_skills",
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
     *          @OA\JsonContent(ref="#/components/schemas/EmployeeSkillInput")
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
            $employee_skills_input = new EmployeeSkillInput($request);
            $employee_skills = EmployeeSkill::find($id);

            $employee_skills->update([
                  'skill_type_id' => $employee_skills_input->skill_type_id == null ? $employee_skills->skill_type_id : $employee_skills_input->skill_type_id,
              'skill_id' => $employee_skills_input->skill_id == null ? $employee_skills->skill_id : $employee_skills_input->skill_id,
              'skill_level_id' => $employee_skills_input->skill_level_id == null ? $employee_skills->skill_level_id : $employee_skills_input->skill_level_id,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $employee_skills->skill_type = $employee_skills->skill_type ;
         $employee_skills->skill = $employee_skills->skill ;
         $employee_skills->skill_level = $employee_skills->skill_level ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('employee_skills'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }


    /**
     * @OA\Delete(
     *      path="/module/hrm/v1/employee-skill/{id}",
     *      operationId="DeleteEmployeeSkill",
     *      tags={"Employee Skills"},
     *      summary="Delete employee_skills",
     *      description="Delete employee_skills",
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
            $employee_skills = EmployeeSkill::find($id);

            $employee_skills->delete();

            return ApiResponse::success();
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }
}

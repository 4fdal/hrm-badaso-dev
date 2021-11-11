<?php

namespace Uasoft\Badaso\Module\HRM\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\HRM\Models\SkillLevel;
use Uasoft\Badaso\Module\HRM\Schema\Inputs\SkillLevelInput;

class SkillLevelController extends Controller
{
    /**
     * @OA\Post(
     *      path="/module/hrm/v1/skill-level",
     *      operationId="AddSkillLevel",
     *      tags={"Skill Levels"},
     *      summary="Add new skill_levels",
     *      description="Add a new skill_levels",
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
     *          @OA\JsonContent(ref="#/components/schemas/SkillLevelInput")
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
            $skill_levels_input = new SkillLevelInput($request);

            $skill_levels = SkillLevel::create([
                  'skill_type_id' => $skill_levels_input->skill_type_id,
              'name' => $skill_levels_input->name,
              'level_progress' => $skill_levels_input->level_progress,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $skill_levels->skill_type = $skill_levels->skill_type ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $skill_levels->skill_level_employee_skills = $skill_levels->skillLevelEmployeeSkills ;
 
            }

            return ApiResponse::success(compact('skill_levels'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/skill-level",
     *      operationId="BrowseSkillLevel",
     *      tags={"Skill Levels"},
     *      summary="Browse skill_levels",
     *      description="Browse skill_levels",
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

            $skill_levels = new SkillLevel();
            $skill_levels_fillable = $skill_levels->getFillable();

            $filter_fields = $request->get('filter_fields', '*');
            $filter_fields = explode(',', $filter_fields);
            if (array_search('*', $filter_fields) == false) {
                $new_filter_fields = [];
                foreach ($filter_fields as $index => $field) {
                    if (!in_array($field, $filter_fields)) {
                        $new_filter_fields[] = $field;
                    }
                }
                $skill_levels = $skill_levels->select($filter_fields);
            }

            $filter_fields_search = $request->get('filter_fields_search', '*');
            $filter_fields_search = explode(',', $filter_fields_search);
            if (isset($request->search)) {
                if (array_search('*', $filter_fields_search) == false) {
                    foreach ($skill_levels_fillable as $index => $field) {
                        $skill_levels = $skill_levels->orWhere($field, "like", "%$request->search%");
                    }
                } else {
                    foreach ($filter_fields_search as $index => $field) {
                        if (in_array($field, $skill_levels_fillable)) {
                            $skill_levels = $skill_levels->orWhere($field, "like", "%$request->search%");
                        }
                    }
                }
            }

            if ($request->get('show_pagination', 'true') == 'true') {
                $max_page = $request->get('max_page', 15);
                $skill_levels = $skill_levels->paginate($max_page);
            } else {
                $skill_levels = $skill_levels->get();
            }

            $skill_levels->map(function($skill_levels) use ($request){

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $skill_levels->skill_type = $skill_levels->skill_type ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $skill_levels->skill_level_employee_skills = $skill_levels->skillLevelEmployeeSkills ;
 
            }

                return $skill_levels ;
            });
            $skill_levels = $skill_levels->toArray();

            return ApiResponse::success(compact('skill_levels'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/skill-level/{id}",
     *      operationId="ReadSkillLevel",
     *      tags={"Skill Levels"},
     *      summary="Read skill_levels",
     *      description="Read skill_levels",
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

            $skill_levels = SkillLevel::find($id);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $skill_levels->skill_type = $skill_levels->skill_type ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $skill_levels->skill_level_employee_skills = $skill_levels->skillLevelEmployeeSkills ;
 
            }

            return ApiResponse::success(compact('skill_levels'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Put(
     *      path="/module/hrm/v1/skill-level/{id}",
     *      operationId="UpdateSkillLevel",
     *      tags={"Skill Levels"},
     *      summary="Update skill_levels",
     *      description="Update skill_levels",
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
     *          @OA\JsonContent(ref="#/components/schemas/SkillLevelInput")
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
            $skill_levels_input = new SkillLevelInput($request);
            $skill_levels = SkillLevel::find($id);

            $skill_levels->update([
                  'skill_type_id' => $skill_levels_input->skill_type_id == null ? $skill_levels->skill_type_id : $skill_levels_input->skill_type_id,
              'name' => $skill_levels_input->name == null ? $skill_levels->name : $skill_levels_input->name,
              'level_progress' => $skill_levels_input->level_progress == null ? $skill_levels->level_progress : $skill_levels_input->level_progress,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $skill_levels->skill_type = $skill_levels->skill_type ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $skill_levels->skill_level_employee_skills = $skill_levels->skillLevelEmployeeSkills ;
 
            }

            return ApiResponse::success(compact('skill_levels'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }


    /**
     * @OA\Delete(
     *      path="/module/hrm/v1/skill-level/{id}",
     *      operationId="DeleteSkillLevel",
     *      tags={"Skill Levels"},
     *      summary="Delete skill_levels",
     *      description="Delete skill_levels",
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
            $skill_levels = SkillLevel::find($id);

            $skill_levels->delete();

            return ApiResponse::success();
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }
}

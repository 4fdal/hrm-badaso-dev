<?php

namespace Uasoft\Badaso\Module\HRM\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\HRM\Models\Recruitment;
use Uasoft\Badaso\Module\HRM\Schema\Inputs\RecruitmentInput;

class RecruitmentController extends Controller
{
    /**
     * @OA\Post(
     *      path="/module/hrm/v1/recruitment",
     *      operationId="AddRecruitment",
     *      tags={"Recruitments"},
     *      summary="Add new recruitments",
     *      description="Add a new recruitments",
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
     *          @OA\JsonContent(ref="#/components/schemas/RecruitmentInput")
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
            $recruitments_input = new RecruitmentInput($request);

            $recruitments = Recruitment::create([
                'job_id' => $recruitments_input->job_id,
                'is_favorite' => $recruitments_input->is_favorite,
                'no_of_application' => $recruitments_input->no_of_application,
                'no_of_to_recruit' => $recruitments_input->no_of_to_recruit,
                'no_of_new_application' => $recruitments_input->no_of_new_application,
                'color' => $recruitments_input->color,
                'recruiter_id' => $recruitments_input->recruiter_id,
                'is_recruitment_done' => $recruitments_input->is_recruitment_done,
            ]);

            if ($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
                $recruitments->job = $recruitments->job;
            }

            if ($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
                $recruitments->recruitment_recruitment_sources = $recruitments->recruitmentRecruitmentSources;
            }

            return ApiResponse::success(compact('recruitments'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/recruitment",
     *      operationId="BrowseRecruitment",
     *      tags={"Recruitments"},
     *      summary="Browse recruitments",
     *      description="Browse recruitments",
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

            $recruitments = new Recruitment();
            $recruitments_fillable = $recruitments->getFillable();

            $filter_fields = $request->get('filter_fields', '*');
            $filter_fields = explode(',', $filter_fields);
            if (array_search('*', $filter_fields) == false) {
                $new_filter_fields = [];
                foreach ($filter_fields as $index => $field) {
                    if (!in_array($field, $filter_fields)) {
                        $new_filter_fields[] = $field;
                    }
                }
                $recruitments = $recruitments->select($filter_fields);
            }

            $filter_fields_search = $request->get('filter_fields_search', '*');
            $filter_fields_search = explode(',', $filter_fields_search);
            if (isset($request->search)) {
                if (array_search('*', $filter_fields_search) == false) {
                    foreach ($recruitments_fillable as $index => $field) {
                        $recruitments = $recruitments->orWhere($field, "like", "%$request->search%");
                    }
                } else {
                    foreach ($filter_fields_search as $index => $field) {
                        if (in_array($field, $recruitments_fillable)) {
                            $recruitments = $recruitments->orWhere($field, "like", "%$request->search%");
                        }
                    }
                }
            }

            if ($request->get('show_pagination', 'true') == 'true') {
                $max_page = $request->get('max_page', 15);
                $recruitments = $recruitments->paginate($max_page);
            } else {
                $recruitments = $recruitments->get();
            }

            $recruitments->map(function ($recruitments) use ($request) {

                if ($request->get("show_belogsto_relation", "false") == "true") {
                    // belogs to relation
                    $recruitments->job = $recruitments->job;
                }

                if ($request->get("show_hasmany_relation", "false") == "true") {
                    // has many relation
                    $recruitments->recruitment_recruitment_sources = $recruitments->recruitmentRecruitmentSources;
                }

                return $recruitments;
            });
            $recruitments = $recruitments->toArray();

            return ApiResponse::success(compact('recruitments'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/recruitment/{id}",
     *      operationId="ReadRecruitment",
     *      tags={"Recruitments"},
     *      summary="Read recruitments",
     *      description="Read recruitments",
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

            $recruitments = Recruitment::find($id);

            if ($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
                $recruitments->job = $recruitments->job;
            }

            if ($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
                $recruitments->recruitment_recruitment_sources = $recruitments->recruitmentRecruitmentSources;
            }

            return ApiResponse::success(compact('recruitments'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Put(
     *      path="/module/hrm/v1/recruitment/{id}",
     *      operationId="UpdateRecruitment",
     *      tags={"Recruitments"},
     *      summary="Update recruitments",
     *      description="Update recruitments",
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
     *          @OA\JsonContent(ref="#/components/schemas/RecruitmentInput")
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
            $recruitments_input = new RecruitmentInput($request);
            $recruitments = Recruitment::find($id);

            $recruitments->update([
                'job_id' => $recruitments_input->job_id == null ? $recruitments->job_id : $recruitments_input->job_id,
                'is_favorite' => $recruitments_input->is_favorite == null ? $recruitments->is_favorite : $recruitments_input->is_favorite,
                'no_of_application' => $recruitments_input->no_of_application == null ? $recruitments->no_of_application : $recruitments_input->no_of_application,
                'no_of_to_recruit' => $recruitments_input->no_of_to_recruit == null ? $recruitments->no_of_to_recruit : $recruitments_input->no_of_to_recruit,
                'no_of_new_application' => $recruitments_input->no_of_new_application == null ? $recruitments->no_of_new_application : $recruitments_input->no_of_new_application,
                'is_recruitment_done' => $recruitments_input->is_recruitment_done,
                'color' => $recruitments_input->color == null ? $recruitments->color : $recruitments_input->color,
            ]);

            if ($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
                $recruitments->job = $recruitments->job;
            }

            if ($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
                $recruitments->recruitment_recruitment_sources = $recruitments->recruitmentRecruitmentSources;
            }

            return ApiResponse::success(compact('recruitments'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }


    /**
     * @OA\Delete(
     *      path="/module/hrm/v1/recruitment/{id}",
     *      operationId="DeleteRecruitment",
     *      tags={"Recruitments"},
     *      summary="Delete recruitments",
     *      description="Delete recruitments",
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
            $recruitments = Recruitment::find($id);

            $recruitments->delete();

            return ApiResponse::success();
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }
}

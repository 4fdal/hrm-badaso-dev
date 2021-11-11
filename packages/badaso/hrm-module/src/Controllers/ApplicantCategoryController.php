<?php

namespace Uasoft\Badaso\Module\HRM\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\HRM\Models\ApplicantCategory;
use Uasoft\Badaso\Module\HRM\Schema\Inputs\ApplicantCategoryInput;

class ApplicantCategoryController extends Controller
{
    /**
     * @OA\Post(
     *      path="/module/hrm/v1/applicant-category",
     *      operationId="AddApplicantCategory",
     *      tags={"Applicant Categories"},
     *      summary="Add new applicant_categories",
     *      description="Add a new applicant_categories",
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
     *          @OA\JsonContent(ref="#/components/schemas/ApplicantCategoryInput")
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
            $applicant_categories_input = new ApplicantCategoryInput($request);

            $applicant_categories = ApplicantCategory::create([
                  'name' => $applicant_categories_input->name,
              'color' => $applicant_categories_input->color,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
    
            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $applicant_categories->applicant_category_applicant_tags = $applicant_categories->applicantCategoryApplicantTags ;
 
            }

            return ApiResponse::success(compact('applicant_categories'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/applicant-category",
     *      operationId="BrowseApplicantCategory",
     *      tags={"Applicant Categories"},
     *      summary="Browse applicant_categories",
     *      description="Browse applicant_categories",
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

            $applicant_categories = new ApplicantCategory();
            $applicant_categories_fillable = $applicant_categories->getFillable();

            $filter_fields = $request->get('filter_fields', '*');
            $filter_fields = explode(',', $filter_fields);
            if (array_search('*', $filter_fields) == false) {
                $new_filter_fields = [];
                foreach ($filter_fields as $index => $field) {
                    if (!in_array($field, $filter_fields)) {
                        $new_filter_fields[] = $field;
                    }
                }
                $applicant_categories = $applicant_categories->select($filter_fields);
            }

            $filter_fields_search = $request->get('filter_fields_search', '*');
            $filter_fields_search = explode(',', $filter_fields_search);
            if (isset($request->search)) {
                if (array_search('*', $filter_fields_search) == false) {
                    foreach ($applicant_categories_fillable as $index => $field) {
                        $applicant_categories = $applicant_categories->orWhere($field, "like", "%$request->search%");
                    }
                } else {
                    foreach ($filter_fields_search as $index => $field) {
                        if (in_array($field, $applicant_categories_fillable)) {
                            $applicant_categories = $applicant_categories->orWhere($field, "like", "%$request->search%");
                        }
                    }
                }
            }

            if ($request->get('show_pagination', 'true') == 'true') {
                $max_page = $request->get('max_page', 15);
                $applicant_categories = $applicant_categories->paginate($max_page);
            } else {
                $applicant_categories = $applicant_categories->get();
            }

            $applicant_categories->map(function($applicant_categories) use ($request){

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
    
            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $applicant_categories->applicant_category_applicant_tags = $applicant_categories->applicantCategoryApplicantTags ;
 
            }

                return $applicant_categories ;
            });
            $applicant_categories = $applicant_categories->toArray();

            return ApiResponse::success(compact('applicant_categories'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/applicant-category/{id}",
     *      operationId="ReadApplicantCategory",
     *      tags={"Applicant Categories"},
     *      summary="Read applicant_categories",
     *      description="Read applicant_categories",
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

            $applicant_categories = ApplicantCategory::find($id);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
    
            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $applicant_categories->applicant_category_applicant_tags = $applicant_categories->applicantCategoryApplicantTags ;
 
            }

            return ApiResponse::success(compact('applicant_categories'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Put(
     *      path="/module/hrm/v1/applicant-category/{id}",
     *      operationId="UpdateApplicantCategory",
     *      tags={"Applicant Categories"},
     *      summary="Update applicant_categories",
     *      description="Update applicant_categories",
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
     *          @OA\JsonContent(ref="#/components/schemas/ApplicantCategoryInput")
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
            $applicant_categories_input = new ApplicantCategoryInput($request);
            $applicant_categories = ApplicantCategory::find($id);

            $applicant_categories->update([
                  'name' => $applicant_categories_input->name == null ? $applicant_categories->name : $applicant_categories_input->name,
              'color' => $applicant_categories_input->color == null ? $applicant_categories->color : $applicant_categories_input->color,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
    
            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $applicant_categories->applicant_category_applicant_tags = $applicant_categories->applicantCategoryApplicantTags ;
 
            }

            return ApiResponse::success(compact('applicant_categories'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }


    /**
     * @OA\Delete(
     *      path="/module/hrm/v1/applicant-category/{id}",
     *      operationId="DeleteApplicantCategory",
     *      tags={"Applicant Categories"},
     *      summary="Delete applicant_categories",
     *      description="Delete applicant_categories",
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
            $applicant_categories = ApplicantCategory::find($id);

            $applicant_categories->delete();

            return ApiResponse::success();
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }
}

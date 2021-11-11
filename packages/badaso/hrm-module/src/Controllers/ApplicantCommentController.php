<?php

namespace Uasoft\Badaso\Module\HRM\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\HRM\Models\ApplicantComment;
use Uasoft\Badaso\Module\HRM\Schema\Inputs\ApplicantCommentInput;

class ApplicantCommentController extends Controller
{
    /**
     * @OA\Post(
     *      path="/module/hrm/v1/applicant-comment",
     *      operationId="AddApplicantComment",
     *      tags={"Applicant Comments"},
     *      summary="Add new applicant_comments",
     *      description="Add a new applicant_comments",
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
     *          @OA\JsonContent(ref="#/components/schemas/ApplicantCommentInput")
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
            $applicant_comments_input = new ApplicantCommentInput($request);

            $applicant_comments = ApplicantComment::create([
                  'applicant_id' => $applicant_comments_input->applicant_id,
              'user_id' => $applicant_comments_input->user_id,
              'message' => $applicant_comments_input->message,
              'attachments' => $applicant_comments_input->attachments,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $applicant_comments->applicant = $applicant_comments->applicant ;
         $applicant_comments->user = $applicant_comments->user ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('applicant_comments'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/applicant-comment",
     *      operationId="BrowseApplicantComment",
     *      tags={"Applicant Comments"},
     *      summary="Browse applicant_comments",
     *      description="Browse applicant_comments",
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

            $applicant_comments = new ApplicantComment();
            $applicant_comments_fillable = $applicant_comments->getFillable();

            $filter_fields = $request->get('filter_fields', '*');
            $filter_fields = explode(',', $filter_fields);
            if (array_search('*', $filter_fields) == false) {
                $new_filter_fields = [];
                foreach ($filter_fields as $index => $field) {
                    if (!in_array($field, $filter_fields)) {
                        $new_filter_fields[] = $field;
                    }
                }
                $applicant_comments = $applicant_comments->select($filter_fields);
            }

            $filter_fields_search = $request->get('filter_fields_search', '*');
            $filter_fields_search = explode(',', $filter_fields_search);
            if (isset($request->search)) {
                if (array_search('*', $filter_fields_search) == false) {
                    foreach ($applicant_comments_fillable as $index => $field) {
                        $applicant_comments = $applicant_comments->orWhere($field, "like", "%$request->search%");
                    }
                } else {
                    foreach ($filter_fields_search as $index => $field) {
                        if (in_array($field, $applicant_comments_fillable)) {
                            $applicant_comments = $applicant_comments->orWhere($field, "like", "%$request->search%");
                        }
                    }
                }
            }

            if ($request->get('show_pagination', 'true') == 'true') {
                $max_page = $request->get('max_page', 15);
                $applicant_comments = $applicant_comments->paginate($max_page);
            } else {
                $applicant_comments = $applicant_comments->get();
            }

            $applicant_comments->map(function($applicant_comments) use ($request){

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $applicant_comments->applicant = $applicant_comments->applicant ;
         $applicant_comments->user = $applicant_comments->user ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

                return $applicant_comments ;
            });
            $applicant_comments = $applicant_comments->toArray();

            return ApiResponse::success(compact('applicant_comments'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/applicant-comment/{id}",
     *      operationId="ReadApplicantComment",
     *      tags={"Applicant Comments"},
     *      summary="Read applicant_comments",
     *      description="Read applicant_comments",
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

            $applicant_comments = ApplicantComment::find($id);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $applicant_comments->applicant = $applicant_comments->applicant ;
         $applicant_comments->user = $applicant_comments->user ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('applicant_comments'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Put(
     *      path="/module/hrm/v1/applicant-comment/{id}",
     *      operationId="UpdateApplicantComment",
     *      tags={"Applicant Comments"},
     *      summary="Update applicant_comments",
     *      description="Update applicant_comments",
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
     *          @OA\JsonContent(ref="#/components/schemas/ApplicantCommentInput")
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
            $applicant_comments_input = new ApplicantCommentInput($request);
            $applicant_comments = ApplicantComment::find($id);

            $applicant_comments->update([
                  'applicant_id' => $applicant_comments_input->applicant_id == null ? $applicant_comments->applicant_id : $applicant_comments_input->applicant_id,
              'user_id' => $applicant_comments_input->user_id == null ? $applicant_comments->user_id : $applicant_comments_input->user_id,
              'message' => $applicant_comments_input->message == null ? $applicant_comments->message : $applicant_comments_input->message,
              'attachments' => $applicant_comments_input->attachments == null ? $applicant_comments->attachments : $applicant_comments_input->attachments,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $applicant_comments->applicant = $applicant_comments->applicant ;
         $applicant_comments->user = $applicant_comments->user ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('applicant_comments'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }


    /**
     * @OA\Delete(
     *      path="/module/hrm/v1/applicant-comment/{id}",
     *      operationId="DeleteApplicantComment",
     *      tags={"Applicant Comments"},
     *      summary="Delete applicant_comments",
     *      description="Delete applicant_comments",
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
            $applicant_comments = ApplicantComment::find($id);

            $applicant_comments->delete();

            return ApiResponse::success();
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }
}

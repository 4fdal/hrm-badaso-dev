<?php

namespace Uasoft\Badaso\Module\HRM\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\HRM\Models\Account;
use Uasoft\Badaso\Module\HRM\Models\ApplicantRefuseType;
use Uasoft\Badaso\Module\HRM\Schema\Inputs\ApplicantRefuseTypeInput;

class ApplicantRefuseTypeController extends Controller
{
    /**
     * @OA\Post(
     *      path="/module/hrm/v1/applicant-refuse-type",
     *      operationId="AddApplicantRefuseType",
     *      tags={"Applicant Refuse Types"},
     *      summary="Add new applicant refuse types",
     *      description="Add a new applicant refuse types",
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
     *          @OA\JsonContent(ref="#/components/schemas/ApplicantRefuseTypeInput")
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
            $applicant_refuse_type_input = new ApplicantRefuseTypeInput($request);

            $applicant_refuse_type = ApplicantRefuseType::create([
                'name' => $applicant_refuse_type_input->name,
            ]);

            if ($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
            }

            if ($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
                $applicant_refuse_type->applicant = $applicant_refuse_type->applicant;
            }

            return ApiResponse::success(compact('applicant_refuse_type'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/applicant-refuse-type",
     *      operationId="BrowseApplicantRefuseType",
     *      tags={"Applicant Refuse Types"},
     *      summary="Browse applicant refuse types",
     *      description="Browse applicant refuse types",
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

            $applicant_refuse_type = new ApplicantRefuseType();
            $applicant_refuse_type_fillable = $applicant_refuse_type->getFillable();

            $filter_fields = $request->get('filter_fields', '*');
            $filter_fields = explode(',', $filter_fields);
            if (array_search('*', $filter_fields) == false) {
                $new_filter_fields = [];
                foreach ($filter_fields as $index => $field) {
                    if (!in_array($field, $filter_fields)) {
                        $new_filter_fields[] = $field;
                    }
                }
                $applicant_refuse_type = $applicant_refuse_type->select($filter_fields);
            }

            $filter_fields_search = $request->get('filter_fields_search', '*');
            $filter_fields_search = explode(',', $filter_fields_search);
            if (isset($request->search)) {
                if (array_search('*', $filter_fields_search) == false) {
                    foreach ($applicant_refuse_type_fillable as $index => $field) {
                        $applicant_refuse_type = $applicant_refuse_type->orWhere($field, "like", "%$request->search%");
                    }
                } else {
                    foreach ($filter_fields_search as $index => $field) {
                        if (in_array($field, $applicant_refuse_type_fillable)) {
                            $applicant_refuse_type = $applicant_refuse_type->orWhere($field, "like", "%$request->search%");
                        }
                    }
                }
            }

            if ($request->get('show_pagination', 'true') == 'true') {
                $max_page = $request->get('max_page', 15);
                $applicant_refuse_type = $applicant_refuse_type->paginate($max_page);
            } else {
                $applicant_refuse_type = $applicant_refuse_type->get();
            }

            $applicant_refuse_type->map(function ($applicant_refuse_type) use ($request) {

                if ($request->get("show_belogsto_relation", "false") == "true") {
                    // belogs to relation
                }

                if ($request->get("show_hasmany_relation", "false") == "true") {
                    // has many relation
                    $applicant_refuse_type->applicant = $applicant_refuse_type->applicat;
                }

                return $applicant_refuse_type;
            });
            $applicant_refuse_type = $applicant_refuse_type->toArray();

            return ApiResponse::success(compact('accounts'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/applicant-refuse-type/{id}",
     *      operationId="ReadApplicantRefuseType",
     *      tags={"Applicant Refuse Types"},
     *      summary="Read applicant refuse types",
     *      description="Read applicant refuse types",
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

            $applicant_refuse_type = ApplicantRefuseType::find($id);

            if ($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
            }

            if ($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
                $applicant_refuse_type->applicant = $applicant_refuse_type->applicat;
            }

            return ApiResponse::success(compact('accounts'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Put(
     *      path="/module/hrm/v1/applicant-refuse-type/{id}",
     *      operationId="UpdateApplicantRefuseType",
     *      tags={"Applicant Refuse Types"},
     *      summary="Update applicant refuse types",
     *      description="Update applicant refuse types",
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
     *          @OA\JsonContent(ref="#/components/schemas/ApplicantRefuseTypeInput")
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
            $applicant_refuse_type_input = new ApplicantRefuseTypeInput($request);
            $applicant_refuse_type = ApplicantRefuseType::find($id);

            $applicant_refuse_type->update([
                'name' => $applicant_refuse_type_input->name == null ? $applicant_refuse_type->name : $applicant_refuse_type_input->name,
            ]);

            if ($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
            }

            if ($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
                $applicant_refuse_type->applicant = $applicant_refuse_type->applicat;
            }

            return ApiResponse::success(compact('accounts'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }


    /**
     * @OA\Delete(
     *      path="/module/hrm/v1/applicant-refuse-type/{id}",
     *      operationId="DeleteApplicantRefuseType",
     *      tags={"Applicant Refuse Types"},
     *      summary="Delete applicant refuse types",
     *      description="Delete applicant refuse types",
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
            $accounts = Account::find($id);

            $accounts->delete();

            return ApiResponse::success();
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }
}

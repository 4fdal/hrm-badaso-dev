<?php

namespace Uasoft\Badaso\Module\HRM\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\HRM\Models\Job;
use Uasoft\Badaso\Module\HRM\Models\Recruitment;
use Uasoft\Badaso\Module\HRM\Schema\Inputs\JobInput;

class JobController extends Controller
{
    /**
     * @OA\Post(
     *      path="/module/hrm/v1/job",
     *      operationId="AddJob",
     *      tags={"Jobs"},
     *      summary="Add new jobs",
     *      description="Add a new jobs",
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
     *          @OA\JsonContent(ref="#/components/schemas/JobInput")
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
            $jobs_input = new JobInput($request);

            $jobs = Job::create([
                'name' => $jobs_input->name,
                'no_of_employee' => $jobs_input->no_of_employee,
                'no_of_recruitment' => $jobs_input->no_of_recruitment,
                'no_of_hired_employee' => $jobs_input->no_of_hired_employee,
                'reqruitment' => $jobs_input->reqruitment,
                'departement_id' => $jobs_input->departement_id,
                'company_id' => $jobs_input->company_id,
                'description' => $jobs_input->description,
                'state' => $jobs_input->state,
                'address_id' => $jobs_input->address_id,
                'manager_id' => $jobs_input->manager_id,
            ]);

            if ($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
                $jobs->departement = $jobs->departement;
                $jobs->company = $jobs->company;
                $jobs->manager = $jobs->manager;
            }

            if ($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
                $jobs->job_recruitments = $jobs->jobRecruitments;
                $jobs->job_applicants = $jobs->jobApplicants;
            }

            return ApiResponse::success(compact('jobs'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/job",
     *      operationId="BrowseJob",
     *      tags={"Jobs"},
     *      summary="Browse jobs",
     *      description="Browse jobs",
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

            $jobs = new Job();
            $jobs_fillable = $jobs->getFillable();

            $filter_fields = $request->get('filter_fields', '*');
            $filter_fields = explode(',', $filter_fields);
            if (array_search('*', $filter_fields) == false) {
                $new_filter_fields = [];
                foreach ($filter_fields as $index => $field) {
                    if (!in_array($field, $filter_fields)) {
                        $new_filter_fields[] = $field;
                    }
                }
                $jobs = $jobs->select($filter_fields);
            }

            $filter_fields_search = $request->get('filter_fields_search', '*');
            $filter_fields_search = explode(',', $filter_fields_search);
            if (isset($request->search)) {
                if (array_search('*', $filter_fields_search) == false) {
                    foreach ($jobs_fillable as $index => $field) {
                        $jobs = $jobs->orWhere($field, "like", "%$request->search%");
                    }
                } else {
                    foreach ($filter_fields_search as $index => $field) {
                        if (in_array($field, $jobs_fillable)) {
                            $jobs = $jobs->orWhere($field, "like", "%$request->search%");
                        }
                    }
                }
            }

            if ($request->get('show_pagination', 'true') == 'true') {
                $max_page = $request->get('max_page', 15);
                $jobs = $jobs->paginate($max_page);
            } else {
                $jobs = $jobs->get();
            }

            $jobs->map(function ($jobs) use ($request) {

                if ($request->get("show_belogsto_relation", "false") == "true") {
                    // belogs to relation
                    $jobs->departement = $jobs->departement;
                    $jobs->company = $jobs->company;
                    $jobs->manager = $jobs->manager;
                }

                if ($request->get("show_hasmany_relation", "false") == "true") {
                    // has many relation
                    $jobs->job_recruitments = $jobs->jobRecruitments;
                    $jobs->job_applicants = $jobs->jobApplicants;
                }

                return $jobs;
            });
            $jobs = $jobs->toArray();

            return ApiResponse::success(compact('jobs'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/job/{id}",
     *      operationId="ReadJob",
     *      tags={"Jobs"},
     *      summary="Read jobs",
     *      description="Read jobs",
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

            $jobs = Job::find($id);

            if ($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
                $jobs->departement = $jobs->departement;
                $jobs->company = $jobs->company;
                $jobs->manager = $jobs->manager;
            }

            if ($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
                $jobs->job_recruitments = $jobs->jobRecruitments;
                $jobs->job_applicants = $jobs->jobApplicants;
            }

            return ApiResponse::success(compact('jobs'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Put(
     *      path="/module/hrm/v1/job/{id}",
     *      operationId="UpdateJob",
     *      tags={"Jobs"},
     *      summary="Update jobs",
     *      description="Update jobs",
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
     *          @OA\JsonContent(ref="#/components/schemas/JobInput")
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
            $jobs_input = new JobInput($request);
            $jobs = Job::find($id);

            $jobs->update([
                'name' => $jobs_input->name == null ? $jobs->name : $jobs_input->name,
                'no_of_employee' => $jobs_input->no_of_employee == null ? $jobs->no_of_employee : $jobs_input->no_of_employee,
                'no_of_recruitment' => $jobs_input->no_of_recruitment == null ? $jobs->no_of_recruitment : $jobs_input->no_of_recruitment,
                'no_of_hired_employee' => $jobs_input->no_of_hired_employee == null ? $jobs->no_of_hired_employee : $jobs_input->no_of_hired_employee,
                'reqruitment' => $jobs_input->reqruitment == null ? $jobs->reqruitment : $jobs_input->reqruitment,
                'departement_id' => $jobs_input->departement_id == null ? $jobs->departement_id : $jobs_input->departement_id,
                'company_id' => $jobs_input->company_id == null ? $jobs->company_id : $jobs_input->company_id,
                'description' => $jobs_input->description == null ? $jobs->description : $jobs_input->description,
                'state' => $jobs_input->state == null ? $jobs->state : $jobs_input->state,
                'address_id' => $jobs_input->address_id == null ? $jobs->address_id : $jobs_input->address_id,
                'manager_id' => $jobs_input->manager_id == null ? $jobs->manager_id : $jobs_input->manager_id,

            ]);

            if ($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
                $jobs->departement = $jobs->departement;
                $jobs->company = $jobs->company;
                $jobs->manager = $jobs->manager;
            }

            if ($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
                $jobs->job_recruitments = $jobs->jobRecruitments;
                $jobs->job_applicants = $jobs->jobApplicants;
            }

            return ApiResponse::success(compact('jobs'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }


    /**
     * @OA\Delete(
     *      path="/module/hrm/v1/job/{id}",
     *      operationId="DeleteJob",
     *      tags={"Jobs"},
     *      summary="Delete jobs",
     *      description="Delete jobs",
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
            $jobs = Job::find($id);

            $jobs->delete();

            return ApiResponse::success();
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }
}

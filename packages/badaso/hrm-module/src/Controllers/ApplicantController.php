<?php

namespace Uasoft\Badaso\Module\HRM\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\HRM\Models\Applicant;
use Uasoft\Badaso\Module\HRM\Models\Employee;
use Uasoft\Badaso\Module\HRM\Models\Job;
use Uasoft\Badaso\Module\HRM\Models\Recruitment;
use Uasoft\Badaso\Module\HRM\Schema\Inputs\ApplicantCreateEmployeeInput;
use Uasoft\Badaso\Module\HRM\Schema\Inputs\ApplicantInput;

class ApplicantController extends Controller
{
    /**
     * @OA\Post(
     *      path="/module/hrm/v1/applicant",
     *      operationId="AddApplicant",
     *      tags={"Applicants"},
     *      summary="Add new applicants",
     *      description="Add a new applicants",
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
     *          @OA\JsonContent(ref="#/components/schemas/ApplicantInput")
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
            $applicants_input = new ApplicantInput($request);

            $applicants = Applicant::create([
                'title' => $applicants_input->title,
                'name' => $applicants_input->name,
                'email' => $applicants_input->email,
                'phone' => $applicants_input->phone,
                'mobile' => $applicants_input->mobile,
                'degree_id' => $applicants_input->degree_id,
                'job_id' => $applicants_input->job_id,
                'departement_id' => $applicants_input->departement_id,
                'company_id' => $applicants_input->company_id,
                'recruiter_id' => $applicants_input->recruiter_id,
                'appreciation' => $applicants_input->appreciation,
                'metsos_source_id' => $applicants_input->metsos_source_id,
                'expected_salary' => $applicants_input->expected_salary,
                'expected_salary_extra' => $applicants_input->expected_salary_extra,
                'proposed_salary' => $applicants_input->proposed_salary,
                'proposed_salary_extra' => $applicants_input->proposed_salary_extra,
                'availability' => $applicants_input->availability,
                'description' => $applicants_input->description,
                'is_active' => $applicants_input->is_active,
                'date_closed' => $applicants_input->date_closed,
                'date_open' => $applicants_input->date_open,
                'date_last_stage_up' => $applicants_input->date_last_stage_up,
                'recruitment_stage_id' => $applicants_input->recruitment_stage_id,
                'last_recruitment_stage_id' => $applicants_input->last_recruitment_stage_id,
                'probability' => $applicants_input->probability,
                'user_id' => $applicants_input->user_id,
                'applicant_refuse_type_id' => $applicants_input->applicant_refuse_type_id,
            ]);

            if ($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
                $applicants->degree = $applicants->degree;
                $applicants->job = $applicants->job;
                $applicants->departement = $applicants->departement;
                $applicants->company = $applicants->company;
                $applicants->metsos_source = $applicants->metsos_source;
                $applicants->user = $applicants->user;
                $applicants->recruitment_id = $applicants->recruitment_id;
            }

            if ($request->get("show_hasmany_relation", "false") == "true") {
                // has relation
                $applicants->applicant_applicant_tags = $applicants->applicantApplicantTags;
                $applicants->applicant_applicant_followers = $applicants->applicantApplicantFollowers;
                $applicants->applicant_applicant_comments = $applicants->applicantApplicantComments;
                $applicants->applicatn_refuse_type = $applicants->applicantRefuseType;
                $applicants->recruitment = $applicants->recruitment;
            }

            return ApiResponse::success(compact('applicants'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/applicant",
     *      operationId="BrowseApplicant",
     *      tags={"Applicants"},
     *      summary="Browse applicants",
     *      description="Browse applicants",
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

            $applicants = new Applicant();
            $applicants_fillable = $applicants->getFillable();

            $filter_fields = $request->get('filter_fields', '*');
            $filter_fields = explode(',', $filter_fields);
            if (array_search('*', $filter_fields) == false) {
                $new_filter_fields = [];
                foreach ($filter_fields as $index => $field) {
                    if (!in_array($field, $filter_fields)) {
                        $new_filter_fields[] = $field;
                    }
                }
                $applicants = $applicants->select($filter_fields);
            }

            $filter_fields_search = $request->get('filter_fields_search', '*');
            $filter_fields_search = explode(',', $filter_fields_search);
            if (isset($request->search)) {
                if (array_search('*', $filter_fields_search) == false) {
                    foreach ($applicants_fillable as $index => $field) {
                        $applicants = $applicants->orWhere($field, "like", "%$request->search%");
                    }
                } else {
                    foreach ($filter_fields_search as $index => $field) {
                        if (in_array($field, $applicants_fillable)) {
                            $applicants = $applicants->orWhere($field, "like", "%$request->search%");
                        }
                    }
                }
            }

            if ($request->get('show_pagination', 'true') == 'true') {
                $max_page = $request->get('max_page', 15);
                $applicants = $applicants->paginate($max_page);
            } else {
                $applicants = $applicants->get();
            }

            $applicants->map(function ($applicants) use ($request) {

                if ($request->get("show_belogsto_relation", "false") == "true") {
                    // belogs to relation
                    $applicants->degree = $applicants->degree;
                    $applicants->job = $applicants->job;
                    $applicants->departement = $applicants->departement;
                    $applicants->company = $applicants->company;
                    $applicants->metsos_source = $applicants->metsos_source;
                    $applicants->user = $applicants->user;
                }

                if ($request->get("show_hasmany_relation", "false") == "true") {
                    // has many relation
                    $applicants->applicant_applicant_tags = $applicants->applicantApplicantTags;
                    $applicants->applicant_applicant_followers = $applicants->applicantApplicantFollowers;
                    $applicants->applicant_applicant_comments = $applicants->applicantApplicantComments;
                    $applicants->applicatn_refuse_type = $applicants->applicantRefuseType;
                }

                return $applicants;
            });
            $applicants = $applicants->toArray();

            return ApiResponse::success(compact('applicants'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/applicant/{id}",
     *      operationId="ReadApplicant",
     *      tags={"Applicants"},
     *      summary="Read applicants",
     *      description="Read applicants",
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

            $applicants = Applicant::find($id);

            if ($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
                $applicants->degree = $applicants->degree;
                $applicants->job = $applicants->job;
                $applicants->departement = $applicants->departement;
                $applicants->company = $applicants->company;
                $applicants->metsos_source = $applicants->metsos_source;
                $applicants->user = $applicants->user;
            }

            if ($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
                $applicants->applicant_applicant_tags = $applicants->applicantApplicantTags;
                $applicants->applicant_applicant_followers = $applicants->applicantApplicantFollowers;
                $applicants->applicant_applicant_comments = $applicants->applicantApplicantComments;
                $applicants->applicatn_refuse_type = $applicants->applicantRefuseType;
            }

            return ApiResponse::success(compact('applicants'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Put(
     *      path="/module/hrm/v1/applicant/{id}",
     *      operationId="UpdateApplicant",
     *      tags={"Applicants"},
     *      summary="Update applicants",
     *      description="Update applicants",
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
     *          @OA\JsonContent(ref="#/components/schemas/ApplicantInput")
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
            $applicants_input = new ApplicantInput($request);
            $applicants = Applicant::find($id);

            $applicants->update([
                'title' => $applicants_input->title == null ? $applicants->title : $applicants_input->title,
                'name' => $applicants_input->name == null ? $applicants->name : $applicants_input->name,
                'email' => $applicants_input->email == null ? $applicants->email : $applicants_input->email,
                'phone' => $applicants_input->phone == null ? $applicants->phone : $applicants_input->phone,
                'mobile' => $applicants_input->mobile == null ? $applicants->mobile : $applicants_input->mobile,
                'degree_id' => $applicants_input->degree_id == null ? $applicants->degree_id : $applicants_input->degree_id,
                'job_id' => $applicants_input->job_id == null ? $applicants->job_id : $applicants_input->job_id,
                'departement_id' => $applicants_input->departement_id == null ? $applicants->departement_id : $applicants_input->departement_id,
                'company_id' => $applicants_input->company_id == null ? $applicants->company_id : $applicants_input->company_id,
                'recruiter_id' => $applicants_input->recruiter_id == null ? $applicants->recruiter_id : $applicants_input->recruiter_id,
                'appreciation' => $applicants_input->appreciation == null ? $applicants->appreciation : $applicants_input->appreciation,
                'metsos_source_id' => $applicants_input->metsos_source_id == null ? $applicants->metsos_source_id : $applicants_input->metsos_source_id,
                'expected_salary' => $applicants_input->expected_salary == null ? $applicants->expected_salary : $applicants_input->expected_salary,
                'expected_salary_extra' => $applicants_input->expected_salary_extra == null ? $applicants->expected_salary_extra : $applicants_input->expected_salary_extra,
                'proposed_salary' => $applicants_input->proposed_salary == null ? $applicants->proposed_salary : $applicants_input->proposed_salary,
                'proposed_salary_extra' => $applicants_input->proposed_salary_extra == null ? $applicants->proposed_salary_extra : $applicants_input->proposed_salary_extra,
                'availability' => $applicants_input->availability == null ? $applicants->availability : $applicants_input->availability,
                'description' => $applicants_input->description == null ? $applicants->description : $applicants_input->description,
                'is_active' => $applicants_input->is_active == null ? $applicants->is_active : $applicants_input->is_active,
                'date_closed' => $applicants_input->date_closed == null ? $applicants->date_closed : $applicants_input->date_closed,
                'date_open' => $applicants_input->date_open == null ? $applicants->date_open : $applicants_input->date_open,
                'date_last_stage_up' => $applicants_input->date_last_stage_up == null ? $applicants->date_last_stage_up : $applicants_input->date_last_stage_up,
                'recruitment_stage_id' => $applicants_input->recruitment_stage_id == null ? $applicants->recruitment_stage_id : $applicants_input->recruitment_stage_id,
                'last_recruitment_stage_id' => $applicants_input->last_recruitment_stage_id == null ? $applicants->last_recruitment_stage_id : $applicants_input->last_recruitment_stage_id,
                'probability' => $applicants_input->probability == null ? $applicants->probability : $applicants_input->probability,
                'user_id' => $applicants_input->user_id == null ? $applicants->user_id : $applicants_input->user_id,
                'applicant_refuse_type_id' => $applicants_input->applicant_refuse_type_id == null ? $applicants->applicant_refuse_type_id : $applicants_input->applicant_refuse_type_id,
            ]);

            if ($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
                $applicants->degree = $applicants->degree;
                $applicants->job = $applicants->job;
                $applicants->departement = $applicants->departement;
                $applicants->company = $applicants->company;
                $applicants->metsos_source = $applicants->metsos_source;
                $applicants->user = $applicants->user;
            }

            if ($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
                $applicants->applicant_applicant_tags = $applicants->applicantApplicantTags;
                $applicants->applicant_applicant_followers = $applicants->applicantApplicantFollowers;
                $applicants->applicant_applicant_comments = $applicants->applicantApplicantComments;
                $applicants->applicatn_refuse_type = $applicants->applicantRefuseType;
            }

            return ApiResponse::success(compact('applicants'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }


    /**
     * @OA\Delete(
     *      path="/module/hrm/v1/applicant/{id}",
     *      operationId="DeleteApplicant",
     *      tags={"Applicants"},
     *      summary="Delete applicants",
     *      description="Delete applicants",
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
            $applicants = Applicant::find($id);

            $applicants->delete();

            return ApiResponse::success();
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Post(
     *      path="/module/hrm/v1/applicant/create-employee",
     *      operationId="ApplicantAddNewEmployee",
     *      tags={"Applicants"},
     *      summary="Add new employee",
     *      description="Add a new employee",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/ApplicantCreateEmployeeInput")
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
    public function createEmployee(Request $request)
    {
        try {

            $applicant_create_employee_input = new ApplicantCreateEmployeeInput($request);

            $recruitment_id = $applicant_create_employee_input->recruitment_id;
            $applicant_id = $applicant_create_employee_input->applicant_id;

            $applicant = Applicant::where('id', $applicant_id)->where('recruitment_id', $recruitment_id)->first();

            $employee = null ;
            if (isset($applicant)) {
                $data_create_employee = [
                    'user_id' => $applicant->user_id,
                    'name' => $applicant->name,
                    'job_postion_name' => $applicant->title,
                    // 'work_mobile' => $applicant,
                    // 'work_phone' => $applicant,
                    // 'work_email' => $applicant,
                    'departement_id' => $applicant->departement_id,
                    'company_id' => $applicant->company_id,
                    // 'coach_id' => $applicant,
                    'is_active' => true,
                    // 'work_address_id' => $applicant,
                    // 'work_location' => $applicant,
                    // 'approve_time_off_user_id' => $applicant,
                    // 'approve_expenses_user_id' => $applicant,
                    // 'work_id' => $applicant,
                    // 'tz' => $applicant,
                    // 'address_id' => $applicant,
                    'email' => $applicant->email,
                    'phone' => $applicant->phone,
                    // 'home_work_distance' => $applicant,
                    // 'marital_status' => $applicant,
                    // 'emergency_contanct' => $applicant,
                    // 'emergency_phone' => $applicant,
                    // 'certificate_level_id' => $applicant,
                    // 'field_of_study' => $applicant,
                    // 'school' => $applicant,
                    // 'country_id' => $applicant,
                    // 'identification_no' => $applicant,
                    // 'pasport_no' => $applicant,
                    // 'gender' => $applicant,
                    // 'data_of_birth' => $applicant,
                    // 'place_of_birth' => $applicant,
                    // 'country_of_birth_id' => $applicant,
                    // 'no_of_children' => $applicant,
                    // 'visa_no' => $applicant,
                    // 'work_permit_no' => $applicant,
                    // 'visa_expire_data' => $applicant,
                    'job_id' => $applicant->job_id,
                    // 'mobility_card' => $applicant,
                    // 'pin_code' => $applicant,
                    // 'id_badge' => $applicant,
                ];

                // create employee
                $employee = Employee::create($data_create_employee);

                $recruitment = Recruitment::find($recruitment_id);
                if (isset($recruitment)) {
                    $job_id = $recruitment->job_id;
                    $job = Job::find($job_id);

                    // increment no employee in job
                    if (isset($job)) {
                        if ($job->no_of_employee == null) {
                            $job->no_of_employee = 1;
                        } else {
                            $job->no_of_employee = $job->no_of_employee + 1;
                        }
                        $job->save();


                        // if no_of_to_recruit equal with no_of_hired_employee
                        if ($recruitment->no_of_to_recruit != null && $job->no_of_hired_employee != null) {

                            // increment no_of_to_recruit because of new employee
                            $recruitment->no_of_to_recruit += 1;

                            // triger status done recruitment is true
                            if ($recruitment->no_of_to_recruit == $job->no_of_hired_employe) {
                                $recruitment->is_recruitment_done = true;
                            }
                        }
                    }

                    // save recruitement
                    $recruitment->save();
                }

                // close applicant
                $date_closed = date('Y-m-d');
                $applicant->date_closed = $date_closed;
                $applicant->save();
            }

            return ApiResponse::success(compact('applicant', 'employee'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }
}

<?php

namespace Uasoft\Badaso\Module\HRM\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\HRM\Models\Employee;
use Uasoft\Badaso\Module\HRM\Schema\Inputs\EmployeeInput;

class EmployeeController extends Controller
{
    /**
     * @OA\Post(
     *      path="/module/hrm/v1/employee",
     *      operationId="AddEmployee",
     *      tags={"Employees"},
     *      summary="Add new employees",
     *      description="Add a new employees",
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
     *          @OA\JsonContent(ref="#/components/schemas/EmployeeInput")
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
            $employees_input = new EmployeeInput($request);

            $employees = Employee::create([
                  'user_id' => $employees_input->user_id,
              'name' => $employees_input->name,
              'job_postion_name' => $employees_input->job_postion_name,
              'work_mobile' => $employees_input->work_mobile,
              'work_phone' => $employees_input->work_phone,
              'work_email' => $employees_input->work_email,
              'departement_id' => $employees_input->departement_id,
              'company_id' => $employees_input->company_id,
              'coach_id' => $employees_input->coach_id,
              'is_active' => $employees_input->is_active,
              'work_address_id' => $employees_input->work_address_id,
              'work_location' => $employees_input->work_location,
              'approve_time_off_user_id' => $employees_input->approve_time_off_user_id,
              'approve_expenses_user_id' => $employees_input->approve_expenses_user_id,
              'work_id' => $employees_input->work_id,
              'tz' => $employees_input->tz,
              'address_id' => $employees_input->address_id,
              'email' => $employees_input->email,
              'phone' => $employees_input->phone,
              'home_work_distance' => $employees_input->home_work_distance,
              'marital_status' => $employees_input->marital_status,
              'emergency_contanct' => $employees_input->emergency_contanct,
              'emergency_phone' => $employees_input->emergency_phone,
              'certificate_level_id' => $employees_input->certificate_level_id,
              'field_of_study' => $employees_input->field_of_study,
              'school' => $employees_input->school,
              'country_id' => $employees_input->country_id,
              'identification_no' => $employees_input->identification_no,
              'pasport_no' => $employees_input->pasport_no,
              'gender' => $employees_input->gender,
              'data_of_birth' => $employees_input->data_of_birth,
              'place_of_birth' => $employees_input->place_of_birth,
              'country_of_birth_id' => $employees_input->country_of_birth_id,
              'no_of_children' => $employees_input->no_of_children,
              'visa_no' => $employees_input->visa_no,
              'work_permit_no' => $employees_input->work_permit_no,
              'visa_expire_data' => $employees_input->visa_expire_data,
              'job_id' => $employees_input->job_id,
              'mobility_card' => $employees_input->mobility_card,
              'pin_code' => $employees_input->pin_code,
              'id_badge' => $employees_input->id_badge,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $employees->user = $employees->user ;
         $employees->approve_time_off_user = $employees->approve_time_off_user ;
         $employees->approve_expenses_user = $employees->approve_expenses_user ;
         $employees->work = $employees->work ;
         $employees->certificate_level = $employees->certificate_level ;
         $employees->country = $employees->country ;
         $employees->country_of_birth = $employees->country_of_birth ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $employees->employee_employee_tags = $employees->employeeEmployeeTags ;
            $employees->employee_employee_resumes = $employees->employeeEmployeeResumes ;
            $employees->employee_employee_attendances = $employees->employeeEmployeeAttendances ;
            $employees->manager_departements = $employees->managerDepartements ;
            $employees->manager_jobs = $employees->managerJobs ;
            $employees->for_employee_time_off_allocations = $employees->forEmployeeTimeOffAllocations ;
            $employees->first_approve_employee_time_off_allocations = $employees->firstApproveEmployeeTimeOffAllocations ;
            $employees->second_approve_employee_time_off_allocations = $employees->secondApproveEmployeeTimeOffAllocations ;
            $employees->manager_employee_time_offs = $employees->managerEmployeeTimeOffs ;
            $employees->employee_time_offs = $employees->employeeTimeOffs ;
            $employees->employee_expense_reports = $employees->employeeExpenseReports ;
 
            }

            return ApiResponse::success(compact('employees'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/employee",
     *      operationId="BrowseEmployee",
     *      tags={"Employees"},
     *      summary="Browse employees",
     *      description="Browse employees",
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

            $employees = new Employee();
            $employees_fillable = $employees->getFillable();

            $filter_fields = $request->get('filter_fields', '*');
            $filter_fields = explode(',', $filter_fields);
            if (array_search('*', $filter_fields) == false) {
                $new_filter_fields = [];
                foreach ($filter_fields as $index => $field) {
                    if (!in_array($field, $filter_fields)) {
                        $new_filter_fields[] = $field;
                    }
                }
                $employees = $employees->select($filter_fields);
            }

            $filter_fields_search = $request->get('filter_fields_search', '*');
            $filter_fields_search = explode(',', $filter_fields_search);
            if (isset($request->search)) {
                if (array_search('*', $filter_fields_search) == false) {
                    foreach ($employees_fillable as $index => $field) {
                        $employees = $employees->orWhere($field, "like", "%$request->search%");
                    }
                } else {
                    foreach ($filter_fields_search as $index => $field) {
                        if (in_array($field, $employees_fillable)) {
                            $employees = $employees->orWhere($field, "like", "%$request->search%");
                        }
                    }
                }
            }

            if ($request->get('show_pagination', 'true') == 'true') {
                $max_page = $request->get('max_page', 15);
                $employees = $employees->paginate($max_page);
            } else {
                $employees = $employees->get();
            }

            $employees->map(function($employees) use ($request){

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $employees->user = $employees->user ;
         $employees->approve_time_off_user = $employees->approve_time_off_user ;
         $employees->approve_expenses_user = $employees->approve_expenses_user ;
         $employees->work = $employees->work ;
         $employees->certificate_level = $employees->certificate_level ;
         $employees->country = $employees->country ;
         $employees->country_of_birth = $employees->country_of_birth ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $employees->employee_employee_tags = $employees->employeeEmployeeTags ;
            $employees->employee_employee_resumes = $employees->employeeEmployeeResumes ;
            $employees->employee_employee_attendances = $employees->employeeEmployeeAttendances ;
            $employees->manager_departements = $employees->managerDepartements ;
            $employees->manager_jobs = $employees->managerJobs ;
            $employees->for_employee_time_off_allocations = $employees->forEmployeeTimeOffAllocations ;
            $employees->first_approve_employee_time_off_allocations = $employees->firstApproveEmployeeTimeOffAllocations ;
            $employees->second_approve_employee_time_off_allocations = $employees->secondApproveEmployeeTimeOffAllocations ;
            $employees->manager_employee_time_offs = $employees->managerEmployeeTimeOffs ;
            $employees->employee_time_offs = $employees->employeeTimeOffs ;
            $employees->employee_expense_reports = $employees->employeeExpenseReports ;
 
            }

                return $employees ;
            });
            $employees = $employees->toArray();

            return ApiResponse::success(compact('employees'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/employee/{id}",
     *      operationId="ReadEmployee",
     *      tags={"Employees"},
     *      summary="Read employees",
     *      description="Read employees",
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

            $employees = Employee::find($id);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $employees->user = $employees->user ;
         $employees->approve_time_off_user = $employees->approve_time_off_user ;
         $employees->approve_expenses_user = $employees->approve_expenses_user ;
         $employees->work = $employees->work ;
         $employees->certificate_level = $employees->certificate_level ;
         $employees->country = $employees->country ;
         $employees->country_of_birth = $employees->country_of_birth ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $employees->employee_employee_tags = $employees->employeeEmployeeTags ;
            $employees->employee_employee_resumes = $employees->employeeEmployeeResumes ;
            $employees->employee_employee_attendances = $employees->employeeEmployeeAttendances ;
            $employees->manager_departements = $employees->managerDepartements ;
            $employees->manager_jobs = $employees->managerJobs ;
            $employees->for_employee_time_off_allocations = $employees->forEmployeeTimeOffAllocations ;
            $employees->first_approve_employee_time_off_allocations = $employees->firstApproveEmployeeTimeOffAllocations ;
            $employees->second_approve_employee_time_off_allocations = $employees->secondApproveEmployeeTimeOffAllocations ;
            $employees->manager_employee_time_offs = $employees->managerEmployeeTimeOffs ;
            $employees->employee_time_offs = $employees->employeeTimeOffs ;
            $employees->employee_expense_reports = $employees->employeeExpenseReports ;
 
            }

            return ApiResponse::success(compact('employees'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Put(
     *      path="/module/hrm/v1/employee/{id}",
     *      operationId="UpdateEmployee",
     *      tags={"Employees"},
     *      summary="Update employees",
     *      description="Update employees",
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
     *          @OA\JsonContent(ref="#/components/schemas/EmployeeInput")
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
            $employees_input = new EmployeeInput($request);
            $employees = Employee::find($id);

            $employees->update([
                  'user_id' => $employees_input->user_id == null ? $employees->user_id : $employees_input->user_id,
              'name' => $employees_input->name == null ? $employees->name : $employees_input->name,
              'job_postion_name' => $employees_input->job_postion_name == null ? $employees->job_postion_name : $employees_input->job_postion_name,
              'work_mobile' => $employees_input->work_mobile == null ? $employees->work_mobile : $employees_input->work_mobile,
              'work_phone' => $employees_input->work_phone == null ? $employees->work_phone : $employees_input->work_phone,
              'work_email' => $employees_input->work_email == null ? $employees->work_email : $employees_input->work_email,
              'departement_id' => $employees_input->departement_id == null ? $employees->departement_id : $employees_input->departement_id,
              'company_id' => $employees_input->company_id == null ? $employees->company_id : $employees_input->company_id,
              'coach_id' => $employees_input->coach_id == null ? $employees->coach_id : $employees_input->coach_id,
              'is_active' => $employees_input->is_active == null ? $employees->is_active : $employees_input->is_active,
              'work_address_id' => $employees_input->work_address_id == null ? $employees->work_address_id : $employees_input->work_address_id,
              'work_location' => $employees_input->work_location == null ? $employees->work_location : $employees_input->work_location,
              'approve_time_off_user_id' => $employees_input->approve_time_off_user_id == null ? $employees->approve_time_off_user_id : $employees_input->approve_time_off_user_id,
              'approve_expenses_user_id' => $employees_input->approve_expenses_user_id == null ? $employees->approve_expenses_user_id : $employees_input->approve_expenses_user_id,
              'work_id' => $employees_input->work_id == null ? $employees->work_id : $employees_input->work_id,
              'tz' => $employees_input->tz == null ? $employees->tz : $employees_input->tz,
              'address_id' => $employees_input->address_id == null ? $employees->address_id : $employees_input->address_id,
              'email' => $employees_input->email == null ? $employees->email : $employees_input->email,
              'phone' => $employees_input->phone == null ? $employees->phone : $employees_input->phone,
              'home_work_distance' => $employees_input->home_work_distance == null ? $employees->home_work_distance : $employees_input->home_work_distance,
              'marital_status' => $employees_input->marital_status == null ? $employees->marital_status : $employees_input->marital_status,
              'emergency_contanct' => $employees_input->emergency_contanct == null ? $employees->emergency_contanct : $employees_input->emergency_contanct,
              'emergency_phone' => $employees_input->emergency_phone == null ? $employees->emergency_phone : $employees_input->emergency_phone,
              'certificate_level_id' => $employees_input->certificate_level_id == null ? $employees->certificate_level_id : $employees_input->certificate_level_id,
              'field_of_study' => $employees_input->field_of_study == null ? $employees->field_of_study : $employees_input->field_of_study,
              'school' => $employees_input->school == null ? $employees->school : $employees_input->school,
              'country_id' => $employees_input->country_id == null ? $employees->country_id : $employees_input->country_id,
              'identification_no' => $employees_input->identification_no == null ? $employees->identification_no : $employees_input->identification_no,
              'pasport_no' => $employees_input->pasport_no == null ? $employees->pasport_no : $employees_input->pasport_no,
              'gender' => $employees_input->gender == null ? $employees->gender : $employees_input->gender,
              'data_of_birth' => $employees_input->data_of_birth == null ? $employees->data_of_birth : $employees_input->data_of_birth,
              'place_of_birth' => $employees_input->place_of_birth == null ? $employees->place_of_birth : $employees_input->place_of_birth,
              'country_of_birth_id' => $employees_input->country_of_birth_id == null ? $employees->country_of_birth_id : $employees_input->country_of_birth_id,
              'no_of_children' => $employees_input->no_of_children == null ? $employees->no_of_children : $employees_input->no_of_children,
              'visa_no' => $employees_input->visa_no == null ? $employees->visa_no : $employees_input->visa_no,
              'work_permit_no' => $employees_input->work_permit_no == null ? $employees->work_permit_no : $employees_input->work_permit_no,
              'visa_expire_data' => $employees_input->visa_expire_data == null ? $employees->visa_expire_data : $employees_input->visa_expire_data,
              'job_id' => $employees_input->job_id == null ? $employees->job_id : $employees_input->job_id,
              'mobility_card' => $employees_input->mobility_card == null ? $employees->mobility_card : $employees_input->mobility_card,
              'pin_code' => $employees_input->pin_code == null ? $employees->pin_code : $employees_input->pin_code,
              'id_badge' => $employees_input->id_badge == null ? $employees->id_badge : $employees_input->id_badge,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $employees->user = $employees->user ;
         $employees->approve_time_off_user = $employees->approve_time_off_user ;
         $employees->approve_expenses_user = $employees->approve_expenses_user ;
         $employees->work = $employees->work ;
         $employees->certificate_level = $employees->certificate_level ;
         $employees->country = $employees->country ;
         $employees->country_of_birth = $employees->country_of_birth ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $employees->employee_employee_tags = $employees->employeeEmployeeTags ;
            $employees->employee_employee_resumes = $employees->employeeEmployeeResumes ;
            $employees->employee_employee_attendances = $employees->employeeEmployeeAttendances ;
            $employees->manager_departements = $employees->managerDepartements ;
            $employees->manager_jobs = $employees->managerJobs ;
            $employees->for_employee_time_off_allocations = $employees->forEmployeeTimeOffAllocations ;
            $employees->first_approve_employee_time_off_allocations = $employees->firstApproveEmployeeTimeOffAllocations ;
            $employees->second_approve_employee_time_off_allocations = $employees->secondApproveEmployeeTimeOffAllocations ;
            $employees->manager_employee_time_offs = $employees->managerEmployeeTimeOffs ;
            $employees->employee_time_offs = $employees->employeeTimeOffs ;
            $employees->employee_expense_reports = $employees->employeeExpenseReports ;
 
            }

            return ApiResponse::success(compact('employees'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }


    /**
     * @OA\Delete(
     *      path="/module/hrm/v1/employee/{id}",
     *      operationId="DeleteEmployee",
     *      tags={"Employees"},
     *      summary="Delete employees",
     *      description="Delete employees",
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
            $employees = Employee::find($id);

            $employees->delete();

            return ApiResponse::success();
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }
}

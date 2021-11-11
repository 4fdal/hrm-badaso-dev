<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="EmployeeInput",
 *     description="",
 *     @OA\Xml(
 *         name="EmployeeInput"
 *     )
 * )
 */

class EmployeeInput {
    /**
     * @OA\Property(
     *     title="user_id",
     *     description="user_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $user_id;
    /**
     * @OA\Property(
     *     title="name",
     *     description="name",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $name;
    /**
     * @OA\Property(
     *     title="job_postion_name",
     *     description="job_postion_name",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $job_postion_name;
    /**
     * @OA\Property(
     *     title="work_mobile",
     *     description="work_mobile",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $work_mobile;
    /**
     * @OA\Property(
     *     title="work_phone",
     *     description="work_phone",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $work_phone;
    /**
     * @OA\Property(
     *     title="work_email",
     *     description="work_email",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $work_email;
    /**
     * @OA\Property(
     *     title="departement_id",
     *     description="departement_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $departement_id;
    /**
     * @OA\Property(
     *     title="company_id",
     *     description="company_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $company_id;
    /**
     * @OA\Property(
     *     title="coach_id",
     *     description="coach_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $coach_id;
    /**
     * @OA\Property(
     *     title="is_active",
     *     description="is_active",
     *     type="boolean",
     *     example=""
     * )
     *
     * @var boolean
     */
    public $is_active;
    /**
     * @OA\Property(
     *     title="work_address_id",
     *     description="work_address_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $work_address_id;
    /**
     * @OA\Property(
     *     title="work_location",
     *     description="work_location",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $work_location;
    /**
     * @OA\Property(
     *     title="approve_time_off_user_id",
     *     description="approve_time_off_user_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $approve_time_off_user_id;
    /**
     * @OA\Property(
     *     title="approve_expenses_user_id",
     *     description="approve_expenses_user_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $approve_expenses_user_id;
    /**
     * @OA\Property(
     *     title="work_id",
     *     description="work_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $work_id;
    /**
     * @OA\Property(
     *     title="tz",
     *     description="tz",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $tz;
    /**
     * @OA\Property(
     *     title="address_id",
     *     description="address_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $address_id;
    /**
     * @OA\Property(
     *     title="email",
     *     description="email",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $email;
    /**
     * @OA\Property(
     *     title="phone",
     *     description="phone",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $phone;
    /**
     * @OA\Property(
     *     title="home_work_distance",
     *     description="home_work_distance",
     *     type="double",
     *     example="0"
     * )
     *
     * @var double
     */
    public $home_work_distance;
    /**
     * @OA\Property(
     *     title="marital_status",
     *     description="marital_status",
     *     type="string",
     *     example="lorem type"
     * )
     *
     * @var string
     */
    public $marital_status;
    /**
     * @OA\Property(
     *     title="emergency_contanct",
     *     description="emergency_contanct",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $emergency_contanct;
    /**
     * @OA\Property(
     *     title="emergency_phone",
     *     description="emergency_phone",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $emergency_phone;
    /**
     * @OA\Property(
     *     title="certificate_level_id",
     *     description="certificate_level_id",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $certificate_level_id;
    /**
     * @OA\Property(
     *     title="field_of_study",
     *     description="field_of_study",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $field_of_study;
    /**
     * @OA\Property(
     *     title="school",
     *     description="school",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $school;
    /**
     * @OA\Property(
     *     title="country_id",
     *     description="country_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $country_id;
    /**
     * @OA\Property(
     *     title="identification_no",
     *     description="identification_no",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $identification_no;
    /**
     * @OA\Property(
     *     title="pasport_no",
     *     description="pasport_no",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $pasport_no;
    /**
     * @OA\Property(
     *     title="gender",
     *     description="gender",
     *     type="string",
     *     example="lorem type"
     * )
     *
     * @var string
     */
    public $gender;
    /**
     * @OA\Property(
     *     title="data_of_birth",
     *     description="data_of_birth",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $data_of_birth;
    /**
     * @OA\Property(
     *     title="place_of_birth",
     *     description="place_of_birth",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $place_of_birth;
    /**
     * @OA\Property(
     *     title="country_of_birth_id",
     *     description="country_of_birth_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $country_of_birth_id;
    /**
     * @OA\Property(
     *     title="no_of_children",
     *     description="no_of_children",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $no_of_children;
    /**
     * @OA\Property(
     *     title="visa_no",
     *     description="visa_no",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $visa_no;
    /**
     * @OA\Property(
     *     title="work_permit_no",
     *     description="work_permit_no",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $work_permit_no;
    /**
     * @OA\Property(
     *     title="visa_expire_data",
     *     description="visa_expire_data",
     *     type="string",
     *     example="2021-10-28"
     * )
     *
     * @var string
     */
    public $visa_expire_data;
    /**
     * @OA\Property(
     *     title="job_id",
     *     description="job_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $job_id;
    /**
     * @OA\Property(
     *     title="mobility_card",
     *     description="mobility_card",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $mobility_card;
    /**
     * @OA\Property(
     *     title="pin_code",
     *     description="pin_code",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $pin_code;
    /**
     * @OA\Property(
     *     title="id_badge",
     *     description="id_badge",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $id_badge;


    public function __construct(Request $request)
    {
        $request->validate([
           'user_id' => ['nullable', 'integer'],
           'name' => ['nullable', 'string'],
           'job_postion_name' => ['nullable', 'string'],
           'work_mobile' => ['nullable', 'string'],
           'work_phone' => ['nullable', 'string'],
           'work_email' => ['nullable', 'string'],
           'departement_id' => ['nullable', 'integer'],
           'company_id' => ['nullable', 'integer'],
           'coach_id' => ['nullable', 'integer'],
           'is_active' => ['nullable', 'boolean'],
           'work_address_id' => ['nullable', 'integer'],
           'work_location' => ['nullable', 'string'],
           'approve_time_off_user_id' => ['nullable', 'integer'],
           'approve_expenses_user_id' => ['nullable', 'integer'],
           'work_id' => ['nullable', 'integer'],
           'tz' => ['nullable', 'string'],
           'address_id' => ['nullable', 'integer'],
           'email' => ['nullable', 'string'],
           'phone' => ['nullable', 'string'],
           'home_work_distance' => ['nullable', 'numeric'],
           'marital_status' => ['nullable', 'string'],
           'emergency_contanct' => ['nullable', 'string'],
           'emergency_phone' => ['nullable', 'string'],
           'certificate_level_id' => ['nullable', 'string'],
           'field_of_study' => ['nullable', 'string'],
           'school' => ['nullable', 'string'],
           'country_id' => ['nullable', 'integer'],
           'identification_no' => ['nullable', 'string'],
           'pasport_no' => ['nullable', 'string'],
           'gender' => ['nullable', 'string'],
           'data_of_birth' => ['nullable', 'string'],
           'place_of_birth' => ['nullable', 'string'],
           'country_of_birth_id' => ['nullable', 'integer'],
           'no_of_children' => ['nullable', 'integer'],
           'visa_no' => ['nullable', 'string'],
           'work_permit_no' => ['nullable', 'string'],
           'visa_expire_data' => ['nullable', 'date_format:Y-m-d'],
           'job_id' => ['nullable', 'integer'],
           'mobility_card' => ['nullable', 'string'],
           'pin_code' => ['nullable', 'string'],
           'id_badge' => ['nullable', 'string'],

        ]);

        $this->user_id = $request->user_id ;
        $this->name = $request->name ;
        $this->job_postion_name = $request->job_postion_name ;
        $this->work_mobile = $request->work_mobile ;
        $this->work_phone = $request->work_phone ;
        $this->work_email = $request->work_email ;
        $this->departement_id = $request->departement_id ;
        $this->company_id = $request->company_id ;
        $this->coach_id = $request->coach_id ;
        $this->is_active = $request->is_active ;
        $this->work_address_id = $request->work_address_id ;
        $this->work_location = $request->work_location ;
        $this->approve_time_off_user_id = $request->approve_time_off_user_id ;
        $this->approve_expenses_user_id = $request->approve_expenses_user_id ;
        $this->work_id = $request->work_id ;
        $this->tz = $request->tz ;
        $this->address_id = $request->address_id ;
        $this->email = $request->email ;
        $this->phone = $request->phone ;
        $this->home_work_distance = $request->home_work_distance ;
        $this->marital_status = $request->marital_status ;
        $this->emergency_contanct = $request->emergency_contanct ;
        $this->emergency_phone = $request->emergency_phone ;
        $this->certificate_level_id = $request->certificate_level_id ;
        $this->field_of_study = $request->field_of_study ;
        $this->school = $request->school ;
        $this->country_id = $request->country_id ;
        $this->identification_no = $request->identification_no ;
        $this->pasport_no = $request->pasport_no ;
        $this->gender = $request->gender ;
        $this->data_of_birth = $request->data_of_birth ;
        $this->place_of_birth = $request->place_of_birth ;
        $this->country_of_birth_id = $request->country_of_birth_id ;
        $this->no_of_children = $request->no_of_children ;
        $this->visa_no = $request->visa_no ;
        $this->work_permit_no = $request->work_permit_no ;
        $this->visa_expire_data = $request->visa_expire_data ;
        $this->job_id = $request->job_id ;
        $this->mobility_card = $request->mobility_card ;
        $this->pin_code = $request->pin_code ;
        $this->id_badge = $request->id_badge ;

    }
}

<?php

namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="ApplicantInput",
 *     description="",
 *     @OA\Xml(
 *         name="ApplicantInput"
 *     )
 * )
 */

class ApplicantInput
{
    /**
     * @OA\Property(
     *     title="title",
     *     description="title",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $title;
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
     *     title="mobile",
     *     description="mobile",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $mobile;
    /**
     * @OA\Property(
     *     title="degree_id",
     *     description="degree_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $degree_id;
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
     *     title="recruitment_id",
     *     description="recruitment_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $recruitment_id;
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
     *     title="recruiter_id",
     *     description="recruiter_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $recruiter_id;
    /**
     * @OA\Property(
     *     title="appreciation",
     *     description="appreciation",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $appreciation;
    /**
     * @OA\Property(
     *     title="metsos_source_id",
     *     description="metsos_source_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $metsos_source_id;
    /**
     * @OA\Property(
     *     title="expected_salary",
     *     description="expected_salary",
     *     type="numeric",
     *     example="0"
     * )
     *
     * @var float
     */
    public $expected_salary;
    /**
     * @OA\Property(
     *     title="expected_salary_extra",
     *     description="expected_salary_extra",
     *     type="numeric",
     *     example="0"
     * )
     *
     * @var float
     */
    public $expected_salary_extra;
    /**
     * @OA\Property(
     *     title="proposed_salary",
     *     description="proposed_salary",
     *     type="numeric",
     *     example="0"
     * )
     *
     * @var float
     */
    public $proposed_salary;
    /**
     * @OA\Property(
     *     title="proposed_salary_extra",
     *     description="proposed_salary_extra",
     *     type="numeric",
     *     example="0"
     * )
     *
     * @var float
     */
    public $proposed_salary_extra;
    /**
     * @OA\Property(
     *     title="availability",
     *     description="availability",
     *     type="string",
     *     example="2021-10-28"
     * )
     *
     * @var string
     */
    public $availability;
    /**
     * @OA\Property(
     *     title="description",
     *     description="description",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $description;
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
     *     title="date_closed",
     *     description="date_closed",
     *     type="string",
     *     example="2021-10-28"
     * )
     *
     * @var string
     */
    public $date_closed;
    /**
     * @OA\Property(
     *     title="date_open",
     *     description="date_open",
     *     type="string",
     *     example="2021-10-28"
     * )
     *
     * @var string
     */
    public $date_open;
    /**
     * @OA\Property(
     *     title="date_last_stage_up",
     *     description="date_last_stage_up",
     *     type="string",
     *     example="2021-10-28"
     * )
     *
     * @var string
     */
    public $date_last_stage_up;
    /**
     * @OA\Property(
     *     title="recruitment_stage_id",
     *     description="recruitment_stage_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $recruitment_stage_id;
    /**
     * @OA\Property(
     *     title="last_recruitment_stage_id",
     *     description="last_recruitment_stage_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $last_recruitment_stage_id;
    /**
     * @OA\Property(
     *     title="probability",
     *     description="probability",
     *     type="numeric",
     *     example="0"
     * )
     *
     * @var float
     */
    public $probability;
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
     *     title="applicant_refuse_type_id",
     *     description="applicant_refuse_type_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $applicant_refuse_type_id;


    public function __construct(Request $request)
    {

        $request->validate([
            'title' => ['nullable', 'string'],
            'name' => ['nullable', 'string'],
            'email' => ['nullable', 'string'],
            'phone' => ['nullable', 'string'],
            'mobile' => ['nullable', 'string'],
            'degree_id' => ['nullable', 'integer'],
            'job_id' => ['nullable', 'integer'],
            'recruitment_id' => ['nullable', 'integer'],
            'departement_id' => ['nullable', 'integer'],
            'company_id' => ['nullable', 'integer'],
            'recruiter_id' => ['nullable', 'integer'],
            'appreciation' => ['nullable', 'integer'],
            'metsos_source_id' => ['nullable', 'integer'],
            'expected_salary' => ['nullable', 'numeric'],
            'expected_salary_extra' => ['nullable', 'numeric'],
            'proposed_salary' => ['nullable', 'numeric'],
            'proposed_salary_extra' => ['nullable', 'numeric'],
            'availability' => ['nullable', 'date_format:Y-m-d'],
            'description' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean'],
            'date_closed' => ['nullable', 'date_format:Y-m-d'],
            'date_open' => ['nullable', 'date_format:Y-m-d'],
            'date_last_stage_up' => ['nullable', 'date_format:Y-m-d'],
            'recruitment_stage_id' => ['nullable', 'integer'],
            'last_recruitment_stage_id' => ['nullable', 'integer'],
            'probability' => ['nullable', 'numeric'],
            'user_id' => ['nullable', 'integer'],
            'applicant_refuse_type_id' => ['nullable', 'integer'],

        ]);

        $this->title = $request->title;
        $this->name = $request->name;
        $this->email = $request->email;
        $this->phone = $request->phone;
        $this->mobile = $request->mobile;
        $this->degree_id = $request->degree_id;
        $this->job_id = $request->job_id;
        $this->recruitment_id = $request->recruitment_id;
        $this->departement_id = $request->departement_id;
        $this->company_id = $request->company_id;
        $this->recruiter_id = $request->recruiter_id;
        $this->appreciation = $request->appreciation;
        $this->metsos_source_id = $request->metsos_source_id;
        $this->expected_salary = $request->expected_salary;
        $this->expected_salary_extra = $request->expected_salary_extra;
        $this->proposed_salary = $request->proposed_salary;
        $this->proposed_salary_extra = $request->proposed_salary_extra;
        $this->availability = $request->availability;
        $this->description = $request->description;
        $this->is_active = $request->is_active;
        $this->date_closed = $request->date_closed;
        $this->date_open = $request->date_open;
        $this->date_last_stage_up = $request->date_last_stage_up;
        $this->recruitment_stage_id = $request->recruitment_stage_id;
        $this->last_recruitment_stage_id = $request->last_recruitment_stage_id;
        $this->probability = $request->probability;
        $this->user_id = $request->user_id;
        $this->applicant_refuse_type_id = $request->applicant_refuse_type_id ;
    }
}

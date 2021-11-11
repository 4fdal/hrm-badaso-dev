<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="TimeOffTypeInput",
 *     description="",
 *     @OA\Xml(
 *         name="TimeOffTypeInput"
 *     )
 * )
 */

class TimeOffTypeInput {
    /**
     * @OA\Property(
     *     title="is_create_calendar",
     *     description="is_create_calendar",
     *     type="boolean",
     *     example=""
     * )
     *
     * @var boolean
     */
    public $is_create_calendar;
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
     *     title="color",
     *     description="color",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $color;
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
     *     title="payroll_code",
     *     description="payroll_code",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $payroll_code;
    /**
     * @OA\Property(
     *     title="take_time_off_types",
     *     description="take_time_off_types",
     *     type="string",
     *     example="lorem type"
     * )
     *
     * @var string
     */
    public $take_time_off_types;
    /**
     * @OA\Property(
     *     title="responsible_user_id",
     *     description="responsible_user_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $responsible_user_id;
    /**
     * @OA\Property(
     *     title="allocation_types",
     *     description="allocation_types",
     *     type="string",
     *     example="lorem type"
     * )
     *
     * @var string
     */
    public $allocation_types;
    /**
     * @OA\Property(
     *     title="allocation_validation_types",
     *     description="allocation_validation_types",
     *     type="string",
     *     example="lorem type"
     * )
     *
     * @var string
     */
    public $allocation_validation_types;
    /**
     * @OA\Property(
     *     title="validity_start",
     *     description="validity_start",
     *     type="string",
     *     example="2021-10-28"
     * )
     *
     * @var string
     */
    public $validity_start;
    /**
     * @OA\Property(
     *     title="validity_stop",
     *     description="validity_stop",
     *     type="string",
     *     example="2021-10-28"
     * )
     *
     * @var string
     */
    public $validity_stop;
    /**
     * @OA\Property(
     *     title="time_off_validation_types",
     *     description="time_off_validation_types",
     *     type="string",
     *     example="lorem type"
     * )
     *
     * @var string
     */
    public $time_off_validation_types;


    public function __construct(Request $request)
    {
        $request->validate([
           'is_create_calendar' => ['nullable', 'boolean'],
           'is_active' => ['nullable', 'boolean'],
           'color' => ['nullable', 'string'],
           'company_id' => ['nullable', 'integer'],
           'name' => ['nullable', 'string'],
           'payroll_code' => ['nullable', 'string'],
           'take_time_off_types' => ['nullable', 'string'],
           'responsible_user_id' => ['nullable', 'integer'],
           'allocation_types' => ['nullable', 'string'],
           'allocation_validation_types' => ['nullable', 'string'],
           'validity_start' => ['nullable', 'date_format:Y-m-d'],
           'validity_stop' => ['nullable', 'date_format:Y-m-d'],
           'time_off_validation_types' => ['nullable', 'string'],

        ]);

        $this->is_create_calendar = $request->is_create_calendar ;
        $this->is_active = $request->is_active ;
        $this->color = $request->color ;
        $this->company_id = $request->company_id ;
        $this->name = $request->name ;
        $this->payroll_code = $request->payroll_code ;
        $this->take_time_off_types = $request->take_time_off_types ;
        $this->responsible_user_id = $request->responsible_user_id ;
        $this->allocation_types = $request->allocation_types ;
        $this->allocation_validation_types = $request->allocation_validation_types ;
        $this->validity_start = $request->validity_start ;
        $this->validity_stop = $request->validity_stop ;
        $this->time_off_validation_types = $request->time_off_validation_types ;

    }
}

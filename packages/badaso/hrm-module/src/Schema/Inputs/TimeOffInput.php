<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="TimeOffInput",
 *     description="",
 *     @OA\Xml(
 *         name="TimeOffInput"
 *     )
 * )
 */

class TimeOffInput {
    /**
     * @OA\Property(
     *     title="private_name",
     *     description="private_name",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $private_name;
    /**
     * @OA\Property(
     *     title="status",
     *     description="status",
     *     type="string",
     *     example="lorem type"
     * )
     *
     * @var string
     */
    public $status;
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
     *     title="manager_employee_id",
     *     description="manager_employee_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $manager_employee_id;
    /**
     * @OA\Property(
     *     title="time_off_type_id",
     *     description="time_off_type_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $time_off_type_id;
    /**
     * @OA\Property(
     *     title="employee_id",
     *     description="employee_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $employee_id;
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
     *     title="notes",
     *     description="notes",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $notes;
    /**
     * @OA\Property(
     *     title="date_from",
     *     description="date_from",
     *     type="string",
     *     example="2021-10-28 08:11:17"
     * )
     *
     * @var string
     */
    public $date_from;
    /**
     * @OA\Property(
     *     title="date_to",
     *     description="date_to",
     *     type="string",
     *     example="2021-10-28 08:11:17"
     * )
     *
     * @var string
     */
    public $date_to;
    /**
     * @OA\Property(
     *     title="number_of_day",
     *     description="number_of_day",
     *     type="double",
     *     example="0"
     * )
     *
     * @var double
     */
    public $number_of_day;
    /**
     * @OA\Property(
     *     title="duration_display",
     *     description="duration_display",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $duration_display;
    /**
     * @OA\Property(
     *     title="metting_calendar_event_id",
     *     description="metting_calendar_event_id",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $metting_calendar_event_id;


    public function __construct(Request $request)
    {
        $request->validate([
           'private_name' => ['nullable', 'string'],
           'status' => ['nullable', 'string'],
           'user_id' => ['nullable', 'integer'],
           'manager_employee_id' => ['nullable', 'integer'],
           'time_off_type_id' => ['nullable', 'integer'],
           'employee_id' => ['nullable', 'integer'],
           'departement_id' => ['nullable', 'integer'],
           'notes' => ['nullable', 'string'],
           'date_from' => ['nullable', 'date_format:Y-m-d H:i:s'],
           'date_to' => ['nullable', 'date_format:Y-m-d H:i:s'],
           'number_of_day' => ['nullable', 'numeric'],
           'duration_display' => ['nullable', 'string'],
           'metting_calendar_event_id' => ['nullable', 'string'],

        ]);

        $this->private_name = $request->private_name ;
        $this->status = $request->status ;
        $this->user_id = $request->user_id ;
        $this->manager_employee_id = $request->manager_employee_id ;
        $this->time_off_type_id = $request->time_off_type_id ;
        $this->employee_id = $request->employee_id ;
        $this->departement_id = $request->departement_id ;
        $this->notes = $request->notes ;
        $this->date_from = $request->date_from ;
        $this->date_to = $request->date_to ;
        $this->number_of_day = $request->number_of_day ;
        $this->duration_display = $request->duration_display ;
        $this->metting_calendar_event_id = $request->metting_calendar_event_id ;

    }
}

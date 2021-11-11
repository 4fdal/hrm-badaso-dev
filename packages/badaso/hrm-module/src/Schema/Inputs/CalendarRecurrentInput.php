<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="CalendarRecurrentInput",
 *     description="",
 *     @OA\Xml(
 *         name="CalendarRecurrentInput"
 *     )
 * )
 */

class CalendarRecurrentInput {
    /**
     * @OA\Property(
     *     title="calendar_event_id",
     *     description="calendar_event_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $calendar_event_id;
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
     *     title="event_tz",
     *     description="event_tz",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $event_tz;
    /**
     * @OA\Property(
     *     title="rrule",
     *     description="rrule",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $rrule;
    /**
     * @OA\Property(
     *     title="rrule_type",
     *     description="rrule_type",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $rrule_type;
    /**
     * @OA\Property(
     *     title="end_type",
     *     description="end_type",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $end_type;
    /**
     * @OA\Property(
     *     title="interval",
     *     description="interval",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $interval;
    /**
     * @OA\Property(
     *     title="count",
     *     description="count",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $count;
    /**
     * @OA\Property(
     *     title="mo",
     *     description="mo",
     *     type="boolean",
     *     example=""
     * )
     *
     * @var boolean
     */
    public $mo;
    /**
     * @OA\Property(
     *     title="tu",
     *     description="tu",
     *     type="boolean",
     *     example=""
     * )
     *
     * @var boolean
     */
    public $tu;
    /**
     * @OA\Property(
     *     title="we",
     *     description="we",
     *     type="boolean",
     *     example=""
     * )
     *
     * @var boolean
     */
    public $we;
    /**
     * @OA\Property(
     *     title="th",
     *     description="th",
     *     type="boolean",
     *     example=""
     * )
     *
     * @var boolean
     */
    public $th;
    /**
     * @OA\Property(
     *     title="fr",
     *     description="fr",
     *     type="boolean",
     *     example=""
     * )
     *
     * @var boolean
     */
    public $fr;
    /**
     * @OA\Property(
     *     title="sa",
     *     description="sa",
     *     type="boolean",
     *     example=""
     * )
     *
     * @var boolean
     */
    public $sa;
    /**
     * @OA\Property(
     *     title="su",
     *     description="su",
     *     type="boolean",
     *     example=""
     * )
     *
     * @var boolean
     */
    public $su;
    /**
     * @OA\Property(
     *     title="month_by",
     *     description="month_by",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $month_by;
    /**
     * @OA\Property(
     *     title="day",
     *     description="day",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $day;
    /**
     * @OA\Property(
     *     title="byday",
     *     description="byday",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $byday;
    /**
     * @OA\Property(
     *     title="until",
     *     description="until",
     *     type="string",
     *     example="2021-10-28"
     * )
     *
     * @var string
     */
    public $until;


    public function __construct(Request $request)
    {
        $request->validate([
           'calendar_event_id' => ['nullable', 'integer'],
           'name' => ['nullable', 'string'],
           'event_tz' => ['nullable', 'string'],
           'rrule' => ['nullable', 'string'],
           'rrule_type' => ['nullable', 'string'],
           'end_type' => ['nullable', 'string'],
           'interval' => ['nullable', 'integer'],
           'count' => ['nullable', 'integer'],
           'mo' => ['nullable', 'boolean'],
           'tu' => ['nullable', 'boolean'],
           'we' => ['nullable', 'boolean'],
           'th' => ['nullable', 'boolean'],
           'fr' => ['nullable', 'boolean'],
           'sa' => ['nullable', 'boolean'],
           'su' => ['nullable', 'boolean'],
           'month_by' => ['nullable', 'string'],
           'day' => ['nullable', 'integer'],
           'byday' => ['nullable', 'string'],
           'until' => ['nullable', 'date_format:Y-m-d'],

        ]);

        $this->calendar_event_id = $request->calendar_event_id ;
        $this->name = $request->name ;
        $this->event_tz = $request->event_tz ;
        $this->rrule = $request->rrule ;
        $this->rrule_type = $request->rrule_type ;
        $this->end_type = $request->end_type ;
        $this->interval = $request->interval ;
        $this->count = $request->count ;
        $this->mo = $request->mo ;
        $this->tu = $request->tu ;
        $this->we = $request->we ;
        $this->th = $request->th ;
        $this->fr = $request->fr ;
        $this->sa = $request->sa ;
        $this->su = $request->su ;
        $this->month_by = $request->month_by ;
        $this->day = $request->day ;
        $this->byday = $request->byday ;
        $this->until = $request->until ;

    }
}

<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="CalendarReminderInput",
 *     description="",
 *     @OA\Xml(
 *         name="CalendarReminderInput"
 *     )
 * )
 */

class CalendarReminderInput {
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
     *     title="calendar_alaram_id",
     *     description="calendar_alaram_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $calendar_alaram_id;


    public function __construct(Request $request)
    {
        $request->validate([
           'calendar_event_id' => ['nullable', 'integer'],
           'calendar_alaram_id' => ['nullable', 'integer'],

        ]);

        $this->calendar_event_id = $request->calendar_event_id ;
        $this->calendar_alaram_id = $request->calendar_alaram_id ;

    }
}

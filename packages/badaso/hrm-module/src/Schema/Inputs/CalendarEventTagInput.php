<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="CalendarEventTagInput",
 *     description="",
 *     @OA\Xml(
 *         name="CalendarEventTagInput"
 *     )
 * )
 */

class CalendarEventTagInput {
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
     *     title="calendar_event_category_id",
     *     description="calendar_event_category_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $calendar_event_category_id;


    public function __construct(Request $request)
    {
        $request->validate([
           'calendar_event_id' => ['nullable', 'integer'],
           'calendar_event_category_id' => ['nullable', 'integer'],

        ]);

        $this->calendar_event_id = $request->calendar_event_id ;
        $this->calendar_event_category_id = $request->calendar_event_category_id ;

    }
}

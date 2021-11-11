<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="CalendarAttendeeInput",
 *     description="",
 *     @OA\Xml(
 *         name="CalendarAttendeeInput"
 *     )
 * )
 */

class CalendarAttendeeInput {
    /**
     * @OA\Property(
     *     title="common_name",
     *     description="common_name",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $common_name;
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
     *     title="partner_id",
     *     description="partner_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $partner_id;


    public function __construct(Request $request)
    {
        $request->validate([
           'common_name' => ['nullable', 'string'],
           'calendar_event_id' => ['nullable', 'integer'],
           'partner_id' => ['nullable', 'integer'],

        ]);

        $this->common_name = $request->common_name ;
        $this->calendar_event_id = $request->calendar_event_id ;
        $this->partner_id = $request->partner_id ;

    }
}

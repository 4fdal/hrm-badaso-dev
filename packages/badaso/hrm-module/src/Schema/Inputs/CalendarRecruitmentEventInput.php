<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="CalendarRecruitmentEventInput",
 *     description="",
 *     @OA\Xml(
 *         name="CalendarRecruitmentEventInput"
 *     )
 * )
 */

class CalendarRecruitmentEventInput {
    /**
     * @OA\Property(
     *     title="done_status",
     *     description="done_status",
     *     type="boolean",
     *     example=""
     * )
     *
     * @var boolean
     */
    public $done_status;
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


    public function __construct(Request $request)
    {
        $request->validate([
           'done_status' => ['nullable', 'boolean'],
           'calendar_event_id' => ['nullable', 'integer'],

        ]);

        $this->done_status = $request->done_status ;
        $this->calendar_event_id = $request->calendar_event_id ;

    }
}

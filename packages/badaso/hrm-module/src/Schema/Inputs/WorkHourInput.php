<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="WorkHourInput",
 *     description="",
 *     @OA\Xml(
 *         name="WorkHourInput"
 *     )
 * )
 */

class WorkHourInput {
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
     *     title="day_of_week",
     *     description="day_of_week",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $day_of_week;
    /**
     * @OA\Property(
     *     title="day_period",
     *     description="day_period",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $day_period;
    /**
     * @OA\Property(
     *     title="work_from",
     *     description="work_from",
     *     type="string",
     *     example="08:11:17"
     * )
     *
     * @var string
     */
    public $work_from;
    /**
     * @OA\Property(
     *     title="work_to",
     *     description="work_to",
     *     type="string",
     *     example="08:11:17"
     * )
     *
     * @var string
     */
    public $work_to;
    /**
     * @OA\Property(
     *     title="start_date",
     *     description="start_date",
     *     type="string",
     *     example="2021-10-28 08:11:17"
     * )
     *
     * @var string
     */
    public $start_date;
    /**
     * @OA\Property(
     *     title="end_date",
     *     description="end_date",
     *     type="string",
     *     example="2021-10-28 08:11:17"
     * )
     *
     * @var string
     */
    public $end_date;


    public function __construct(Request $request)
    {
        $request->validate([
           'work_id' => ['nullable', 'integer'],
           'name' => ['nullable', 'string'],
           'day_of_week' => ['nullable', 'string'],
           'day_period' => ['nullable', 'string'],
           'work_from' => ['nullable', 'date_format:H:i:s'],
           'work_to' => ['nullable', 'date_format:H:i:s'],
           'start_date' => ['nullable', 'date_format:Y-m-d H:i:s'],
           'end_date' => ['nullable', 'date_format:Y-m-d H:i:s'],

        ]);

        $this->work_id = $request->work_id ;
        $this->name = $request->name ;
        $this->day_of_week = $request->day_of_week ;
        $this->day_period = $request->day_period ;
        $this->work_from = $request->work_from ;
        $this->work_to = $request->work_to ;
        $this->start_date = $request->start_date ;
        $this->end_date = $request->end_date ;

    }
}

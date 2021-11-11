<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="CalendarEventInput",
 *     description="",
 *     @OA\Xml(
 *         name="CalendarEventInput"
 *     )
 * )
 */

class CalendarEventInput {
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
     *     title="start",
     *     description="start",
     *     type="string",
     *     example="2021-10-28"
     * )
     *
     * @var string
     */
    public $start;
    /**
     * @OA\Property(
     *     title="stop",
     *     description="stop",
     *     type="string",
     *     example="2021-10-28"
     * )
     *
     * @var string
     */
    public $stop;
    /**
     * @OA\Property(
     *     title="is_all_day",
     *     description="is_all_day",
     *     type="boolean",
     *     example=""
     * )
     *
     * @var boolean
     */
    public $is_all_day;
    /**
     * @OA\Property(
     *     title="duration",
     *     description="duration",
     *     type="double",
     *     example="0"
     * )
     *
     * @var double
     */
    public $duration;
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
     *     title="privacy",
     *     description="privacy",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $privacy;
    /**
     * @OA\Property(
     *     title="localtion",
     *     description="localtion",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $localtion;
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
     *     title="is_recurrent",
     *     description="is_recurrent",
     *     type="boolean",
     *     example=""
     * )
     *
     * @var boolean
     */
    public $is_recurrent;
    /**
     * @OA\Property(
     *     title="show_as",
     *     description="show_as",
     *     type="string",
     *     example="lorem type"
     * )
     *
     * @var string
     */
    public $show_as;


    public function __construct(Request $request)
    {
        $request->validate([
           'name' => ['nullable', 'string'],
           'start' => ['nullable', 'date_format:Y-m-d'],
           'stop' => ['nullable', 'date_format:Y-m-d'],
           'is_all_day' => ['nullable', 'boolean'],
           'duration' => ['nullable', 'numeric'],
           'description' => ['nullable', 'string'],
           'privacy' => ['nullable', 'string'],
           'localtion' => ['nullable', 'string'],
           'user_id' => ['nullable', 'integer'],
           'is_active' => ['nullable', 'boolean'],
           'is_recurrent' => ['nullable', 'boolean'],
           'show_as' => ['nullable', 'string'],

        ]);

        $this->name = $request->name ;
        $this->start = $request->start ;
        $this->stop = $request->stop ;
        $this->is_all_day = $request->is_all_day ;
        $this->duration = $request->duration ;
        $this->description = $request->description ;
        $this->privacy = $request->privacy ;
        $this->localtion = $request->localtion ;
        $this->user_id = $request->user_id ;
        $this->is_active = $request->is_active ;
        $this->is_recurrent = $request->is_recurrent ;
        $this->show_as = $request->show_as ;

    }
}

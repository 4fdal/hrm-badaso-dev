<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="LunchAlertInput",
 *     description="",
 *     @OA\Xml(
 *         name="LunchAlertInput"
 *     )
 * )
 */

class LunchAlertInput {
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
     *     title="message",
     *     description="message",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $message;
    /**
     * @OA\Property(
     *     title="display_mode",
     *     description="display_mode",
     *     type="string",
     *     example="lorem type"
     * )
     *
     * @var string
     */
    public $display_mode;
    /**
     * @OA\Property(
     *     title="show_until",
     *     description="show_until",
     *     type="string",
     *     example="2021-10-28"
     * )
     *
     * @var string
     */
    public $show_until;
    /**
     * @OA\Property(
     *     title="is_recurrent_monday",
     *     description="is_recurrent_monday",
     *     type="boolean",
     *     example=""
     * )
     *
     * @var boolean
     */
    public $is_recurrent_monday;
    /**
     * @OA\Property(
     *     title="is_recurrent_tuesday",
     *     description="is_recurrent_tuesday",
     *     type="boolean",
     *     example=""
     * )
     *
     * @var boolean
     */
    public $is_recurrent_tuesday;
    /**
     * @OA\Property(
     *     title="is_recurrent_wednesday",
     *     description="is_recurrent_wednesday",
     *     type="boolean",
     *     example=""
     * )
     *
     * @var boolean
     */
    public $is_recurrent_wednesday;
    /**
     * @OA\Property(
     *     title="is_recurrent_thursday",
     *     description="is_recurrent_thursday",
     *     type="boolean",
     *     example=""
     * )
     *
     * @var boolean
     */
    public $is_recurrent_thursday;
    /**
     * @OA\Property(
     *     title="is_recurrent_friday",
     *     description="is_recurrent_friday",
     *     type="boolean",
     *     example=""
     * )
     *
     * @var boolean
     */
    public $is_recurrent_friday;
    /**
     * @OA\Property(
     *     title="is_recurrent_saturday",
     *     description="is_recurrent_saturday",
     *     type="boolean",
     *     example=""
     * )
     *
     * @var boolean
     */
    public $is_recurrent_saturday;
    /**
     * @OA\Property(
     *     title="is_recurrent_sunday",
     *     description="is_recurrent_sunday",
     *     type="boolean",
     *     example=""
     * )
     *
     * @var boolean
     */
    public $is_recurrent_sunday;
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
     *     title="timezone",
     *     description="timezone",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $timezone;


    public function __construct(Request $request)
    {
        $request->validate([
           'name' => ['nullable', 'string'],
           'message' => ['nullable', 'string'],
           'display_mode' => ['nullable', 'string'],
           'show_until' => ['nullable', 'date_format:Y-m-d'],
           'is_recurrent_monday' => ['nullable', 'boolean'],
           'is_recurrent_tuesday' => ['nullable', 'boolean'],
           'is_recurrent_wednesday' => ['nullable', 'boolean'],
           'is_recurrent_thursday' => ['nullable', 'boolean'],
           'is_recurrent_friday' => ['nullable', 'boolean'],
           'is_recurrent_saturday' => ['nullable', 'boolean'],
           'is_recurrent_sunday' => ['nullable', 'boolean'],
           'is_active' => ['nullable', 'boolean'],
           'timezone' => ['nullable', 'string'],

        ]);

        $this->name = $request->name ;
        $this->message = $request->message ;
        $this->display_mode = $request->display_mode ;
        $this->show_until = $request->show_until ;
        $this->is_recurrent_monday = $request->is_recurrent_monday ;
        $this->is_recurrent_tuesday = $request->is_recurrent_tuesday ;
        $this->is_recurrent_wednesday = $request->is_recurrent_wednesday ;
        $this->is_recurrent_thursday = $request->is_recurrent_thursday ;
        $this->is_recurrent_friday = $request->is_recurrent_friday ;
        $this->is_recurrent_saturday = $request->is_recurrent_saturday ;
        $this->is_recurrent_sunday = $request->is_recurrent_sunday ;
        $this->is_active = $request->is_active ;
        $this->timezone = $request->timezone ;

    }
}

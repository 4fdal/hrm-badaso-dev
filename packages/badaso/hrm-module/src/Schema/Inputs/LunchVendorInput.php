<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="LunchVendorInput",
 *     description="",
 *     @OA\Xml(
 *         name="LunchVendorInput"
 *     )
 * )
 */

class LunchVendorInput {
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
     *     title="send_by",
     *     description="send_by",
     *     type="string",
     *     example="lorem type"
     * )
     *
     * @var string
     */
    public $send_by;
    /**
     * @OA\Property(
     *     title="automatic_email_time",
     *     description="automatic_email_time",
     *     type="double",
     *     example="0"
     * )
     *
     * @var double
     */
    public $automatic_email_time;
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
     *     title="timezone",
     *     description="timezone",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $timezone;
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
     *     title="moment",
     *     description="moment",
     *     type="string",
     *     example="lorem type"
     * )
     *
     * @var string
     */
    public $moment;
    /**
     * @OA\Property(
     *     title="delivery",
     *     description="delivery",
     *     type="string",
     *     example="lorem type"
     * )
     *
     * @var string
     */
    public $delivery;


    public function __construct(Request $request)
    {
        $request->validate([
           'partner_id' => ['nullable', 'integer'],
           'company_id' => ['nullable', 'integer'],
           'responsible_user_id' => ['nullable', 'integer'],
           'send_by' => ['nullable', 'string'],
           'automatic_email_time' => ['nullable', 'numeric'],
           'is_recurrent_monday' => ['nullable', 'boolean'],
           'is_recurrent_tuesday' => ['nullable', 'boolean'],
           'is_recurrent_wednesday' => ['nullable', 'boolean'],
           'is_recurrent_thursday' => ['nullable', 'boolean'],
           'is_recurrent_friday' => ['nullable', 'boolean'],
           'is_recurrent_saturday' => ['nullable', 'boolean'],
           'is_recurrent_sunday' => ['nullable', 'boolean'],
           'timezone' => ['nullable', 'string'],
           'is_active' => ['nullable', 'boolean'],
           'moment' => ['nullable', 'string'],
           'delivery' => ['nullable', 'string'],

        ]);

        $this->partner_id = $request->partner_id ;
        $this->company_id = $request->company_id ;
        $this->responsible_user_id = $request->responsible_user_id ;
        $this->send_by = $request->send_by ;
        $this->automatic_email_time = $request->automatic_email_time ;
        $this->is_recurrent_monday = $request->is_recurrent_monday ;
        $this->is_recurrent_tuesday = $request->is_recurrent_tuesday ;
        $this->is_recurrent_wednesday = $request->is_recurrent_wednesday ;
        $this->is_recurrent_thursday = $request->is_recurrent_thursday ;
        $this->is_recurrent_friday = $request->is_recurrent_friday ;
        $this->is_recurrent_saturday = $request->is_recurrent_saturday ;
        $this->is_recurrent_sunday = $request->is_recurrent_sunday ;
        $this->timezone = $request->timezone ;
        $this->is_active = $request->is_active ;
        $this->moment = $request->moment ;
        $this->delivery = $request->delivery ;

    }
}

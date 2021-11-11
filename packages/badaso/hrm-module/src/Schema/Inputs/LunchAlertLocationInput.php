<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="LunchAlertLocationInput",
 *     description="",
 *     @OA\Xml(
 *         name="LunchAlertLocationInput"
 *     )
 * )
 */

class LunchAlertLocationInput {
    /**
     * @OA\Property(
     *     title="lunch_alert_id",
     *     description="lunch_alert_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $lunch_alert_id;
    /**
     * @OA\Property(
     *     title="lunch_location_id",
     *     description="lunch_location_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $lunch_location_id;


    public function __construct(Request $request)
    {
        $request->validate([
           'lunch_alert_id' => ['nullable', 'integer'],
           'lunch_location_id' => ['nullable', 'integer'],

        ]);

        $this->lunch_alert_id = $request->lunch_alert_id ;
        $this->lunch_location_id = $request->lunch_location_id ;

    }
}

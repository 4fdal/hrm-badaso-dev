<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="FleetVendorInput",
 *     description="",
 *     @OA\Xml(
 *         name="FleetVendorInput"
 *     )
 * )
 */

class FleetVendorInput {
    /**
     * @OA\Property(
     *     title="fleet_model_id",
     *     description="fleet_model_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $fleet_model_id;
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
           'fleet_model_id' => ['nullable', 'integer'],
           'partner_id' => ['nullable', 'integer'],

        ]);

        $this->fleet_model_id = $request->fleet_model_id ;
        $this->partner_id = $request->partner_id ;

    }
}

<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="FleetVehicleTagInput",
 *     description="",
 *     @OA\Xml(
 *         name="FleetVehicleTagInput"
 *     )
 * )
 */

class FleetVehicleTagInput {
    /**
     * @OA\Property(
     *     title="fleet_vehicle_id",
     *     description="fleet_vehicle_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $fleet_vehicle_id;
    /**
     * @OA\Property(
     *     title="fleet_vehicle_categorie_id",
     *     description="fleet_vehicle_categorie_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $fleet_vehicle_categorie_id;


    public function __construct(Request $request)
    {
        $request->validate([
           'fleet_vehicle_id' => ['nullable', 'integer'],
           'fleet_vehicle_categorie_id' => ['nullable', 'integer'],

        ]);

        $this->fleet_vehicle_id = $request->fleet_vehicle_id ;
        $this->fleet_vehicle_categorie_id = $request->fleet_vehicle_categorie_id ;

    }
}

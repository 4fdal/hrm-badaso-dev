<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="FleetServiceInput",
 *     description="",
 *     @OA\Xml(
 *         name="FleetServiceInput"
 *     )
 * )
 */

class FleetServiceInput {
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
     *     title="fleet_service_type_id",
     *     description="fleet_service_type_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $fleet_service_type_id;
    /**
     * @OA\Property(
     *     title="date",
     *     description="date",
     *     type="string",
     *     example="2021-10-28"
     * )
     *
     * @var string
     */
    public $date;
    /**
     * @OA\Property(
     *     title="cost",
     *     description="cost",
     *     type="double",
     *     example="0"
     * )
     *
     * @var double
     */
    public $cost;
    /**
     * @OA\Property(
     *     title="vendor_parent_id",
     *     description="vendor_parent_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $vendor_parent_id;
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
     *     title="driver_partner_id",
     *     description="driver_partner_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $driver_partner_id;
    /**
     * @OA\Property(
     *     title="odometer_value",
     *     description="odometer_value",
     *     type="double",
     *     example="0"
     * )
     *
     * @var double
     */
    public $odometer_value;
    /**
     * @OA\Property(
     *     title="notes",
     *     description="notes",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $notes;


    public function __construct(Request $request)
    {
        $request->validate([
           'description' => ['nullable', 'string'],
           'fleet_service_type_id' => ['nullable', 'integer'],
           'date' => ['nullable', 'date_format:Y-m-d'],
           'cost' => ['nullable', 'numeric'],
           'vendor_parent_id' => ['nullable', 'integer'],
           'fleet_vehicle_id' => ['nullable', 'integer'],
           'driver_partner_id' => ['nullable', 'integer'],
           'odometer_value' => ['nullable', 'numeric'],
           'notes' => ['nullable', 'string'],

        ]);

        $this->description = $request->description ;
        $this->fleet_service_type_id = $request->fleet_service_type_id ;
        $this->date = $request->date ;
        $this->cost = $request->cost ;
        $this->vendor_parent_id = $request->vendor_parent_id ;
        $this->fleet_vehicle_id = $request->fleet_vehicle_id ;
        $this->driver_partner_id = $request->driver_partner_id ;
        $this->odometer_value = $request->odometer_value ;
        $this->notes = $request->notes ;

    }
}

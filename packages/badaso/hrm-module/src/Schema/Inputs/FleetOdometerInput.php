<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="FleetOdometerInput",
 *     description="",
 *     @OA\Xml(
 *         name="FleetOdometerInput"
 *     )
 * )
 */

class FleetOdometerInput {
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
     *     title="date",
     *     description="date",
     *     type="",
     *     example=""
     * )
     *
     * @var
     */
    public $date;
    /**
     * @OA\Property(
     *     title="value",
     *     description="value",
     *     type="double",
     *     example="0"
     * )
     *
     * @var double
     */
    public $value;
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


    public function __construct(Request $request)
    {
        $request->validate([
           'name' => ['nullable', 'string'],
           'date' => ['nullable', ''],
           'value' => ['nullable', 'numeric'],
           'fleet_vehicle_id' => ['nullable', 'integer'],

        ]);

        $this->name = $request->name ;
        $this->date = $request->date ;
        $this->value = $request->value ;
        $this->fleet_vehicle_id = $request->fleet_vehicle_id ;

    }
}

<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="FleetModelInput",
 *     description="",
 *     @OA\Xml(
 *         name="FleetModelInput"
 *     )
 * )
 */

class FleetModelInput {
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
     *     title="fleet_model_brand_id",
     *     description="fleet_model_brand_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $fleet_model_brand_id;
    /**
     * @OA\Property(
     *     title="manager_user_id",
     *     description="manager_user_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $manager_user_id;
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
     *     title="vehicle_type",
     *     description="vehicle_type",
     *     type="string",
     *     example="lorem type"
     * )
     *
     * @var string
     */
    public $vehicle_type;


    public function __construct(Request $request)
    {
        $request->validate([
           'name' => ['nullable', 'string'],
           'fleet_model_brand_id' => ['nullable', 'integer'],
           'manager_user_id' => ['nullable', 'integer'],
           'is_active' => ['nullable', 'boolean'],
           'vehicle_type' => ['nullable', 'string'],

        ]);

        $this->name = $request->name ;
        $this->fleet_model_brand_id = $request->fleet_model_brand_id ;
        $this->manager_user_id = $request->manager_user_id ;
        $this->is_active = $request->is_active ;
        $this->vehicle_type = $request->vehicle_type ;

    }
}

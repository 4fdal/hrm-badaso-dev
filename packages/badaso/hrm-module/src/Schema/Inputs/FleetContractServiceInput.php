<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="FleetContractServiceInput",
 *     description="",
 *     @OA\Xml(
 *         name="FleetContractServiceInput"
 *     )
 * )
 */

class FleetContractServiceInput {
    /**
     * @OA\Property(
     *     title="fleet_contract_id",
     *     description="fleet_contract_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $fleet_contract_id;
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


    public function __construct(Request $request)
    {
        $request->validate([
           'fleet_contract_id' => ['nullable', 'integer'],
           'fleet_service_type_id' => ['nullable', 'integer'],

        ]);

        $this->fleet_contract_id = $request->fleet_contract_id ;
        $this->fleet_service_type_id = $request->fleet_service_type_id ;

    }
}

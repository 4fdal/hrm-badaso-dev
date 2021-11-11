<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="FleetContractInput",
 *     description="",
 *     @OA\Xml(
 *         name="FleetContractInput"
 *     )
 * )
 */

class FleetContractInput {
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
     *     title="fleet_contract_type_id",
     *     description="fleet_contract_type_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $fleet_contract_type_id;
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
     *     title="reference",
     *     description="reference",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $reference;
    /**
     * @OA\Property(
     *     title="activation_cost",
     *     description="activation_cost",
     *     type="double",
     *     example="0"
     * )
     *
     * @var double
     */
    public $activation_cost;
    /**
     * @OA\Property(
     *     title="recurring_cost",
     *     description="recurring_cost",
     *     type="double",
     *     example="0"
     * )
     *
     * @var double
     */
    public $recurring_cost;
    /**
     * @OA\Property(
     *     title="recurring_cost_frequency",
     *     description="recurring_cost_frequency",
     *     type="string",
     *     example="lorem type"
     * )
     *
     * @var string
     */
    public $recurring_cost_frequency;
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
     *     title="invoice_date",
     *     description="invoice_date",
     *     type="string",
     *     example="2021-10-28"
     * )
     *
     * @var string
     */
    public $invoice_date;
    /**
     * @OA\Property(
     *     title="contract_start_date",
     *     description="contract_start_date",
     *     type="string",
     *     example="2021-10-28"
     * )
     *
     * @var string
     */
    public $contract_start_date;
    /**
     * @OA\Property(
     *     title="contract_expiration_date",
     *     description="contract_expiration_date",
     *     type="string",
     *     example="2021-10-28"
     * )
     *
     * @var string
     */
    public $contract_expiration_date;
    /**
     * @OA\Property(
     *     title="terms_conditions",
     *     description="terms_conditions",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $terms_conditions;


    public function __construct(Request $request)
    {
        $request->validate([
           'responsible_user_id' => ['nullable', 'integer'],
           'fleet_contract_type_id' => ['nullable', 'integer'],
           'vendor_parent_id' => ['nullable', 'integer'],
           'reference' => ['nullable', 'string'],
           'activation_cost' => ['nullable', 'numeric'],
           'recurring_cost' => ['nullable', 'numeric'],
           'recurring_cost_frequency' => ['nullable', 'string'],
           'fleet_vehicle_id' => ['nullable', 'integer'],
           'invoice_date' => ['nullable', 'date_format:Y-m-d'],
           'contract_start_date' => ['nullable', 'date_format:Y-m-d'],
           'contract_expiration_date' => ['nullable', 'date_format:Y-m-d'],
           'terms_conditions' => ['nullable', 'string'],

        ]);

        $this->responsible_user_id = $request->responsible_user_id ;
        $this->fleet_contract_type_id = $request->fleet_contract_type_id ;
        $this->vendor_parent_id = $request->vendor_parent_id ;
        $this->reference = $request->reference ;
        $this->activation_cost = $request->activation_cost ;
        $this->recurring_cost = $request->recurring_cost ;
        $this->recurring_cost_frequency = $request->recurring_cost_frequency ;
        $this->fleet_vehicle_id = $request->fleet_vehicle_id ;
        $this->invoice_date = $request->invoice_date ;
        $this->contract_start_date = $request->contract_start_date ;
        $this->contract_expiration_date = $request->contract_expiration_date ;
        $this->terms_conditions = $request->terms_conditions ;

    }
}

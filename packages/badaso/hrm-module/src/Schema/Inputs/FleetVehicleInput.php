<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="FleetVehicleInput",
 *     description="",
 *     @OA\Xml(
 *         name="FleetVehicleInput"
 *     )
 * )
 */

class FleetVehicleInput {
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
     *     title="vin_sn",
     *     description="vin_sn",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $vin_sn;
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
     *     title="license_plate",
     *     description="license_plate",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $license_plate;
    /**
     * @OA\Property(
     *     title="fleet_state_id",
     *     description="fleet_state_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $fleet_state_id;
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
     *     title="future_driver_partner_id",
     *     description="future_driver_partner_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $future_driver_partner_id;
    /**
     * @OA\Property(
     *     title="is_plan_change_card",
     *     description="is_plan_change_card",
     *     type="boolean",
     *     example=""
     * )
     *
     * @var boolean
     */
    public $is_plan_change_card;
    /**
     * @OA\Property(
     *     title="assignment_date",
     *     description="assignment_date",
     *     type="string",
     *     example="2021-10-28"
     * )
     *
     * @var string
     */
    public $assignment_date;
    /**
     * @OA\Property(
     *     title="localtion",
     *     description="localtion",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $localtion;
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
     *     title="first_contract_date",
     *     description="first_contract_date",
     *     type="string",
     *     example="2021-10-28"
     * )
     *
     * @var string
     */
    public $first_contract_date;
    /**
     * @OA\Property(
     *     title="last_odometer",
     *     description="last_odometer",
     *     type="double",
     *     example="0"
     * )
     *
     * @var double
     */
    public $last_odometer;
    /**
     * @OA\Property(
     *     title="unit_odometer",
     *     description="unit_odometer",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $unit_odometer;
    /**
     * @OA\Property(
     *     title="immatriculation_date",
     *     description="immatriculation_date",
     *     type="string",
     *     example="2021-10-28"
     * )
     *
     * @var string
     */
    public $immatriculation_date;
    /**
     * @OA\Property(
     *     title="chassis_number",
     *     description="chassis_number",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $chassis_number;
    /**
     * @OA\Property(
     *     title="catalog_value",
     *     description="catalog_value",
     *     type="double",
     *     example="0"
     * )
     *
     * @var double
     */
    public $catalog_value;
    /**
     * @OA\Property(
     *     title="purchase_value",
     *     description="purchase_value",
     *     type="double",
     *     example="0"
     * )
     *
     * @var double
     */
    public $purchase_value;
    /**
     * @OA\Property(
     *     title="residual_value",
     *     description="residual_value",
     *     type="double",
     *     example="0"
     * )
     *
     * @var double
     */
    public $residual_value;
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
     *     title="seats_number",
     *     description="seats_number",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $seats_number;
    /**
     * @OA\Property(
     *     title="doors_number",
     *     description="doors_number",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $doors_number;
    /**
     * @OA\Property(
     *     title="color",
     *     description="color",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $color;
    /**
     * @OA\Property(
     *     title="model_year",
     *     description="model_year",
     *     type="string",
     *     example="2021"
     * )
     *
     * @var string
     */
    public $model_year;
    /**
     * @OA\Property(
     *     title="transmission",
     *     description="transmission",
     *     type="string",
     *     example="lorem type"
     * )
     *
     * @var string
     */
    public $transmission;
    /**
     * @OA\Property(
     *     title="fuel_type",
     *     description="fuel_type",
     *     type="string",
     *     example="lorem type"
     * )
     *
     * @var string
     */
    public $fuel_type;
    /**
     * @OA\Property(
     *     title="c02_emission",
     *     description="c02_emission",
     *     type="double",
     *     example="0"
     * )
     *
     * @var double
     */
    public $c02_emission;
    /**
     * @OA\Property(
     *     title="horsepower",
     *     description="horsepower",
     *     type="double",
     *     example="0"
     * )
     *
     * @var double
     */
    public $horsepower;
    /**
     * @OA\Property(
     *     title="horsepower_taxation",
     *     description="horsepower_taxation",
     *     type="double",
     *     example="0"
     * )
     *
     * @var double
     */
    public $horsepower_taxation;
    /**
     * @OA\Property(
     *     title="power",
     *     description="power",
     *     type="double",
     *     example="0"
     * )
     *
     * @var double
     */
    public $power;


    public function __construct(Request $request)
    {
        $request->validate([
           'fleet_model_id' => ['nullable', 'integer'],
           'fleet_model_brand_id' => ['nullable', 'integer'],
           'name' => ['nullable', 'string'],
           'is_active' => ['nullable', 'boolean'],
           'vin_sn' => ['nullable', 'string'],
           'description' => ['nullable', 'string'],
           'license_plate' => ['nullable', 'string'],
           'fleet_state_id' => ['nullable', 'integer'],
           'driver_partner_id' => ['nullable', 'integer'],
           'future_driver_partner_id' => ['nullable', 'integer'],
           'is_plan_change_card' => ['nullable', 'boolean'],
           'assignment_date' => ['nullable', 'date_format:Y-m-d'],
           'localtion' => ['nullable', 'string'],
           'manager_user_id' => ['nullable', 'integer'],
           'first_contract_date' => ['nullable', 'date_format:Y-m-d'],
           'last_odometer' => ['nullable', 'numeric'],
           'unit_odometer' => ['nullable', 'string'],
           'immatriculation_date' => ['nullable', 'date_format:Y-m-d'],
           'chassis_number' => ['nullable', 'string'],
           'catalog_value' => ['nullable', 'numeric'],
           'purchase_value' => ['nullable', 'numeric'],
           'residual_value' => ['nullable', 'numeric'],
           'company_id' => ['nullable', 'integer'],
           'seats_number' => ['nullable', 'string'],
           'doors_number' => ['nullable', 'string'],
           'color' => ['nullable', 'string'],
           'model_year' => ['nullable', 'date_format:Y'],
           'transmission' => ['nullable', 'string'],
           'fuel_type' => ['nullable', 'string'],
           'c02_emission' => ['nullable', 'numeric'],
           'horsepower' => ['nullable', 'numeric'],
           'horsepower_taxation' => ['nullable', 'numeric'],
           'power' => ['nullable', 'numeric'],

        ]);

        $this->fleet_model_id = $request->fleet_model_id ;
        $this->fleet_model_brand_id = $request->fleet_model_brand_id ;
        $this->name = $request->name ;
        $this->is_active = $request->is_active ;
        $this->vin_sn = $request->vin_sn ;
        $this->description = $request->description ;
        $this->license_plate = $request->license_plate ;
        $this->fleet_state_id = $request->fleet_state_id ;
        $this->driver_partner_id = $request->driver_partner_id ;
        $this->future_driver_partner_id = $request->future_driver_partner_id ;
        $this->is_plan_change_card = $request->is_plan_change_card ;
        $this->assignment_date = $request->assignment_date ;
        $this->localtion = $request->localtion ;
        $this->manager_user_id = $request->manager_user_id ;
        $this->first_contract_date = $request->first_contract_date ;
        $this->last_odometer = $request->last_odometer ;
        $this->unit_odometer = $request->unit_odometer ;
        $this->immatriculation_date = $request->immatriculation_date ;
        $this->chassis_number = $request->chassis_number ;
        $this->catalog_value = $request->catalog_value ;
        $this->purchase_value = $request->purchase_value ;
        $this->residual_value = $request->residual_value ;
        $this->company_id = $request->company_id ;
        $this->seats_number = $request->seats_number ;
        $this->doors_number = $request->doors_number ;
        $this->color = $request->color ;
        $this->model_year = $request->model_year ;
        $this->transmission = $request->transmission ;
        $this->fuel_type = $request->fuel_type ;
        $this->c02_emission = $request->c02_emission ;
        $this->horsepower = $request->horsepower ;
        $this->horsepower_taxation = $request->horsepower_taxation ;
        $this->power = $request->power ;

    }
}

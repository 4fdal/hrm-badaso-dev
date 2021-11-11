<?php

namespace Uasoft\Badaso\Module\HRM\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\HRM\Models\FleetVehicle;
use Uasoft\Badaso\Module\HRM\Schema\Inputs\FleetVehicleInput;

class FleetVehicleController extends Controller
{
    /**
     * @OA\Post(
     *      path="/module/hrm/v1/fleet-vehicle",
     *      operationId="AddFleetVehicle",
     *      tags={"Fleet Vehicles"},
     *      summary="Add new fleet_vehicles",
     *      description="Add a new fleet_vehicles",
     *      @OA\Parameter(
     *          name="show_belogsto_relation",
     *          in="query",
     *          example=false,
     *          required=false,
     *          @OA\Schema(
     *              type="boolean"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="show_hasmany_relation",
     *          in="query",
     *          example=false,
     *          required=false,
     *          @OA\Schema(
     *              type="boolean"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/FleetVehicleInput")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      security={{"bearerAuth" : {}}}
     * )
     */
    public function add(Request $request)
    {
        try {
            $fleet_vehicles_input = new FleetVehicleInput($request);

            $fleet_vehicles = FleetVehicle::create([
                  'fleet_model_id' => $fleet_vehicles_input->fleet_model_id,
              'fleet_model_brand_id' => $fleet_vehicles_input->fleet_model_brand_id,
              'name' => $fleet_vehicles_input->name,
              'is_active' => $fleet_vehicles_input->is_active,
              'vin_sn' => $fleet_vehicles_input->vin_sn,
              'description' => $fleet_vehicles_input->description,
              'license_plate' => $fleet_vehicles_input->license_plate,
              'fleet_state_id' => $fleet_vehicles_input->fleet_state_id,
              'driver_partner_id' => $fleet_vehicles_input->driver_partner_id,
              'future_driver_partner_id' => $fleet_vehicles_input->future_driver_partner_id,
              'is_plan_change_card' => $fleet_vehicles_input->is_plan_change_card,
              'assignment_date' => $fleet_vehicles_input->assignment_date,
              'localtion' => $fleet_vehicles_input->localtion,
              'manager_user_id' => $fleet_vehicles_input->manager_user_id,
              'first_contract_date' => $fleet_vehicles_input->first_contract_date,
              'last_odometer' => $fleet_vehicles_input->last_odometer,
              'unit_odometer' => $fleet_vehicles_input->unit_odometer,
              'immatriculation_date' => $fleet_vehicles_input->immatriculation_date,
              'chassis_number' => $fleet_vehicles_input->chassis_number,
              'catalog_value' => $fleet_vehicles_input->catalog_value,
              'purchase_value' => $fleet_vehicles_input->purchase_value,
              'residual_value' => $fleet_vehicles_input->residual_value,
              'company_id' => $fleet_vehicles_input->company_id,
              'seats_number' => $fleet_vehicles_input->seats_number,
              'doors_number' => $fleet_vehicles_input->doors_number,
              'color' => $fleet_vehicles_input->color,
              'model_year' => $fleet_vehicles_input->model_year,
              'transmission' => $fleet_vehicles_input->transmission,
              'fuel_type' => $fleet_vehicles_input->fuel_type,
              'c02_emission' => $fleet_vehicles_input->c02_emission,
              'horsepower' => $fleet_vehicles_input->horsepower,
              'horsepower_taxation' => $fleet_vehicles_input->horsepower_taxation,
              'power' => $fleet_vehicles_input->power,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $fleet_vehicles->fleet_model = $fleet_vehicles->fleet_model ;
         $fleet_vehicles->fleet_model_brand = $fleet_vehicles->fleet_model_brand ;
         $fleet_vehicles->fleet_state = $fleet_vehicles->fleet_state ;
         $fleet_vehicles->driver_partner = $fleet_vehicles->driver_partner ;
         $fleet_vehicles->future_driver_partner = $fleet_vehicles->future_driver_partner ;
         $fleet_vehicles->manager_user = $fleet_vehicles->manager_user ;
         $fleet_vehicles->company = $fleet_vehicles->company ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $fleet_vehicles->fleet_vehicle_fleet_vehicle_tags = $fleet_vehicles->fleetVehicleFleetVehicleTags ;
            $fleet_vehicles->fleet_vehicle_fleet_services = $fleet_vehicles->fleetVehicleFleetServices ;
            $fleet_vehicles->fleet_vehicle_fleet_odometers = $fleet_vehicles->fleetVehicleFleetOdometers ;
 
            }

            return ApiResponse::success(compact('fleet_vehicles'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/fleet-vehicle",
     *      operationId="BrowseFleetVehicle",
     *      tags={"Fleet Vehicles"},
     *      summary="Browse fleet_vehicles",
     *      description="Browse fleet_vehicles",
     *      @OA\Parameter(
     *          name="filter_fields",
     *          in="query",
     *          example="*",
     *          required=false,
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="filter_fields_search",
     *          in="query",
     *          example="*",
     *          required=false,
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="max_page",
     *          in="query",
     *          required=false,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="search",
     *          in="query",
     *          required=false,
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="show_pagination",
     *          in="query",
     *          example=true,
     *          required=false,
     *          @OA\Schema(
     *              type="boolean"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="show_belogsto_relation",
     *          in="query",
     *          example=false,
     *          required=false,
     *          @OA\Schema(
     *              type="boolean"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="show_hasmany_relation",
     *          in="query",
     *          example=false,
     *          required=false,
     *          @OA\Schema(
     *              type="boolean"
     *          )
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      security={{"bearerAuth" : {}}}
     * )
     */
    public function browse(Request $request)
    {
        try {

            $fleet_vehicles = new FleetVehicle();
            $fleet_vehicles_fillable = $fleet_vehicles->getFillable();

            $filter_fields = $request->get('filter_fields', '*');
            $filter_fields = explode(',', $filter_fields);
            if (array_search('*', $filter_fields) == false) {
                $new_filter_fields = [];
                foreach ($filter_fields as $index => $field) {
                    if (!in_array($field, $filter_fields)) {
                        $new_filter_fields[] = $field;
                    }
                }
                $fleet_vehicles = $fleet_vehicles->select($filter_fields);
            }

            $filter_fields_search = $request->get('filter_fields_search', '*');
            $filter_fields_search = explode(',', $filter_fields_search);
            if (isset($request->search)) {
                if (array_search('*', $filter_fields_search) == false) {
                    foreach ($fleet_vehicles_fillable as $index => $field) {
                        $fleet_vehicles = $fleet_vehicles->orWhere($field, "like", "%$request->search%");
                    }
                } else {
                    foreach ($filter_fields_search as $index => $field) {
                        if (in_array($field, $fleet_vehicles_fillable)) {
                            $fleet_vehicles = $fleet_vehicles->orWhere($field, "like", "%$request->search%");
                        }
                    }
                }
            }

            if ($request->get('show_pagination', 'true') == 'true') {
                $max_page = $request->get('max_page', 15);
                $fleet_vehicles = $fleet_vehicles->paginate($max_page);
            } else {
                $fleet_vehicles = $fleet_vehicles->get();
            }

            $fleet_vehicles->map(function($fleet_vehicles) use ($request){

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $fleet_vehicles->fleet_model = $fleet_vehicles->fleet_model ;
         $fleet_vehicles->fleet_model_brand = $fleet_vehicles->fleet_model_brand ;
         $fleet_vehicles->fleet_state = $fleet_vehicles->fleet_state ;
         $fleet_vehicles->driver_partner = $fleet_vehicles->driver_partner ;
         $fleet_vehicles->future_driver_partner = $fleet_vehicles->future_driver_partner ;
         $fleet_vehicles->manager_user = $fleet_vehicles->manager_user ;
         $fleet_vehicles->company = $fleet_vehicles->company ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $fleet_vehicles->fleet_vehicle_fleet_vehicle_tags = $fleet_vehicles->fleetVehicleFleetVehicleTags ;
            $fleet_vehicles->fleet_vehicle_fleet_services = $fleet_vehicles->fleetVehicleFleetServices ;
            $fleet_vehicles->fleet_vehicle_fleet_odometers = $fleet_vehicles->fleetVehicleFleetOdometers ;
 
            }

                return $fleet_vehicles ;
            });
            $fleet_vehicles = $fleet_vehicles->toArray();

            return ApiResponse::success(compact('fleet_vehicles'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/fleet-vehicle/{id}",
     *      operationId="ReadFleetVehicle",
     *      tags={"Fleet Vehicles"},
     *      summary="Read fleet_vehicles",
     *      description="Read fleet_vehicles",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="show_belogsto_relation",
     *          in="query",
     *          example=false,
     *          required=false,
     *          @OA\Schema(
     *              type="boolean"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="show_hasmany_relation",
     *          in="query",
     *          example=false,
     *          required=false,
     *          @OA\Schema(
     *              type="boolean"
     *          )
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      security={{"bearerAuth" : {}}}
     * )
     */
    public function read(Request $request, $id)
    {
        try {

            $fleet_vehicles = FleetVehicle::find($id);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $fleet_vehicles->fleet_model = $fleet_vehicles->fleet_model ;
         $fleet_vehicles->fleet_model_brand = $fleet_vehicles->fleet_model_brand ;
         $fleet_vehicles->fleet_state = $fleet_vehicles->fleet_state ;
         $fleet_vehicles->driver_partner = $fleet_vehicles->driver_partner ;
         $fleet_vehicles->future_driver_partner = $fleet_vehicles->future_driver_partner ;
         $fleet_vehicles->manager_user = $fleet_vehicles->manager_user ;
         $fleet_vehicles->company = $fleet_vehicles->company ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $fleet_vehicles->fleet_vehicle_fleet_vehicle_tags = $fleet_vehicles->fleetVehicleFleetVehicleTags ;
            $fleet_vehicles->fleet_vehicle_fleet_services = $fleet_vehicles->fleetVehicleFleetServices ;
            $fleet_vehicles->fleet_vehicle_fleet_odometers = $fleet_vehicles->fleetVehicleFleetOdometers ;
 
            }

            return ApiResponse::success(compact('fleet_vehicles'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Put(
     *      path="/module/hrm/v1/fleet-vehicle/{id}",
     *      operationId="UpdateFleetVehicle",
     *      tags={"Fleet Vehicles"},
     *      summary="Update fleet_vehicles",
     *      description="Update fleet_vehicles",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="show_belogsto_relation",
     *          in="query",
     *          required=false,
     *          example=false,
     *          @OA\Schema(
     *              type="boolean"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="show_hasmany_relation",
     *          in="query",
     *          required=false,
     *          example=false,
     *          @OA\Schema(
     *              type="boolean"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/FleetVehicleInput")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      security={{"bearerAuth" : {}}}
     * )
     */
    public function update(Request $request, $id)
    {
        try {
            $fleet_vehicles_input = new FleetVehicleInput($request);
            $fleet_vehicles = FleetVehicle::find($id);

            $fleet_vehicles->update([
                  'fleet_model_id' => $fleet_vehicles_input->fleet_model_id == null ? $fleet_vehicles->fleet_model_id : $fleet_vehicles_input->fleet_model_id,
              'fleet_model_brand_id' => $fleet_vehicles_input->fleet_model_brand_id == null ? $fleet_vehicles->fleet_model_brand_id : $fleet_vehicles_input->fleet_model_brand_id,
              'name' => $fleet_vehicles_input->name == null ? $fleet_vehicles->name : $fleet_vehicles_input->name,
              'is_active' => $fleet_vehicles_input->is_active == null ? $fleet_vehicles->is_active : $fleet_vehicles_input->is_active,
              'vin_sn' => $fleet_vehicles_input->vin_sn == null ? $fleet_vehicles->vin_sn : $fleet_vehicles_input->vin_sn,
              'description' => $fleet_vehicles_input->description == null ? $fleet_vehicles->description : $fleet_vehicles_input->description,
              'license_plate' => $fleet_vehicles_input->license_plate == null ? $fleet_vehicles->license_plate : $fleet_vehicles_input->license_plate,
              'fleet_state_id' => $fleet_vehicles_input->fleet_state_id == null ? $fleet_vehicles->fleet_state_id : $fleet_vehicles_input->fleet_state_id,
              'driver_partner_id' => $fleet_vehicles_input->driver_partner_id == null ? $fleet_vehicles->driver_partner_id : $fleet_vehicles_input->driver_partner_id,
              'future_driver_partner_id' => $fleet_vehicles_input->future_driver_partner_id == null ? $fleet_vehicles->future_driver_partner_id : $fleet_vehicles_input->future_driver_partner_id,
              'is_plan_change_card' => $fleet_vehicles_input->is_plan_change_card == null ? $fleet_vehicles->is_plan_change_card : $fleet_vehicles_input->is_plan_change_card,
              'assignment_date' => $fleet_vehicles_input->assignment_date == null ? $fleet_vehicles->assignment_date : $fleet_vehicles_input->assignment_date,
              'localtion' => $fleet_vehicles_input->localtion == null ? $fleet_vehicles->localtion : $fleet_vehicles_input->localtion,
              'manager_user_id' => $fleet_vehicles_input->manager_user_id == null ? $fleet_vehicles->manager_user_id : $fleet_vehicles_input->manager_user_id,
              'first_contract_date' => $fleet_vehicles_input->first_contract_date == null ? $fleet_vehicles->first_contract_date : $fleet_vehicles_input->first_contract_date,
              'last_odometer' => $fleet_vehicles_input->last_odometer == null ? $fleet_vehicles->last_odometer : $fleet_vehicles_input->last_odometer,
              'unit_odometer' => $fleet_vehicles_input->unit_odometer == null ? $fleet_vehicles->unit_odometer : $fleet_vehicles_input->unit_odometer,
              'immatriculation_date' => $fleet_vehicles_input->immatriculation_date == null ? $fleet_vehicles->immatriculation_date : $fleet_vehicles_input->immatriculation_date,
              'chassis_number' => $fleet_vehicles_input->chassis_number == null ? $fleet_vehicles->chassis_number : $fleet_vehicles_input->chassis_number,
              'catalog_value' => $fleet_vehicles_input->catalog_value == null ? $fleet_vehicles->catalog_value : $fleet_vehicles_input->catalog_value,
              'purchase_value' => $fleet_vehicles_input->purchase_value == null ? $fleet_vehicles->purchase_value : $fleet_vehicles_input->purchase_value,
              'residual_value' => $fleet_vehicles_input->residual_value == null ? $fleet_vehicles->residual_value : $fleet_vehicles_input->residual_value,
              'company_id' => $fleet_vehicles_input->company_id == null ? $fleet_vehicles->company_id : $fleet_vehicles_input->company_id,
              'seats_number' => $fleet_vehicles_input->seats_number == null ? $fleet_vehicles->seats_number : $fleet_vehicles_input->seats_number,
              'doors_number' => $fleet_vehicles_input->doors_number == null ? $fleet_vehicles->doors_number : $fleet_vehicles_input->doors_number,
              'color' => $fleet_vehicles_input->color == null ? $fleet_vehicles->color : $fleet_vehicles_input->color,
              'model_year' => $fleet_vehicles_input->model_year == null ? $fleet_vehicles->model_year : $fleet_vehicles_input->model_year,
              'transmission' => $fleet_vehicles_input->transmission == null ? $fleet_vehicles->transmission : $fleet_vehicles_input->transmission,
              'fuel_type' => $fleet_vehicles_input->fuel_type == null ? $fleet_vehicles->fuel_type : $fleet_vehicles_input->fuel_type,
              'c02_emission' => $fleet_vehicles_input->c02_emission == null ? $fleet_vehicles->c02_emission : $fleet_vehicles_input->c02_emission,
              'horsepower' => $fleet_vehicles_input->horsepower == null ? $fleet_vehicles->horsepower : $fleet_vehicles_input->horsepower,
              'horsepower_taxation' => $fleet_vehicles_input->horsepower_taxation == null ? $fleet_vehicles->horsepower_taxation : $fleet_vehicles_input->horsepower_taxation,
              'power' => $fleet_vehicles_input->power == null ? $fleet_vehicles->power : $fleet_vehicles_input->power,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $fleet_vehicles->fleet_model = $fleet_vehicles->fleet_model ;
         $fleet_vehicles->fleet_model_brand = $fleet_vehicles->fleet_model_brand ;
         $fleet_vehicles->fleet_state = $fleet_vehicles->fleet_state ;
         $fleet_vehicles->driver_partner = $fleet_vehicles->driver_partner ;
         $fleet_vehicles->future_driver_partner = $fleet_vehicles->future_driver_partner ;
         $fleet_vehicles->manager_user = $fleet_vehicles->manager_user ;
         $fleet_vehicles->company = $fleet_vehicles->company ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $fleet_vehicles->fleet_vehicle_fleet_vehicle_tags = $fleet_vehicles->fleetVehicleFleetVehicleTags ;
            $fleet_vehicles->fleet_vehicle_fleet_services = $fleet_vehicles->fleetVehicleFleetServices ;
            $fleet_vehicles->fleet_vehicle_fleet_odometers = $fleet_vehicles->fleetVehicleFleetOdometers ;
 
            }

            return ApiResponse::success(compact('fleet_vehicles'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }


    /**
     * @OA\Delete(
     *      path="/module/hrm/v1/fleet-vehicle/{id}",
     *      operationId="DeleteFleetVehicle",
     *      tags={"Fleet Vehicles"},
     *      summary="Delete fleet_vehicles",
     *      description="Delete fleet_vehicles",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      security={{"bearerAuth" : {}}}
     * )
     */
    public function delete($id)
    {
        try {
            $fleet_vehicles = FleetVehicle::find($id);

            $fleet_vehicles->delete();

            return ApiResponse::success();
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }
}

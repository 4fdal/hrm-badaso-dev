<?php

namespace Uasoft\Badaso\Module\HRM\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\HRM\Models\FleetContract;
use Uasoft\Badaso\Module\HRM\Schema\Inputs\FleetContractInput;

class FleetContractController extends Controller
{
    /**
     * @OA\Post(
     *      path="/module/hrm/v1/fleet-contract",
     *      operationId="AddFleetContract",
     *      tags={"Fleet Contracts"},
     *      summary="Add new fleet_contracts",
     *      description="Add a new fleet_contracts",
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
     *          @OA\JsonContent(ref="#/components/schemas/FleetContractInput")
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
            $fleet_contracts_input = new FleetContractInput($request);

            $fleet_contracts = FleetContract::create([
                  'responsible_user_id' => $fleet_contracts_input->responsible_user_id,
              'fleet_contract_type_id' => $fleet_contracts_input->fleet_contract_type_id,
              'vendor_parent_id' => $fleet_contracts_input->vendor_parent_id,
              'reference' => $fleet_contracts_input->reference,
              'activation_cost' => $fleet_contracts_input->activation_cost,
              'recurring_cost' => $fleet_contracts_input->recurring_cost,
              'recurring_cost_frequency' => $fleet_contracts_input->recurring_cost_frequency,
              'fleet_vehicle_id' => $fleet_contracts_input->fleet_vehicle_id,
              'invoice_date' => $fleet_contracts_input->invoice_date,
              'contract_start_date' => $fleet_contracts_input->contract_start_date,
              'contract_expiration_date' => $fleet_contracts_input->contract_expiration_date,
              'terms_conditions' => $fleet_contracts_input->terms_conditions,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
    
            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $fleet_contracts->fleet_contract_fleet_contract_services = $fleet_contracts->fleetContractFleetContractServices ;
 
            }

            return ApiResponse::success(compact('fleet_contracts'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/fleet-contract",
     *      operationId="BrowseFleetContract",
     *      tags={"Fleet Contracts"},
     *      summary="Browse fleet_contracts",
     *      description="Browse fleet_contracts",
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

            $fleet_contracts = new FleetContract();
            $fleet_contracts_fillable = $fleet_contracts->getFillable();

            $filter_fields = $request->get('filter_fields', '*');
            $filter_fields = explode(',', $filter_fields);
            if (array_search('*', $filter_fields) == false) {
                $new_filter_fields = [];
                foreach ($filter_fields as $index => $field) {
                    if (!in_array($field, $filter_fields)) {
                        $new_filter_fields[] = $field;
                    }
                }
                $fleet_contracts = $fleet_contracts->select($filter_fields);
            }

            $filter_fields_search = $request->get('filter_fields_search', '*');
            $filter_fields_search = explode(',', $filter_fields_search);
            if (isset($request->search)) {
                if (array_search('*', $filter_fields_search) == false) {
                    foreach ($fleet_contracts_fillable as $index => $field) {
                        $fleet_contracts = $fleet_contracts->orWhere($field, "like", "%$request->search%");
                    }
                } else {
                    foreach ($filter_fields_search as $index => $field) {
                        if (in_array($field, $fleet_contracts_fillable)) {
                            $fleet_contracts = $fleet_contracts->orWhere($field, "like", "%$request->search%");
                        }
                    }
                }
            }

            if ($request->get('show_pagination', 'true') == 'true') {
                $max_page = $request->get('max_page', 15);
                $fleet_contracts = $fleet_contracts->paginate($max_page);
            } else {
                $fleet_contracts = $fleet_contracts->get();
            }

            $fleet_contracts->map(function($fleet_contracts) use ($request){

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
    
            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $fleet_contracts->fleet_contract_fleet_contract_services = $fleet_contracts->fleetContractFleetContractServices ;
 
            }

                return $fleet_contracts ;
            });
            $fleet_contracts = $fleet_contracts->toArray();

            return ApiResponse::success(compact('fleet_contracts'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/fleet-contract/{id}",
     *      operationId="ReadFleetContract",
     *      tags={"Fleet Contracts"},
     *      summary="Read fleet_contracts",
     *      description="Read fleet_contracts",
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

            $fleet_contracts = FleetContract::find($id);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
    
            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $fleet_contracts->fleet_contract_fleet_contract_services = $fleet_contracts->fleetContractFleetContractServices ;
 
            }

            return ApiResponse::success(compact('fleet_contracts'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Put(
     *      path="/module/hrm/v1/fleet-contract/{id}",
     *      operationId="UpdateFleetContract",
     *      tags={"Fleet Contracts"},
     *      summary="Update fleet_contracts",
     *      description="Update fleet_contracts",
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
     *          @OA\JsonContent(ref="#/components/schemas/FleetContractInput")
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
            $fleet_contracts_input = new FleetContractInput($request);
            $fleet_contracts = FleetContract::find($id);

            $fleet_contracts->update([
                  'responsible_user_id' => $fleet_contracts_input->responsible_user_id == null ? $fleet_contracts->responsible_user_id : $fleet_contracts_input->responsible_user_id,
              'fleet_contract_type_id' => $fleet_contracts_input->fleet_contract_type_id == null ? $fleet_contracts->fleet_contract_type_id : $fleet_contracts_input->fleet_contract_type_id,
              'vendor_parent_id' => $fleet_contracts_input->vendor_parent_id == null ? $fleet_contracts->vendor_parent_id : $fleet_contracts_input->vendor_parent_id,
              'reference' => $fleet_contracts_input->reference == null ? $fleet_contracts->reference : $fleet_contracts_input->reference,
              'activation_cost' => $fleet_contracts_input->activation_cost == null ? $fleet_contracts->activation_cost : $fleet_contracts_input->activation_cost,
              'recurring_cost' => $fleet_contracts_input->recurring_cost == null ? $fleet_contracts->recurring_cost : $fleet_contracts_input->recurring_cost,
              'recurring_cost_frequency' => $fleet_contracts_input->recurring_cost_frequency == null ? $fleet_contracts->recurring_cost_frequency : $fleet_contracts_input->recurring_cost_frequency,
              'fleet_vehicle_id' => $fleet_contracts_input->fleet_vehicle_id == null ? $fleet_contracts->fleet_vehicle_id : $fleet_contracts_input->fleet_vehicle_id,
              'invoice_date' => $fleet_contracts_input->invoice_date == null ? $fleet_contracts->invoice_date : $fleet_contracts_input->invoice_date,
              'contract_start_date' => $fleet_contracts_input->contract_start_date == null ? $fleet_contracts->contract_start_date : $fleet_contracts_input->contract_start_date,
              'contract_expiration_date' => $fleet_contracts_input->contract_expiration_date == null ? $fleet_contracts->contract_expiration_date : $fleet_contracts_input->contract_expiration_date,
              'terms_conditions' => $fleet_contracts_input->terms_conditions == null ? $fleet_contracts->terms_conditions : $fleet_contracts_input->terms_conditions,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
    
            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $fleet_contracts->fleet_contract_fleet_contract_services = $fleet_contracts->fleetContractFleetContractServices ;
 
            }

            return ApiResponse::success(compact('fleet_contracts'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }


    /**
     * @OA\Delete(
     *      path="/module/hrm/v1/fleet-contract/{id}",
     *      operationId="DeleteFleetContract",
     *      tags={"Fleet Contracts"},
     *      summary="Delete fleet_contracts",
     *      description="Delete fleet_contracts",
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
            $fleet_contracts = FleetContract::find($id);

            $fleet_contracts->delete();

            return ApiResponse::success();
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }
}

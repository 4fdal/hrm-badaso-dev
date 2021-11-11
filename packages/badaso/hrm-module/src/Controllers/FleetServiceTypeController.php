<?php

namespace Uasoft\Badaso\Module\HRM\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\HRM\Models\FleetServiceType;
use Uasoft\Badaso\Module\HRM\Schema\Inputs\FleetServiceTypeInput;

class FleetServiceTypeController extends Controller
{
    /**
     * @OA\Post(
     *      path="/module/hrm/v1/fleet-service-type",
     *      operationId="AddFleetServiceType",
     *      tags={"Fleet Service Types"},
     *      summary="Add new fleet_service_types",
     *      description="Add a new fleet_service_types",
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
     *          @OA\JsonContent(ref="#/components/schemas/FleetServiceTypeInput")
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
            $fleet_service_types_input = new FleetServiceTypeInput($request);

            $fleet_service_types = FleetServiceType::create([
                  'name' => $fleet_service_types_input->name,
              'category' => $fleet_service_types_input->category,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
    
            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $fleet_service_types->fleet_service_type_fleet_contract_services = $fleet_service_types->fleetServiceTypeFleetContractServices ;
            $fleet_service_types->fleet_service_type_fleet_services = $fleet_service_types->fleetServiceTypeFleetServices ;
            $fleet_service_types->vendor_parent_fleet_services = $fleet_service_types->vendorParentFleetServices ;
 
            }

            return ApiResponse::success(compact('fleet_service_types'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/fleet-service-type",
     *      operationId="BrowseFleetServiceType",
     *      tags={"Fleet Service Types"},
     *      summary="Browse fleet_service_types",
     *      description="Browse fleet_service_types",
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

            $fleet_service_types = new FleetServiceType();
            $fleet_service_types_fillable = $fleet_service_types->getFillable();

            $filter_fields = $request->get('filter_fields', '*');
            $filter_fields = explode(',', $filter_fields);
            if (array_search('*', $filter_fields) == false) {
                $new_filter_fields = [];
                foreach ($filter_fields as $index => $field) {
                    if (!in_array($field, $filter_fields)) {
                        $new_filter_fields[] = $field;
                    }
                }
                $fleet_service_types = $fleet_service_types->select($filter_fields);
            }

            $filter_fields_search = $request->get('filter_fields_search', '*');
            $filter_fields_search = explode(',', $filter_fields_search);
            if (isset($request->search)) {
                if (array_search('*', $filter_fields_search) == false) {
                    foreach ($fleet_service_types_fillable as $index => $field) {
                        $fleet_service_types = $fleet_service_types->orWhere($field, "like", "%$request->search%");
                    }
                } else {
                    foreach ($filter_fields_search as $index => $field) {
                        if (in_array($field, $fleet_service_types_fillable)) {
                            $fleet_service_types = $fleet_service_types->orWhere($field, "like", "%$request->search%");
                        }
                    }
                }
            }

            if ($request->get('show_pagination', 'true') == 'true') {
                $max_page = $request->get('max_page', 15);
                $fleet_service_types = $fleet_service_types->paginate($max_page);
            } else {
                $fleet_service_types = $fleet_service_types->get();
            }

            $fleet_service_types->map(function($fleet_service_types) use ($request){

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
    
            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $fleet_service_types->fleet_service_type_fleet_contract_services = $fleet_service_types->fleetServiceTypeFleetContractServices ;
            $fleet_service_types->fleet_service_type_fleet_services = $fleet_service_types->fleetServiceTypeFleetServices ;
            $fleet_service_types->vendor_parent_fleet_services = $fleet_service_types->vendorParentFleetServices ;
 
            }

                return $fleet_service_types ;
            });
            $fleet_service_types = $fleet_service_types->toArray();

            return ApiResponse::success(compact('fleet_service_types'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/fleet-service-type/{id}",
     *      operationId="ReadFleetServiceType",
     *      tags={"Fleet Service Types"},
     *      summary="Read fleet_service_types",
     *      description="Read fleet_service_types",
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

            $fleet_service_types = FleetServiceType::find($id);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
    
            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $fleet_service_types->fleet_service_type_fleet_contract_services = $fleet_service_types->fleetServiceTypeFleetContractServices ;
            $fleet_service_types->fleet_service_type_fleet_services = $fleet_service_types->fleetServiceTypeFleetServices ;
            $fleet_service_types->vendor_parent_fleet_services = $fleet_service_types->vendorParentFleetServices ;
 
            }

            return ApiResponse::success(compact('fleet_service_types'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Put(
     *      path="/module/hrm/v1/fleet-service-type/{id}",
     *      operationId="UpdateFleetServiceType",
     *      tags={"Fleet Service Types"},
     *      summary="Update fleet_service_types",
     *      description="Update fleet_service_types",
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
     *          @OA\JsonContent(ref="#/components/schemas/FleetServiceTypeInput")
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
            $fleet_service_types_input = new FleetServiceTypeInput($request);
            $fleet_service_types = FleetServiceType::find($id);

            $fleet_service_types->update([
                  'name' => $fleet_service_types_input->name == null ? $fleet_service_types->name : $fleet_service_types_input->name,
              'category' => $fleet_service_types_input->category == null ? $fleet_service_types->category : $fleet_service_types_input->category,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
    
            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $fleet_service_types->fleet_service_type_fleet_contract_services = $fleet_service_types->fleetServiceTypeFleetContractServices ;
            $fleet_service_types->fleet_service_type_fleet_services = $fleet_service_types->fleetServiceTypeFleetServices ;
            $fleet_service_types->vendor_parent_fleet_services = $fleet_service_types->vendorParentFleetServices ;
 
            }

            return ApiResponse::success(compact('fleet_service_types'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }


    /**
     * @OA\Delete(
     *      path="/module/hrm/v1/fleet-service-type/{id}",
     *      operationId="DeleteFleetServiceType",
     *      tags={"Fleet Service Types"},
     *      summary="Delete fleet_service_types",
     *      description="Delete fleet_service_types",
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
            $fleet_service_types = FleetServiceType::find($id);

            $fleet_service_types->delete();

            return ApiResponse::success();
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }
}

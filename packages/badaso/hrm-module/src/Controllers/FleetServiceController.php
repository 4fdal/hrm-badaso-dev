<?php

namespace Uasoft\Badaso\Module\HRM\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\HRM\Models\FleetService;
use Uasoft\Badaso\Module\HRM\Schema\Inputs\FleetServiceInput;

class FleetServiceController extends Controller
{
    /**
     * @OA\Post(
     *      path="/module/hrm/v1/fleet-service",
     *      operationId="AddFleetService",
     *      tags={"Fleet Services"},
     *      summary="Add new fleet_services",
     *      description="Add a new fleet_services",
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
     *          @OA\JsonContent(ref="#/components/schemas/FleetServiceInput")
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
            $fleet_services_input = new FleetServiceInput($request);

            $fleet_services = FleetService::create([
                  'description' => $fleet_services_input->description,
              'fleet_service_type_id' => $fleet_services_input->fleet_service_type_id,
              'date' => $fleet_services_input->date,
              'cost' => $fleet_services_input->cost,
              'vendor_parent_id' => $fleet_services_input->vendor_parent_id,
              'fleet_vehicle_id' => $fleet_services_input->fleet_vehicle_id,
              'driver_partner_id' => $fleet_services_input->driver_partner_id,
              'odometer_value' => $fleet_services_input->odometer_value,
              'notes' => $fleet_services_input->notes,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $fleet_services->fleet_service_type = $fleet_services->fleet_service_type ;
         $fleet_services->vendor_parent = $fleet_services->vendor_parent ;
         $fleet_services->fleet_vehicle = $fleet_services->fleet_vehicle ;
         $fleet_services->driver_partner = $fleet_services->driver_partner ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('fleet_services'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/fleet-service",
     *      operationId="BrowseFleetService",
     *      tags={"Fleet Services"},
     *      summary="Browse fleet_services",
     *      description="Browse fleet_services",
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

            $fleet_services = new FleetService();
            $fleet_services_fillable = $fleet_services->getFillable();

            $filter_fields = $request->get('filter_fields', '*');
            $filter_fields = explode(',', $filter_fields);
            if (array_search('*', $filter_fields) == false) {
                $new_filter_fields = [];
                foreach ($filter_fields as $index => $field) {
                    if (!in_array($field, $filter_fields)) {
                        $new_filter_fields[] = $field;
                    }
                }
                $fleet_services = $fleet_services->select($filter_fields);
            }

            $filter_fields_search = $request->get('filter_fields_search', '*');
            $filter_fields_search = explode(',', $filter_fields_search);
            if (isset($request->search)) {
                if (array_search('*', $filter_fields_search) == false) {
                    foreach ($fleet_services_fillable as $index => $field) {
                        $fleet_services = $fleet_services->orWhere($field, "like", "%$request->search%");
                    }
                } else {
                    foreach ($filter_fields_search as $index => $field) {
                        if (in_array($field, $fleet_services_fillable)) {
                            $fleet_services = $fleet_services->orWhere($field, "like", "%$request->search%");
                        }
                    }
                }
            }

            if ($request->get('show_pagination', 'true') == 'true') {
                $max_page = $request->get('max_page', 15);
                $fleet_services = $fleet_services->paginate($max_page);
            } else {
                $fleet_services = $fleet_services->get();
            }

            $fleet_services->map(function($fleet_services) use ($request){

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $fleet_services->fleet_service_type = $fleet_services->fleet_service_type ;
         $fleet_services->vendor_parent = $fleet_services->vendor_parent ;
         $fleet_services->fleet_vehicle = $fleet_services->fleet_vehicle ;
         $fleet_services->driver_partner = $fleet_services->driver_partner ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

                return $fleet_services ;
            });
            $fleet_services = $fleet_services->toArray();

            return ApiResponse::success(compact('fleet_services'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/fleet-service/{id}",
     *      operationId="ReadFleetService",
     *      tags={"Fleet Services"},
     *      summary="Read fleet_services",
     *      description="Read fleet_services",
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

            $fleet_services = FleetService::find($id);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $fleet_services->fleet_service_type = $fleet_services->fleet_service_type ;
         $fleet_services->vendor_parent = $fleet_services->vendor_parent ;
         $fleet_services->fleet_vehicle = $fleet_services->fleet_vehicle ;
         $fleet_services->driver_partner = $fleet_services->driver_partner ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('fleet_services'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Put(
     *      path="/module/hrm/v1/fleet-service/{id}",
     *      operationId="UpdateFleetService",
     *      tags={"Fleet Services"},
     *      summary="Update fleet_services",
     *      description="Update fleet_services",
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
     *          @OA\JsonContent(ref="#/components/schemas/FleetServiceInput")
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
            $fleet_services_input = new FleetServiceInput($request);
            $fleet_services = FleetService::find($id);

            $fleet_services->update([
                  'description' => $fleet_services_input->description == null ? $fleet_services->description : $fleet_services_input->description,
              'fleet_service_type_id' => $fleet_services_input->fleet_service_type_id == null ? $fleet_services->fleet_service_type_id : $fleet_services_input->fleet_service_type_id,
              'date' => $fleet_services_input->date == null ? $fleet_services->date : $fleet_services_input->date,
              'cost' => $fleet_services_input->cost == null ? $fleet_services->cost : $fleet_services_input->cost,
              'vendor_parent_id' => $fleet_services_input->vendor_parent_id == null ? $fleet_services->vendor_parent_id : $fleet_services_input->vendor_parent_id,
              'fleet_vehicle_id' => $fleet_services_input->fleet_vehicle_id == null ? $fleet_services->fleet_vehicle_id : $fleet_services_input->fleet_vehicle_id,
              'driver_partner_id' => $fleet_services_input->driver_partner_id == null ? $fleet_services->driver_partner_id : $fleet_services_input->driver_partner_id,
              'odometer_value' => $fleet_services_input->odometer_value == null ? $fleet_services->odometer_value : $fleet_services_input->odometer_value,
              'notes' => $fleet_services_input->notes == null ? $fleet_services->notes : $fleet_services_input->notes,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $fleet_services->fleet_service_type = $fleet_services->fleet_service_type ;
         $fleet_services->vendor_parent = $fleet_services->vendor_parent ;
         $fleet_services->fleet_vehicle = $fleet_services->fleet_vehicle ;
         $fleet_services->driver_partner = $fleet_services->driver_partner ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('fleet_services'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }


    /**
     * @OA\Delete(
     *      path="/module/hrm/v1/fleet-service/{id}",
     *      operationId="DeleteFleetService",
     *      tags={"Fleet Services"},
     *      summary="Delete fleet_services",
     *      description="Delete fleet_services",
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
            $fleet_services = FleetService::find($id);

            $fleet_services->delete();

            return ApiResponse::success();
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }
}

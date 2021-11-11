<?php

namespace Uasoft\Badaso\Module\HRM\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\HRM\Models\FleetModel;
use Uasoft\Badaso\Module\HRM\Schema\Inputs\FleetModelInput;

class FleetModelController extends Controller
{
    /**
     * @OA\Post(
     *      path="/module/hrm/v1/fleet-model",
     *      operationId="AddFleetModel",
     *      tags={"Fleet Models"},
     *      summary="Add new fleet_models",
     *      description="Add a new fleet_models",
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
     *          @OA\JsonContent(ref="#/components/schemas/FleetModelInput")
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
            $fleet_models_input = new FleetModelInput($request);

            $fleet_models = FleetModel::create([
                  'name' => $fleet_models_input->name,
              'fleet_model_brand_id' => $fleet_models_input->fleet_model_brand_id,
              'manager_user_id' => $fleet_models_input->manager_user_id,
              'is_active' => $fleet_models_input->is_active,
              'vehicle_type' => $fleet_models_input->vehicle_type,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $fleet_models->fleet_model_brand = $fleet_models->fleet_model_brand ;
         $fleet_models->manager_user = $fleet_models->manager_user ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $fleet_models->fleet_model_fleet_vendors = $fleet_models->fleetModelFleetVendors ;
            $fleet_models->fleet_model_fleet_vehicles = $fleet_models->fleetModelFleetVehicles ;
 
            }

            return ApiResponse::success(compact('fleet_models'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/fleet-model",
     *      operationId="BrowseFleetModel",
     *      tags={"Fleet Models"},
     *      summary="Browse fleet_models",
     *      description="Browse fleet_models",
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

            $fleet_models = new FleetModel();
            $fleet_models_fillable = $fleet_models->getFillable();

            $filter_fields = $request->get('filter_fields', '*');
            $filter_fields = explode(',', $filter_fields);
            if (array_search('*', $filter_fields) == false) {
                $new_filter_fields = [];
                foreach ($filter_fields as $index => $field) {
                    if (!in_array($field, $filter_fields)) {
                        $new_filter_fields[] = $field;
                    }
                }
                $fleet_models = $fleet_models->select($filter_fields);
            }

            $filter_fields_search = $request->get('filter_fields_search', '*');
            $filter_fields_search = explode(',', $filter_fields_search);
            if (isset($request->search)) {
                if (array_search('*', $filter_fields_search) == false) {
                    foreach ($fleet_models_fillable as $index => $field) {
                        $fleet_models = $fleet_models->orWhere($field, "like", "%$request->search%");
                    }
                } else {
                    foreach ($filter_fields_search as $index => $field) {
                        if (in_array($field, $fleet_models_fillable)) {
                            $fleet_models = $fleet_models->orWhere($field, "like", "%$request->search%");
                        }
                    }
                }
            }

            if ($request->get('show_pagination', 'true') == 'true') {
                $max_page = $request->get('max_page', 15);
                $fleet_models = $fleet_models->paginate($max_page);
            } else {
                $fleet_models = $fleet_models->get();
            }

            $fleet_models->map(function($fleet_models) use ($request){

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $fleet_models->fleet_model_brand = $fleet_models->fleet_model_brand ;
         $fleet_models->manager_user = $fleet_models->manager_user ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $fleet_models->fleet_model_fleet_vendors = $fleet_models->fleetModelFleetVendors ;
            $fleet_models->fleet_model_fleet_vehicles = $fleet_models->fleetModelFleetVehicles ;
 
            }

                return $fleet_models ;
            });
            $fleet_models = $fleet_models->toArray();

            return ApiResponse::success(compact('fleet_models'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/fleet-model/{id}",
     *      operationId="ReadFleetModel",
     *      tags={"Fleet Models"},
     *      summary="Read fleet_models",
     *      description="Read fleet_models",
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

            $fleet_models = FleetModel::find($id);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $fleet_models->fleet_model_brand = $fleet_models->fleet_model_brand ;
         $fleet_models->manager_user = $fleet_models->manager_user ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $fleet_models->fleet_model_fleet_vendors = $fleet_models->fleetModelFleetVendors ;
            $fleet_models->fleet_model_fleet_vehicles = $fleet_models->fleetModelFleetVehicles ;
 
            }

            return ApiResponse::success(compact('fleet_models'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Put(
     *      path="/module/hrm/v1/fleet-model/{id}",
     *      operationId="UpdateFleetModel",
     *      tags={"Fleet Models"},
     *      summary="Update fleet_models",
     *      description="Update fleet_models",
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
     *          @OA\JsonContent(ref="#/components/schemas/FleetModelInput")
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
            $fleet_models_input = new FleetModelInput($request);
            $fleet_models = FleetModel::find($id);

            $fleet_models->update([
                  'name' => $fleet_models_input->name == null ? $fleet_models->name : $fleet_models_input->name,
              'fleet_model_brand_id' => $fleet_models_input->fleet_model_brand_id == null ? $fleet_models->fleet_model_brand_id : $fleet_models_input->fleet_model_brand_id,
              'manager_user_id' => $fleet_models_input->manager_user_id == null ? $fleet_models->manager_user_id : $fleet_models_input->manager_user_id,
              'is_active' => $fleet_models_input->is_active == null ? $fleet_models->is_active : $fleet_models_input->is_active,
              'vehicle_type' => $fleet_models_input->vehicle_type == null ? $fleet_models->vehicle_type : $fleet_models_input->vehicle_type,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $fleet_models->fleet_model_brand = $fleet_models->fleet_model_brand ;
         $fleet_models->manager_user = $fleet_models->manager_user ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $fleet_models->fleet_model_fleet_vendors = $fleet_models->fleetModelFleetVendors ;
            $fleet_models->fleet_model_fleet_vehicles = $fleet_models->fleetModelFleetVehicles ;
 
            }

            return ApiResponse::success(compact('fleet_models'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }


    /**
     * @OA\Delete(
     *      path="/module/hrm/v1/fleet-model/{id}",
     *      operationId="DeleteFleetModel",
     *      tags={"Fleet Models"},
     *      summary="Delete fleet_models",
     *      description="Delete fleet_models",
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
            $fleet_models = FleetModel::find($id);

            $fleet_models->delete();

            return ApiResponse::success();
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }
}

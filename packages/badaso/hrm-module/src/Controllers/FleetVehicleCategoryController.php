<?php

namespace Uasoft\Badaso\Module\HRM\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\HRM\Models\FleetVehicleCategory;
use Uasoft\Badaso\Module\HRM\Schema\Inputs\FleetVehicleCategoryInput;

class FleetVehicleCategoryController extends Controller
{
    /**
     * @OA\Post(
     *      path="/module/hrm/v1/fleet-vehicle-category",
     *      operationId="AddFleetVehicleCategory",
     *      tags={"Fleet Vehicle Categories"},
     *      summary="Add new fleet_vehicle_categories",
     *      description="Add a new fleet_vehicle_categories",
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
     *          @OA\JsonContent(ref="#/components/schemas/FleetVehicleCategoryInput")
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
            $fleet_vehicle_categories_input = new FleetVehicleCategoryInput($request);

            $fleet_vehicle_categories = FleetVehicleCategory::create([
                  'name' => $fleet_vehicle_categories_input->name,
              'color' => $fleet_vehicle_categories_input->color,
              'user_id' => $fleet_vehicle_categories_input->user_id,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $fleet_vehicle_categories->user = $fleet_vehicle_categories->user ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $fleet_vehicle_categories->fleet_vehicle_categorie_fleet_vehicle_tags = $fleet_vehicle_categories->fleetVehicleCategorieFleetVehicleTags ;
 
            }

            return ApiResponse::success(compact('fleet_vehicle_categories'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/fleet-vehicle-category",
     *      operationId="BrowseFleetVehicleCategory",
     *      tags={"Fleet Vehicle Categories"},
     *      summary="Browse fleet_vehicle_categories",
     *      description="Browse fleet_vehicle_categories",
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

            $fleet_vehicle_categories = new FleetVehicleCategory();
            $fleet_vehicle_categories_fillable = $fleet_vehicle_categories->getFillable();

            $filter_fields = $request->get('filter_fields', '*');
            $filter_fields = explode(',', $filter_fields);
            if (array_search('*', $filter_fields) == false) {
                $new_filter_fields = [];
                foreach ($filter_fields as $index => $field) {
                    if (!in_array($field, $filter_fields)) {
                        $new_filter_fields[] = $field;
                    }
                }
                $fleet_vehicle_categories = $fleet_vehicle_categories->select($filter_fields);
            }

            $filter_fields_search = $request->get('filter_fields_search', '*');
            $filter_fields_search = explode(',', $filter_fields_search);
            if (isset($request->search)) {
                if (array_search('*', $filter_fields_search) == false) {
                    foreach ($fleet_vehicle_categories_fillable as $index => $field) {
                        $fleet_vehicle_categories = $fleet_vehicle_categories->orWhere($field, "like", "%$request->search%");
                    }
                } else {
                    foreach ($filter_fields_search as $index => $field) {
                        if (in_array($field, $fleet_vehicle_categories_fillable)) {
                            $fleet_vehicle_categories = $fleet_vehicle_categories->orWhere($field, "like", "%$request->search%");
                        }
                    }
                }
            }

            if ($request->get('show_pagination', 'true') == 'true') {
                $max_page = $request->get('max_page', 15);
                $fleet_vehicle_categories = $fleet_vehicle_categories->paginate($max_page);
            } else {
                $fleet_vehicle_categories = $fleet_vehicle_categories->get();
            }

            $fleet_vehicle_categories->map(function($fleet_vehicle_categories) use ($request){

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $fleet_vehicle_categories->user = $fleet_vehicle_categories->user ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $fleet_vehicle_categories->fleet_vehicle_categorie_fleet_vehicle_tags = $fleet_vehicle_categories->fleetVehicleCategorieFleetVehicleTags ;
 
            }

                return $fleet_vehicle_categories ;
            });
            $fleet_vehicle_categories = $fleet_vehicle_categories->toArray();

            return ApiResponse::success(compact('fleet_vehicle_categories'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/fleet-vehicle-category/{id}",
     *      operationId="ReadFleetVehicleCategory",
     *      tags={"Fleet Vehicle Categories"},
     *      summary="Read fleet_vehicle_categories",
     *      description="Read fleet_vehicle_categories",
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

            $fleet_vehicle_categories = FleetVehicleCategory::find($id);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $fleet_vehicle_categories->user = $fleet_vehicle_categories->user ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $fleet_vehicle_categories->fleet_vehicle_categorie_fleet_vehicle_tags = $fleet_vehicle_categories->fleetVehicleCategorieFleetVehicleTags ;
 
            }

            return ApiResponse::success(compact('fleet_vehicle_categories'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Put(
     *      path="/module/hrm/v1/fleet-vehicle-category/{id}",
     *      operationId="UpdateFleetVehicleCategory",
     *      tags={"Fleet Vehicle Categories"},
     *      summary="Update fleet_vehicle_categories",
     *      description="Update fleet_vehicle_categories",
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
     *          @OA\JsonContent(ref="#/components/schemas/FleetVehicleCategoryInput")
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
            $fleet_vehicle_categories_input = new FleetVehicleCategoryInput($request);
            $fleet_vehicle_categories = FleetVehicleCategory::find($id);

            $fleet_vehicle_categories->update([
                  'name' => $fleet_vehicle_categories_input->name == null ? $fleet_vehicle_categories->name : $fleet_vehicle_categories_input->name,
              'color' => $fleet_vehicle_categories_input->color == null ? $fleet_vehicle_categories->color : $fleet_vehicle_categories_input->color,
              'user_id' => $fleet_vehicle_categories_input->user_id == null ? $fleet_vehicle_categories->user_id : $fleet_vehicle_categories_input->user_id,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $fleet_vehicle_categories->user = $fleet_vehicle_categories->user ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $fleet_vehicle_categories->fleet_vehicle_categorie_fleet_vehicle_tags = $fleet_vehicle_categories->fleetVehicleCategorieFleetVehicleTags ;
 
            }

            return ApiResponse::success(compact('fleet_vehicle_categories'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }


    /**
     * @OA\Delete(
     *      path="/module/hrm/v1/fleet-vehicle-category/{id}",
     *      operationId="DeleteFleetVehicleCategory",
     *      tags={"Fleet Vehicle Categories"},
     *      summary="Delete fleet_vehicle_categories",
     *      description="Delete fleet_vehicle_categories",
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
            $fleet_vehicle_categories = FleetVehicleCategory::find($id);

            $fleet_vehicle_categories->delete();

            return ApiResponse::success();
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }
}

<?php

namespace Uasoft\Badaso\Module\HRM\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\HRM\Models\FleetVehicleTag;
use Uasoft\Badaso\Module\HRM\Schema\Inputs\FleetVehicleTagInput;

class FleetVehicleTagController extends Controller
{
    /**
     * @OA\Post(
     *      path="/module/hrm/v1/fleet-vehicle-tag",
     *      operationId="AddFleetVehicleTag",
     *      tags={"Fleet Vehicle Tags"},
     *      summary="Add new fleet_vehicle_tags",
     *      description="Add a new fleet_vehicle_tags",
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
     *          @OA\JsonContent(ref="#/components/schemas/FleetVehicleTagInput")
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
            $fleet_vehicle_tags_input = new FleetVehicleTagInput($request);

            $fleet_vehicle_tags = FleetVehicleTag::create([
                  'fleet_vehicle_id' => $fleet_vehicle_tags_input->fleet_vehicle_id,
              'fleet_vehicle_categorie_id' => $fleet_vehicle_tags_input->fleet_vehicle_categorie_id,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $fleet_vehicle_tags->fleet_vehicle = $fleet_vehicle_tags->fleet_vehicle ;
         $fleet_vehicle_tags->fleet_vehicle_categorie = $fleet_vehicle_tags->fleet_vehicle_categorie ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('fleet_vehicle_tags'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/fleet-vehicle-tag",
     *      operationId="BrowseFleetVehicleTag",
     *      tags={"Fleet Vehicle Tags"},
     *      summary="Browse fleet_vehicle_tags",
     *      description="Browse fleet_vehicle_tags",
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

            $fleet_vehicle_tags = new FleetVehicleTag();
            $fleet_vehicle_tags_fillable = $fleet_vehicle_tags->getFillable();

            $filter_fields = $request->get('filter_fields', '*');
            $filter_fields = explode(',', $filter_fields);
            if (array_search('*', $filter_fields) == false) {
                $new_filter_fields = [];
                foreach ($filter_fields as $index => $field) {
                    if (!in_array($field, $filter_fields)) {
                        $new_filter_fields[] = $field;
                    }
                }
                $fleet_vehicle_tags = $fleet_vehicle_tags->select($filter_fields);
            }

            $filter_fields_search = $request->get('filter_fields_search', '*');
            $filter_fields_search = explode(',', $filter_fields_search);
            if (isset($request->search)) {
                if (array_search('*', $filter_fields_search) == false) {
                    foreach ($fleet_vehicle_tags_fillable as $index => $field) {
                        $fleet_vehicle_tags = $fleet_vehicle_tags->orWhere($field, "like", "%$request->search%");
                    }
                } else {
                    foreach ($filter_fields_search as $index => $field) {
                        if (in_array($field, $fleet_vehicle_tags_fillable)) {
                            $fleet_vehicle_tags = $fleet_vehicle_tags->orWhere($field, "like", "%$request->search%");
                        }
                    }
                }
            }

            if ($request->get('show_pagination', 'true') == 'true') {
                $max_page = $request->get('max_page', 15);
                $fleet_vehicle_tags = $fleet_vehicle_tags->paginate($max_page);
            } else {
                $fleet_vehicle_tags = $fleet_vehicle_tags->get();
            }

            $fleet_vehicle_tags->map(function($fleet_vehicle_tags) use ($request){

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $fleet_vehicle_tags->fleet_vehicle = $fleet_vehicle_tags->fleet_vehicle ;
         $fleet_vehicle_tags->fleet_vehicle_categorie = $fleet_vehicle_tags->fleet_vehicle_categorie ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

                return $fleet_vehicle_tags ;
            });
            $fleet_vehicle_tags = $fleet_vehicle_tags->toArray();

            return ApiResponse::success(compact('fleet_vehicle_tags'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/fleet-vehicle-tag/{id}",
     *      operationId="ReadFleetVehicleTag",
     *      tags={"Fleet Vehicle Tags"},
     *      summary="Read fleet_vehicle_tags",
     *      description="Read fleet_vehicle_tags",
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

            $fleet_vehicle_tags = FleetVehicleTag::find($id);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $fleet_vehicle_tags->fleet_vehicle = $fleet_vehicle_tags->fleet_vehicle ;
         $fleet_vehicle_tags->fleet_vehicle_categorie = $fleet_vehicle_tags->fleet_vehicle_categorie ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('fleet_vehicle_tags'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Put(
     *      path="/module/hrm/v1/fleet-vehicle-tag/{id}",
     *      operationId="UpdateFleetVehicleTag",
     *      tags={"Fleet Vehicle Tags"},
     *      summary="Update fleet_vehicle_tags",
     *      description="Update fleet_vehicle_tags",
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
     *          @OA\JsonContent(ref="#/components/schemas/FleetVehicleTagInput")
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
            $fleet_vehicle_tags_input = new FleetVehicleTagInput($request);
            $fleet_vehicle_tags = FleetVehicleTag::find($id);

            $fleet_vehicle_tags->update([
                  'fleet_vehicle_id' => $fleet_vehicle_tags_input->fleet_vehicle_id == null ? $fleet_vehicle_tags->fleet_vehicle_id : $fleet_vehicle_tags_input->fleet_vehicle_id,
              'fleet_vehicle_categorie_id' => $fleet_vehicle_tags_input->fleet_vehicle_categorie_id == null ? $fleet_vehicle_tags->fleet_vehicle_categorie_id : $fleet_vehicle_tags_input->fleet_vehicle_categorie_id,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $fleet_vehicle_tags->fleet_vehicle = $fleet_vehicle_tags->fleet_vehicle ;
         $fleet_vehicle_tags->fleet_vehicle_categorie = $fleet_vehicle_tags->fleet_vehicle_categorie ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('fleet_vehicle_tags'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }


    /**
     * @OA\Delete(
     *      path="/module/hrm/v1/fleet-vehicle-tag/{id}",
     *      operationId="DeleteFleetVehicleTag",
     *      tags={"Fleet Vehicle Tags"},
     *      summary="Delete fleet_vehicle_tags",
     *      description="Delete fleet_vehicle_tags",
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
            $fleet_vehicle_tags = FleetVehicleTag::find($id);

            $fleet_vehicle_tags->delete();

            return ApiResponse::success();
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }
}

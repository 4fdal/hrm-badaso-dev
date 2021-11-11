<?php

namespace Uasoft\Badaso\Module\HRM\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\HRM\Models\FleetVendor;
use Uasoft\Badaso\Module\HRM\Schema\Inputs\FleetVendorInput;

class FleetVendorController extends Controller
{
    /**
     * @OA\Post(
     *      path="/module/hrm/v1/fleet-vendor",
     *      operationId="AddFleetVendor",
     *      tags={"Fleet Vendors"},
     *      summary="Add new fleet_vendors",
     *      description="Add a new fleet_vendors",
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
     *          @OA\JsonContent(ref="#/components/schemas/FleetVendorInput")
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
            $fleet_vendors_input = new FleetVendorInput($request);

            $fleet_vendors = FleetVendor::create([
                  'fleet_model_id' => $fleet_vendors_input->fleet_model_id,
              'partner_id' => $fleet_vendors_input->partner_id,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $fleet_vendors->fleet_model = $fleet_vendors->fleet_model ;
         $fleet_vendors->partner = $fleet_vendors->partner ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('fleet_vendors'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/fleet-vendor",
     *      operationId="BrowseFleetVendor",
     *      tags={"Fleet Vendors"},
     *      summary="Browse fleet_vendors",
     *      description="Browse fleet_vendors",
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

            $fleet_vendors = new FleetVendor();
            $fleet_vendors_fillable = $fleet_vendors->getFillable();

            $filter_fields = $request->get('filter_fields', '*');
            $filter_fields = explode(',', $filter_fields);
            if (array_search('*', $filter_fields) == false) {
                $new_filter_fields = [];
                foreach ($filter_fields as $index => $field) {
                    if (!in_array($field, $filter_fields)) {
                        $new_filter_fields[] = $field;
                    }
                }
                $fleet_vendors = $fleet_vendors->select($filter_fields);
            }

            $filter_fields_search = $request->get('filter_fields_search', '*');
            $filter_fields_search = explode(',', $filter_fields_search);
            if (isset($request->search)) {
                if (array_search('*', $filter_fields_search) == false) {
                    foreach ($fleet_vendors_fillable as $index => $field) {
                        $fleet_vendors = $fleet_vendors->orWhere($field, "like", "%$request->search%");
                    }
                } else {
                    foreach ($filter_fields_search as $index => $field) {
                        if (in_array($field, $fleet_vendors_fillable)) {
                            $fleet_vendors = $fleet_vendors->orWhere($field, "like", "%$request->search%");
                        }
                    }
                }
            }

            if ($request->get('show_pagination', 'true') == 'true') {
                $max_page = $request->get('max_page', 15);
                $fleet_vendors = $fleet_vendors->paginate($max_page);
            } else {
                $fleet_vendors = $fleet_vendors->get();
            }

            $fleet_vendors->map(function($fleet_vendors) use ($request){

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $fleet_vendors->fleet_model = $fleet_vendors->fleet_model ;
         $fleet_vendors->partner = $fleet_vendors->partner ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

                return $fleet_vendors ;
            });
            $fleet_vendors = $fleet_vendors->toArray();

            return ApiResponse::success(compact('fleet_vendors'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/fleet-vendor/{id}",
     *      operationId="ReadFleetVendor",
     *      tags={"Fleet Vendors"},
     *      summary="Read fleet_vendors",
     *      description="Read fleet_vendors",
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

            $fleet_vendors = FleetVendor::find($id);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $fleet_vendors->fleet_model = $fleet_vendors->fleet_model ;
         $fleet_vendors->partner = $fleet_vendors->partner ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('fleet_vendors'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Put(
     *      path="/module/hrm/v1/fleet-vendor/{id}",
     *      operationId="UpdateFleetVendor",
     *      tags={"Fleet Vendors"},
     *      summary="Update fleet_vendors",
     *      description="Update fleet_vendors",
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
     *          @OA\JsonContent(ref="#/components/schemas/FleetVendorInput")
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
            $fleet_vendors_input = new FleetVendorInput($request);
            $fleet_vendors = FleetVendor::find($id);

            $fleet_vendors->update([
                  'fleet_model_id' => $fleet_vendors_input->fleet_model_id == null ? $fleet_vendors->fleet_model_id : $fleet_vendors_input->fleet_model_id,
              'partner_id' => $fleet_vendors_input->partner_id == null ? $fleet_vendors->partner_id : $fleet_vendors_input->partner_id,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $fleet_vendors->fleet_model = $fleet_vendors->fleet_model ;
         $fleet_vendors->partner = $fleet_vendors->partner ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('fleet_vendors'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }


    /**
     * @OA\Delete(
     *      path="/module/hrm/v1/fleet-vendor/{id}",
     *      operationId="DeleteFleetVendor",
     *      tags={"Fleet Vendors"},
     *      summary="Delete fleet_vendors",
     *      description="Delete fleet_vendors",
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
            $fleet_vendors = FleetVendor::find($id);

            $fleet_vendors->delete();

            return ApiResponse::success();
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }
}

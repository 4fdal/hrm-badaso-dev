<?php

namespace Uasoft\Badaso\Module\HRM\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\HRM\Models\LunchLocation;
use Uasoft\Badaso\Module\HRM\Schema\Inputs\LunchLocationInput;

class LunchLocationController extends Controller
{
    /**
     * @OA\Post(
     *      path="/module/hrm/v1/lunch-location",
     *      operationId="AddLunchLocation",
     *      tags={"Lunch Locations"},
     *      summary="Add new lunch_locations",
     *      description="Add a new lunch_locations",
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
     *          @OA\JsonContent(ref="#/components/schemas/LunchLocationInput")
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
            $lunch_locations_input = new LunchLocationInput($request);

            $lunch_locations = LunchLocation::create([
                  'name' => $lunch_locations_input->name,
              'address' => $lunch_locations_input->address,
              'company_id' => $lunch_locations_input->company_id,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $lunch_locations->company = $lunch_locations->company ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $lunch_locations->lunch_locations_lunch_vendors_location_orders = $lunch_locations->lunchLocationsLunchVendorsLocationOrders ;
            $lunch_locations->lunch_location_lunch_alert_locations = $lunch_locations->lunchLocationLunchAlertLocations ;
 
            }

            return ApiResponse::success(compact('lunch_locations'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/lunch-location",
     *      operationId="BrowseLunchLocation",
     *      tags={"Lunch Locations"},
     *      summary="Browse lunch_locations",
     *      description="Browse lunch_locations",
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

            $lunch_locations = new LunchLocation();
            $lunch_locations_fillable = $lunch_locations->getFillable();

            $filter_fields = $request->get('filter_fields', '*');
            $filter_fields = explode(',', $filter_fields);
            if (array_search('*', $filter_fields) == false) {
                $new_filter_fields = [];
                foreach ($filter_fields as $index => $field) {
                    if (!in_array($field, $filter_fields)) {
                        $new_filter_fields[] = $field;
                    }
                }
                $lunch_locations = $lunch_locations->select($filter_fields);
            }

            $filter_fields_search = $request->get('filter_fields_search', '*');
            $filter_fields_search = explode(',', $filter_fields_search);
            if (isset($request->search)) {
                if (array_search('*', $filter_fields_search) == false) {
                    foreach ($lunch_locations_fillable as $index => $field) {
                        $lunch_locations = $lunch_locations->orWhere($field, "like", "%$request->search%");
                    }
                } else {
                    foreach ($filter_fields_search as $index => $field) {
                        if (in_array($field, $lunch_locations_fillable)) {
                            $lunch_locations = $lunch_locations->orWhere($field, "like", "%$request->search%");
                        }
                    }
                }
            }

            if ($request->get('show_pagination', 'true') == 'true') {
                $max_page = $request->get('max_page', 15);
                $lunch_locations = $lunch_locations->paginate($max_page);
            } else {
                $lunch_locations = $lunch_locations->get();
            }

            $lunch_locations->map(function($lunch_locations) use ($request){

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $lunch_locations->company = $lunch_locations->company ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $lunch_locations->lunch_locations_lunch_vendors_location_orders = $lunch_locations->lunchLocationsLunchVendorsLocationOrders ;
            $lunch_locations->lunch_location_lunch_alert_locations = $lunch_locations->lunchLocationLunchAlertLocations ;
 
            }

                return $lunch_locations ;
            });
            $lunch_locations = $lunch_locations->toArray();

            return ApiResponse::success(compact('lunch_locations'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/lunch-location/{id}",
     *      operationId="ReadLunchLocation",
     *      tags={"Lunch Locations"},
     *      summary="Read lunch_locations",
     *      description="Read lunch_locations",
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

            $lunch_locations = LunchLocation::find($id);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $lunch_locations->company = $lunch_locations->company ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $lunch_locations->lunch_locations_lunch_vendors_location_orders = $lunch_locations->lunchLocationsLunchVendorsLocationOrders ;
            $lunch_locations->lunch_location_lunch_alert_locations = $lunch_locations->lunchLocationLunchAlertLocations ;
 
            }

            return ApiResponse::success(compact('lunch_locations'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Put(
     *      path="/module/hrm/v1/lunch-location/{id}",
     *      operationId="UpdateLunchLocation",
     *      tags={"Lunch Locations"},
     *      summary="Update lunch_locations",
     *      description="Update lunch_locations",
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
     *          @OA\JsonContent(ref="#/components/schemas/LunchLocationInput")
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
            $lunch_locations_input = new LunchLocationInput($request);
            $lunch_locations = LunchLocation::find($id);

            $lunch_locations->update([
                  'name' => $lunch_locations_input->name == null ? $lunch_locations->name : $lunch_locations_input->name,
              'address' => $lunch_locations_input->address == null ? $lunch_locations->address : $lunch_locations_input->address,
              'company_id' => $lunch_locations_input->company_id == null ? $lunch_locations->company_id : $lunch_locations_input->company_id,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $lunch_locations->company = $lunch_locations->company ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $lunch_locations->lunch_locations_lunch_vendors_location_orders = $lunch_locations->lunchLocationsLunchVendorsLocationOrders ;
            $lunch_locations->lunch_location_lunch_alert_locations = $lunch_locations->lunchLocationLunchAlertLocations ;
 
            }

            return ApiResponse::success(compact('lunch_locations'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }


    /**
     * @OA\Delete(
     *      path="/module/hrm/v1/lunch-location/{id}",
     *      operationId="DeleteLunchLocation",
     *      tags={"Lunch Locations"},
     *      summary="Delete lunch_locations",
     *      description="Delete lunch_locations",
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
            $lunch_locations = LunchLocation::find($id);

            $lunch_locations->delete();

            return ApiResponse::success();
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }
}

<?php

namespace Uasoft\Badaso\Module\HRM\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\HRM\Models\LunchVendorsLocationOrder;
use Uasoft\Badaso\Module\HRM\Schema\Inputs\LunchVendorsLocationOrderInput;

class LunchVendorsLocationOrderController extends Controller
{
    /**
     * @OA\Post(
     *      path="/module/hrm/v1/lunch-vendors-location-order",
     *      operationId="AddLunchVendorsLocationOrder",
     *      tags={"Lunch Vendors Location Orders"},
     *      summary="Add new lunch_vendors_location_orders",
     *      description="Add a new lunch_vendors_location_orders",
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
     *          @OA\JsonContent(ref="#/components/schemas/LunchVendorsLocationOrderInput")
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
            $lunch_vendors_location_orders_input = new LunchVendorsLocationOrderInput($request);

            $lunch_vendors_location_orders = LunchVendorsLocationOrder::create([
                  'lunch_vendor_id' => $lunch_vendors_location_orders_input->lunch_vendor_id,
              'lunch_locations_id' => $lunch_vendors_location_orders_input->lunch_locations_id,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $lunch_vendors_location_orders->lunch_vendor = $lunch_vendors_location_orders->lunch_vendor ;
         $lunch_vendors_location_orders->lunch_locations = $lunch_vendors_location_orders->lunch_locations ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('lunch_vendors_location_orders'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/lunch-vendors-location-order",
     *      operationId="BrowseLunchVendorsLocationOrder",
     *      tags={"Lunch Vendors Location Orders"},
     *      summary="Browse lunch_vendors_location_orders",
     *      description="Browse lunch_vendors_location_orders",
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

            $lunch_vendors_location_orders = new LunchVendorsLocationOrder();
            $lunch_vendors_location_orders_fillable = $lunch_vendors_location_orders->getFillable();

            $filter_fields = $request->get('filter_fields', '*');
            $filter_fields = explode(',', $filter_fields);
            if (array_search('*', $filter_fields) == false) {
                $new_filter_fields = [];
                foreach ($filter_fields as $index => $field) {
                    if (!in_array($field, $filter_fields)) {
                        $new_filter_fields[] = $field;
                    }
                }
                $lunch_vendors_location_orders = $lunch_vendors_location_orders->select($filter_fields);
            }

            $filter_fields_search = $request->get('filter_fields_search', '*');
            $filter_fields_search = explode(',', $filter_fields_search);
            if (isset($request->search)) {
                if (array_search('*', $filter_fields_search) == false) {
                    foreach ($lunch_vendors_location_orders_fillable as $index => $field) {
                        $lunch_vendors_location_orders = $lunch_vendors_location_orders->orWhere($field, "like", "%$request->search%");
                    }
                } else {
                    foreach ($filter_fields_search as $index => $field) {
                        if (in_array($field, $lunch_vendors_location_orders_fillable)) {
                            $lunch_vendors_location_orders = $lunch_vendors_location_orders->orWhere($field, "like", "%$request->search%");
                        }
                    }
                }
            }

            if ($request->get('show_pagination', 'true') == 'true') {
                $max_page = $request->get('max_page', 15);
                $lunch_vendors_location_orders = $lunch_vendors_location_orders->paginate($max_page);
            } else {
                $lunch_vendors_location_orders = $lunch_vendors_location_orders->get();
            }

            $lunch_vendors_location_orders->map(function($lunch_vendors_location_orders) use ($request){

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $lunch_vendors_location_orders->lunch_vendor = $lunch_vendors_location_orders->lunch_vendor ;
         $lunch_vendors_location_orders->lunch_locations = $lunch_vendors_location_orders->lunch_locations ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

                return $lunch_vendors_location_orders ;
            });
            $lunch_vendors_location_orders = $lunch_vendors_location_orders->toArray();

            return ApiResponse::success(compact('lunch_vendors_location_orders'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/lunch-vendors-location-order/{id}",
     *      operationId="ReadLunchVendorsLocationOrder",
     *      tags={"Lunch Vendors Location Orders"},
     *      summary="Read lunch_vendors_location_orders",
     *      description="Read lunch_vendors_location_orders",
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

            $lunch_vendors_location_orders = LunchVendorsLocationOrder::find($id);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $lunch_vendors_location_orders->lunch_vendor = $lunch_vendors_location_orders->lunch_vendor ;
         $lunch_vendors_location_orders->lunch_locations = $lunch_vendors_location_orders->lunch_locations ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('lunch_vendors_location_orders'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Put(
     *      path="/module/hrm/v1/lunch-vendors-location-order/{id}",
     *      operationId="UpdateLunchVendorsLocationOrder",
     *      tags={"Lunch Vendors Location Orders"},
     *      summary="Update lunch_vendors_location_orders",
     *      description="Update lunch_vendors_location_orders",
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
     *          @OA\JsonContent(ref="#/components/schemas/LunchVendorsLocationOrderInput")
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
            $lunch_vendors_location_orders_input = new LunchVendorsLocationOrderInput($request);
            $lunch_vendors_location_orders = LunchVendorsLocationOrder::find($id);

            $lunch_vendors_location_orders->update([
                  'lunch_vendor_id' => $lunch_vendors_location_orders_input->lunch_vendor_id == null ? $lunch_vendors_location_orders->lunch_vendor_id : $lunch_vendors_location_orders_input->lunch_vendor_id,
              'lunch_locations_id' => $lunch_vendors_location_orders_input->lunch_locations_id == null ? $lunch_vendors_location_orders->lunch_locations_id : $lunch_vendors_location_orders_input->lunch_locations_id,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $lunch_vendors_location_orders->lunch_vendor = $lunch_vendors_location_orders->lunch_vendor ;
         $lunch_vendors_location_orders->lunch_locations = $lunch_vendors_location_orders->lunch_locations ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('lunch_vendors_location_orders'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }


    /**
     * @OA\Delete(
     *      path="/module/hrm/v1/lunch-vendors-location-order/{id}",
     *      operationId="DeleteLunchVendorsLocationOrder",
     *      tags={"Lunch Vendors Location Orders"},
     *      summary="Delete lunch_vendors_location_orders",
     *      description="Delete lunch_vendors_location_orders",
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
            $lunch_vendors_location_orders = LunchVendorsLocationOrder::find($id);

            $lunch_vendors_location_orders->delete();

            return ApiResponse::success();
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }
}

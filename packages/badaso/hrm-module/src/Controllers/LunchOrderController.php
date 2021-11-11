<?php

namespace Uasoft\Badaso\Module\HRM\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\HRM\Models\LunchOrder;
use Uasoft\Badaso\Module\HRM\Schema\Inputs\LunchOrderInput;

class LunchOrderController extends Controller
{
    /**
     * @OA\Post(
     *      path="/module/hrm/v1/lunch-order",
     *      operationId="AddLunchOrder",
     *      tags={"Lunch Orders"},
     *      summary="Add new lunch_orders",
     *      description="Add a new lunch_orders",
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
     *          @OA\JsonContent(ref="#/components/schemas/LunchOrderInput")
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
            $lunch_orders_input = new LunchOrderInput($request);

            $lunch_orders = LunchOrder::create([
                  'lunch_product_id' => $lunch_orders_input->lunch_product_id,
              'lunch_product_category_id' => $lunch_orders_input->lunch_product_category_id,
              'date' => $lunch_orders_input->date,
              'lunch_vendor_id' => $lunch_orders_input->lunch_vendor_id,
              'user_id' => $lunch_orders_input->user_id,
              'note' => $lunch_orders_input->note,
              'price' => $lunch_orders_input->price,
              'is_active' => $lunch_orders_input->is_active,
              'state' => $lunch_orders_input->state,
              'company_id' => $lunch_orders_input->company_id,
              'currency_id' => $lunch_orders_input->currency_id,
              'quantity' => $lunch_orders_input->quantity,
              'display_topping' => $lunch_orders_input->display_topping,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $lunch_orders->lunch_product = $lunch_orders->lunch_product ;
         $lunch_orders->lunch_product_category = $lunch_orders->lunch_product_category ;
         $lunch_orders->lunch_vendor = $lunch_orders->lunch_vendor ;
         $lunch_orders->company = $lunch_orders->company ;
         $lunch_orders->currency = $lunch_orders->currency ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $lunch_orders->lunch_order_lunch_order_toppings = $lunch_orders->lunchOrderLunchOrderToppings ;
 
            }

            return ApiResponse::success(compact('lunch_orders'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/lunch-order",
     *      operationId="BrowseLunchOrder",
     *      tags={"Lunch Orders"},
     *      summary="Browse lunch_orders",
     *      description="Browse lunch_orders",
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

            $lunch_orders = new LunchOrder();
            $lunch_orders_fillable = $lunch_orders->getFillable();

            $filter_fields = $request->get('filter_fields', '*');
            $filter_fields = explode(',', $filter_fields);
            if (array_search('*', $filter_fields) == false) {
                $new_filter_fields = [];
                foreach ($filter_fields as $index => $field) {
                    if (!in_array($field, $filter_fields)) {
                        $new_filter_fields[] = $field;
                    }
                }
                $lunch_orders = $lunch_orders->select($filter_fields);
            }

            $filter_fields_search = $request->get('filter_fields_search', '*');
            $filter_fields_search = explode(',', $filter_fields_search);
            if (isset($request->search)) {
                if (array_search('*', $filter_fields_search) == false) {
                    foreach ($lunch_orders_fillable as $index => $field) {
                        $lunch_orders = $lunch_orders->orWhere($field, "like", "%$request->search%");
                    }
                } else {
                    foreach ($filter_fields_search as $index => $field) {
                        if (in_array($field, $lunch_orders_fillable)) {
                            $lunch_orders = $lunch_orders->orWhere($field, "like", "%$request->search%");
                        }
                    }
                }
            }

            if ($request->get('show_pagination', 'true') == 'true') {
                $max_page = $request->get('max_page', 15);
                $lunch_orders = $lunch_orders->paginate($max_page);
            } else {
                $lunch_orders = $lunch_orders->get();
            }

            $lunch_orders->map(function($lunch_orders) use ($request){

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $lunch_orders->lunch_product = $lunch_orders->lunch_product ;
         $lunch_orders->lunch_product_category = $lunch_orders->lunch_product_category ;
         $lunch_orders->lunch_vendor = $lunch_orders->lunch_vendor ;
         $lunch_orders->company = $lunch_orders->company ;
         $lunch_orders->currency = $lunch_orders->currency ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $lunch_orders->lunch_order_lunch_order_toppings = $lunch_orders->lunchOrderLunchOrderToppings ;
 
            }

                return $lunch_orders ;
            });
            $lunch_orders = $lunch_orders->toArray();

            return ApiResponse::success(compact('lunch_orders'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/lunch-order/{id}",
     *      operationId="ReadLunchOrder",
     *      tags={"Lunch Orders"},
     *      summary="Read lunch_orders",
     *      description="Read lunch_orders",
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

            $lunch_orders = LunchOrder::find($id);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $lunch_orders->lunch_product = $lunch_orders->lunch_product ;
         $lunch_orders->lunch_product_category = $lunch_orders->lunch_product_category ;
         $lunch_orders->lunch_vendor = $lunch_orders->lunch_vendor ;
         $lunch_orders->company = $lunch_orders->company ;
         $lunch_orders->currency = $lunch_orders->currency ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $lunch_orders->lunch_order_lunch_order_toppings = $lunch_orders->lunchOrderLunchOrderToppings ;
 
            }

            return ApiResponse::success(compact('lunch_orders'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Put(
     *      path="/module/hrm/v1/lunch-order/{id}",
     *      operationId="UpdateLunchOrder",
     *      tags={"Lunch Orders"},
     *      summary="Update lunch_orders",
     *      description="Update lunch_orders",
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
     *          @OA\JsonContent(ref="#/components/schemas/LunchOrderInput")
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
            $lunch_orders_input = new LunchOrderInput($request);
            $lunch_orders = LunchOrder::find($id);

            $lunch_orders->update([
                  'lunch_product_id' => $lunch_orders_input->lunch_product_id == null ? $lunch_orders->lunch_product_id : $lunch_orders_input->lunch_product_id,
              'lunch_product_category_id' => $lunch_orders_input->lunch_product_category_id == null ? $lunch_orders->lunch_product_category_id : $lunch_orders_input->lunch_product_category_id,
              'date' => $lunch_orders_input->date == null ? $lunch_orders->date : $lunch_orders_input->date,
              'lunch_vendor_id' => $lunch_orders_input->lunch_vendor_id == null ? $lunch_orders->lunch_vendor_id : $lunch_orders_input->lunch_vendor_id,
              'user_id' => $lunch_orders_input->user_id == null ? $lunch_orders->user_id : $lunch_orders_input->user_id,
              'note' => $lunch_orders_input->note == null ? $lunch_orders->note : $lunch_orders_input->note,
              'price' => $lunch_orders_input->price == null ? $lunch_orders->price : $lunch_orders_input->price,
              'is_active' => $lunch_orders_input->is_active == null ? $lunch_orders->is_active : $lunch_orders_input->is_active,
              'state' => $lunch_orders_input->state == null ? $lunch_orders->state : $lunch_orders_input->state,
              'company_id' => $lunch_orders_input->company_id == null ? $lunch_orders->company_id : $lunch_orders_input->company_id,
              'currency_id' => $lunch_orders_input->currency_id == null ? $lunch_orders->currency_id : $lunch_orders_input->currency_id,
              'quantity' => $lunch_orders_input->quantity == null ? $lunch_orders->quantity : $lunch_orders_input->quantity,
              'display_topping' => $lunch_orders_input->display_topping == null ? $lunch_orders->display_topping : $lunch_orders_input->display_topping,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $lunch_orders->lunch_product = $lunch_orders->lunch_product ;
         $lunch_orders->lunch_product_category = $lunch_orders->lunch_product_category ;
         $lunch_orders->lunch_vendor = $lunch_orders->lunch_vendor ;
         $lunch_orders->company = $lunch_orders->company ;
         $lunch_orders->currency = $lunch_orders->currency ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $lunch_orders->lunch_order_lunch_order_toppings = $lunch_orders->lunchOrderLunchOrderToppings ;
 
            }

            return ApiResponse::success(compact('lunch_orders'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }


    /**
     * @OA\Delete(
     *      path="/module/hrm/v1/lunch-order/{id}",
     *      operationId="DeleteLunchOrder",
     *      tags={"Lunch Orders"},
     *      summary="Delete lunch_orders",
     *      description="Delete lunch_orders",
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
            $lunch_orders = LunchOrder::find($id);

            $lunch_orders->delete();

            return ApiResponse::success();
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }
}

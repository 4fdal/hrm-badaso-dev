<?php

namespace Uasoft\Badaso\Module\HRM\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\HRM\Models\LunchOrderTopping;
use Uasoft\Badaso\Module\HRM\Schema\Inputs\LunchOrderToppingInput;

class LunchOrderToppingController extends Controller
{
    /**
     * @OA\Post(
     *      path="/module/hrm/v1/lunch-order-topping",
     *      operationId="AddLunchOrderTopping",
     *      tags={"Lunch Order Toppings"},
     *      summary="Add new lunch_order_toppings",
     *      description="Add a new lunch_order_toppings",
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
     *          @OA\JsonContent(ref="#/components/schemas/LunchOrderToppingInput")
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
            $lunch_order_toppings_input = new LunchOrderToppingInput($request);

            $lunch_order_toppings = LunchOrderTopping::create([
                  'lunch_order_id' => $lunch_order_toppings_input->lunch_order_id,
              'lunch_topping_id' => $lunch_order_toppings_input->lunch_topping_id,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $lunch_order_toppings->lunch_order = $lunch_order_toppings->lunch_order ;
         $lunch_order_toppings->lunch_topping = $lunch_order_toppings->lunch_topping ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('lunch_order_toppings'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/lunch-order-topping",
     *      operationId="BrowseLunchOrderTopping",
     *      tags={"Lunch Order Toppings"},
     *      summary="Browse lunch_order_toppings",
     *      description="Browse lunch_order_toppings",
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

            $lunch_order_toppings = new LunchOrderTopping();
            $lunch_order_toppings_fillable = $lunch_order_toppings->getFillable();

            $filter_fields = $request->get('filter_fields', '*');
            $filter_fields = explode(',', $filter_fields);
            if (array_search('*', $filter_fields) == false) {
                $new_filter_fields = [];
                foreach ($filter_fields as $index => $field) {
                    if (!in_array($field, $filter_fields)) {
                        $new_filter_fields[] = $field;
                    }
                }
                $lunch_order_toppings = $lunch_order_toppings->select($filter_fields);
            }

            $filter_fields_search = $request->get('filter_fields_search', '*');
            $filter_fields_search = explode(',', $filter_fields_search);
            if (isset($request->search)) {
                if (array_search('*', $filter_fields_search) == false) {
                    foreach ($lunch_order_toppings_fillable as $index => $field) {
                        $lunch_order_toppings = $lunch_order_toppings->orWhere($field, "like", "%$request->search%");
                    }
                } else {
                    foreach ($filter_fields_search as $index => $field) {
                        if (in_array($field, $lunch_order_toppings_fillable)) {
                            $lunch_order_toppings = $lunch_order_toppings->orWhere($field, "like", "%$request->search%");
                        }
                    }
                }
            }

            if ($request->get('show_pagination', 'true') == 'true') {
                $max_page = $request->get('max_page', 15);
                $lunch_order_toppings = $lunch_order_toppings->paginate($max_page);
            } else {
                $lunch_order_toppings = $lunch_order_toppings->get();
            }

            $lunch_order_toppings->map(function($lunch_order_toppings) use ($request){

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $lunch_order_toppings->lunch_order = $lunch_order_toppings->lunch_order ;
         $lunch_order_toppings->lunch_topping = $lunch_order_toppings->lunch_topping ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

                return $lunch_order_toppings ;
            });
            $lunch_order_toppings = $lunch_order_toppings->toArray();

            return ApiResponse::success(compact('lunch_order_toppings'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/lunch-order-topping/{id}",
     *      operationId="ReadLunchOrderTopping",
     *      tags={"Lunch Order Toppings"},
     *      summary="Read lunch_order_toppings",
     *      description="Read lunch_order_toppings",
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

            $lunch_order_toppings = LunchOrderTopping::find($id);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $lunch_order_toppings->lunch_order = $lunch_order_toppings->lunch_order ;
         $lunch_order_toppings->lunch_topping = $lunch_order_toppings->lunch_topping ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('lunch_order_toppings'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Put(
     *      path="/module/hrm/v1/lunch-order-topping/{id}",
     *      operationId="UpdateLunchOrderTopping",
     *      tags={"Lunch Order Toppings"},
     *      summary="Update lunch_order_toppings",
     *      description="Update lunch_order_toppings",
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
     *          @OA\JsonContent(ref="#/components/schemas/LunchOrderToppingInput")
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
            $lunch_order_toppings_input = new LunchOrderToppingInput($request);
            $lunch_order_toppings = LunchOrderTopping::find($id);

            $lunch_order_toppings->update([
                  'lunch_order_id' => $lunch_order_toppings_input->lunch_order_id == null ? $lunch_order_toppings->lunch_order_id : $lunch_order_toppings_input->lunch_order_id,
              'lunch_topping_id' => $lunch_order_toppings_input->lunch_topping_id == null ? $lunch_order_toppings->lunch_topping_id : $lunch_order_toppings_input->lunch_topping_id,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $lunch_order_toppings->lunch_order = $lunch_order_toppings->lunch_order ;
         $lunch_order_toppings->lunch_topping = $lunch_order_toppings->lunch_topping ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('lunch_order_toppings'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }


    /**
     * @OA\Delete(
     *      path="/module/hrm/v1/lunch-order-topping/{id}",
     *      operationId="DeleteLunchOrderTopping",
     *      tags={"Lunch Order Toppings"},
     *      summary="Delete lunch_order_toppings",
     *      description="Delete lunch_order_toppings",
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
            $lunch_order_toppings = LunchOrderTopping::find($id);

            $lunch_order_toppings->delete();

            return ApiResponse::success();
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }
}

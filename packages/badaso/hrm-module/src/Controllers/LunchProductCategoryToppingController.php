<?php

namespace Uasoft\Badaso\Module\HRM\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\HRM\Models\LunchProductCategoryTopping;
use Uasoft\Badaso\Module\HRM\Schema\Inputs\LunchProductCategoryToppingInput;

class LunchProductCategoryToppingController extends Controller
{
    /**
     * @OA\Post(
     *      path="/module/hrm/v1/lunch-product-category-topping",
     *      operationId="AddLunchProductCategoryTopping",
     *      tags={"Lunch Product Category Toppings"},
     *      summary="Add new lunch_product_category_toppings",
     *      description="Add a new lunch_product_category_toppings",
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
     *          @OA\JsonContent(ref="#/components/schemas/LunchProductCategoryToppingInput")
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
            $lunch_product_category_toppings_input = new LunchProductCategoryToppingInput($request);

            $lunch_product_category_toppings = LunchProductCategoryTopping::create([
                  'lunch_product_category_id' => $lunch_product_category_toppings_input->lunch_product_category_id,
              'name' => $lunch_product_category_toppings_input->name,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $lunch_product_category_toppings->lunch_product_category = $lunch_product_category_toppings->lunch_product_category ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $lunch_product_category_toppings->lunch_product_category_lunch_product_category_toppings = $lunch_product_category_toppings->lunchProductCategoryLunchProductCategoryToppings ;
            $lunch_product_category_toppings->lunch_product_category_topping_lunch_product_category_topping_items = $lunch_product_category_toppings->lunchProductCategoryToppingLunchProductCategoryToppingItems ;
 
            }

            return ApiResponse::success(compact('lunch_product_category_toppings'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/lunch-product-category-topping",
     *      operationId="BrowseLunchProductCategoryTopping",
     *      tags={"Lunch Product Category Toppings"},
     *      summary="Browse lunch_product_category_toppings",
     *      description="Browse lunch_product_category_toppings",
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

            $lunch_product_category_toppings = new LunchProductCategoryTopping();
            $lunch_product_category_toppings_fillable = $lunch_product_category_toppings->getFillable();

            $filter_fields = $request->get('filter_fields', '*');
            $filter_fields = explode(',', $filter_fields);
            if (array_search('*', $filter_fields) == false) {
                $new_filter_fields = [];
                foreach ($filter_fields as $index => $field) {
                    if (!in_array($field, $filter_fields)) {
                        $new_filter_fields[] = $field;
                    }
                }
                $lunch_product_category_toppings = $lunch_product_category_toppings->select($filter_fields);
            }

            $filter_fields_search = $request->get('filter_fields_search', '*');
            $filter_fields_search = explode(',', $filter_fields_search);
            if (isset($request->search)) {
                if (array_search('*', $filter_fields_search) == false) {
                    foreach ($lunch_product_category_toppings_fillable as $index => $field) {
                        $lunch_product_category_toppings = $lunch_product_category_toppings->orWhere($field, "like", "%$request->search%");
                    }
                } else {
                    foreach ($filter_fields_search as $index => $field) {
                        if (in_array($field, $lunch_product_category_toppings_fillable)) {
                            $lunch_product_category_toppings = $lunch_product_category_toppings->orWhere($field, "like", "%$request->search%");
                        }
                    }
                }
            }

            if ($request->get('show_pagination', 'true') == 'true') {
                $max_page = $request->get('max_page', 15);
                $lunch_product_category_toppings = $lunch_product_category_toppings->paginate($max_page);
            } else {
                $lunch_product_category_toppings = $lunch_product_category_toppings->get();
            }

            $lunch_product_category_toppings->map(function($lunch_product_category_toppings) use ($request){

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $lunch_product_category_toppings->lunch_product_category = $lunch_product_category_toppings->lunch_product_category ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $lunch_product_category_toppings->lunch_product_category_lunch_product_category_toppings = $lunch_product_category_toppings->lunchProductCategoryLunchProductCategoryToppings ;
            $lunch_product_category_toppings->lunch_product_category_topping_lunch_product_category_topping_items = $lunch_product_category_toppings->lunchProductCategoryToppingLunchProductCategoryToppingItems ;
 
            }

                return $lunch_product_category_toppings ;
            });
            $lunch_product_category_toppings = $lunch_product_category_toppings->toArray();

            return ApiResponse::success(compact('lunch_product_category_toppings'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/lunch-product-category-topping/{id}",
     *      operationId="ReadLunchProductCategoryTopping",
     *      tags={"Lunch Product Category Toppings"},
     *      summary="Read lunch_product_category_toppings",
     *      description="Read lunch_product_category_toppings",
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

            $lunch_product_category_toppings = LunchProductCategoryTopping::find($id);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $lunch_product_category_toppings->lunch_product_category = $lunch_product_category_toppings->lunch_product_category ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $lunch_product_category_toppings->lunch_product_category_lunch_product_category_toppings = $lunch_product_category_toppings->lunchProductCategoryLunchProductCategoryToppings ;
            $lunch_product_category_toppings->lunch_product_category_topping_lunch_product_category_topping_items = $lunch_product_category_toppings->lunchProductCategoryToppingLunchProductCategoryToppingItems ;
 
            }

            return ApiResponse::success(compact('lunch_product_category_toppings'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Put(
     *      path="/module/hrm/v1/lunch-product-category-topping/{id}",
     *      operationId="UpdateLunchProductCategoryTopping",
     *      tags={"Lunch Product Category Toppings"},
     *      summary="Update lunch_product_category_toppings",
     *      description="Update lunch_product_category_toppings",
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
     *          @OA\JsonContent(ref="#/components/schemas/LunchProductCategoryToppingInput")
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
            $lunch_product_category_toppings_input = new LunchProductCategoryToppingInput($request);
            $lunch_product_category_toppings = LunchProductCategoryTopping::find($id);

            $lunch_product_category_toppings->update([
                  'lunch_product_category_id' => $lunch_product_category_toppings_input->lunch_product_category_id == null ? $lunch_product_category_toppings->lunch_product_category_id : $lunch_product_category_toppings_input->lunch_product_category_id,
              'name' => $lunch_product_category_toppings_input->name == null ? $lunch_product_category_toppings->name : $lunch_product_category_toppings_input->name,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $lunch_product_category_toppings->lunch_product_category = $lunch_product_category_toppings->lunch_product_category ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $lunch_product_category_toppings->lunch_product_category_lunch_product_category_toppings = $lunch_product_category_toppings->lunchProductCategoryLunchProductCategoryToppings ;
            $lunch_product_category_toppings->lunch_product_category_topping_lunch_product_category_topping_items = $lunch_product_category_toppings->lunchProductCategoryToppingLunchProductCategoryToppingItems ;
 
            }

            return ApiResponse::success(compact('lunch_product_category_toppings'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }


    /**
     * @OA\Delete(
     *      path="/module/hrm/v1/lunch-product-category-topping/{id}",
     *      operationId="DeleteLunchProductCategoryTopping",
     *      tags={"Lunch Product Category Toppings"},
     *      summary="Delete lunch_product_category_toppings",
     *      description="Delete lunch_product_category_toppings",
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
            $lunch_product_category_toppings = LunchProductCategoryTopping::find($id);

            $lunch_product_category_toppings->delete();

            return ApiResponse::success();
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }
}

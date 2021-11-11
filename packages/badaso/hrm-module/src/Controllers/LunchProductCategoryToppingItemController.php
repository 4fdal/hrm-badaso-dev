<?php

namespace Uasoft\Badaso\Module\HRM\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\HRM\Models\LunchProductCategoryToppingItem;
use Uasoft\Badaso\Module\HRM\Schema\Inputs\LunchProductCategoryToppingItemInput;

class LunchProductCategoryToppingItemController extends Controller
{
    /**
     * @OA\Post(
     *      path="/module/hrm/v1/lunch-product-category-topping-item",
     *      operationId="AddLunchProductCategoryToppingItem",
     *      tags={"Lunch Product Category Topping Items"},
     *      summary="Add new lunch_product_category_topping_items",
     *      description="Add a new lunch_product_category_topping_items",
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
     *          @OA\JsonContent(ref="#/components/schemas/LunchProductCategoryToppingItemInput")
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
            $lunch_product_category_topping_items_input = new LunchProductCategoryToppingItemInput($request);

            $lunch_product_category_topping_items = LunchProductCategoryToppingItem::create([
                  'lunch_product_category_topping_id' => $lunch_product_category_topping_items_input->lunch_product_category_topping_id,
              'name' => $lunch_product_category_topping_items_input->name,
              'price' => $lunch_product_category_topping_items_input->price,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $lunch_product_category_topping_items->lunch_product_category_topping = $lunch_product_category_topping_items->lunch_product_category_topping ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('lunch_product_category_topping_items'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/lunch-product-category-topping-item",
     *      operationId="BrowseLunchProductCategoryToppingItem",
     *      tags={"Lunch Product Category Topping Items"},
     *      summary="Browse lunch_product_category_topping_items",
     *      description="Browse lunch_product_category_topping_items",
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

            $lunch_product_category_topping_items = new LunchProductCategoryToppingItem();
            $lunch_product_category_topping_items_fillable = $lunch_product_category_topping_items->getFillable();

            $filter_fields = $request->get('filter_fields', '*');
            $filter_fields = explode(',', $filter_fields);
            if (array_search('*', $filter_fields) == false) {
                $new_filter_fields = [];
                foreach ($filter_fields as $index => $field) {
                    if (!in_array($field, $filter_fields)) {
                        $new_filter_fields[] = $field;
                    }
                }
                $lunch_product_category_topping_items = $lunch_product_category_topping_items->select($filter_fields);
            }

            $filter_fields_search = $request->get('filter_fields_search', '*');
            $filter_fields_search = explode(',', $filter_fields_search);
            if (isset($request->search)) {
                if (array_search('*', $filter_fields_search) == false) {
                    foreach ($lunch_product_category_topping_items_fillable as $index => $field) {
                        $lunch_product_category_topping_items = $lunch_product_category_topping_items->orWhere($field, "like", "%$request->search%");
                    }
                } else {
                    foreach ($filter_fields_search as $index => $field) {
                        if (in_array($field, $lunch_product_category_topping_items_fillable)) {
                            $lunch_product_category_topping_items = $lunch_product_category_topping_items->orWhere($field, "like", "%$request->search%");
                        }
                    }
                }
            }

            if ($request->get('show_pagination', 'true') == 'true') {
                $max_page = $request->get('max_page', 15);
                $lunch_product_category_topping_items = $lunch_product_category_topping_items->paginate($max_page);
            } else {
                $lunch_product_category_topping_items = $lunch_product_category_topping_items->get();
            }

            $lunch_product_category_topping_items->map(function($lunch_product_category_topping_items) use ($request){

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $lunch_product_category_topping_items->lunch_product_category_topping = $lunch_product_category_topping_items->lunch_product_category_topping ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

                return $lunch_product_category_topping_items ;
            });
            $lunch_product_category_topping_items = $lunch_product_category_topping_items->toArray();

            return ApiResponse::success(compact('lunch_product_category_topping_items'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/lunch-product-category-topping-item/{id}",
     *      operationId="ReadLunchProductCategoryToppingItem",
     *      tags={"Lunch Product Category Topping Items"},
     *      summary="Read lunch_product_category_topping_items",
     *      description="Read lunch_product_category_topping_items",
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

            $lunch_product_category_topping_items = LunchProductCategoryToppingItem::find($id);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $lunch_product_category_topping_items->lunch_product_category_topping = $lunch_product_category_topping_items->lunch_product_category_topping ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('lunch_product_category_topping_items'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Put(
     *      path="/module/hrm/v1/lunch-product-category-topping-item/{id}",
     *      operationId="UpdateLunchProductCategoryToppingItem",
     *      tags={"Lunch Product Category Topping Items"},
     *      summary="Update lunch_product_category_topping_items",
     *      description="Update lunch_product_category_topping_items",
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
     *          @OA\JsonContent(ref="#/components/schemas/LunchProductCategoryToppingItemInput")
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
            $lunch_product_category_topping_items_input = new LunchProductCategoryToppingItemInput($request);
            $lunch_product_category_topping_items = LunchProductCategoryToppingItem::find($id);

            $lunch_product_category_topping_items->update([
                  'lunch_product_category_topping_id' => $lunch_product_category_topping_items_input->lunch_product_category_topping_id == null ? $lunch_product_category_topping_items->lunch_product_category_topping_id : $lunch_product_category_topping_items_input->lunch_product_category_topping_id,
              'name' => $lunch_product_category_topping_items_input->name == null ? $lunch_product_category_topping_items->name : $lunch_product_category_topping_items_input->name,
              'price' => $lunch_product_category_topping_items_input->price == null ? $lunch_product_category_topping_items->price : $lunch_product_category_topping_items_input->price,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $lunch_product_category_topping_items->lunch_product_category_topping = $lunch_product_category_topping_items->lunch_product_category_topping ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('lunch_product_category_topping_items'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }


    /**
     * @OA\Delete(
     *      path="/module/hrm/v1/lunch-product-category-topping-item/{id}",
     *      operationId="DeleteLunchProductCategoryToppingItem",
     *      tags={"Lunch Product Category Topping Items"},
     *      summary="Delete lunch_product_category_topping_items",
     *      description="Delete lunch_product_category_topping_items",
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
            $lunch_product_category_topping_items = LunchProductCategoryToppingItem::find($id);

            $lunch_product_category_topping_items->delete();

            return ApiResponse::success();
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }
}

<?php

namespace Uasoft\Badaso\Module\HRM\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\HRM\Models\LunchProduct;
use Uasoft\Badaso\Module\HRM\Schema\Inputs\LunchProductInput;

class LunchProductController extends Controller
{
    /**
     * @OA\Post(
     *      path="/module/hrm/v1/lunch-product",
     *      operationId="AddLunchProduct",
     *      tags={"Lunch Products"},
     *      summary="Add new lunch_products",
     *      description="Add a new lunch_products",
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
     *          @OA\JsonContent(ref="#/components/schemas/LunchProductInput")
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
            $lunch_products_input = new LunchProductInput($request);

            $lunch_products = LunchProduct::create([
                  'name' => $lunch_products_input->name,
              'lunch_product_category_id' => $lunch_products_input->lunch_product_category_id,
              'description' => $lunch_products_input->description,
              'price' => $lunch_products_input->price,
              'lunch_vendor_id' => $lunch_products_input->lunch_vendor_id,
              'is_active' => $lunch_products_input->is_active,
              'company_id' => $lunch_products_input->company_id,
              'new_until' => $lunch_products_input->new_until,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $lunch_products->lunch_product_category = $lunch_products->lunch_product_category ;
         $lunch_products->lunch_vendor = $lunch_products->lunch_vendor ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $lunch_products->lunch_product_lunch_product_favorites = $lunch_products->lunchProductLunchProductFavorites ;
            $lunch_products->lunch_product_lunch_orders = $lunch_products->lunchProductLunchOrders ;
            $lunch_products->lunch_vendor_lunch_orders = $lunch_products->lunchVendorLunchOrders ;
 
            }

            return ApiResponse::success(compact('lunch_products'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/lunch-product",
     *      operationId="BrowseLunchProduct",
     *      tags={"Lunch Products"},
     *      summary="Browse lunch_products",
     *      description="Browse lunch_products",
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

            $lunch_products = new LunchProduct();
            $lunch_products_fillable = $lunch_products->getFillable();

            $filter_fields = $request->get('filter_fields', '*');
            $filter_fields = explode(',', $filter_fields);
            if (array_search('*', $filter_fields) == false) {
                $new_filter_fields = [];
                foreach ($filter_fields as $index => $field) {
                    if (!in_array($field, $filter_fields)) {
                        $new_filter_fields[] = $field;
                    }
                }
                $lunch_products = $lunch_products->select($filter_fields);
            }

            $filter_fields_search = $request->get('filter_fields_search', '*');
            $filter_fields_search = explode(',', $filter_fields_search);
            if (isset($request->search)) {
                if (array_search('*', $filter_fields_search) == false) {
                    foreach ($lunch_products_fillable as $index => $field) {
                        $lunch_products = $lunch_products->orWhere($field, "like", "%$request->search%");
                    }
                } else {
                    foreach ($filter_fields_search as $index => $field) {
                        if (in_array($field, $lunch_products_fillable)) {
                            $lunch_products = $lunch_products->orWhere($field, "like", "%$request->search%");
                        }
                    }
                }
            }

            if ($request->get('show_pagination', 'true') == 'true') {
                $max_page = $request->get('max_page', 15);
                $lunch_products = $lunch_products->paginate($max_page);
            } else {
                $lunch_products = $lunch_products->get();
            }

            $lunch_products->map(function($lunch_products) use ($request){

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $lunch_products->lunch_product_category = $lunch_products->lunch_product_category ;
         $lunch_products->lunch_vendor = $lunch_products->lunch_vendor ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $lunch_products->lunch_product_lunch_product_favorites = $lunch_products->lunchProductLunchProductFavorites ;
            $lunch_products->lunch_product_lunch_orders = $lunch_products->lunchProductLunchOrders ;
            $lunch_products->lunch_vendor_lunch_orders = $lunch_products->lunchVendorLunchOrders ;
 
            }

                return $lunch_products ;
            });
            $lunch_products = $lunch_products->toArray();

            return ApiResponse::success(compact('lunch_products'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/lunch-product/{id}",
     *      operationId="ReadLunchProduct",
     *      tags={"Lunch Products"},
     *      summary="Read lunch_products",
     *      description="Read lunch_products",
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

            $lunch_products = LunchProduct::find($id);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $lunch_products->lunch_product_category = $lunch_products->lunch_product_category ;
         $lunch_products->lunch_vendor = $lunch_products->lunch_vendor ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $lunch_products->lunch_product_lunch_product_favorites = $lunch_products->lunchProductLunchProductFavorites ;
            $lunch_products->lunch_product_lunch_orders = $lunch_products->lunchProductLunchOrders ;
            $lunch_products->lunch_vendor_lunch_orders = $lunch_products->lunchVendorLunchOrders ;
 
            }

            return ApiResponse::success(compact('lunch_products'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Put(
     *      path="/module/hrm/v1/lunch-product/{id}",
     *      operationId="UpdateLunchProduct",
     *      tags={"Lunch Products"},
     *      summary="Update lunch_products",
     *      description="Update lunch_products",
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
     *          @OA\JsonContent(ref="#/components/schemas/LunchProductInput")
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
            $lunch_products_input = new LunchProductInput($request);
            $lunch_products = LunchProduct::find($id);

            $lunch_products->update([
                  'name' => $lunch_products_input->name == null ? $lunch_products->name : $lunch_products_input->name,
              'lunch_product_category_id' => $lunch_products_input->lunch_product_category_id == null ? $lunch_products->lunch_product_category_id : $lunch_products_input->lunch_product_category_id,
              'description' => $lunch_products_input->description == null ? $lunch_products->description : $lunch_products_input->description,
              'price' => $lunch_products_input->price == null ? $lunch_products->price : $lunch_products_input->price,
              'lunch_vendor_id' => $lunch_products_input->lunch_vendor_id == null ? $lunch_products->lunch_vendor_id : $lunch_products_input->lunch_vendor_id,
              'is_active' => $lunch_products_input->is_active == null ? $lunch_products->is_active : $lunch_products_input->is_active,
              'company_id' => $lunch_products_input->company_id == null ? $lunch_products->company_id : $lunch_products_input->company_id,
              'new_until' => $lunch_products_input->new_until == null ? $lunch_products->new_until : $lunch_products_input->new_until,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $lunch_products->lunch_product_category = $lunch_products->lunch_product_category ;
         $lunch_products->lunch_vendor = $lunch_products->lunch_vendor ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $lunch_products->lunch_product_lunch_product_favorites = $lunch_products->lunchProductLunchProductFavorites ;
            $lunch_products->lunch_product_lunch_orders = $lunch_products->lunchProductLunchOrders ;
            $lunch_products->lunch_vendor_lunch_orders = $lunch_products->lunchVendorLunchOrders ;
 
            }

            return ApiResponse::success(compact('lunch_products'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }


    /**
     * @OA\Delete(
     *      path="/module/hrm/v1/lunch-product/{id}",
     *      operationId="DeleteLunchProduct",
     *      tags={"Lunch Products"},
     *      summary="Delete lunch_products",
     *      description="Delete lunch_products",
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
            $lunch_products = LunchProduct::find($id);

            $lunch_products->delete();

            return ApiResponse::success();
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }
}

<?php

namespace Uasoft\Badaso\Module\HRM\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\HRM\Models\LunchProductCategory;
use Uasoft\Badaso\Module\HRM\Schema\Inputs\LunchProductCategoryInput;

class LunchProductCategoryController extends Controller
{
    /**
     * @OA\Post(
     *      path="/module/hrm/v1/lunch-product-category",
     *      operationId="AddLunchProductCategory",
     *      tags={"Lunch Product Categories"},
     *      summary="Add new lunch_product_categories",
     *      description="Add a new lunch_product_categories",
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
     *          @OA\JsonContent(ref="#/components/schemas/LunchProductCategoryInput")
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
            $lunch_product_categories_input = new LunchProductCategoryInput($request);

            $lunch_product_categories = LunchProductCategory::create([
                  'name' => $lunch_product_categories_input->name,
              'company_id' => $lunch_product_categories_input->company_id,
              'is_active' => $lunch_product_categories_input->is_active,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $lunch_product_categories->company = $lunch_product_categories->company ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $lunch_product_categories->lunch_product_category_lunch_products = $lunch_product_categories->lunchProductCategoryLunchProducts ;
            $lunch_product_categories->lunch_product_category_lunch_orders = $lunch_product_categories->lunchProductCategoryLunchOrders ;
 
            }

            return ApiResponse::success(compact('lunch_product_categories'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/lunch-product-category",
     *      operationId="BrowseLunchProductCategory",
     *      tags={"Lunch Product Categories"},
     *      summary="Browse lunch_product_categories",
     *      description="Browse lunch_product_categories",
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

            $lunch_product_categories = new LunchProductCategory();
            $lunch_product_categories_fillable = $lunch_product_categories->getFillable();

            $filter_fields = $request->get('filter_fields', '*');
            $filter_fields = explode(',', $filter_fields);
            if (array_search('*', $filter_fields) == false) {
                $new_filter_fields = [];
                foreach ($filter_fields as $index => $field) {
                    if (!in_array($field, $filter_fields)) {
                        $new_filter_fields[] = $field;
                    }
                }
                $lunch_product_categories = $lunch_product_categories->select($filter_fields);
            }

            $filter_fields_search = $request->get('filter_fields_search', '*');
            $filter_fields_search = explode(',', $filter_fields_search);
            if (isset($request->search)) {
                if (array_search('*', $filter_fields_search) == false) {
                    foreach ($lunch_product_categories_fillable as $index => $field) {
                        $lunch_product_categories = $lunch_product_categories->orWhere($field, "like", "%$request->search%");
                    }
                } else {
                    foreach ($filter_fields_search as $index => $field) {
                        if (in_array($field, $lunch_product_categories_fillable)) {
                            $lunch_product_categories = $lunch_product_categories->orWhere($field, "like", "%$request->search%");
                        }
                    }
                }
            }

            if ($request->get('show_pagination', 'true') == 'true') {
                $max_page = $request->get('max_page', 15);
                $lunch_product_categories = $lunch_product_categories->paginate($max_page);
            } else {
                $lunch_product_categories = $lunch_product_categories->get();
            }

            $lunch_product_categories->map(function($lunch_product_categories) use ($request){

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $lunch_product_categories->company = $lunch_product_categories->company ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $lunch_product_categories->lunch_product_category_lunch_products = $lunch_product_categories->lunchProductCategoryLunchProducts ;
            $lunch_product_categories->lunch_product_category_lunch_orders = $lunch_product_categories->lunchProductCategoryLunchOrders ;
 
            }

                return $lunch_product_categories ;
            });
            $lunch_product_categories = $lunch_product_categories->toArray();

            return ApiResponse::success(compact('lunch_product_categories'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/lunch-product-category/{id}",
     *      operationId="ReadLunchProductCategory",
     *      tags={"Lunch Product Categories"},
     *      summary="Read lunch_product_categories",
     *      description="Read lunch_product_categories",
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

            $lunch_product_categories = LunchProductCategory::find($id);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $lunch_product_categories->company = $lunch_product_categories->company ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $lunch_product_categories->lunch_product_category_lunch_products = $lunch_product_categories->lunchProductCategoryLunchProducts ;
            $lunch_product_categories->lunch_product_category_lunch_orders = $lunch_product_categories->lunchProductCategoryLunchOrders ;
 
            }

            return ApiResponse::success(compact('lunch_product_categories'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Put(
     *      path="/module/hrm/v1/lunch-product-category/{id}",
     *      operationId="UpdateLunchProductCategory",
     *      tags={"Lunch Product Categories"},
     *      summary="Update lunch_product_categories",
     *      description="Update lunch_product_categories",
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
     *          @OA\JsonContent(ref="#/components/schemas/LunchProductCategoryInput")
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
            $lunch_product_categories_input = new LunchProductCategoryInput($request);
            $lunch_product_categories = LunchProductCategory::find($id);

            $lunch_product_categories->update([
                  'name' => $lunch_product_categories_input->name == null ? $lunch_product_categories->name : $lunch_product_categories_input->name,
              'company_id' => $lunch_product_categories_input->company_id == null ? $lunch_product_categories->company_id : $lunch_product_categories_input->company_id,
              'is_active' => $lunch_product_categories_input->is_active == null ? $lunch_product_categories->is_active : $lunch_product_categories_input->is_active,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $lunch_product_categories->company = $lunch_product_categories->company ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $lunch_product_categories->lunch_product_category_lunch_products = $lunch_product_categories->lunchProductCategoryLunchProducts ;
            $lunch_product_categories->lunch_product_category_lunch_orders = $lunch_product_categories->lunchProductCategoryLunchOrders ;
 
            }

            return ApiResponse::success(compact('lunch_product_categories'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }


    /**
     * @OA\Delete(
     *      path="/module/hrm/v1/lunch-product-category/{id}",
     *      operationId="DeleteLunchProductCategory",
     *      tags={"Lunch Product Categories"},
     *      summary="Delete lunch_product_categories",
     *      description="Delete lunch_product_categories",
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
            $lunch_product_categories = LunchProductCategory::find($id);

            $lunch_product_categories->delete();

            return ApiResponse::success();
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }
}

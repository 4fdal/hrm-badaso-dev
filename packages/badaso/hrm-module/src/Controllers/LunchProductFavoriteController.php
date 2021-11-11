<?php

namespace Uasoft\Badaso\Module\HRM\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\HRM\Models\LunchProductFavorite;
use Uasoft\Badaso\Module\HRM\Schema\Inputs\LunchProductFavoriteInput;

class LunchProductFavoriteController extends Controller
{
    /**
     * @OA\Post(
     *      path="/module/hrm/v1/lunch-product-favorite",
     *      operationId="AddLunchProductFavorite",
     *      tags={"Lunch Product Favorites"},
     *      summary="Add new lunch_product_favorites",
     *      description="Add a new lunch_product_favorites",
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
     *          @OA\JsonContent(ref="#/components/schemas/LunchProductFavoriteInput")
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
            $lunch_product_favorites_input = new LunchProductFavoriteInput($request);

            $lunch_product_favorites = LunchProductFavorite::create([
                  'lunch_product_id' => $lunch_product_favorites_input->lunch_product_id,
              'user_id' => $lunch_product_favorites_input->user_id,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $lunch_product_favorites->lunch_product = $lunch_product_favorites->lunch_product ;
         $lunch_product_favorites->user = $lunch_product_favorites->user ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('lunch_product_favorites'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/lunch-product-favorite",
     *      operationId="BrowseLunchProductFavorite",
     *      tags={"Lunch Product Favorites"},
     *      summary="Browse lunch_product_favorites",
     *      description="Browse lunch_product_favorites",
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

            $lunch_product_favorites = new LunchProductFavorite();
            $lunch_product_favorites_fillable = $lunch_product_favorites->getFillable();

            $filter_fields = $request->get('filter_fields', '*');
            $filter_fields = explode(',', $filter_fields);
            if (array_search('*', $filter_fields) == false) {
                $new_filter_fields = [];
                foreach ($filter_fields as $index => $field) {
                    if (!in_array($field, $filter_fields)) {
                        $new_filter_fields[] = $field;
                    }
                }
                $lunch_product_favorites = $lunch_product_favorites->select($filter_fields);
            }

            $filter_fields_search = $request->get('filter_fields_search', '*');
            $filter_fields_search = explode(',', $filter_fields_search);
            if (isset($request->search)) {
                if (array_search('*', $filter_fields_search) == false) {
                    foreach ($lunch_product_favorites_fillable as $index => $field) {
                        $lunch_product_favorites = $lunch_product_favorites->orWhere($field, "like", "%$request->search%");
                    }
                } else {
                    foreach ($filter_fields_search as $index => $field) {
                        if (in_array($field, $lunch_product_favorites_fillable)) {
                            $lunch_product_favorites = $lunch_product_favorites->orWhere($field, "like", "%$request->search%");
                        }
                    }
                }
            }

            if ($request->get('show_pagination', 'true') == 'true') {
                $max_page = $request->get('max_page', 15);
                $lunch_product_favorites = $lunch_product_favorites->paginate($max_page);
            } else {
                $lunch_product_favorites = $lunch_product_favorites->get();
            }

            $lunch_product_favorites->map(function($lunch_product_favorites) use ($request){

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $lunch_product_favorites->lunch_product = $lunch_product_favorites->lunch_product ;
         $lunch_product_favorites->user = $lunch_product_favorites->user ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

                return $lunch_product_favorites ;
            });
            $lunch_product_favorites = $lunch_product_favorites->toArray();

            return ApiResponse::success(compact('lunch_product_favorites'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/lunch-product-favorite/{id}",
     *      operationId="ReadLunchProductFavorite",
     *      tags={"Lunch Product Favorites"},
     *      summary="Read lunch_product_favorites",
     *      description="Read lunch_product_favorites",
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

            $lunch_product_favorites = LunchProductFavorite::find($id);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $lunch_product_favorites->lunch_product = $lunch_product_favorites->lunch_product ;
         $lunch_product_favorites->user = $lunch_product_favorites->user ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('lunch_product_favorites'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Put(
     *      path="/module/hrm/v1/lunch-product-favorite/{id}",
     *      operationId="UpdateLunchProductFavorite",
     *      tags={"Lunch Product Favorites"},
     *      summary="Update lunch_product_favorites",
     *      description="Update lunch_product_favorites",
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
     *          @OA\JsonContent(ref="#/components/schemas/LunchProductFavoriteInput")
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
            $lunch_product_favorites_input = new LunchProductFavoriteInput($request);
            $lunch_product_favorites = LunchProductFavorite::find($id);

            $lunch_product_favorites->update([
                  'lunch_product_id' => $lunch_product_favorites_input->lunch_product_id == null ? $lunch_product_favorites->lunch_product_id : $lunch_product_favorites_input->lunch_product_id,
              'user_id' => $lunch_product_favorites_input->user_id == null ? $lunch_product_favorites->user_id : $lunch_product_favorites_input->user_id,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $lunch_product_favorites->lunch_product = $lunch_product_favorites->lunch_product ;
         $lunch_product_favorites->user = $lunch_product_favorites->user ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('lunch_product_favorites'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }


    /**
     * @OA\Delete(
     *      path="/module/hrm/v1/lunch-product-favorite/{id}",
     *      operationId="DeleteLunchProductFavorite",
     *      tags={"Lunch Product Favorites"},
     *      summary="Delete lunch_product_favorites",
     *      description="Delete lunch_product_favorites",
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
            $lunch_product_favorites = LunchProductFavorite::find($id);

            $lunch_product_favorites->delete();

            return ApiResponse::success();
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }
}

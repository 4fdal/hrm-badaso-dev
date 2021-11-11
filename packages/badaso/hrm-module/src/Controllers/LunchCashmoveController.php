<?php

namespace Uasoft\Badaso\Module\HRM\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\HRM\Models\LunchCashmove;
use Uasoft\Badaso\Module\HRM\Schema\Inputs\LunchCashmoveInput;

class LunchCashmoveController extends Controller
{
    /**
     * @OA\Post(
     *      path="/module/hrm/v1/lunch-cashmove",
     *      operationId="AddLunchCashmove",
     *      tags={"Lunch Cashmoves"},
     *      summary="Add new lunch_cashmoves",
     *      description="Add a new lunch_cashmoves",
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
     *          @OA\JsonContent(ref="#/components/schemas/LunchCashmoveInput")
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
            $lunch_cashmoves_input = new LunchCashmoveInput($request);

            $lunch_cashmoves = LunchCashmove::create([
                  'currency_id' => $lunch_cashmoves_input->currency_id,
              'user_id' => $lunch_cashmoves_input->user_id,
              'date' => $lunch_cashmoves_input->date,
              'amount' => $lunch_cashmoves_input->amount,
              'description' => $lunch_cashmoves_input->description,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $lunch_cashmoves->currency = $lunch_cashmoves->currency ;
         $lunch_cashmoves->user = $lunch_cashmoves->user ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('lunch_cashmoves'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/lunch-cashmove",
     *      operationId="BrowseLunchCashmove",
     *      tags={"Lunch Cashmoves"},
     *      summary="Browse lunch_cashmoves",
     *      description="Browse lunch_cashmoves",
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

            $lunch_cashmoves = new LunchCashmove();
            $lunch_cashmoves_fillable = $lunch_cashmoves->getFillable();

            $filter_fields = $request->get('filter_fields', '*');
            $filter_fields = explode(',', $filter_fields);
            if (array_search('*', $filter_fields) == false) {
                $new_filter_fields = [];
                foreach ($filter_fields as $index => $field) {
                    if (!in_array($field, $filter_fields)) {
                        $new_filter_fields[] = $field;
                    }
                }
                $lunch_cashmoves = $lunch_cashmoves->select($filter_fields);
            }

            $filter_fields_search = $request->get('filter_fields_search', '*');
            $filter_fields_search = explode(',', $filter_fields_search);
            if (isset($request->search)) {
                if (array_search('*', $filter_fields_search) == false) {
                    foreach ($lunch_cashmoves_fillable as $index => $field) {
                        $lunch_cashmoves = $lunch_cashmoves->orWhere($field, "like", "%$request->search%");
                    }
                } else {
                    foreach ($filter_fields_search as $index => $field) {
                        if (in_array($field, $lunch_cashmoves_fillable)) {
                            $lunch_cashmoves = $lunch_cashmoves->orWhere($field, "like", "%$request->search%");
                        }
                    }
                }
            }

            if ($request->get('show_pagination', 'true') == 'true') {
                $max_page = $request->get('max_page', 15);
                $lunch_cashmoves = $lunch_cashmoves->paginate($max_page);
            } else {
                $lunch_cashmoves = $lunch_cashmoves->get();
            }

            $lunch_cashmoves->map(function($lunch_cashmoves) use ($request){

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $lunch_cashmoves->currency = $lunch_cashmoves->currency ;
         $lunch_cashmoves->user = $lunch_cashmoves->user ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

                return $lunch_cashmoves ;
            });
            $lunch_cashmoves = $lunch_cashmoves->toArray();

            return ApiResponse::success(compact('lunch_cashmoves'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/lunch-cashmove/{id}",
     *      operationId="ReadLunchCashmove",
     *      tags={"Lunch Cashmoves"},
     *      summary="Read lunch_cashmoves",
     *      description="Read lunch_cashmoves",
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

            $lunch_cashmoves = LunchCashmove::find($id);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $lunch_cashmoves->currency = $lunch_cashmoves->currency ;
         $lunch_cashmoves->user = $lunch_cashmoves->user ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('lunch_cashmoves'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Put(
     *      path="/module/hrm/v1/lunch-cashmove/{id}",
     *      operationId="UpdateLunchCashmove",
     *      tags={"Lunch Cashmoves"},
     *      summary="Update lunch_cashmoves",
     *      description="Update lunch_cashmoves",
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
     *          @OA\JsonContent(ref="#/components/schemas/LunchCashmoveInput")
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
            $lunch_cashmoves_input = new LunchCashmoveInput($request);
            $lunch_cashmoves = LunchCashmove::find($id);

            $lunch_cashmoves->update([
                  'currency_id' => $lunch_cashmoves_input->currency_id == null ? $lunch_cashmoves->currency_id : $lunch_cashmoves_input->currency_id,
              'user_id' => $lunch_cashmoves_input->user_id == null ? $lunch_cashmoves->user_id : $lunch_cashmoves_input->user_id,
              'date' => $lunch_cashmoves_input->date == null ? $lunch_cashmoves->date : $lunch_cashmoves_input->date,
              'amount' => $lunch_cashmoves_input->amount == null ? $lunch_cashmoves->amount : $lunch_cashmoves_input->amount,
              'description' => $lunch_cashmoves_input->description == null ? $lunch_cashmoves->description : $lunch_cashmoves_input->description,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $lunch_cashmoves->currency = $lunch_cashmoves->currency ;
         $lunch_cashmoves->user = $lunch_cashmoves->user ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('lunch_cashmoves'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }


    /**
     * @OA\Delete(
     *      path="/module/hrm/v1/lunch-cashmove/{id}",
     *      operationId="DeleteLunchCashmove",
     *      tags={"Lunch Cashmoves"},
     *      summary="Delete lunch_cashmoves",
     *      description="Delete lunch_cashmoves",
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
            $lunch_cashmoves = LunchCashmove::find($id);

            $lunch_cashmoves->delete();

            return ApiResponse::success();
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }
}

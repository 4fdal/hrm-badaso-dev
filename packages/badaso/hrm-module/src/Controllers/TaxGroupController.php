<?php

namespace Uasoft\Badaso\Module\HRM\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\HRM\Models\TaxGroup;
use Uasoft\Badaso\Module\HRM\Schema\Inputs\TaxGroupInput;

class TaxGroupController extends Controller
{
    /**
     * @OA\Post(
     *      path="/module/hrm/v1/tax-group",
     *      operationId="AddTaxGroup",
     *      tags={"Tax Groups"},
     *      summary="Add new tax_groups",
     *      description="Add a new tax_groups",
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
     *          @OA\JsonContent(ref="#/components/schemas/TaxGroupInput")
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
            $tax_groups_input = new TaxGroupInput($request);

            $tax_groups = TaxGroup::create([
                  'current_tax_account_payable_id' => $tax_groups_input->current_tax_account_payable_id,
              'advanced_tax_account_payable_id' => $tax_groups_input->advanced_tax_account_payable_id,
              'sequnce' => $tax_groups_input->sequnce,
              'receiver_current_tax_account_payable_id' => $tax_groups_input->receiver_current_tax_account_payable_id,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $tax_groups->current_tax_account_payable = $tax_groups->current_tax_account_payable ;
         $tax_groups->advanced_tax_account_payable = $tax_groups->advanced_tax_account_payable ;
         $tax_groups->receiver_current_tax_account_payable = $tax_groups->receiver_current_tax_account_payable ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('tax_groups'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/tax-group",
     *      operationId="BrowseTaxGroup",
     *      tags={"Tax Groups"},
     *      summary="Browse tax_groups",
     *      description="Browse tax_groups",
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

            $tax_groups = new TaxGroup();
            $tax_groups_fillable = $tax_groups->getFillable();

            $filter_fields = $request->get('filter_fields', '*');
            $filter_fields = explode(',', $filter_fields);
            if (array_search('*', $filter_fields) == false) {
                $new_filter_fields = [];
                foreach ($filter_fields as $index => $field) {
                    if (!in_array($field, $filter_fields)) {
                        $new_filter_fields[] = $field;
                    }
                }
                $tax_groups = $tax_groups->select($filter_fields);
            }

            $filter_fields_search = $request->get('filter_fields_search', '*');
            $filter_fields_search = explode(',', $filter_fields_search);
            if (isset($request->search)) {
                if (array_search('*', $filter_fields_search) == false) {
                    foreach ($tax_groups_fillable as $index => $field) {
                        $tax_groups = $tax_groups->orWhere($field, "like", "%$request->search%");
                    }
                } else {
                    foreach ($filter_fields_search as $index => $field) {
                        if (in_array($field, $tax_groups_fillable)) {
                            $tax_groups = $tax_groups->orWhere($field, "like", "%$request->search%");
                        }
                    }
                }
            }

            if ($request->get('show_pagination', 'true') == 'true') {
                $max_page = $request->get('max_page', 15);
                $tax_groups = $tax_groups->paginate($max_page);
            } else {
                $tax_groups = $tax_groups->get();
            }

            $tax_groups->map(function($tax_groups) use ($request){

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $tax_groups->current_tax_account_payable = $tax_groups->current_tax_account_payable ;
         $tax_groups->advanced_tax_account_payable = $tax_groups->advanced_tax_account_payable ;
         $tax_groups->receiver_current_tax_account_payable = $tax_groups->receiver_current_tax_account_payable ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

                return $tax_groups ;
            });
            $tax_groups = $tax_groups->toArray();

            return ApiResponse::success(compact('tax_groups'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/tax-group/{id}",
     *      operationId="ReadTaxGroup",
     *      tags={"Tax Groups"},
     *      summary="Read tax_groups",
     *      description="Read tax_groups",
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

            $tax_groups = TaxGroup::find($id);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $tax_groups->current_tax_account_payable = $tax_groups->current_tax_account_payable ;
         $tax_groups->advanced_tax_account_payable = $tax_groups->advanced_tax_account_payable ;
         $tax_groups->receiver_current_tax_account_payable = $tax_groups->receiver_current_tax_account_payable ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('tax_groups'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Put(
     *      path="/module/hrm/v1/tax-group/{id}",
     *      operationId="UpdateTaxGroup",
     *      tags={"Tax Groups"},
     *      summary="Update tax_groups",
     *      description="Update tax_groups",
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
     *          @OA\JsonContent(ref="#/components/schemas/TaxGroupInput")
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
            $tax_groups_input = new TaxGroupInput($request);
            $tax_groups = TaxGroup::find($id);

            $tax_groups->update([
                  'current_tax_account_payable_id' => $tax_groups_input->current_tax_account_payable_id == null ? $tax_groups->current_tax_account_payable_id : $tax_groups_input->current_tax_account_payable_id,
              'advanced_tax_account_payable_id' => $tax_groups_input->advanced_tax_account_payable_id == null ? $tax_groups->advanced_tax_account_payable_id : $tax_groups_input->advanced_tax_account_payable_id,
              'sequnce' => $tax_groups_input->sequnce == null ? $tax_groups->sequnce : $tax_groups_input->sequnce,
              'receiver_current_tax_account_payable_id' => $tax_groups_input->receiver_current_tax_account_payable_id == null ? $tax_groups->receiver_current_tax_account_payable_id : $tax_groups_input->receiver_current_tax_account_payable_id,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $tax_groups->current_tax_account_payable = $tax_groups->current_tax_account_payable ;
         $tax_groups->advanced_tax_account_payable = $tax_groups->advanced_tax_account_payable ;
         $tax_groups->receiver_current_tax_account_payable = $tax_groups->receiver_current_tax_account_payable ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('tax_groups'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }


    /**
     * @OA\Delete(
     *      path="/module/hrm/v1/tax-group/{id}",
     *      operationId="DeleteTaxGroup",
     *      tags={"Tax Groups"},
     *      summary="Delete tax_groups",
     *      description="Delete tax_groups",
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
            $tax_groups = TaxGroup::find($id);

            $tax_groups->delete();

            return ApiResponse::success();
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }
}

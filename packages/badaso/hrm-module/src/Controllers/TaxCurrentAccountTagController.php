<?php

namespace Uasoft\Badaso\Module\HRM\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\HRM\Models\TaxCurrentAccountTag;
use Uasoft\Badaso\Module\HRM\Schema\Inputs\TaxCurrentAccountTagInput;

class TaxCurrentAccountTagController extends Controller
{
    /**
     * @OA\Post(
     *      path="/module/hrm/v1/tax-current-account-tag",
     *      operationId="AddTaxCurrentAccountTag",
     *      tags={"Tax Current Account Tags"},
     *      summary="Add new tax_current_account_tags",
     *      description="Add a new tax_current_account_tags",
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
     *          @OA\JsonContent(ref="#/components/schemas/TaxCurrentAccountTagInput")
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
            $tax_current_account_tags_input = new TaxCurrentAccountTagInput($request);

            $tax_current_account_tags = TaxCurrentAccountTag::create([
                  'tax_account_payables' => $tax_current_account_tags_input->tax_account_payables,
              'account_tag_id' => $tax_current_account_tags_input->account_tag_id,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $tax_current_account_tags->tax_account_payables = $tax_current_account_tags->tax_account_payables ;
         $tax_current_account_tags->account_tag = $tax_current_account_tags->account_tag ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('tax_current_account_tags'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/tax-current-account-tag",
     *      operationId="BrowseTaxCurrentAccountTag",
     *      tags={"Tax Current Account Tags"},
     *      summary="Browse tax_current_account_tags",
     *      description="Browse tax_current_account_tags",
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

            $tax_current_account_tags = new TaxCurrentAccountTag();
            $tax_current_account_tags_fillable = $tax_current_account_tags->getFillable();

            $filter_fields = $request->get('filter_fields', '*');
            $filter_fields = explode(',', $filter_fields);
            if (array_search('*', $filter_fields) == false) {
                $new_filter_fields = [];
                foreach ($filter_fields as $index => $field) {
                    if (!in_array($field, $filter_fields)) {
                        $new_filter_fields[] = $field;
                    }
                }
                $tax_current_account_tags = $tax_current_account_tags->select($filter_fields);
            }

            $filter_fields_search = $request->get('filter_fields_search', '*');
            $filter_fields_search = explode(',', $filter_fields_search);
            if (isset($request->search)) {
                if (array_search('*', $filter_fields_search) == false) {
                    foreach ($tax_current_account_tags_fillable as $index => $field) {
                        $tax_current_account_tags = $tax_current_account_tags->orWhere($field, "like", "%$request->search%");
                    }
                } else {
                    foreach ($filter_fields_search as $index => $field) {
                        if (in_array($field, $tax_current_account_tags_fillable)) {
                            $tax_current_account_tags = $tax_current_account_tags->orWhere($field, "like", "%$request->search%");
                        }
                    }
                }
            }

            if ($request->get('show_pagination', 'true') == 'true') {
                $max_page = $request->get('max_page', 15);
                $tax_current_account_tags = $tax_current_account_tags->paginate($max_page);
            } else {
                $tax_current_account_tags = $tax_current_account_tags->get();
            }

            $tax_current_account_tags->map(function($tax_current_account_tags) use ($request){

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $tax_current_account_tags->tax_account_payables = $tax_current_account_tags->tax_account_payables ;
         $tax_current_account_tags->account_tag = $tax_current_account_tags->account_tag ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

                return $tax_current_account_tags ;
            });
            $tax_current_account_tags = $tax_current_account_tags->toArray();

            return ApiResponse::success(compact('tax_current_account_tags'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/tax-current-account-tag/{id}",
     *      operationId="ReadTaxCurrentAccountTag",
     *      tags={"Tax Current Account Tags"},
     *      summary="Read tax_current_account_tags",
     *      description="Read tax_current_account_tags",
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

            $tax_current_account_tags = TaxCurrentAccountTag::find($id);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $tax_current_account_tags->tax_account_payables = $tax_current_account_tags->tax_account_payables ;
         $tax_current_account_tags->account_tag = $tax_current_account_tags->account_tag ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('tax_current_account_tags'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Put(
     *      path="/module/hrm/v1/tax-current-account-tag/{id}",
     *      operationId="UpdateTaxCurrentAccountTag",
     *      tags={"Tax Current Account Tags"},
     *      summary="Update tax_current_account_tags",
     *      description="Update tax_current_account_tags",
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
     *          @OA\JsonContent(ref="#/components/schemas/TaxCurrentAccountTagInput")
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
            $tax_current_account_tags_input = new TaxCurrentAccountTagInput($request);
            $tax_current_account_tags = TaxCurrentAccountTag::find($id);

            $tax_current_account_tags->update([
                  'tax_account_payables' => $tax_current_account_tags_input->tax_account_payables == null ? $tax_current_account_tags->tax_account_payables : $tax_current_account_tags_input->tax_account_payables,
              'account_tag_id' => $tax_current_account_tags_input->account_tag_id == null ? $tax_current_account_tags->account_tag_id : $tax_current_account_tags_input->account_tag_id,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $tax_current_account_tags->tax_account_payables = $tax_current_account_tags->tax_account_payables ;
         $tax_current_account_tags->account_tag = $tax_current_account_tags->account_tag ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('tax_current_account_tags'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }


    /**
     * @OA\Delete(
     *      path="/module/hrm/v1/tax-current-account-tag/{id}",
     *      operationId="DeleteTaxCurrentAccountTag",
     *      tags={"Tax Current Account Tags"},
     *      summary="Delete tax_current_account_tags",
     *      description="Delete tax_current_account_tags",
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
            $tax_current_account_tags = TaxCurrentAccountTag::find($id);

            $tax_current_account_tags->delete();

            return ApiResponse::success();
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }
}

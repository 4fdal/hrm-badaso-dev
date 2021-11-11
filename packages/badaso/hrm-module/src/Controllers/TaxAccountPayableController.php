<?php

namespace Uasoft\Badaso\Module\HRM\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\HRM\Models\TaxAccountPayable;
use Uasoft\Badaso\Module\HRM\Schema\Inputs\TaxAccountPayableInput;

class TaxAccountPayableController extends Controller
{
    /**
     * @OA\Post(
     *      path="/module/hrm/v1/tax-account-payable",
     *      operationId="AddTaxAccountPayable",
     *      tags={"Tax Account Payables"},
     *      summary="Add new tax_account_payables",
     *      description="Add a new tax_account_payables",
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
     *          @OA\JsonContent(ref="#/components/schemas/TaxAccountPayableInput")
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
            $tax_account_payables_input = new TaxAccountPayableInput($request);

            $tax_account_payables = TaxAccountPayable::create([
                  'code' => $tax_account_payables_input->code,
              'group_account_type_id' => $tax_account_payables_input->group_account_type_id,
              'is_deprecated' => $tax_account_payables_input->is_deprecated,
              'default_account_tax_id' => $tax_account_payables_input->default_account_tax_id,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $tax_account_payables->group_account_type = $tax_account_payables->group_account_type ;
         $tax_account_payables->default_account_tax = $tax_account_payables->default_account_tax ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $tax_account_payables->tax_account_payables_tax_current_account_tags = $tax_account_payables->taxAccountPayablesTaxCurrentAccountTags ;
            $tax_account_payables->tax_account_payables_tax_current_account_journals = $tax_account_payables->taxAccountPayablesTaxCurrentAccountJournals ;
            $tax_account_payables->current_tax_account_payable_tax_groups = $tax_account_payables->currentTaxAccountPayableTaxGroups ;
            $tax_account_payables->advanced_tax_account_payable_tax_groups = $tax_account_payables->advancedTaxAccountPayableTaxGroups ;
            $tax_account_payables->receiver_current_tax_account_payable_tax_groups = $tax_account_payables->receiverCurrentTaxAccountPayableTaxGroups ;
 
            }

            return ApiResponse::success(compact('tax_account_payables'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/tax-account-payable",
     *      operationId="BrowseTaxAccountPayable",
     *      tags={"Tax Account Payables"},
     *      summary="Browse tax_account_payables",
     *      description="Browse tax_account_payables",
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

            $tax_account_payables = new TaxAccountPayable();
            $tax_account_payables_fillable = $tax_account_payables->getFillable();

            $filter_fields = $request->get('filter_fields', '*');
            $filter_fields = explode(',', $filter_fields);
            if (array_search('*', $filter_fields) == false) {
                $new_filter_fields = [];
                foreach ($filter_fields as $index => $field) {
                    if (!in_array($field, $filter_fields)) {
                        $new_filter_fields[] = $field;
                    }
                }
                $tax_account_payables = $tax_account_payables->select($filter_fields);
            }

            $filter_fields_search = $request->get('filter_fields_search', '*');
            $filter_fields_search = explode(',', $filter_fields_search);
            if (isset($request->search)) {
                if (array_search('*', $filter_fields_search) == false) {
                    foreach ($tax_account_payables_fillable as $index => $field) {
                        $tax_account_payables = $tax_account_payables->orWhere($field, "like", "%$request->search%");
                    }
                } else {
                    foreach ($filter_fields_search as $index => $field) {
                        if (in_array($field, $tax_account_payables_fillable)) {
                            $tax_account_payables = $tax_account_payables->orWhere($field, "like", "%$request->search%");
                        }
                    }
                }
            }

            if ($request->get('show_pagination', 'true') == 'true') {
                $max_page = $request->get('max_page', 15);
                $tax_account_payables = $tax_account_payables->paginate($max_page);
            } else {
                $tax_account_payables = $tax_account_payables->get();
            }

            $tax_account_payables->map(function($tax_account_payables) use ($request){

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $tax_account_payables->group_account_type = $tax_account_payables->group_account_type ;
         $tax_account_payables->default_account_tax = $tax_account_payables->default_account_tax ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $tax_account_payables->tax_account_payables_tax_current_account_tags = $tax_account_payables->taxAccountPayablesTaxCurrentAccountTags ;
            $tax_account_payables->tax_account_payables_tax_current_account_journals = $tax_account_payables->taxAccountPayablesTaxCurrentAccountJournals ;
            $tax_account_payables->current_tax_account_payable_tax_groups = $tax_account_payables->currentTaxAccountPayableTaxGroups ;
            $tax_account_payables->advanced_tax_account_payable_tax_groups = $tax_account_payables->advancedTaxAccountPayableTaxGroups ;
            $tax_account_payables->receiver_current_tax_account_payable_tax_groups = $tax_account_payables->receiverCurrentTaxAccountPayableTaxGroups ;
 
            }

                return $tax_account_payables ;
            });
            $tax_account_payables = $tax_account_payables->toArray();

            return ApiResponse::success(compact('tax_account_payables'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/tax-account-payable/{id}",
     *      operationId="ReadTaxAccountPayable",
     *      tags={"Tax Account Payables"},
     *      summary="Read tax_account_payables",
     *      description="Read tax_account_payables",
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

            $tax_account_payables = TaxAccountPayable::find($id);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $tax_account_payables->group_account_type = $tax_account_payables->group_account_type ;
         $tax_account_payables->default_account_tax = $tax_account_payables->default_account_tax ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $tax_account_payables->tax_account_payables_tax_current_account_tags = $tax_account_payables->taxAccountPayablesTaxCurrentAccountTags ;
            $tax_account_payables->tax_account_payables_tax_current_account_journals = $tax_account_payables->taxAccountPayablesTaxCurrentAccountJournals ;
            $tax_account_payables->current_tax_account_payable_tax_groups = $tax_account_payables->currentTaxAccountPayableTaxGroups ;
            $tax_account_payables->advanced_tax_account_payable_tax_groups = $tax_account_payables->advancedTaxAccountPayableTaxGroups ;
            $tax_account_payables->receiver_current_tax_account_payable_tax_groups = $tax_account_payables->receiverCurrentTaxAccountPayableTaxGroups ;
 
            }

            return ApiResponse::success(compact('tax_account_payables'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Put(
     *      path="/module/hrm/v1/tax-account-payable/{id}",
     *      operationId="UpdateTaxAccountPayable",
     *      tags={"Tax Account Payables"},
     *      summary="Update tax_account_payables",
     *      description="Update tax_account_payables",
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
     *          @OA\JsonContent(ref="#/components/schemas/TaxAccountPayableInput")
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
            $tax_account_payables_input = new TaxAccountPayableInput($request);
            $tax_account_payables = TaxAccountPayable::find($id);

            $tax_account_payables->update([
                  'code' => $tax_account_payables_input->code == null ? $tax_account_payables->code : $tax_account_payables_input->code,
              'group_account_type_id' => $tax_account_payables_input->group_account_type_id == null ? $tax_account_payables->group_account_type_id : $tax_account_payables_input->group_account_type_id,
              'is_deprecated' => $tax_account_payables_input->is_deprecated == null ? $tax_account_payables->is_deprecated : $tax_account_payables_input->is_deprecated,
              'default_account_tax_id' => $tax_account_payables_input->default_account_tax_id == null ? $tax_account_payables->default_account_tax_id : $tax_account_payables_input->default_account_tax_id,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $tax_account_payables->group_account_type = $tax_account_payables->group_account_type ;
         $tax_account_payables->default_account_tax = $tax_account_payables->default_account_tax ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $tax_account_payables->tax_account_payables_tax_current_account_tags = $tax_account_payables->taxAccountPayablesTaxCurrentAccountTags ;
            $tax_account_payables->tax_account_payables_tax_current_account_journals = $tax_account_payables->taxAccountPayablesTaxCurrentAccountJournals ;
            $tax_account_payables->current_tax_account_payable_tax_groups = $tax_account_payables->currentTaxAccountPayableTaxGroups ;
            $tax_account_payables->advanced_tax_account_payable_tax_groups = $tax_account_payables->advancedTaxAccountPayableTaxGroups ;
            $tax_account_payables->receiver_current_tax_account_payable_tax_groups = $tax_account_payables->receiverCurrentTaxAccountPayableTaxGroups ;
 
            }

            return ApiResponse::success(compact('tax_account_payables'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }


    /**
     * @OA\Delete(
     *      path="/module/hrm/v1/tax-account-payable/{id}",
     *      operationId="DeleteTaxAccountPayable",
     *      tags={"Tax Account Payables"},
     *      summary="Delete tax_account_payables",
     *      description="Delete tax_account_payables",
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
            $tax_account_payables = TaxAccountPayable::find($id);

            $tax_account_payables->delete();

            return ApiResponse::success();
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }
}

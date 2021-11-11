<?php

namespace Uasoft\Badaso\Module\HRM\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\HRM\Models\AccountingDistributionCreditNote;
use Uasoft\Badaso\Module\HRM\Schema\Inputs\AccountingDistributionCreditNoteInput;

class AccountingDistributionCreditNoteController extends Controller
{
    /**
     * @OA\Post(
     *      path="/module/hrm/v1/accounting-distribution-credit-note",
     *      operationId="AddAccountingDistributionCreditNote",
     *      tags={"Accounting Distribution Credit Notes"},
     *      summary="Add new accounting_distribution_credit_notes",
     *      description="Add a new accounting_distribution_credit_notes",
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
     *          @OA\JsonContent(ref="#/components/schemas/AccountingDistributionCreditNoteInput")
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
            $accounting_distribution_credit_notes_input = new AccountingDistributionCreditNoteInput($request);

            $accounting_distribution_credit_notes = AccountingDistributionCreditNote::create([
                  'accounting_tax_id' => $accounting_distribution_credit_notes_input->accounting_tax_id,
              'percent' => $accounting_distribution_credit_notes_input->percent,
              'base_on' => $accounting_distribution_credit_notes_input->base_on,
              'account_id' => $accounting_distribution_credit_notes_input->account_id,
              'tax_grids' => $accounting_distribution_credit_notes_input->tax_grids,
              'is_close_entry' => $accounting_distribution_credit_notes_input->is_close_entry,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $accounting_distribution_credit_notes->accounting_tax = $accounting_distribution_credit_notes->accounting_tax ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('accounting_distribution_credit_notes'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/accounting-distribution-credit-note",
     *      operationId="BrowseAccountingDistributionCreditNote",
     *      tags={"Accounting Distribution Credit Notes"},
     *      summary="Browse accounting_distribution_credit_notes",
     *      description="Browse accounting_distribution_credit_notes",
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

            $accounting_distribution_credit_notes = new AccountingDistributionCreditNote();
            $accounting_distribution_credit_notes_fillable = $accounting_distribution_credit_notes->getFillable();

            $filter_fields = $request->get('filter_fields', '*');
            $filter_fields = explode(',', $filter_fields);
            if (array_search('*', $filter_fields) == false) {
                $new_filter_fields = [];
                foreach ($filter_fields as $index => $field) {
                    if (!in_array($field, $filter_fields)) {
                        $new_filter_fields[] = $field;
                    }
                }
                $accounting_distribution_credit_notes = $accounting_distribution_credit_notes->select($filter_fields);
            }

            $filter_fields_search = $request->get('filter_fields_search', '*');
            $filter_fields_search = explode(',', $filter_fields_search);
            if (isset($request->search)) {
                if (array_search('*', $filter_fields_search) == false) {
                    foreach ($accounting_distribution_credit_notes_fillable as $index => $field) {
                        $accounting_distribution_credit_notes = $accounting_distribution_credit_notes->orWhere($field, "like", "%$request->search%");
                    }
                } else {
                    foreach ($filter_fields_search as $index => $field) {
                        if (in_array($field, $accounting_distribution_credit_notes_fillable)) {
                            $accounting_distribution_credit_notes = $accounting_distribution_credit_notes->orWhere($field, "like", "%$request->search%");
                        }
                    }
                }
            }

            if ($request->get('show_pagination', 'true') == 'true') {
                $max_page = $request->get('max_page', 15);
                $accounting_distribution_credit_notes = $accounting_distribution_credit_notes->paginate($max_page);
            } else {
                $accounting_distribution_credit_notes = $accounting_distribution_credit_notes->get();
            }

            $accounting_distribution_credit_notes->map(function($accounting_distribution_credit_notes) use ($request){

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $accounting_distribution_credit_notes->accounting_tax = $accounting_distribution_credit_notes->accounting_tax ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

                return $accounting_distribution_credit_notes ;
            });
            $accounting_distribution_credit_notes = $accounting_distribution_credit_notes->toArray();

            return ApiResponse::success(compact('accounting_distribution_credit_notes'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/accounting-distribution-credit-note/{id}",
     *      operationId="ReadAccountingDistributionCreditNote",
     *      tags={"Accounting Distribution Credit Notes"},
     *      summary="Read accounting_distribution_credit_notes",
     *      description="Read accounting_distribution_credit_notes",
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

            $accounting_distribution_credit_notes = AccountingDistributionCreditNote::find($id);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $accounting_distribution_credit_notes->accounting_tax = $accounting_distribution_credit_notes->accounting_tax ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('accounting_distribution_credit_notes'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Put(
     *      path="/module/hrm/v1/accounting-distribution-credit-note/{id}",
     *      operationId="UpdateAccountingDistributionCreditNote",
     *      tags={"Accounting Distribution Credit Notes"},
     *      summary="Update accounting_distribution_credit_notes",
     *      description="Update accounting_distribution_credit_notes",
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
     *          @OA\JsonContent(ref="#/components/schemas/AccountingDistributionCreditNoteInput")
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
            $accounting_distribution_credit_notes_input = new AccountingDistributionCreditNoteInput($request);
            $accounting_distribution_credit_notes = AccountingDistributionCreditNote::find($id);

            $accounting_distribution_credit_notes->update([
                  'accounting_tax_id' => $accounting_distribution_credit_notes_input->accounting_tax_id == null ? $accounting_distribution_credit_notes->accounting_tax_id : $accounting_distribution_credit_notes_input->accounting_tax_id,
              'percent' => $accounting_distribution_credit_notes_input->percent == null ? $accounting_distribution_credit_notes->percent : $accounting_distribution_credit_notes_input->percent,
              'base_on' => $accounting_distribution_credit_notes_input->base_on == null ? $accounting_distribution_credit_notes->base_on : $accounting_distribution_credit_notes_input->base_on,
              'account_id' => $accounting_distribution_credit_notes_input->account_id == null ? $accounting_distribution_credit_notes->account_id : $accounting_distribution_credit_notes_input->account_id,
              'tax_grids' => $accounting_distribution_credit_notes_input->tax_grids == null ? $accounting_distribution_credit_notes->tax_grids : $accounting_distribution_credit_notes_input->tax_grids,
              'is_close_entry' => $accounting_distribution_credit_notes_input->is_close_entry == null ? $accounting_distribution_credit_notes->is_close_entry : $accounting_distribution_credit_notes_input->is_close_entry,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $accounting_distribution_credit_notes->accounting_tax = $accounting_distribution_credit_notes->accounting_tax ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('accounting_distribution_credit_notes'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }


    /**
     * @OA\Delete(
     *      path="/module/hrm/v1/accounting-distribution-credit-note/{id}",
     *      operationId="DeleteAccountingDistributionCreditNote",
     *      tags={"Accounting Distribution Credit Notes"},
     *      summary="Delete accounting_distribution_credit_notes",
     *      description="Delete accounting_distribution_credit_notes",
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
            $accounting_distribution_credit_notes = AccountingDistributionCreditNote::find($id);

            $accounting_distribution_credit_notes->delete();

            return ApiResponse::success();
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }
}

<?php

namespace Uasoft\Badaso\Module\HRM\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\HRM\Models\TaxCurrentAccountJournal;
use Uasoft\Badaso\Module\HRM\Schema\Inputs\TaxCurrentAccountJournalInput;

class TaxCurrentAccountJournalController extends Controller
{
    /**
     * @OA\Post(
     *      path="/module/hrm/v1/tax-current-account-journal",
     *      operationId="AddTaxCurrentAccountJournal",
     *      tags={"Tax Current Account Journals"},
     *      summary="Add new tax_current_account_journals",
     *      description="Add a new tax_current_account_journals",
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
     *          @OA\JsonContent(ref="#/components/schemas/TaxCurrentAccountJournalInput")
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
            $tax_current_account_journals_input = new TaxCurrentAccountJournalInput($request);

            $tax_current_account_journals = TaxCurrentAccountJournal::create([
                  'tax_account_payables' => $tax_current_account_journals_input->tax_account_payables,
              'account_journal_id' => $tax_current_account_journals_input->account_journal_id,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $tax_current_account_journals->tax_account_payables = $tax_current_account_journals->tax_account_payables ;
         $tax_current_account_journals->account_journal = $tax_current_account_journals->account_journal ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('tax_current_account_journals'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/tax-current-account-journal",
     *      operationId="BrowseTaxCurrentAccountJournal",
     *      tags={"Tax Current Account Journals"},
     *      summary="Browse tax_current_account_journals",
     *      description="Browse tax_current_account_journals",
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

            $tax_current_account_journals = new TaxCurrentAccountJournal();
            $tax_current_account_journals_fillable = $tax_current_account_journals->getFillable();

            $filter_fields = $request->get('filter_fields', '*');
            $filter_fields = explode(',', $filter_fields);
            if (array_search('*', $filter_fields) == false) {
                $new_filter_fields = [];
                foreach ($filter_fields as $index => $field) {
                    if (!in_array($field, $filter_fields)) {
                        $new_filter_fields[] = $field;
                    }
                }
                $tax_current_account_journals = $tax_current_account_journals->select($filter_fields);
            }

            $filter_fields_search = $request->get('filter_fields_search', '*');
            $filter_fields_search = explode(',', $filter_fields_search);
            if (isset($request->search)) {
                if (array_search('*', $filter_fields_search) == false) {
                    foreach ($tax_current_account_journals_fillable as $index => $field) {
                        $tax_current_account_journals = $tax_current_account_journals->orWhere($field, "like", "%$request->search%");
                    }
                } else {
                    foreach ($filter_fields_search as $index => $field) {
                        if (in_array($field, $tax_current_account_journals_fillable)) {
                            $tax_current_account_journals = $tax_current_account_journals->orWhere($field, "like", "%$request->search%");
                        }
                    }
                }
            }

            if ($request->get('show_pagination', 'true') == 'true') {
                $max_page = $request->get('max_page', 15);
                $tax_current_account_journals = $tax_current_account_journals->paginate($max_page);
            } else {
                $tax_current_account_journals = $tax_current_account_journals->get();
            }

            $tax_current_account_journals->map(function($tax_current_account_journals) use ($request){

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $tax_current_account_journals->tax_account_payables = $tax_current_account_journals->tax_account_payables ;
         $tax_current_account_journals->account_journal = $tax_current_account_journals->account_journal ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

                return $tax_current_account_journals ;
            });
            $tax_current_account_journals = $tax_current_account_journals->toArray();

            return ApiResponse::success(compact('tax_current_account_journals'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/tax-current-account-journal/{id}",
     *      operationId="ReadTaxCurrentAccountJournal",
     *      tags={"Tax Current Account Journals"},
     *      summary="Read tax_current_account_journals",
     *      description="Read tax_current_account_journals",
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

            $tax_current_account_journals = TaxCurrentAccountJournal::find($id);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $tax_current_account_journals->tax_account_payables = $tax_current_account_journals->tax_account_payables ;
         $tax_current_account_journals->account_journal = $tax_current_account_journals->account_journal ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('tax_current_account_journals'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Put(
     *      path="/module/hrm/v1/tax-current-account-journal/{id}",
     *      operationId="UpdateTaxCurrentAccountJournal",
     *      tags={"Tax Current Account Journals"},
     *      summary="Update tax_current_account_journals",
     *      description="Update tax_current_account_journals",
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
     *          @OA\JsonContent(ref="#/components/schemas/TaxCurrentAccountJournalInput")
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
            $tax_current_account_journals_input = new TaxCurrentAccountJournalInput($request);
            $tax_current_account_journals = TaxCurrentAccountJournal::find($id);

            $tax_current_account_journals->update([
                  'tax_account_payables' => $tax_current_account_journals_input->tax_account_payables == null ? $tax_current_account_journals->tax_account_payables : $tax_current_account_journals_input->tax_account_payables,
              'account_journal_id' => $tax_current_account_journals_input->account_journal_id == null ? $tax_current_account_journals->account_journal_id : $tax_current_account_journals_input->account_journal_id,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $tax_current_account_journals->tax_account_payables = $tax_current_account_journals->tax_account_payables ;
         $tax_current_account_journals->account_journal = $tax_current_account_journals->account_journal ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('tax_current_account_journals'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }


    /**
     * @OA\Delete(
     *      path="/module/hrm/v1/tax-current-account-journal/{id}",
     *      operationId="DeleteTaxCurrentAccountJournal",
     *      tags={"Tax Current Account Journals"},
     *      summary="Delete tax_current_account_journals",
     *      description="Delete tax_current_account_journals",
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
            $tax_current_account_journals = TaxCurrentAccountJournal::find($id);

            $tax_current_account_journals->delete();

            return ApiResponse::success();
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }
}

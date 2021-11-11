<?php

namespace Uasoft\Badaso\Module\HRM\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\HRM\Models\PartnerBank;
use Uasoft\Badaso\Module\HRM\Schema\Inputs\PartnerBankInput;

class PartnerBankController extends Controller
{
    /**
     * @OA\Post(
     *      path="/module/hrm/v1/partner-bank",
     *      operationId="AddPartnerBank",
     *      tags={"Partner Banks"},
     *      summary="Add new partner_banks",
     *      description="Add a new partner_banks",
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
     *          @OA\JsonContent(ref="#/components/schemas/PartnerBankInput")
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
            $partner_banks_input = new PartnerBankInput($request);

            $partner_banks = PartnerBank::create([
                  'is_active' => $partner_banks_input->is_active,
              'acc_number' => $partner_banks_input->acc_number,
              'sanitize_acc_number' => $partner_banks_input->sanitize_acc_number,
              'acc_holder_name' => $partner_banks_input->acc_holder_name,
              'partner_id' => $partner_banks_input->partner_id,
              'bank_id' => $partner_banks_input->bank_id,
              'sequnce' => $partner_banks_input->sequnce,
              'currency_id' => $partner_banks_input->currency_id,
              'company_id' => $partner_banks_input->company_id,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $partner_banks->partner = $partner_banks->partner ;
         $partner_banks->bank = $partner_banks->bank ;
         $partner_banks->currency = $partner_banks->currency ;
         $partner_banks->company = $partner_banks->company ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $partner_banks->partner_bank_account_journals = $partner_banks->partnerBankAccountJournals ;
 
            }

            return ApiResponse::success(compact('partner_banks'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/partner-bank",
     *      operationId="BrowsePartnerBank",
     *      tags={"Partner Banks"},
     *      summary="Browse partner_banks",
     *      description="Browse partner_banks",
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

            $partner_banks = new PartnerBank();
            $partner_banks_fillable = $partner_banks->getFillable();

            $filter_fields = $request->get('filter_fields', '*');
            $filter_fields = explode(',', $filter_fields);
            if (array_search('*', $filter_fields) == false) {
                $new_filter_fields = [];
                foreach ($filter_fields as $index => $field) {
                    if (!in_array($field, $filter_fields)) {
                        $new_filter_fields[] = $field;
                    }
                }
                $partner_banks = $partner_banks->select($filter_fields);
            }

            $filter_fields_search = $request->get('filter_fields_search', '*');
            $filter_fields_search = explode(',', $filter_fields_search);
            if (isset($request->search)) {
                if (array_search('*', $filter_fields_search) == false) {
                    foreach ($partner_banks_fillable as $index => $field) {
                        $partner_banks = $partner_banks->orWhere($field, "like", "%$request->search%");
                    }
                } else {
                    foreach ($filter_fields_search as $index => $field) {
                        if (in_array($field, $partner_banks_fillable)) {
                            $partner_banks = $partner_banks->orWhere($field, "like", "%$request->search%");
                        }
                    }
                }
            }

            if ($request->get('show_pagination', 'true') == 'true') {
                $max_page = $request->get('max_page', 15);
                $partner_banks = $partner_banks->paginate($max_page);
            } else {
                $partner_banks = $partner_banks->get();
            }

            $partner_banks->map(function($partner_banks) use ($request){

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $partner_banks->partner = $partner_banks->partner ;
         $partner_banks->bank = $partner_banks->bank ;
         $partner_banks->currency = $partner_banks->currency ;
         $partner_banks->company = $partner_banks->company ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $partner_banks->partner_bank_account_journals = $partner_banks->partnerBankAccountJournals ;
 
            }

                return $partner_banks ;
            });
            $partner_banks = $partner_banks->toArray();

            return ApiResponse::success(compact('partner_banks'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/partner-bank/{id}",
     *      operationId="ReadPartnerBank",
     *      tags={"Partner Banks"},
     *      summary="Read partner_banks",
     *      description="Read partner_banks",
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

            $partner_banks = PartnerBank::find($id);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $partner_banks->partner = $partner_banks->partner ;
         $partner_banks->bank = $partner_banks->bank ;
         $partner_banks->currency = $partner_banks->currency ;
         $partner_banks->company = $partner_banks->company ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $partner_banks->partner_bank_account_journals = $partner_banks->partnerBankAccountJournals ;
 
            }

            return ApiResponse::success(compact('partner_banks'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Put(
     *      path="/module/hrm/v1/partner-bank/{id}",
     *      operationId="UpdatePartnerBank",
     *      tags={"Partner Banks"},
     *      summary="Update partner_banks",
     *      description="Update partner_banks",
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
     *          @OA\JsonContent(ref="#/components/schemas/PartnerBankInput")
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
            $partner_banks_input = new PartnerBankInput($request);
            $partner_banks = PartnerBank::find($id);

            $partner_banks->update([
                  'is_active' => $partner_banks_input->is_active == null ? $partner_banks->is_active : $partner_banks_input->is_active,
              'acc_number' => $partner_banks_input->acc_number == null ? $partner_banks->acc_number : $partner_banks_input->acc_number,
              'sanitize_acc_number' => $partner_banks_input->sanitize_acc_number == null ? $partner_banks->sanitize_acc_number : $partner_banks_input->sanitize_acc_number,
              'acc_holder_name' => $partner_banks_input->acc_holder_name == null ? $partner_banks->acc_holder_name : $partner_banks_input->acc_holder_name,
              'partner_id' => $partner_banks_input->partner_id == null ? $partner_banks->partner_id : $partner_banks_input->partner_id,
              'bank_id' => $partner_banks_input->bank_id == null ? $partner_banks->bank_id : $partner_banks_input->bank_id,
              'sequnce' => $partner_banks_input->sequnce == null ? $partner_banks->sequnce : $partner_banks_input->sequnce,
              'currency_id' => $partner_banks_input->currency_id == null ? $partner_banks->currency_id : $partner_banks_input->currency_id,
              'company_id' => $partner_banks_input->company_id == null ? $partner_banks->company_id : $partner_banks_input->company_id,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $partner_banks->partner = $partner_banks->partner ;
         $partner_banks->bank = $partner_banks->bank ;
         $partner_banks->currency = $partner_banks->currency ;
         $partner_banks->company = $partner_banks->company ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $partner_banks->partner_bank_account_journals = $partner_banks->partnerBankAccountJournals ;
 
            }

            return ApiResponse::success(compact('partner_banks'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }


    /**
     * @OA\Delete(
     *      path="/module/hrm/v1/partner-bank/{id}",
     *      operationId="DeletePartnerBank",
     *      tags={"Partner Banks"},
     *      summary="Delete partner_banks",
     *      description="Delete partner_banks",
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
            $partner_banks = PartnerBank::find($id);

            $partner_banks->delete();

            return ApiResponse::success();
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }
}

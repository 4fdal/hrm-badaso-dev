<?php

namespace Uasoft\Badaso\Module\HRM\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\HRM\Models\Bank;
use Uasoft\Badaso\Module\HRM\Schema\Inputs\BankInput;

class BankController extends Controller
{
    /**
     * @OA\Post(
     *      path="/module/hrm/v1/bank",
     *      operationId="AddBank",
     *      tags={"Banks"},
     *      summary="Add new banks",
     *      description="Add a new banks",
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
     *          @OA\JsonContent(ref="#/components/schemas/BankInput")
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
            $banks_input = new BankInput($request);

            $banks = Bank::create([
                  'name' => $banks_input->name,
              'street1' => $banks_input->street1,
              'street2' => $banks_input->street2,
              'zip' => $banks_input->zip,
              'state_id' => $banks_input->state_id,
              'company_id' => $banks_input->company_id,
              'email' => $banks_input->email,
              'phone' => $banks_input->phone,
              'is_active' => $banks_input->is_active,
              'bic' => $banks_input->bic,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $banks->state = $banks->state ;
         $banks->company = $banks->company ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $banks->bank_partner_banks = $banks->bankPartnerBanks ;
 
            }

            return ApiResponse::success(compact('banks'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/bank",
     *      operationId="BrowseBank",
     *      tags={"Banks"},
     *      summary="Browse banks",
     *      description="Browse banks",
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

            $banks = new Bank();
            $banks_fillable = $banks->getFillable();

            $filter_fields = $request->get('filter_fields', '*');
            $filter_fields = explode(',', $filter_fields);
            if (array_search('*', $filter_fields) == false) {
                $new_filter_fields = [];
                foreach ($filter_fields as $index => $field) {
                    if (!in_array($field, $filter_fields)) {
                        $new_filter_fields[] = $field;
                    }
                }
                $banks = $banks->select($filter_fields);
            }

            $filter_fields_search = $request->get('filter_fields_search', '*');
            $filter_fields_search = explode(',', $filter_fields_search);
            if (isset($request->search)) {
                if (array_search('*', $filter_fields_search) == false) {
                    foreach ($banks_fillable as $index => $field) {
                        $banks = $banks->orWhere($field, "like", "%$request->search%");
                    }
                } else {
                    foreach ($filter_fields_search as $index => $field) {
                        if (in_array($field, $banks_fillable)) {
                            $banks = $banks->orWhere($field, "like", "%$request->search%");
                        }
                    }
                }
            }

            if ($request->get('show_pagination', 'true') == 'true') {
                $max_page = $request->get('max_page', 15);
                $banks = $banks->paginate($max_page);
            } else {
                $banks = $banks->get();
            }

            $banks->map(function($banks) use ($request){

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $banks->state = $banks->state ;
         $banks->company = $banks->company ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $banks->bank_partner_banks = $banks->bankPartnerBanks ;
 
            }

                return $banks ;
            });
            $banks = $banks->toArray();

            return ApiResponse::success(compact('banks'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/bank/{id}",
     *      operationId="ReadBank",
     *      tags={"Banks"},
     *      summary="Read banks",
     *      description="Read banks",
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

            $banks = Bank::find($id);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $banks->state = $banks->state ;
         $banks->company = $banks->company ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $banks->bank_partner_banks = $banks->bankPartnerBanks ;
 
            }

            return ApiResponse::success(compact('banks'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Put(
     *      path="/module/hrm/v1/bank/{id}",
     *      operationId="UpdateBank",
     *      tags={"Banks"},
     *      summary="Update banks",
     *      description="Update banks",
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
     *          @OA\JsonContent(ref="#/components/schemas/BankInput")
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
            $banks_input = new BankInput($request);
            $banks = Bank::find($id);

            $banks->update([
                  'name' => $banks_input->name == null ? $banks->name : $banks_input->name,
              'street1' => $banks_input->street1 == null ? $banks->street1 : $banks_input->street1,
              'street2' => $banks_input->street2 == null ? $banks->street2 : $banks_input->street2,
              'zip' => $banks_input->zip == null ? $banks->zip : $banks_input->zip,
              'state_id' => $banks_input->state_id == null ? $banks->state_id : $banks_input->state_id,
              'company_id' => $banks_input->company_id == null ? $banks->company_id : $banks_input->company_id,
              'email' => $banks_input->email == null ? $banks->email : $banks_input->email,
              'phone' => $banks_input->phone == null ? $banks->phone : $banks_input->phone,
              'is_active' => $banks_input->is_active == null ? $banks->is_active : $banks_input->is_active,
              'bic' => $banks_input->bic == null ? $banks->bic : $banks_input->bic,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $banks->state = $banks->state ;
         $banks->company = $banks->company ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $banks->bank_partner_banks = $banks->bankPartnerBanks ;
 
            }

            return ApiResponse::success(compact('banks'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }


    /**
     * @OA\Delete(
     *      path="/module/hrm/v1/bank/{id}",
     *      operationId="DeleteBank",
     *      tags={"Banks"},
     *      summary="Delete banks",
     *      description="Delete banks",
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
            $banks = Bank::find($id);

            $banks->delete();

            return ApiResponse::success();
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }
}

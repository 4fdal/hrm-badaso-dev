<?php

namespace Uasoft\Badaso\Module\HRM\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\HRM\Models\Currency;
use Uasoft\Badaso\Module\HRM\Schema\Inputs\CurrencyInput;

class CurrencyController extends Controller
{
    /**
     * @OA\Post(
     *      path="/module/hrm/v1/currency",
     *      operationId="AddCurrency",
     *      tags={"Currencies"},
     *      summary="Add new currencies",
     *      description="Add a new currencies",
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
     *          @OA\JsonContent(ref="#/components/schemas/CurrencyInput")
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
            $currencies_input = new CurrencyInput($request);

            $currencies = Currency::create([
                  'name' => $currencies_input->name,
              'sysmbol' => $currencies_input->sysmbol,
              'rounding' => $currencies_input->rounding,
              'decimal_place' => $currencies_input->decimal_place,
              'is_active' => $currencies_input->is_active,
              'position' => $currencies_input->position,
              'currency_unit_label' => $currencies_input->currency_unit_label,
              'currency_subunit_label' => $currencies_input->currency_subunit_label,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
    
            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $currencies->currency_countries = $currencies->currencyCountries ;
            $currencies->currency_companies = $currencies->currencyCompanies ;
            $currencies->currency_lunch_cashmoves = $currencies->currencyLunchCashmoves ;
            $currencies->currency_lunch_orders = $currencies->currencyLunchOrders ;
            $currencies->currency_accounts = $currencies->currencyAccounts ;
            $currencies->currency_partner_banks = $currencies->currencyPartnerBanks ;
            $currencies->currency_account_journals = $currencies->currencyAccountJournals ;
 
            }

            return ApiResponse::success(compact('currencies'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/currency",
     *      operationId="BrowseCurrency",
     *      tags={"Currencies"},
     *      summary="Browse currencies",
     *      description="Browse currencies",
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

            $currencies = new Currency();
            $currencies_fillable = $currencies->getFillable();

            $filter_fields = $request->get('filter_fields', '*');
            $filter_fields = explode(',', $filter_fields);
            if (array_search('*', $filter_fields) == false) {
                $new_filter_fields = [];
                foreach ($filter_fields as $index => $field) {
                    if (!in_array($field, $filter_fields)) {
                        $new_filter_fields[] = $field;
                    }
                }
                $currencies = $currencies->select($filter_fields);
            }

            $filter_fields_search = $request->get('filter_fields_search', '*');
            $filter_fields_search = explode(',', $filter_fields_search);
            if (isset($request->search)) {
                if (array_search('*', $filter_fields_search) == false) {
                    foreach ($currencies_fillable as $index => $field) {
                        $currencies = $currencies->orWhere($field, "like", "%$request->search%");
                    }
                } else {
                    foreach ($filter_fields_search as $index => $field) {
                        if (in_array($field, $currencies_fillable)) {
                            $currencies = $currencies->orWhere($field, "like", "%$request->search%");
                        }
                    }
                }
            }

            if ($request->get('show_pagination', 'true') == 'true') {
                $max_page = $request->get('max_page', 15);
                $currencies = $currencies->paginate($max_page);
            } else {
                $currencies = $currencies->get();
            }

            $currencies->map(function($currencies) use ($request){

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
    
            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $currencies->currency_countries = $currencies->currencyCountries ;
            $currencies->currency_companies = $currencies->currencyCompanies ;
            $currencies->currency_lunch_cashmoves = $currencies->currencyLunchCashmoves ;
            $currencies->currency_lunch_orders = $currencies->currencyLunchOrders ;
            $currencies->currency_accounts = $currencies->currencyAccounts ;
            $currencies->currency_partner_banks = $currencies->currencyPartnerBanks ;
            $currencies->currency_account_journals = $currencies->currencyAccountJournals ;
 
            }

                return $currencies ;
            });
            $currencies = $currencies->toArray();

            return ApiResponse::success(compact('currencies'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/currency/{id}",
     *      operationId="ReadCurrency",
     *      tags={"Currencies"},
     *      summary="Read currencies",
     *      description="Read currencies",
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

            $currencies = Currency::find($id);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
    
            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $currencies->currency_countries = $currencies->currencyCountries ;
            $currencies->currency_companies = $currencies->currencyCompanies ;
            $currencies->currency_lunch_cashmoves = $currencies->currencyLunchCashmoves ;
            $currencies->currency_lunch_orders = $currencies->currencyLunchOrders ;
            $currencies->currency_accounts = $currencies->currencyAccounts ;
            $currencies->currency_partner_banks = $currencies->currencyPartnerBanks ;
            $currencies->currency_account_journals = $currencies->currencyAccountJournals ;
 
            }

            return ApiResponse::success(compact('currencies'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Put(
     *      path="/module/hrm/v1/currency/{id}",
     *      operationId="UpdateCurrency",
     *      tags={"Currencies"},
     *      summary="Update currencies",
     *      description="Update currencies",
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
     *          @OA\JsonContent(ref="#/components/schemas/CurrencyInput")
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
            $currencies_input = new CurrencyInput($request);
            $currencies = Currency::find($id);

            $currencies->update([
                  'name' => $currencies_input->name == null ? $currencies->name : $currencies_input->name,
              'sysmbol' => $currencies_input->sysmbol == null ? $currencies->sysmbol : $currencies_input->sysmbol,
              'rounding' => $currencies_input->rounding == null ? $currencies->rounding : $currencies_input->rounding,
              'decimal_place' => $currencies_input->decimal_place == null ? $currencies->decimal_place : $currencies_input->decimal_place,
              'is_active' => $currencies_input->is_active == null ? $currencies->is_active : $currencies_input->is_active,
              'position' => $currencies_input->position == null ? $currencies->position : $currencies_input->position,
              'currency_unit_label' => $currencies_input->currency_unit_label == null ? $currencies->currency_unit_label : $currencies_input->currency_unit_label,
              'currency_subunit_label' => $currencies_input->currency_subunit_label == null ? $currencies->currency_subunit_label : $currencies_input->currency_subunit_label,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
    
            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $currencies->currency_countries = $currencies->currencyCountries ;
            $currencies->currency_companies = $currencies->currencyCompanies ;
            $currencies->currency_lunch_cashmoves = $currencies->currencyLunchCashmoves ;
            $currencies->currency_lunch_orders = $currencies->currencyLunchOrders ;
            $currencies->currency_accounts = $currencies->currencyAccounts ;
            $currencies->currency_partner_banks = $currencies->currencyPartnerBanks ;
            $currencies->currency_account_journals = $currencies->currencyAccountJournals ;
 
            }

            return ApiResponse::success(compact('currencies'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }


    /**
     * @OA\Delete(
     *      path="/module/hrm/v1/currency/{id}",
     *      operationId="DeleteCurrency",
     *      tags={"Currencies"},
     *      summary="Delete currencies",
     *      description="Delete currencies",
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
            $currencies = Currency::find($id);

            $currencies->delete();

            return ApiResponse::success();
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }
}

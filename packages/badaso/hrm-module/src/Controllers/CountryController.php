<?php

namespace Uasoft\Badaso\Module\HRM\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\HRM\Models\Country;
use Uasoft\Badaso\Module\HRM\Schema\Inputs\CountryInput;

class CountryController extends Controller
{
    /**
     * @OA\Post(
     *      path="/module/hrm/v1/country",
     *      operationId="AddCountry",
     *      tags={"Countries"},
     *      summary="Add new countries",
     *      description="Add a new countries",
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
     *          @OA\JsonContent(ref="#/components/schemas/CountryInput")
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
            $countries_input = new CountryInput($request);

            $countries = Country::create([
                  'name' => $countries_input->name,
              'code' => $countries_input->code,
              'currency_id' => $countries_input->currency_id,
              'phone_code' => $countries_input->phone_code,
              'name_position' => $countries_input->name_position,
              'vat_label' => $countries_input->vat_label,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $countries->currency = $countries->currency ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $countries->country_states = $countries->countryStates ;
            $countries->country_employees = $countries->countryEmployees ;
            $countries->country_of_birth_employees = $countries->countryOfBirthEmployees ;
            $countries->country_company_contacts = $countries->countryCompanyContacts ;
            $countries->country_account_tags = $countries->countryAccountTags ;
 
            }

            return ApiResponse::success(compact('countries'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/country",
     *      operationId="BrowseCountry",
     *      tags={"Countries"},
     *      summary="Browse countries",
     *      description="Browse countries",
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

            $countries = new Country();
            $countries_fillable = $countries->getFillable();

            $filter_fields = $request->get('filter_fields', '*');
            $filter_fields = explode(',', $filter_fields);
            if (array_search('*', $filter_fields) == false) {
                $new_filter_fields = [];
                foreach ($filter_fields as $index => $field) {
                    if (!in_array($field, $filter_fields)) {
                        $new_filter_fields[] = $field;
                    }
                }
                $countries = $countries->select($filter_fields);
            }

            $filter_fields_search = $request->get('filter_fields_search', '*');
            $filter_fields_search = explode(',', $filter_fields_search);
            if (isset($request->search)) {
                if (array_search('*', $filter_fields_search) == false) {
                    foreach ($countries_fillable as $index => $field) {
                        $countries = $countries->orWhere($field, "like", "%$request->search%");
                    }
                } else {
                    foreach ($filter_fields_search as $index => $field) {
                        if (in_array($field, $countries_fillable)) {
                            $countries = $countries->orWhere($field, "like", "%$request->search%");
                        }
                    }
                }
            }

            if ($request->get('show_pagination', 'true') == 'true') {
                $max_page = $request->get('max_page', 15);
                $countries = $countries->paginate($max_page);
            } else {
                $countries = $countries->get();
            }

            $countries->map(function($countries) use ($request){

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $countries->currency = $countries->currency ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $countries->country_states = $countries->countryStates ;
            $countries->country_employees = $countries->countryEmployees ;
            $countries->country_of_birth_employees = $countries->countryOfBirthEmployees ;
            $countries->country_company_contacts = $countries->countryCompanyContacts ;
            $countries->country_account_tags = $countries->countryAccountTags ;
 
            }

                return $countries ;
            });
            $countries = $countries->toArray();

            return ApiResponse::success(compact('countries'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/country/{id}",
     *      operationId="ReadCountry",
     *      tags={"Countries"},
     *      summary="Read countries",
     *      description="Read countries",
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

            $countries = Country::find($id);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $countries->currency = $countries->currency ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $countries->country_states = $countries->countryStates ;
            $countries->country_employees = $countries->countryEmployees ;
            $countries->country_of_birth_employees = $countries->countryOfBirthEmployees ;
            $countries->country_company_contacts = $countries->countryCompanyContacts ;
            $countries->country_account_tags = $countries->countryAccountTags ;
 
            }

            return ApiResponse::success(compact('countries'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Put(
     *      path="/module/hrm/v1/country/{id}",
     *      operationId="UpdateCountry",
     *      tags={"Countries"},
     *      summary="Update countries",
     *      description="Update countries",
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
     *          @OA\JsonContent(ref="#/components/schemas/CountryInput")
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
            $countries_input = new CountryInput($request);
            $countries = Country::find($id);

            $countries->update([
                  'name' => $countries_input->name == null ? $countries->name : $countries_input->name,
              'code' => $countries_input->code == null ? $countries->code : $countries_input->code,
              'currency_id' => $countries_input->currency_id == null ? $countries->currency_id : $countries_input->currency_id,
              'phone_code' => $countries_input->phone_code == null ? $countries->phone_code : $countries_input->phone_code,
              'name_position' => $countries_input->name_position == null ? $countries->name_position : $countries_input->name_position,
              'vat_label' => $countries_input->vat_label == null ? $countries->vat_label : $countries_input->vat_label,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $countries->currency = $countries->currency ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $countries->country_states = $countries->countryStates ;
            $countries->country_employees = $countries->countryEmployees ;
            $countries->country_of_birth_employees = $countries->countryOfBirthEmployees ;
            $countries->country_company_contacts = $countries->countryCompanyContacts ;
            $countries->country_account_tags = $countries->countryAccountTags ;
 
            }

            return ApiResponse::success(compact('countries'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }


    /**
     * @OA\Delete(
     *      path="/module/hrm/v1/country/{id}",
     *      operationId="DeleteCountry",
     *      tags={"Countries"},
     *      summary="Delete countries",
     *      description="Delete countries",
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
            $countries = Country::find($id);

            $countries->delete();

            return ApiResponse::success();
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }
}

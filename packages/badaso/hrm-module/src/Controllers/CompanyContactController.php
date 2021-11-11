<?php

namespace Uasoft\Badaso\Module\HRM\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\HRM\Models\CompanyContact;
use Uasoft\Badaso\Module\HRM\Schema\Inputs\CompanyContactInput;

class CompanyContactController extends Controller
{
    /**
     * @OA\Post(
     *      path="/module/hrm/v1/company-contact",
     *      operationId="AddCompanyContact",
     *      tags={"Company Contacts"},
     *      summary="Add new company_contacts",
     *      description="Add a new company_contacts",
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
     *          @OA\JsonContent(ref="#/components/schemas/CompanyContactInput")
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
            $company_contacts_input = new CompanyContactInput($request);

            $company_contacts = CompanyContact::create([
                  'type' => $company_contacts_input->type,
              'name' => $company_contacts_input->name,
              'partner_title_id' => $company_contacts_input->partner_title_id,
              'job_title' => $company_contacts_input->job_title,
              'email' => $company_contacts_input->email,
              'phone' => $company_contacts_input->phone,
              'mobile' => $company_contacts_input->mobile,
              'notes' => $company_contacts_input->notes,
              'street1' => $company_contacts_input->street1,
              'street2' => $company_contacts_input->street2,
              'city' => $company_contacts_input->city,
              'state_id' => $company_contacts_input->state_id,
              'zip' => $company_contacts_input->zip,
              'country_id' => $company_contacts_input->country_id,
              'image_path' => $company_contacts_input->image_path,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $company_contacts->partner_title = $company_contacts->partner_title ;
         $company_contacts->state = $company_contacts->state ;
         $company_contacts->country = $company_contacts->country ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('company_contacts'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/company-contact",
     *      operationId="BrowseCompanyContact",
     *      tags={"Company Contacts"},
     *      summary="Browse company_contacts",
     *      description="Browse company_contacts",
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

            $company_contacts = new CompanyContact();
            $company_contacts_fillable = $company_contacts->getFillable();

            $filter_fields = $request->get('filter_fields', '*');
            $filter_fields = explode(',', $filter_fields);
            if (array_search('*', $filter_fields) == false) {
                $new_filter_fields = [];
                foreach ($filter_fields as $index => $field) {
                    if (!in_array($field, $filter_fields)) {
                        $new_filter_fields[] = $field;
                    }
                }
                $company_contacts = $company_contacts->select($filter_fields);
            }

            $filter_fields_search = $request->get('filter_fields_search', '*');
            $filter_fields_search = explode(',', $filter_fields_search);
            if (isset($request->search)) {
                if (array_search('*', $filter_fields_search) == false) {
                    foreach ($company_contacts_fillable as $index => $field) {
                        $company_contacts = $company_contacts->orWhere($field, "like", "%$request->search%");
                    }
                } else {
                    foreach ($filter_fields_search as $index => $field) {
                        if (in_array($field, $company_contacts_fillable)) {
                            $company_contacts = $company_contacts->orWhere($field, "like", "%$request->search%");
                        }
                    }
                }
            }

            if ($request->get('show_pagination', 'true') == 'true') {
                $max_page = $request->get('max_page', 15);
                $company_contacts = $company_contacts->paginate($max_page);
            } else {
                $company_contacts = $company_contacts->get();
            }

            $company_contacts->map(function($company_contacts) use ($request){

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $company_contacts->partner_title = $company_contacts->partner_title ;
         $company_contacts->state = $company_contacts->state ;
         $company_contacts->country = $company_contacts->country ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

                return $company_contacts ;
            });
            $company_contacts = $company_contacts->toArray();

            return ApiResponse::success(compact('company_contacts'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/company-contact/{id}",
     *      operationId="ReadCompanyContact",
     *      tags={"Company Contacts"},
     *      summary="Read company_contacts",
     *      description="Read company_contacts",
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

            $company_contacts = CompanyContact::find($id);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $company_contacts->partner_title = $company_contacts->partner_title ;
         $company_contacts->state = $company_contacts->state ;
         $company_contacts->country = $company_contacts->country ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('company_contacts'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Put(
     *      path="/module/hrm/v1/company-contact/{id}",
     *      operationId="UpdateCompanyContact",
     *      tags={"Company Contacts"},
     *      summary="Update company_contacts",
     *      description="Update company_contacts",
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
     *          @OA\JsonContent(ref="#/components/schemas/CompanyContactInput")
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
            $company_contacts_input = new CompanyContactInput($request);
            $company_contacts = CompanyContact::find($id);

            $company_contacts->update([
                  'type' => $company_contacts_input->type == null ? $company_contacts->type : $company_contacts_input->type,
              'name' => $company_contacts_input->name == null ? $company_contacts->name : $company_contacts_input->name,
              'partner_title_id' => $company_contacts_input->partner_title_id == null ? $company_contacts->partner_title_id : $company_contacts_input->partner_title_id,
              'job_title' => $company_contacts_input->job_title == null ? $company_contacts->job_title : $company_contacts_input->job_title,
              'email' => $company_contacts_input->email == null ? $company_contacts->email : $company_contacts_input->email,
              'phone' => $company_contacts_input->phone == null ? $company_contacts->phone : $company_contacts_input->phone,
              'mobile' => $company_contacts_input->mobile == null ? $company_contacts->mobile : $company_contacts_input->mobile,
              'notes' => $company_contacts_input->notes == null ? $company_contacts->notes : $company_contacts_input->notes,
              'street1' => $company_contacts_input->street1 == null ? $company_contacts->street1 : $company_contacts_input->street1,
              'street2' => $company_contacts_input->street2 == null ? $company_contacts->street2 : $company_contacts_input->street2,
              'city' => $company_contacts_input->city == null ? $company_contacts->city : $company_contacts_input->city,
              'state_id' => $company_contacts_input->state_id == null ? $company_contacts->state_id : $company_contacts_input->state_id,
              'zip' => $company_contacts_input->zip == null ? $company_contacts->zip : $company_contacts_input->zip,
              'country_id' => $company_contacts_input->country_id == null ? $company_contacts->country_id : $company_contacts_input->country_id,
              'image_path' => $company_contacts_input->image_path == null ? $company_contacts->image_path : $company_contacts_input->image_path,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $company_contacts->partner_title = $company_contacts->partner_title ;
         $company_contacts->state = $company_contacts->state ;
         $company_contacts->country = $company_contacts->country ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('company_contacts'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }


    /**
     * @OA\Delete(
     *      path="/module/hrm/v1/company-contact/{id}",
     *      operationId="DeleteCompanyContact",
     *      tags={"Company Contacts"},
     *      summary="Delete company_contacts",
     *      description="Delete company_contacts",
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
            $company_contacts = CompanyContact::find($id);

            $company_contacts->delete();

            return ApiResponse::success();
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }
}

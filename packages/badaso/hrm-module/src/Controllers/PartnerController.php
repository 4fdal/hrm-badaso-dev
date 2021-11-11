<?php

namespace Uasoft\Badaso\Module\HRM\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\HRM\Models\Partner;
use Uasoft\Badaso\Module\HRM\Schema\Inputs\PartnerInput;

class PartnerController extends Controller
{
    /**
     * @OA\Post(
     *      path="/module/hrm/v1/partner",
     *      operationId="AddPartner",
     *      tags={"Partners"},
     *      summary="Add new partners",
     *      description="Add a new partners",
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
     *          @OA\JsonContent(ref="#/components/schemas/PartnerInput")
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
            $partners_input = new PartnerInput($request);

            $partners = Partner::create([
                  'company_id' => $partners_input->company_id,
              'name' => $partners_input->name,
              'display_name' => $partners_input->display_name,
              'parent_id' => $partners_input->parent_id,
              'lang' => $partners_input->lang,
              'timezone' => $partners_input->timezone,
              'vat' => $partners_input->vat,
              'website' => $partners_input->website,
              'credit_limit' => $partners_input->credit_limit,
              'is_active' => $partners_input->is_active,
              'type' => $partners_input->type,
              'street1' => $partners_input->street1,
              'street2' => $partners_input->street2,
              'zip' => $partners_input->zip,
              'city' => $partners_input->city,
              'state_id' => $partners_input->state_id,
              'country_id' => $partners_input->country_id,
              'latitude' => $partners_input->latitude,
              'longitute' => $partners_input->longitute,
              'email' => $partners_input->email,
              'phone' => $partners_input->phone,
              'mobile' => $partners_input->mobile,
              'is_comapany' => $partners_input->is_comapany,
              'industry_id' => $partners_input->industry_id,
              'commercial_partner_id' => $partners_input->commercial_partner_id,
              'commercial_company_name' => $partners_input->commercial_company_name,
              'company_name' => $partners_input->company_name,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $partners->company = $partners->company ;
         $partners->parent = $partners->parent ;
         $partners->industry = $partners->industry ;
         $partners->commercial_partner = $partners->commercial_partner ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $partners->parent_partners = $partners->parentPartners ;
            $partners->commercial_partner_partners = $partners->commercialPartnerPartners ;
            $partners->partner_companies = $partners->partnerCompanies ;
            $partners->partner_calendar_attendees = $partners->partnerCalendarAttendees ;
            $partners->partner_lunch_vendors = $partners->partnerLunchVendors ;
            $partners->partner_fleet_vendors = $partners->partnerFleetVendors ;
            $partners->driver_partner_fleet_vehicles = $partners->driverPartnerFleetVehicles ;
            $partners->future_driver_partner_fleet_vehicles = $partners->futureDriverPartnerFleetVehicles ;
            $partners->driver_partner_fleet_services = $partners->driverPartnerFleetServices ;
            $partners->partner_partner_banks = $partners->partnerPartnerBanks ;
 
            }

            return ApiResponse::success(compact('partners'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/partner",
     *      operationId="BrowsePartner",
     *      tags={"Partners"},
     *      summary="Browse partners",
     *      description="Browse partners",
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

            $partners = new Partner();
            $partners_fillable = $partners->getFillable();

            $filter_fields = $request->get('filter_fields', '*');
            $filter_fields = explode(',', $filter_fields);
            if (array_search('*', $filter_fields) == false) {
                $new_filter_fields = [];
                foreach ($filter_fields as $index => $field) {
                    if (!in_array($field, $filter_fields)) {
                        $new_filter_fields[] = $field;
                    }
                }
                $partners = $partners->select($filter_fields);
            }

            $filter_fields_search = $request->get('filter_fields_search', '*');
            $filter_fields_search = explode(',', $filter_fields_search);
            if (isset($request->search)) {
                if (array_search('*', $filter_fields_search) == false) {
                    foreach ($partners_fillable as $index => $field) {
                        $partners = $partners->orWhere($field, "like", "%$request->search%");
                    }
                } else {
                    foreach ($filter_fields_search as $index => $field) {
                        if (in_array($field, $partners_fillable)) {
                            $partners = $partners->orWhere($field, "like", "%$request->search%");
                        }
                    }
                }
            }

            if ($request->get('show_pagination', 'true') == 'true') {
                $max_page = $request->get('max_page', 15);
                $partners = $partners->paginate($max_page);
            } else {
                $partners = $partners->get();
            }

            $partners->map(function($partners) use ($request){

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $partners->company = $partners->company ;
         $partners->parent = $partners->parent ;
         $partners->industry = $partners->industry ;
         $partners->commercial_partner = $partners->commercial_partner ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $partners->parent_partners = $partners->parentPartners ;
            $partners->commercial_partner_partners = $partners->commercialPartnerPartners ;
            $partners->partner_companies = $partners->partnerCompanies ;
            $partners->partner_calendar_attendees = $partners->partnerCalendarAttendees ;
            $partners->partner_lunch_vendors = $partners->partnerLunchVendors ;
            $partners->partner_fleet_vendors = $partners->partnerFleetVendors ;
            $partners->driver_partner_fleet_vehicles = $partners->driverPartnerFleetVehicles ;
            $partners->future_driver_partner_fleet_vehicles = $partners->futureDriverPartnerFleetVehicles ;
            $partners->driver_partner_fleet_services = $partners->driverPartnerFleetServices ;
            $partners->partner_partner_banks = $partners->partnerPartnerBanks ;
 
            }

                return $partners ;
            });
            $partners = $partners->toArray();

            return ApiResponse::success(compact('partners'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/partner/{id}",
     *      operationId="ReadPartner",
     *      tags={"Partners"},
     *      summary="Read partners",
     *      description="Read partners",
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

            $partners = Partner::find($id);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $partners->company = $partners->company ;
         $partners->parent = $partners->parent ;
         $partners->industry = $partners->industry ;
         $partners->commercial_partner = $partners->commercial_partner ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $partners->parent_partners = $partners->parentPartners ;
            $partners->commercial_partner_partners = $partners->commercialPartnerPartners ;
            $partners->partner_companies = $partners->partnerCompanies ;
            $partners->partner_calendar_attendees = $partners->partnerCalendarAttendees ;
            $partners->partner_lunch_vendors = $partners->partnerLunchVendors ;
            $partners->partner_fleet_vendors = $partners->partnerFleetVendors ;
            $partners->driver_partner_fleet_vehicles = $partners->driverPartnerFleetVehicles ;
            $partners->future_driver_partner_fleet_vehicles = $partners->futureDriverPartnerFleetVehicles ;
            $partners->driver_partner_fleet_services = $partners->driverPartnerFleetServices ;
            $partners->partner_partner_banks = $partners->partnerPartnerBanks ;
 
            }

            return ApiResponse::success(compact('partners'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Put(
     *      path="/module/hrm/v1/partner/{id}",
     *      operationId="UpdatePartner",
     *      tags={"Partners"},
     *      summary="Update partners",
     *      description="Update partners",
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
     *          @OA\JsonContent(ref="#/components/schemas/PartnerInput")
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
            $partners_input = new PartnerInput($request);
            $partners = Partner::find($id);

            $partners->update([
                  'company_id' => $partners_input->company_id == null ? $partners->company_id : $partners_input->company_id,
              'name' => $partners_input->name == null ? $partners->name : $partners_input->name,
              'display_name' => $partners_input->display_name == null ? $partners->display_name : $partners_input->display_name,
              'parent_id' => $partners_input->parent_id == null ? $partners->parent_id : $partners_input->parent_id,
              'lang' => $partners_input->lang == null ? $partners->lang : $partners_input->lang,
              'timezone' => $partners_input->timezone == null ? $partners->timezone : $partners_input->timezone,
              'vat' => $partners_input->vat == null ? $partners->vat : $partners_input->vat,
              'website' => $partners_input->website == null ? $partners->website : $partners_input->website,
              'credit_limit' => $partners_input->credit_limit == null ? $partners->credit_limit : $partners_input->credit_limit,
              'is_active' => $partners_input->is_active == null ? $partners->is_active : $partners_input->is_active,
              'type' => $partners_input->type == null ? $partners->type : $partners_input->type,
              'street1' => $partners_input->street1 == null ? $partners->street1 : $partners_input->street1,
              'street2' => $partners_input->street2 == null ? $partners->street2 : $partners_input->street2,
              'zip' => $partners_input->zip == null ? $partners->zip : $partners_input->zip,
              'city' => $partners_input->city == null ? $partners->city : $partners_input->city,
              'state_id' => $partners_input->state_id == null ? $partners->state_id : $partners_input->state_id,
              'country_id' => $partners_input->country_id == null ? $partners->country_id : $partners_input->country_id,
              'latitude' => $partners_input->latitude == null ? $partners->latitude : $partners_input->latitude,
              'longitute' => $partners_input->longitute == null ? $partners->longitute : $partners_input->longitute,
              'email' => $partners_input->email == null ? $partners->email : $partners_input->email,
              'phone' => $partners_input->phone == null ? $partners->phone : $partners_input->phone,
              'mobile' => $partners_input->mobile == null ? $partners->mobile : $partners_input->mobile,
              'is_comapany' => $partners_input->is_comapany == null ? $partners->is_comapany : $partners_input->is_comapany,
              'industry_id' => $partners_input->industry_id == null ? $partners->industry_id : $partners_input->industry_id,
              'commercial_partner_id' => $partners_input->commercial_partner_id == null ? $partners->commercial_partner_id : $partners_input->commercial_partner_id,
              'commercial_company_name' => $partners_input->commercial_company_name == null ? $partners->commercial_company_name : $partners_input->commercial_company_name,
              'company_name' => $partners_input->company_name == null ? $partners->company_name : $partners_input->company_name,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $partners->company = $partners->company ;
         $partners->parent = $partners->parent ;
         $partners->industry = $partners->industry ;
         $partners->commercial_partner = $partners->commercial_partner ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $partners->parent_partners = $partners->parentPartners ;
            $partners->commercial_partner_partners = $partners->commercialPartnerPartners ;
            $partners->partner_companies = $partners->partnerCompanies ;
            $partners->partner_calendar_attendees = $partners->partnerCalendarAttendees ;
            $partners->partner_lunch_vendors = $partners->partnerLunchVendors ;
            $partners->partner_fleet_vendors = $partners->partnerFleetVendors ;
            $partners->driver_partner_fleet_vehicles = $partners->driverPartnerFleetVehicles ;
            $partners->future_driver_partner_fleet_vehicles = $partners->futureDriverPartnerFleetVehicles ;
            $partners->driver_partner_fleet_services = $partners->driverPartnerFleetServices ;
            $partners->partner_partner_banks = $partners->partnerPartnerBanks ;
 
            }

            return ApiResponse::success(compact('partners'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }


    /**
     * @OA\Delete(
     *      path="/module/hrm/v1/partner/{id}",
     *      operationId="DeletePartner",
     *      tags={"Partners"},
     *      summary="Delete partners",
     *      description="Delete partners",
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
            $partners = Partner::find($id);

            $partners->delete();

            return ApiResponse::success();
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }
}

<?php

namespace Uasoft\Badaso\Module\HRM\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\HRM\Models\Company;
use Uasoft\Badaso\Module\HRM\Schema\Inputs\CompanyInput;

class CompanyController extends Controller
{
    /**
     * @OA\Post(
     *      path="/module/hrm/v1/company",
     *      operationId="AddCompany",
     *      tags={"Companies"},
     *      summary="Add new companies",
     *      description="Add a new companies",
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
     *          @OA\JsonContent(ref="#/components/schemas/CompanyInput")
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
            $companies_input = new CompanyInput($request);

            $companies = Company::create([
                  'name' => $companies_input->name,
              'parent_id' => $companies_input->parent_id,
              'currency_id' => $companies_input->currency_id,
              'sequnce' => $companies_input->sequnce,
              'partner_id' => $companies_input->partner_id,
              'report_header' => $companies_input->report_header,
              'report_footer' => $companies_input->report_footer,
              'img_logo_path' => $companies_input->img_logo_path,
              'email' => $companies_input->email,
              'phone' => $companies_input->phone,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $companies->parent = $companies->parent ;
         $companies->currency = $companies->currency ;
         $companies->partner = $companies->partner ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $companies->company_partners = $companies->companyPartners ;
            $companies->parent_companies = $companies->parentCompanies ;
            $companies->company_workes = $companies->companyWorkes ;
            $companies->company_departements = $companies->companyDepartements ;
            $companies->company_jobs = $companies->companyJobs ;
            $companies->company_applicants = $companies->companyApplicants ;
            $companies->company_time_off_types = $companies->companyTimeOffTypes ;
            $companies->for_company_time_off_allocations = $companies->forCompanyTimeOffAllocations ;
            $companies->company_lunch_vendors = $companies->companyLunchVendors ;
            $companies->company_lunch_locations = $companies->companyLunchLocations ;
            $companies->company_lunch_product_categories = $companies->companyLunchProductCategories ;
            $companies->company_lunch_orders = $companies->companyLunchOrders ;
            $companies->company_fleet_vehicles = $companies->companyFleetVehicles ;
            $companies->company_account_types = $companies->companyAccountTypes ;
            $companies->company_account_taxes = $companies->companyAccountTaxes ;
            $companies->company_account_groups = $companies->companyAccountGroups ;
            $companies->company_accounts = $companies->companyAccounts ;
            $companies->company_banks = $companies->companyBanks ;
            $companies->company_partner_banks = $companies->companyPartnerBanks ;
            $companies->company_account_journals = $companies->companyAccountJournals ;
            $companies->company_expense_reports = $companies->companyExpenseReports ;
 
            }

            return ApiResponse::success(compact('companies'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/company",
     *      operationId="BrowseCompany",
     *      tags={"Companies"},
     *      summary="Browse companies",
     *      description="Browse companies",
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

            $companies = new Company();
            $companies_fillable = $companies->getFillable();

            $filter_fields = $request->get('filter_fields', '*');
            $filter_fields = explode(',', $filter_fields);
            if (array_search('*', $filter_fields) == false) {
                $new_filter_fields = [];
                foreach ($filter_fields as $index => $field) {
                    if (!in_array($field, $filter_fields)) {
                        $new_filter_fields[] = $field;
                    }
                }
                $companies = $companies->select($filter_fields);
            }

            $filter_fields_search = $request->get('filter_fields_search', '*');
            $filter_fields_search = explode(',', $filter_fields_search);
            if (isset($request->search)) {
                if (array_search('*', $filter_fields_search) == false) {
                    foreach ($companies_fillable as $index => $field) {
                        $companies = $companies->orWhere($field, "like", "%$request->search%");
                    }
                } else {
                    foreach ($filter_fields_search as $index => $field) {
                        if (in_array($field, $companies_fillable)) {
                            $companies = $companies->orWhere($field, "like", "%$request->search%");
                        }
                    }
                }
            }

            if ($request->get('show_pagination', 'true') == 'true') {
                $max_page = $request->get('max_page', 15);
                $companies = $companies->paginate($max_page);
            } else {
                $companies = $companies->get();
            }

            $companies->map(function($companies) use ($request){

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $companies->parent = $companies->parent ;
         $companies->currency = $companies->currency ;
         $companies->partner = $companies->partner ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $companies->company_partners = $companies->companyPartners ;
            $companies->parent_companies = $companies->parentCompanies ;
            $companies->company_workes = $companies->companyWorkes ;
            $companies->company_departements = $companies->companyDepartements ;
            $companies->company_jobs = $companies->companyJobs ;
            $companies->company_applicants = $companies->companyApplicants ;
            $companies->company_time_off_types = $companies->companyTimeOffTypes ;
            $companies->for_company_time_off_allocations = $companies->forCompanyTimeOffAllocations ;
            $companies->company_lunch_vendors = $companies->companyLunchVendors ;
            $companies->company_lunch_locations = $companies->companyLunchLocations ;
            $companies->company_lunch_product_categories = $companies->companyLunchProductCategories ;
            $companies->company_lunch_orders = $companies->companyLunchOrders ;
            $companies->company_fleet_vehicles = $companies->companyFleetVehicles ;
            $companies->company_account_types = $companies->companyAccountTypes ;
            $companies->company_account_taxes = $companies->companyAccountTaxes ;
            $companies->company_account_groups = $companies->companyAccountGroups ;
            $companies->company_accounts = $companies->companyAccounts ;
            $companies->company_banks = $companies->companyBanks ;
            $companies->company_partner_banks = $companies->companyPartnerBanks ;
            $companies->company_account_journals = $companies->companyAccountJournals ;
            $companies->company_expense_reports = $companies->companyExpenseReports ;
 
            }

                return $companies ;
            });
            $companies = $companies->toArray();

            return ApiResponse::success(compact('companies'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/company/{id}",
     *      operationId="ReadCompany",
     *      tags={"Companies"},
     *      summary="Read companies",
     *      description="Read companies",
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

            $companies = Company::find($id);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $companies->parent = $companies->parent ;
         $companies->currency = $companies->currency ;
         $companies->partner = $companies->partner ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $companies->company_partners = $companies->companyPartners ;
            $companies->parent_companies = $companies->parentCompanies ;
            $companies->company_workes = $companies->companyWorkes ;
            $companies->company_departements = $companies->companyDepartements ;
            $companies->company_jobs = $companies->companyJobs ;
            $companies->company_applicants = $companies->companyApplicants ;
            $companies->company_time_off_types = $companies->companyTimeOffTypes ;
            $companies->for_company_time_off_allocations = $companies->forCompanyTimeOffAllocations ;
            $companies->company_lunch_vendors = $companies->companyLunchVendors ;
            $companies->company_lunch_locations = $companies->companyLunchLocations ;
            $companies->company_lunch_product_categories = $companies->companyLunchProductCategories ;
            $companies->company_lunch_orders = $companies->companyLunchOrders ;
            $companies->company_fleet_vehicles = $companies->companyFleetVehicles ;
            $companies->company_account_types = $companies->companyAccountTypes ;
            $companies->company_account_taxes = $companies->companyAccountTaxes ;
            $companies->company_account_groups = $companies->companyAccountGroups ;
            $companies->company_accounts = $companies->companyAccounts ;
            $companies->company_banks = $companies->companyBanks ;
            $companies->company_partner_banks = $companies->companyPartnerBanks ;
            $companies->company_account_journals = $companies->companyAccountJournals ;
            $companies->company_expense_reports = $companies->companyExpenseReports ;
 
            }

            return ApiResponse::success(compact('companies'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Put(
     *      path="/module/hrm/v1/company/{id}",
     *      operationId="UpdateCompany",
     *      tags={"Companies"},
     *      summary="Update companies",
     *      description="Update companies",
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
     *          @OA\JsonContent(ref="#/components/schemas/CompanyInput")
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
            $companies_input = new CompanyInput($request);
            $companies = Company::find($id);

            $companies->update([
                  'name' => $companies_input->name == null ? $companies->name : $companies_input->name,
              'parent_id' => $companies_input->parent_id == null ? $companies->parent_id : $companies_input->parent_id,
              'currency_id' => $companies_input->currency_id == null ? $companies->currency_id : $companies_input->currency_id,
              'sequnce' => $companies_input->sequnce == null ? $companies->sequnce : $companies_input->sequnce,
              'partner_id' => $companies_input->partner_id == null ? $companies->partner_id : $companies_input->partner_id,
              'report_header' => $companies_input->report_header == null ? $companies->report_header : $companies_input->report_header,
              'report_footer' => $companies_input->report_footer == null ? $companies->report_footer : $companies_input->report_footer,
              'img_logo_path' => $companies_input->img_logo_path == null ? $companies->img_logo_path : $companies_input->img_logo_path,
              'email' => $companies_input->email == null ? $companies->email : $companies_input->email,
              'phone' => $companies_input->phone == null ? $companies->phone : $companies_input->phone,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $companies->parent = $companies->parent ;
         $companies->currency = $companies->currency ;
         $companies->partner = $companies->partner ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $companies->company_partners = $companies->companyPartners ;
            $companies->parent_companies = $companies->parentCompanies ;
            $companies->company_workes = $companies->companyWorkes ;
            $companies->company_departements = $companies->companyDepartements ;
            $companies->company_jobs = $companies->companyJobs ;
            $companies->company_applicants = $companies->companyApplicants ;
            $companies->company_time_off_types = $companies->companyTimeOffTypes ;
            $companies->for_company_time_off_allocations = $companies->forCompanyTimeOffAllocations ;
            $companies->company_lunch_vendors = $companies->companyLunchVendors ;
            $companies->company_lunch_locations = $companies->companyLunchLocations ;
            $companies->company_lunch_product_categories = $companies->companyLunchProductCategories ;
            $companies->company_lunch_orders = $companies->companyLunchOrders ;
            $companies->company_fleet_vehicles = $companies->companyFleetVehicles ;
            $companies->company_account_types = $companies->companyAccountTypes ;
            $companies->company_account_taxes = $companies->companyAccountTaxes ;
            $companies->company_account_groups = $companies->companyAccountGroups ;
            $companies->company_accounts = $companies->companyAccounts ;
            $companies->company_banks = $companies->companyBanks ;
            $companies->company_partner_banks = $companies->companyPartnerBanks ;
            $companies->company_account_journals = $companies->companyAccountJournals ;
            $companies->company_expense_reports = $companies->companyExpenseReports ;
 
            }

            return ApiResponse::success(compact('companies'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }


    /**
     * @OA\Delete(
     *      path="/module/hrm/v1/company/{id}",
     *      operationId="DeleteCompany",
     *      tags={"Companies"},
     *      summary="Delete companies",
     *      description="Delete companies",
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
            $companies = Company::find($id);

            $companies->delete();

            return ApiResponse::success();
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }
}

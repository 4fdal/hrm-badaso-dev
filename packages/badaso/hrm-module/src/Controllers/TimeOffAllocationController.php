<?php

namespace Uasoft\Badaso\Module\HRM\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\HRM\Models\TimeOffAllocation;
use Uasoft\Badaso\Module\HRM\Schema\Inputs\TimeOffAllocationInput;

class TimeOffAllocationController extends Controller
{
    /**
     * @OA\Post(
     *      path="/module/hrm/v1/time-off-allocation",
     *      operationId="AddTimeOffAllocation",
     *      tags={"Time Off Allocations"},
     *      summary="Add new time_off_allocations",
     *      description="Add a new time_off_allocations",
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
     *          @OA\JsonContent(ref="#/components/schemas/TimeOffAllocationInput")
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
            $time_off_allocations_input = new TimeOffAllocationInput($request);

            $time_off_allocations = TimeOffAllocation::create([
                  'name' => $time_off_allocations_input->name,
              'time_off_type_id' => $time_off_allocations_input->time_off_type_id,
              'allocation_types' => $time_off_allocations_input->allocation_types,
              'number_of_day' => $time_off_allocations_input->number_of_day,
              'holiday_mode' => $time_off_allocations_input->holiday_mode,
              'for_employee_id' => $time_off_allocations_input->for_employee_id,
              'for_company_id' => $time_off_allocations_input->for_company_id,
              'for_departement_id' => $time_off_allocations_input->for_departement_id,
              'for_employee_categorie_id' => $time_off_allocations_input->for_employee_categorie_id,
              'description' => $time_off_allocations_input->description,
              'first_approve_employee_id' => $time_off_allocations_input->first_approve_employee_id,
              'second_approve_employee_id' => $time_off_allocations_input->second_approve_employee_id,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $time_off_allocations->time_off_type = $time_off_allocations->time_off_type ;
         $time_off_allocations->for_employee = $time_off_allocations->for_employee ;
         $time_off_allocations->for_company = $time_off_allocations->for_company ;
         $time_off_allocations->for_departement = $time_off_allocations->for_departement ;
         $time_off_allocations->for_employee_categorie = $time_off_allocations->for_employee_categorie ;
         $time_off_allocations->first_approve_employee = $time_off_allocations->first_approve_employee ;
         $time_off_allocations->second_approve_employee = $time_off_allocations->second_approve_employee ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('time_off_allocations'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/time-off-allocation",
     *      operationId="BrowseTimeOffAllocation",
     *      tags={"Time Off Allocations"},
     *      summary="Browse time_off_allocations",
     *      description="Browse time_off_allocations",
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

            $time_off_allocations = new TimeOffAllocation();
            $time_off_allocations_fillable = $time_off_allocations->getFillable();

            $filter_fields = $request->get('filter_fields', '*');
            $filter_fields = explode(',', $filter_fields);
            if (array_search('*', $filter_fields) == false) {
                $new_filter_fields = [];
                foreach ($filter_fields as $index => $field) {
                    if (!in_array($field, $filter_fields)) {
                        $new_filter_fields[] = $field;
                    }
                }
                $time_off_allocations = $time_off_allocations->select($filter_fields);
            }

            $filter_fields_search = $request->get('filter_fields_search', '*');
            $filter_fields_search = explode(',', $filter_fields_search);
            if (isset($request->search)) {
                if (array_search('*', $filter_fields_search) == false) {
                    foreach ($time_off_allocations_fillable as $index => $field) {
                        $time_off_allocations = $time_off_allocations->orWhere($field, "like", "%$request->search%");
                    }
                } else {
                    foreach ($filter_fields_search as $index => $field) {
                        if (in_array($field, $time_off_allocations_fillable)) {
                            $time_off_allocations = $time_off_allocations->orWhere($field, "like", "%$request->search%");
                        }
                    }
                }
            }

            if ($request->get('show_pagination', 'true') == 'true') {
                $max_page = $request->get('max_page', 15);
                $time_off_allocations = $time_off_allocations->paginate($max_page);
            } else {
                $time_off_allocations = $time_off_allocations->get();
            }

            $time_off_allocations->map(function($time_off_allocations) use ($request){

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $time_off_allocations->time_off_type = $time_off_allocations->time_off_type ;
         $time_off_allocations->for_employee = $time_off_allocations->for_employee ;
         $time_off_allocations->for_company = $time_off_allocations->for_company ;
         $time_off_allocations->for_departement = $time_off_allocations->for_departement ;
         $time_off_allocations->for_employee_categorie = $time_off_allocations->for_employee_categorie ;
         $time_off_allocations->first_approve_employee = $time_off_allocations->first_approve_employee ;
         $time_off_allocations->second_approve_employee = $time_off_allocations->second_approve_employee ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

                return $time_off_allocations ;
            });
            $time_off_allocations = $time_off_allocations->toArray();

            return ApiResponse::success(compact('time_off_allocations'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/time-off-allocation/{id}",
     *      operationId="ReadTimeOffAllocation",
     *      tags={"Time Off Allocations"},
     *      summary="Read time_off_allocations",
     *      description="Read time_off_allocations",
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

            $time_off_allocations = TimeOffAllocation::find($id);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $time_off_allocations->time_off_type = $time_off_allocations->time_off_type ;
         $time_off_allocations->for_employee = $time_off_allocations->for_employee ;
         $time_off_allocations->for_company = $time_off_allocations->for_company ;
         $time_off_allocations->for_departement = $time_off_allocations->for_departement ;
         $time_off_allocations->for_employee_categorie = $time_off_allocations->for_employee_categorie ;
         $time_off_allocations->first_approve_employee = $time_off_allocations->first_approve_employee ;
         $time_off_allocations->second_approve_employee = $time_off_allocations->second_approve_employee ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('time_off_allocations'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Put(
     *      path="/module/hrm/v1/time-off-allocation/{id}",
     *      operationId="UpdateTimeOffAllocation",
     *      tags={"Time Off Allocations"},
     *      summary="Update time_off_allocations",
     *      description="Update time_off_allocations",
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
     *          @OA\JsonContent(ref="#/components/schemas/TimeOffAllocationInput")
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
            $time_off_allocations_input = new TimeOffAllocationInput($request);
            $time_off_allocations = TimeOffAllocation::find($id);

            $time_off_allocations->update([
                  'name' => $time_off_allocations_input->name == null ? $time_off_allocations->name : $time_off_allocations_input->name,
              'time_off_type_id' => $time_off_allocations_input->time_off_type_id == null ? $time_off_allocations->time_off_type_id : $time_off_allocations_input->time_off_type_id,
              'allocation_types' => $time_off_allocations_input->allocation_types == null ? $time_off_allocations->allocation_types : $time_off_allocations_input->allocation_types,
              'number_of_day' => $time_off_allocations_input->number_of_day == null ? $time_off_allocations->number_of_day : $time_off_allocations_input->number_of_day,
              'holiday_mode' => $time_off_allocations_input->holiday_mode == null ? $time_off_allocations->holiday_mode : $time_off_allocations_input->holiday_mode,
              'for_employee_id' => $time_off_allocations_input->for_employee_id == null ? $time_off_allocations->for_employee_id : $time_off_allocations_input->for_employee_id,
              'for_company_id' => $time_off_allocations_input->for_company_id == null ? $time_off_allocations->for_company_id : $time_off_allocations_input->for_company_id,
              'for_departement_id' => $time_off_allocations_input->for_departement_id == null ? $time_off_allocations->for_departement_id : $time_off_allocations_input->for_departement_id,
              'for_employee_categorie_id' => $time_off_allocations_input->for_employee_categorie_id == null ? $time_off_allocations->for_employee_categorie_id : $time_off_allocations_input->for_employee_categorie_id,
              'description' => $time_off_allocations_input->description == null ? $time_off_allocations->description : $time_off_allocations_input->description,
              'first_approve_employee_id' => $time_off_allocations_input->first_approve_employee_id == null ? $time_off_allocations->first_approve_employee_id : $time_off_allocations_input->first_approve_employee_id,
              'second_approve_employee_id' => $time_off_allocations_input->second_approve_employee_id == null ? $time_off_allocations->second_approve_employee_id : $time_off_allocations_input->second_approve_employee_id,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $time_off_allocations->time_off_type = $time_off_allocations->time_off_type ;
         $time_off_allocations->for_employee = $time_off_allocations->for_employee ;
         $time_off_allocations->for_company = $time_off_allocations->for_company ;
         $time_off_allocations->for_departement = $time_off_allocations->for_departement ;
         $time_off_allocations->for_employee_categorie = $time_off_allocations->for_employee_categorie ;
         $time_off_allocations->first_approve_employee = $time_off_allocations->first_approve_employee ;
         $time_off_allocations->second_approve_employee = $time_off_allocations->second_approve_employee ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('time_off_allocations'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }


    /**
     * @OA\Delete(
     *      path="/module/hrm/v1/time-off-allocation/{id}",
     *      operationId="DeleteTimeOffAllocation",
     *      tags={"Time Off Allocations"},
     *      summary="Delete time_off_allocations",
     *      description="Delete time_off_allocations",
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
            $time_off_allocations = TimeOffAllocation::find($id);

            $time_off_allocations->delete();

            return ApiResponse::success();
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }
}

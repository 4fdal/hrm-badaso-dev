<?php

namespace Uasoft\Badaso\Module\HRM\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\HRM\Models\TimeOffType;
use Uasoft\Badaso\Module\HRM\Schema\Inputs\TimeOffTypeInput;

class TimeOffTypeController extends Controller
{
    /**
     * @OA\Post(
     *      path="/module/hrm/v1/time-off-type",
     *      operationId="AddTimeOffType",
     *      tags={"Time Off Types"},
     *      summary="Add new time_off_types",
     *      description="Add a new time_off_types",
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
     *          @OA\JsonContent(ref="#/components/schemas/TimeOffTypeInput")
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
            $time_off_types_input = new TimeOffTypeInput($request);

            $time_off_types = TimeOffType::create([
                  'is_create_calendar' => $time_off_types_input->is_create_calendar,
              'is_active' => $time_off_types_input->is_active,
              'color' => $time_off_types_input->color,
              'company_id' => $time_off_types_input->company_id,
              'name' => $time_off_types_input->name,
              'payroll_code' => $time_off_types_input->payroll_code,
              'take_time_off_types' => $time_off_types_input->take_time_off_types,
              'responsible_user_id' => $time_off_types_input->responsible_user_id,
              'allocation_types' => $time_off_types_input->allocation_types,
              'allocation_validation_types' => $time_off_types_input->allocation_validation_types,
              'validity_start' => $time_off_types_input->validity_start,
              'validity_stop' => $time_off_types_input->validity_stop,
              'time_off_validation_types' => $time_off_types_input->time_off_validation_types,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $time_off_types->company = $time_off_types->company ;
         $time_off_types->responsible_user = $time_off_types->responsible_user ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $time_off_types->time_off_type_time_off_allocations = $time_off_types->timeOffTypeTimeOffAllocations ;
            $time_off_types->time_off_type_time_offs = $time_off_types->timeOffTypeTimeOffs ;
 
            }

            return ApiResponse::success(compact('time_off_types'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/time-off-type",
     *      operationId="BrowseTimeOffType",
     *      tags={"Time Off Types"},
     *      summary="Browse time_off_types",
     *      description="Browse time_off_types",
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

            $time_off_types = new TimeOffType();
            $time_off_types_fillable = $time_off_types->getFillable();

            $filter_fields = $request->get('filter_fields', '*');
            $filter_fields = explode(',', $filter_fields);
            if (array_search('*', $filter_fields) == false) {
                $new_filter_fields = [];
                foreach ($filter_fields as $index => $field) {
                    if (!in_array($field, $filter_fields)) {
                        $new_filter_fields[] = $field;
                    }
                }
                $time_off_types = $time_off_types->select($filter_fields);
            }

            $filter_fields_search = $request->get('filter_fields_search', '*');
            $filter_fields_search = explode(',', $filter_fields_search);
            if (isset($request->search)) {
                if (array_search('*', $filter_fields_search) == false) {
                    foreach ($time_off_types_fillable as $index => $field) {
                        $time_off_types = $time_off_types->orWhere($field, "like", "%$request->search%");
                    }
                } else {
                    foreach ($filter_fields_search as $index => $field) {
                        if (in_array($field, $time_off_types_fillable)) {
                            $time_off_types = $time_off_types->orWhere($field, "like", "%$request->search%");
                        }
                    }
                }
            }

            if ($request->get('show_pagination', 'true') == 'true') {
                $max_page = $request->get('max_page', 15);
                $time_off_types = $time_off_types->paginate($max_page);
            } else {
                $time_off_types = $time_off_types->get();
            }

            $time_off_types->map(function($time_off_types) use ($request){

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $time_off_types->company = $time_off_types->company ;
         $time_off_types->responsible_user = $time_off_types->responsible_user ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $time_off_types->time_off_type_time_off_allocations = $time_off_types->timeOffTypeTimeOffAllocations ;
            $time_off_types->time_off_type_time_offs = $time_off_types->timeOffTypeTimeOffs ;
 
            }

                return $time_off_types ;
            });
            $time_off_types = $time_off_types->toArray();

            return ApiResponse::success(compact('time_off_types'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/time-off-type/{id}",
     *      operationId="ReadTimeOffType",
     *      tags={"Time Off Types"},
     *      summary="Read time_off_types",
     *      description="Read time_off_types",
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

            $time_off_types = TimeOffType::find($id);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $time_off_types->company = $time_off_types->company ;
         $time_off_types->responsible_user = $time_off_types->responsible_user ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $time_off_types->time_off_type_time_off_allocations = $time_off_types->timeOffTypeTimeOffAllocations ;
            $time_off_types->time_off_type_time_offs = $time_off_types->timeOffTypeTimeOffs ;
 
            }

            return ApiResponse::success(compact('time_off_types'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Put(
     *      path="/module/hrm/v1/time-off-type/{id}",
     *      operationId="UpdateTimeOffType",
     *      tags={"Time Off Types"},
     *      summary="Update time_off_types",
     *      description="Update time_off_types",
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
     *          @OA\JsonContent(ref="#/components/schemas/TimeOffTypeInput")
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
            $time_off_types_input = new TimeOffTypeInput($request);
            $time_off_types = TimeOffType::find($id);

            $time_off_types->update([
                  'is_create_calendar' => $time_off_types_input->is_create_calendar == null ? $time_off_types->is_create_calendar : $time_off_types_input->is_create_calendar,
              'is_active' => $time_off_types_input->is_active == null ? $time_off_types->is_active : $time_off_types_input->is_active,
              'color' => $time_off_types_input->color == null ? $time_off_types->color : $time_off_types_input->color,
              'company_id' => $time_off_types_input->company_id == null ? $time_off_types->company_id : $time_off_types_input->company_id,
              'name' => $time_off_types_input->name == null ? $time_off_types->name : $time_off_types_input->name,
              'payroll_code' => $time_off_types_input->payroll_code == null ? $time_off_types->payroll_code : $time_off_types_input->payroll_code,
              'take_time_off_types' => $time_off_types_input->take_time_off_types == null ? $time_off_types->take_time_off_types : $time_off_types_input->take_time_off_types,
              'responsible_user_id' => $time_off_types_input->responsible_user_id == null ? $time_off_types->responsible_user_id : $time_off_types_input->responsible_user_id,
              'allocation_types' => $time_off_types_input->allocation_types == null ? $time_off_types->allocation_types : $time_off_types_input->allocation_types,
              'allocation_validation_types' => $time_off_types_input->allocation_validation_types == null ? $time_off_types->allocation_validation_types : $time_off_types_input->allocation_validation_types,
              'validity_start' => $time_off_types_input->validity_start == null ? $time_off_types->validity_start : $time_off_types_input->validity_start,
              'validity_stop' => $time_off_types_input->validity_stop == null ? $time_off_types->validity_stop : $time_off_types_input->validity_stop,
              'time_off_validation_types' => $time_off_types_input->time_off_validation_types == null ? $time_off_types->time_off_validation_types : $time_off_types_input->time_off_validation_types,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $time_off_types->company = $time_off_types->company ;
         $time_off_types->responsible_user = $time_off_types->responsible_user ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $time_off_types->time_off_type_time_off_allocations = $time_off_types->timeOffTypeTimeOffAllocations ;
            $time_off_types->time_off_type_time_offs = $time_off_types->timeOffTypeTimeOffs ;
 
            }

            return ApiResponse::success(compact('time_off_types'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }


    /**
     * @OA\Delete(
     *      path="/module/hrm/v1/time-off-type/{id}",
     *      operationId="DeleteTimeOffType",
     *      tags={"Time Off Types"},
     *      summary="Delete time_off_types",
     *      description="Delete time_off_types",
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
            $time_off_types = TimeOffType::find($id);

            $time_off_types->delete();

            return ApiResponse::success();
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }
}

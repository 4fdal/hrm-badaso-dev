<?php

namespace Uasoft\Badaso\Module\HRM\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\HRM\Models\TimeOff;
use Uasoft\Badaso\Module\HRM\Schema\Inputs\TimeOffInput;

class TimeOffController extends Controller
{
    /**
     * @OA\Post(
     *      path="/module/hrm/v1/time-off",
     *      operationId="AddTimeOff",
     *      tags={"Time Offs"},
     *      summary="Add new time_offs",
     *      description="Add a new time_offs",
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
     *          @OA\JsonContent(ref="#/components/schemas/TimeOffInput")
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
            $time_offs_input = new TimeOffInput($request);

            $time_offs = TimeOff::create([
                  'private_name' => $time_offs_input->private_name,
              'status' => $time_offs_input->status,
              'user_id' => $time_offs_input->user_id,
              'manager_employee_id' => $time_offs_input->manager_employee_id,
              'time_off_type_id' => $time_offs_input->time_off_type_id,
              'employee_id' => $time_offs_input->employee_id,
              'departement_id' => $time_offs_input->departement_id,
              'notes' => $time_offs_input->notes,
              'date_from' => $time_offs_input->date_from,
              'date_to' => $time_offs_input->date_to,
              'number_of_day' => $time_offs_input->number_of_day,
              'duration_display' => $time_offs_input->duration_display,
              'metting_calendar_event_id' => $time_offs_input->metting_calendar_event_id,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $time_offs->user = $time_offs->user ;
         $time_offs->manager_employee = $time_offs->manager_employee ;
         $time_offs->time_off_type = $time_offs->time_off_type ;
         $time_offs->employee = $time_offs->employee ;
         $time_offs->departement = $time_offs->departement ;
         $time_offs->metting_calendar_event = $time_offs->metting_calendar_event ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('time_offs'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/time-off",
     *      operationId="BrowseTimeOff",
     *      tags={"Time Offs"},
     *      summary="Browse time_offs",
     *      description="Browse time_offs",
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

            $time_offs = new TimeOff();
            $time_offs_fillable = $time_offs->getFillable();

            $filter_fields = $request->get('filter_fields', '*');
            $filter_fields = explode(',', $filter_fields);
            if (array_search('*', $filter_fields) == false) {
                $new_filter_fields = [];
                foreach ($filter_fields as $index => $field) {
                    if (!in_array($field, $filter_fields)) {
                        $new_filter_fields[] = $field;
                    }
                }
                $time_offs = $time_offs->select($filter_fields);
            }

            $filter_fields_search = $request->get('filter_fields_search', '*');
            $filter_fields_search = explode(',', $filter_fields_search);
            if (isset($request->search)) {
                if (array_search('*', $filter_fields_search) == false) {
                    foreach ($time_offs_fillable as $index => $field) {
                        $time_offs = $time_offs->orWhere($field, "like", "%$request->search%");
                    }
                } else {
                    foreach ($filter_fields_search as $index => $field) {
                        if (in_array($field, $time_offs_fillable)) {
                            $time_offs = $time_offs->orWhere($field, "like", "%$request->search%");
                        }
                    }
                }
            }

            if ($request->get('show_pagination', 'true') == 'true') {
                $max_page = $request->get('max_page', 15);
                $time_offs = $time_offs->paginate($max_page);
            } else {
                $time_offs = $time_offs->get();
            }

            $time_offs->map(function($time_offs) use ($request){

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $time_offs->user = $time_offs->user ;
         $time_offs->manager_employee = $time_offs->manager_employee ;
         $time_offs->time_off_type = $time_offs->time_off_type ;
         $time_offs->employee = $time_offs->employee ;
         $time_offs->departement = $time_offs->departement ;
         $time_offs->metting_calendar_event = $time_offs->metting_calendar_event ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

                return $time_offs ;
            });
            $time_offs = $time_offs->toArray();

            return ApiResponse::success(compact('time_offs'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/time-off/{id}",
     *      operationId="ReadTimeOff",
     *      tags={"Time Offs"},
     *      summary="Read time_offs",
     *      description="Read time_offs",
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

            $time_offs = TimeOff::find($id);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $time_offs->user = $time_offs->user ;
         $time_offs->manager_employee = $time_offs->manager_employee ;
         $time_offs->time_off_type = $time_offs->time_off_type ;
         $time_offs->employee = $time_offs->employee ;
         $time_offs->departement = $time_offs->departement ;
         $time_offs->metting_calendar_event = $time_offs->metting_calendar_event ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('time_offs'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Put(
     *      path="/module/hrm/v1/time-off/{id}",
     *      operationId="UpdateTimeOff",
     *      tags={"Time Offs"},
     *      summary="Update time_offs",
     *      description="Update time_offs",
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
     *          @OA\JsonContent(ref="#/components/schemas/TimeOffInput")
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
            $time_offs_input = new TimeOffInput($request);
            $time_offs = TimeOff::find($id);

            $time_offs->update([
                  'private_name' => $time_offs_input->private_name == null ? $time_offs->private_name : $time_offs_input->private_name,
              'status' => $time_offs_input->status == null ? $time_offs->status : $time_offs_input->status,
              'user_id' => $time_offs_input->user_id == null ? $time_offs->user_id : $time_offs_input->user_id,
              'manager_employee_id' => $time_offs_input->manager_employee_id == null ? $time_offs->manager_employee_id : $time_offs_input->manager_employee_id,
              'time_off_type_id' => $time_offs_input->time_off_type_id == null ? $time_offs->time_off_type_id : $time_offs_input->time_off_type_id,
              'employee_id' => $time_offs_input->employee_id == null ? $time_offs->employee_id : $time_offs_input->employee_id,
              'departement_id' => $time_offs_input->departement_id == null ? $time_offs->departement_id : $time_offs_input->departement_id,
              'notes' => $time_offs_input->notes == null ? $time_offs->notes : $time_offs_input->notes,
              'date_from' => $time_offs_input->date_from == null ? $time_offs->date_from : $time_offs_input->date_from,
              'date_to' => $time_offs_input->date_to == null ? $time_offs->date_to : $time_offs_input->date_to,
              'number_of_day' => $time_offs_input->number_of_day == null ? $time_offs->number_of_day : $time_offs_input->number_of_day,
              'duration_display' => $time_offs_input->duration_display == null ? $time_offs->duration_display : $time_offs_input->duration_display,
              'metting_calendar_event_id' => $time_offs_input->metting_calendar_event_id == null ? $time_offs->metting_calendar_event_id : $time_offs_input->metting_calendar_event_id,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $time_offs->user = $time_offs->user ;
         $time_offs->manager_employee = $time_offs->manager_employee ;
         $time_offs->time_off_type = $time_offs->time_off_type ;
         $time_offs->employee = $time_offs->employee ;
         $time_offs->departement = $time_offs->departement ;
         $time_offs->metting_calendar_event = $time_offs->metting_calendar_event ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('time_offs'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }


    /**
     * @OA\Delete(
     *      path="/module/hrm/v1/time-off/{id}",
     *      operationId="DeleteTimeOff",
     *      tags={"Time Offs"},
     *      summary="Delete time_offs",
     *      description="Delete time_offs",
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
            $time_offs = TimeOff::find($id);

            $time_offs->delete();

            return ApiResponse::success();
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }
}

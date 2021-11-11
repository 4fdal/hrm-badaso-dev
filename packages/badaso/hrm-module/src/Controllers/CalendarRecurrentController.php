<?php

namespace Uasoft\Badaso\Module\HRM\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\HRM\Models\CalendarRecurrent;
use Uasoft\Badaso\Module\HRM\Schema\Inputs\CalendarRecurrentInput;

class CalendarRecurrentController extends Controller
{
    /**
     * @OA\Post(
     *      path="/module/hrm/v1/calendar-recurrent",
     *      operationId="AddCalendarRecurrent",
     *      tags={"Calendar Recurrents"},
     *      summary="Add new calendar_recurrents",
     *      description="Add a new calendar_recurrents",
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
     *          @OA\JsonContent(ref="#/components/schemas/CalendarRecurrentInput")
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
            $calendar_recurrents_input = new CalendarRecurrentInput($request);

            $calendar_recurrents = CalendarRecurrent::create([
                  'calendar_event_id' => $calendar_recurrents_input->calendar_event_id,
              'name' => $calendar_recurrents_input->name,
              'event_tz' => $calendar_recurrents_input->event_tz,
              'rrule' => $calendar_recurrents_input->rrule,
              'rrule_type' => $calendar_recurrents_input->rrule_type,
              'end_type' => $calendar_recurrents_input->end_type,
              'interval' => $calendar_recurrents_input->interval,
              'count' => $calendar_recurrents_input->count,
              'mo' => $calendar_recurrents_input->mo,
              'tu' => $calendar_recurrents_input->tu,
              'we' => $calendar_recurrents_input->we,
              'th' => $calendar_recurrents_input->th,
              'fr' => $calendar_recurrents_input->fr,
              'sa' => $calendar_recurrents_input->sa,
              'su' => $calendar_recurrents_input->su,
              'month_by' => $calendar_recurrents_input->month_by,
              'day' => $calendar_recurrents_input->day,
              'byday' => $calendar_recurrents_input->byday,
              'until' => $calendar_recurrents_input->until,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $calendar_recurrents->calendar_event = $calendar_recurrents->calendar_event ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('calendar_recurrents'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/calendar-recurrent",
     *      operationId="BrowseCalendarRecurrent",
     *      tags={"Calendar Recurrents"},
     *      summary="Browse calendar_recurrents",
     *      description="Browse calendar_recurrents",
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

            $calendar_recurrents = new CalendarRecurrent();
            $calendar_recurrents_fillable = $calendar_recurrents->getFillable();

            $filter_fields = $request->get('filter_fields', '*');
            $filter_fields = explode(',', $filter_fields);
            if (array_search('*', $filter_fields) == false) {
                $new_filter_fields = [];
                foreach ($filter_fields as $index => $field) {
                    if (!in_array($field, $filter_fields)) {
                        $new_filter_fields[] = $field;
                    }
                }
                $calendar_recurrents = $calendar_recurrents->select($filter_fields);
            }

            $filter_fields_search = $request->get('filter_fields_search', '*');
            $filter_fields_search = explode(',', $filter_fields_search);
            if (isset($request->search)) {
                if (array_search('*', $filter_fields_search) == false) {
                    foreach ($calendar_recurrents_fillable as $index => $field) {
                        $calendar_recurrents = $calendar_recurrents->orWhere($field, "like", "%$request->search%");
                    }
                } else {
                    foreach ($filter_fields_search as $index => $field) {
                        if (in_array($field, $calendar_recurrents_fillable)) {
                            $calendar_recurrents = $calendar_recurrents->orWhere($field, "like", "%$request->search%");
                        }
                    }
                }
            }

            if ($request->get('show_pagination', 'true') == 'true') {
                $max_page = $request->get('max_page', 15);
                $calendar_recurrents = $calendar_recurrents->paginate($max_page);
            } else {
                $calendar_recurrents = $calendar_recurrents->get();
            }

            $calendar_recurrents->map(function($calendar_recurrents) use ($request){

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $calendar_recurrents->calendar_event = $calendar_recurrents->calendar_event ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

                return $calendar_recurrents ;
            });
            $calendar_recurrents = $calendar_recurrents->toArray();

            return ApiResponse::success(compact('calendar_recurrents'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/calendar-recurrent/{id}",
     *      operationId="ReadCalendarRecurrent",
     *      tags={"Calendar Recurrents"},
     *      summary="Read calendar_recurrents",
     *      description="Read calendar_recurrents",
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

            $calendar_recurrents = CalendarRecurrent::find($id);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $calendar_recurrents->calendar_event = $calendar_recurrents->calendar_event ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('calendar_recurrents'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Put(
     *      path="/module/hrm/v1/calendar-recurrent/{id}",
     *      operationId="UpdateCalendarRecurrent",
     *      tags={"Calendar Recurrents"},
     *      summary="Update calendar_recurrents",
     *      description="Update calendar_recurrents",
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
     *          @OA\JsonContent(ref="#/components/schemas/CalendarRecurrentInput")
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
            $calendar_recurrents_input = new CalendarRecurrentInput($request);
            $calendar_recurrents = CalendarRecurrent::find($id);

            $calendar_recurrents->update([
                  'calendar_event_id' => $calendar_recurrents_input->calendar_event_id == null ? $calendar_recurrents->calendar_event_id : $calendar_recurrents_input->calendar_event_id,
              'name' => $calendar_recurrents_input->name == null ? $calendar_recurrents->name : $calendar_recurrents_input->name,
              'event_tz' => $calendar_recurrents_input->event_tz == null ? $calendar_recurrents->event_tz : $calendar_recurrents_input->event_tz,
              'rrule' => $calendar_recurrents_input->rrule == null ? $calendar_recurrents->rrule : $calendar_recurrents_input->rrule,
              'rrule_type' => $calendar_recurrents_input->rrule_type == null ? $calendar_recurrents->rrule_type : $calendar_recurrents_input->rrule_type,
              'end_type' => $calendar_recurrents_input->end_type == null ? $calendar_recurrents->end_type : $calendar_recurrents_input->end_type,
              'interval' => $calendar_recurrents_input->interval == null ? $calendar_recurrents->interval : $calendar_recurrents_input->interval,
              'count' => $calendar_recurrents_input->count == null ? $calendar_recurrents->count : $calendar_recurrents_input->count,
              'mo' => $calendar_recurrents_input->mo == null ? $calendar_recurrents->mo : $calendar_recurrents_input->mo,
              'tu' => $calendar_recurrents_input->tu == null ? $calendar_recurrents->tu : $calendar_recurrents_input->tu,
              'we' => $calendar_recurrents_input->we == null ? $calendar_recurrents->we : $calendar_recurrents_input->we,
              'th' => $calendar_recurrents_input->th == null ? $calendar_recurrents->th : $calendar_recurrents_input->th,
              'fr' => $calendar_recurrents_input->fr == null ? $calendar_recurrents->fr : $calendar_recurrents_input->fr,
              'sa' => $calendar_recurrents_input->sa == null ? $calendar_recurrents->sa : $calendar_recurrents_input->sa,
              'su' => $calendar_recurrents_input->su == null ? $calendar_recurrents->su : $calendar_recurrents_input->su,
              'month_by' => $calendar_recurrents_input->month_by == null ? $calendar_recurrents->month_by : $calendar_recurrents_input->month_by,
              'day' => $calendar_recurrents_input->day == null ? $calendar_recurrents->day : $calendar_recurrents_input->day,
              'byday' => $calendar_recurrents_input->byday == null ? $calendar_recurrents->byday : $calendar_recurrents_input->byday,
              'until' => $calendar_recurrents_input->until == null ? $calendar_recurrents->until : $calendar_recurrents_input->until,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $calendar_recurrents->calendar_event = $calendar_recurrents->calendar_event ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('calendar_recurrents'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }


    /**
     * @OA\Delete(
     *      path="/module/hrm/v1/calendar-recurrent/{id}",
     *      operationId="DeleteCalendarRecurrent",
     *      tags={"Calendar Recurrents"},
     *      summary="Delete calendar_recurrents",
     *      description="Delete calendar_recurrents",
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
            $calendar_recurrents = CalendarRecurrent::find($id);

            $calendar_recurrents->delete();

            return ApiResponse::success();
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }
}

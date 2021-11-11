<?php

namespace Uasoft\Badaso\Module\HRM\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\HRM\Models\CalendarEvent;
use Uasoft\Badaso\Module\HRM\Schema\Inputs\CalendarEventInput;

class CalendarEventController extends Controller
{
    /**
     * @OA\Post(
     *      path="/module/hrm/v1/calendar-event",
     *      operationId="AddCalendarEvent",
     *      tags={"Calendar Events"},
     *      summary="Add new calendar_events",
     *      description="Add a new calendar_events",
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
     *          @OA\JsonContent(ref="#/components/schemas/CalendarEventInput")
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
            $calendar_events_input = new CalendarEventInput($request);

            $calendar_events = CalendarEvent::create([
                  'name' => $calendar_events_input->name,
              'start' => $calendar_events_input->start,
              'stop' => $calendar_events_input->stop,
              'is_all_day' => $calendar_events_input->is_all_day,
              'duration' => $calendar_events_input->duration,
              'description' => $calendar_events_input->description,
              'privacy' => $calendar_events_input->privacy,
              'localtion' => $calendar_events_input->localtion,
              'user_id' => $calendar_events_input->user_id,
              'is_active' => $calendar_events_input->is_active,
              'is_recurrent' => $calendar_events_input->is_recurrent,
              'show_as' => $calendar_events_input->show_as,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $calendar_events->user = $calendar_events->user ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $calendar_events->calendar_event_calendar_event_tags = $calendar_events->calendarEventCalendarEventTags ;
            $calendar_events->calendar_event_calendar_recurrents = $calendar_events->calendarEventCalendarRecurrents ;
            $calendar_events->calendar_event_calendar_attendees = $calendar_events->calendarEventCalendarAttendees ;
            $calendar_events->calendar_event_calendar_reminders = $calendar_events->calendarEventCalendarReminders ;
            $calendar_events->calendar_event_calendar_recruitment_events = $calendar_events->calendarEventCalendarRecruitmentEvents ;
            $calendar_events->metting_calendar_event_time_offs = $calendar_events->mettingCalendarEventTimeOffs ;
 
            }

            return ApiResponse::success(compact('calendar_events'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/calendar-event",
     *      operationId="BrowseCalendarEvent",
     *      tags={"Calendar Events"},
     *      summary="Browse calendar_events",
     *      description="Browse calendar_events",
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

            $calendar_events = new CalendarEvent();
            $calendar_events_fillable = $calendar_events->getFillable();

            $filter_fields = $request->get('filter_fields', '*');
            $filter_fields = explode(',', $filter_fields);
            if (array_search('*', $filter_fields) == false) {
                $new_filter_fields = [];
                foreach ($filter_fields as $index => $field) {
                    if (!in_array($field, $filter_fields)) {
                        $new_filter_fields[] = $field;
                    }
                }
                $calendar_events = $calendar_events->select($filter_fields);
            }

            $filter_fields_search = $request->get('filter_fields_search', '*');
            $filter_fields_search = explode(',', $filter_fields_search);
            if (isset($request->search)) {
                if (array_search('*', $filter_fields_search) == false) {
                    foreach ($calendar_events_fillable as $index => $field) {
                        $calendar_events = $calendar_events->orWhere($field, "like", "%$request->search%");
                    }
                } else {
                    foreach ($filter_fields_search as $index => $field) {
                        if (in_array($field, $calendar_events_fillable)) {
                            $calendar_events = $calendar_events->orWhere($field, "like", "%$request->search%");
                        }
                    }
                }
            }

            if ($request->get('show_pagination', 'true') == 'true') {
                $max_page = $request->get('max_page', 15);
                $calendar_events = $calendar_events->paginate($max_page);
            } else {
                $calendar_events = $calendar_events->get();
            }

            $calendar_events->map(function($calendar_events) use ($request){

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $calendar_events->user = $calendar_events->user ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $calendar_events->calendar_event_calendar_event_tags = $calendar_events->calendarEventCalendarEventTags ;
            $calendar_events->calendar_event_calendar_recurrents = $calendar_events->calendarEventCalendarRecurrents ;
            $calendar_events->calendar_event_calendar_attendees = $calendar_events->calendarEventCalendarAttendees ;
            $calendar_events->calendar_event_calendar_reminders = $calendar_events->calendarEventCalendarReminders ;
            $calendar_events->calendar_event_calendar_recruitment_events = $calendar_events->calendarEventCalendarRecruitmentEvents ;
            $calendar_events->metting_calendar_event_time_offs = $calendar_events->mettingCalendarEventTimeOffs ;
 
            }

                return $calendar_events ;
            });
            $calendar_events = $calendar_events->toArray();

            return ApiResponse::success(compact('calendar_events'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/calendar-event/{id}",
     *      operationId="ReadCalendarEvent",
     *      tags={"Calendar Events"},
     *      summary="Read calendar_events",
     *      description="Read calendar_events",
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

            $calendar_events = CalendarEvent::find($id);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $calendar_events->user = $calendar_events->user ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $calendar_events->calendar_event_calendar_event_tags = $calendar_events->calendarEventCalendarEventTags ;
            $calendar_events->calendar_event_calendar_recurrents = $calendar_events->calendarEventCalendarRecurrents ;
            $calendar_events->calendar_event_calendar_attendees = $calendar_events->calendarEventCalendarAttendees ;
            $calendar_events->calendar_event_calendar_reminders = $calendar_events->calendarEventCalendarReminders ;
            $calendar_events->calendar_event_calendar_recruitment_events = $calendar_events->calendarEventCalendarRecruitmentEvents ;
            $calendar_events->metting_calendar_event_time_offs = $calendar_events->mettingCalendarEventTimeOffs ;
 
            }

            return ApiResponse::success(compact('calendar_events'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Put(
     *      path="/module/hrm/v1/calendar-event/{id}",
     *      operationId="UpdateCalendarEvent",
     *      tags={"Calendar Events"},
     *      summary="Update calendar_events",
     *      description="Update calendar_events",
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
     *          @OA\JsonContent(ref="#/components/schemas/CalendarEventInput")
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
            $calendar_events_input = new CalendarEventInput($request);
            $calendar_events = CalendarEvent::find($id);

            $calendar_events->update([
                  'name' => $calendar_events_input->name == null ? $calendar_events->name : $calendar_events_input->name,
              'start' => $calendar_events_input->start == null ? $calendar_events->start : $calendar_events_input->start,
              'stop' => $calendar_events_input->stop == null ? $calendar_events->stop : $calendar_events_input->stop,
              'is_all_day' => $calendar_events_input->is_all_day == null ? $calendar_events->is_all_day : $calendar_events_input->is_all_day,
              'duration' => $calendar_events_input->duration == null ? $calendar_events->duration : $calendar_events_input->duration,
              'description' => $calendar_events_input->description == null ? $calendar_events->description : $calendar_events_input->description,
              'privacy' => $calendar_events_input->privacy == null ? $calendar_events->privacy : $calendar_events_input->privacy,
              'localtion' => $calendar_events_input->localtion == null ? $calendar_events->localtion : $calendar_events_input->localtion,
              'user_id' => $calendar_events_input->user_id == null ? $calendar_events->user_id : $calendar_events_input->user_id,
              'is_active' => $calendar_events_input->is_active == null ? $calendar_events->is_active : $calendar_events_input->is_active,
              'is_recurrent' => $calendar_events_input->is_recurrent == null ? $calendar_events->is_recurrent : $calendar_events_input->is_recurrent,
              'show_as' => $calendar_events_input->show_as == null ? $calendar_events->show_as : $calendar_events_input->show_as,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $calendar_events->user = $calendar_events->user ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $calendar_events->calendar_event_calendar_event_tags = $calendar_events->calendarEventCalendarEventTags ;
            $calendar_events->calendar_event_calendar_recurrents = $calendar_events->calendarEventCalendarRecurrents ;
            $calendar_events->calendar_event_calendar_attendees = $calendar_events->calendarEventCalendarAttendees ;
            $calendar_events->calendar_event_calendar_reminders = $calendar_events->calendarEventCalendarReminders ;
            $calendar_events->calendar_event_calendar_recruitment_events = $calendar_events->calendarEventCalendarRecruitmentEvents ;
            $calendar_events->metting_calendar_event_time_offs = $calendar_events->mettingCalendarEventTimeOffs ;
 
            }

            return ApiResponse::success(compact('calendar_events'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }


    /**
     * @OA\Delete(
     *      path="/module/hrm/v1/calendar-event/{id}",
     *      operationId="DeleteCalendarEvent",
     *      tags={"Calendar Events"},
     *      summary="Delete calendar_events",
     *      description="Delete calendar_events",
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
            $calendar_events = CalendarEvent::find($id);

            $calendar_events->delete();

            return ApiResponse::success();
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }
}

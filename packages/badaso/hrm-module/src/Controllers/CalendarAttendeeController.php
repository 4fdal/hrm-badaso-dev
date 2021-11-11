<?php

namespace Uasoft\Badaso\Module\HRM\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\HRM\Models\CalendarAttendee;
use Uasoft\Badaso\Module\HRM\Schema\Inputs\CalendarAttendeeInput;

class CalendarAttendeeController extends Controller
{
    /**
     * @OA\Post(
     *      path="/module/hrm/v1/calendar-attendee",
     *      operationId="AddCalendarAttendee",
     *      tags={"Calendar Attendees"},
     *      summary="Add new calendar_attendees",
     *      description="Add a new calendar_attendees",
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
     *          @OA\JsonContent(ref="#/components/schemas/CalendarAttendeeInput")
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
            $calendar_attendees_input = new CalendarAttendeeInput($request);

            $calendar_attendees = CalendarAttendee::create([
                  'common_name' => $calendar_attendees_input->common_name,
              'calendar_event_id' => $calendar_attendees_input->calendar_event_id,
              'partner_id' => $calendar_attendees_input->partner_id,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $calendar_attendees->calendar_event = $calendar_attendees->calendar_event ;
         $calendar_attendees->partner = $calendar_attendees->partner ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('calendar_attendees'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/calendar-attendee",
     *      operationId="BrowseCalendarAttendee",
     *      tags={"Calendar Attendees"},
     *      summary="Browse calendar_attendees",
     *      description="Browse calendar_attendees",
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

            $calendar_attendees = new CalendarAttendee();
            $calendar_attendees_fillable = $calendar_attendees->getFillable();

            $filter_fields = $request->get('filter_fields', '*');
            $filter_fields = explode(',', $filter_fields);
            if (array_search('*', $filter_fields) == false) {
                $new_filter_fields = [];
                foreach ($filter_fields as $index => $field) {
                    if (!in_array($field, $filter_fields)) {
                        $new_filter_fields[] = $field;
                    }
                }
                $calendar_attendees = $calendar_attendees->select($filter_fields);
            }

            $filter_fields_search = $request->get('filter_fields_search', '*');
            $filter_fields_search = explode(',', $filter_fields_search);
            if (isset($request->search)) {
                if (array_search('*', $filter_fields_search) == false) {
                    foreach ($calendar_attendees_fillable as $index => $field) {
                        $calendar_attendees = $calendar_attendees->orWhere($field, "like", "%$request->search%");
                    }
                } else {
                    foreach ($filter_fields_search as $index => $field) {
                        if (in_array($field, $calendar_attendees_fillable)) {
                            $calendar_attendees = $calendar_attendees->orWhere($field, "like", "%$request->search%");
                        }
                    }
                }
            }

            if ($request->get('show_pagination', 'true') == 'true') {
                $max_page = $request->get('max_page', 15);
                $calendar_attendees = $calendar_attendees->paginate($max_page);
            } else {
                $calendar_attendees = $calendar_attendees->get();
            }

            $calendar_attendees->map(function($calendar_attendees) use ($request){

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $calendar_attendees->calendar_event = $calendar_attendees->calendar_event ;
         $calendar_attendees->partner = $calendar_attendees->partner ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

                return $calendar_attendees ;
            });
            $calendar_attendees = $calendar_attendees->toArray();

            return ApiResponse::success(compact('calendar_attendees'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/calendar-attendee/{id}",
     *      operationId="ReadCalendarAttendee",
     *      tags={"Calendar Attendees"},
     *      summary="Read calendar_attendees",
     *      description="Read calendar_attendees",
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

            $calendar_attendees = CalendarAttendee::find($id);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $calendar_attendees->calendar_event = $calendar_attendees->calendar_event ;
         $calendar_attendees->partner = $calendar_attendees->partner ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('calendar_attendees'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Put(
     *      path="/module/hrm/v1/calendar-attendee/{id}",
     *      operationId="UpdateCalendarAttendee",
     *      tags={"Calendar Attendees"},
     *      summary="Update calendar_attendees",
     *      description="Update calendar_attendees",
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
     *          @OA\JsonContent(ref="#/components/schemas/CalendarAttendeeInput")
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
            $calendar_attendees_input = new CalendarAttendeeInput($request);
            $calendar_attendees = CalendarAttendee::find($id);

            $calendar_attendees->update([
                  'common_name' => $calendar_attendees_input->common_name == null ? $calendar_attendees->common_name : $calendar_attendees_input->common_name,
              'calendar_event_id' => $calendar_attendees_input->calendar_event_id == null ? $calendar_attendees->calendar_event_id : $calendar_attendees_input->calendar_event_id,
              'partner_id' => $calendar_attendees_input->partner_id == null ? $calendar_attendees->partner_id : $calendar_attendees_input->partner_id,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $calendar_attendees->calendar_event = $calendar_attendees->calendar_event ;
         $calendar_attendees->partner = $calendar_attendees->partner ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('calendar_attendees'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }


    /**
     * @OA\Delete(
     *      path="/module/hrm/v1/calendar-attendee/{id}",
     *      operationId="DeleteCalendarAttendee",
     *      tags={"Calendar Attendees"},
     *      summary="Delete calendar_attendees",
     *      description="Delete calendar_attendees",
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
            $calendar_attendees = CalendarAttendee::find($id);

            $calendar_attendees->delete();

            return ApiResponse::success();
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }
}

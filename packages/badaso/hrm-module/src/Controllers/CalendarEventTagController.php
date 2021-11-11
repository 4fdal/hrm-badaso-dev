<?php

namespace Uasoft\Badaso\Module\HRM\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\HRM\Models\CalendarEventTag;
use Uasoft\Badaso\Module\HRM\Schema\Inputs\CalendarEventTagInput;

class CalendarEventTagController extends Controller
{
    /**
     * @OA\Post(
     *      path="/module/hrm/v1/calendar-event-tag",
     *      operationId="AddCalendarEventTag",
     *      tags={"Calendar Event Tags"},
     *      summary="Add new calendar_event_tags",
     *      description="Add a new calendar_event_tags",
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
     *          @OA\JsonContent(ref="#/components/schemas/CalendarEventTagInput")
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
            $calendar_event_tags_input = new CalendarEventTagInput($request);

            $calendar_event_tags = CalendarEventTag::create([
                  'calendar_event_id' => $calendar_event_tags_input->calendar_event_id,
              'calendar_event_category_id' => $calendar_event_tags_input->calendar_event_category_id,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $calendar_event_tags->calendar_event = $calendar_event_tags->calendar_event ;
         $calendar_event_tags->calendar_event_category = $calendar_event_tags->calendar_event_category ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('calendar_event_tags'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/calendar-event-tag",
     *      operationId="BrowseCalendarEventTag",
     *      tags={"Calendar Event Tags"},
     *      summary="Browse calendar_event_tags",
     *      description="Browse calendar_event_tags",
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

            $calendar_event_tags = new CalendarEventTag();
            $calendar_event_tags_fillable = $calendar_event_tags->getFillable();

            $filter_fields = $request->get('filter_fields', '*');
            $filter_fields = explode(',', $filter_fields);
            if (array_search('*', $filter_fields) == false) {
                $new_filter_fields = [];
                foreach ($filter_fields as $index => $field) {
                    if (!in_array($field, $filter_fields)) {
                        $new_filter_fields[] = $field;
                    }
                }
                $calendar_event_tags = $calendar_event_tags->select($filter_fields);
            }

            $filter_fields_search = $request->get('filter_fields_search', '*');
            $filter_fields_search = explode(',', $filter_fields_search);
            if (isset($request->search)) {
                if (array_search('*', $filter_fields_search) == false) {
                    foreach ($calendar_event_tags_fillable as $index => $field) {
                        $calendar_event_tags = $calendar_event_tags->orWhere($field, "like", "%$request->search%");
                    }
                } else {
                    foreach ($filter_fields_search as $index => $field) {
                        if (in_array($field, $calendar_event_tags_fillable)) {
                            $calendar_event_tags = $calendar_event_tags->orWhere($field, "like", "%$request->search%");
                        }
                    }
                }
            }

            if ($request->get('show_pagination', 'true') == 'true') {
                $max_page = $request->get('max_page', 15);
                $calendar_event_tags = $calendar_event_tags->paginate($max_page);
            } else {
                $calendar_event_tags = $calendar_event_tags->get();
            }

            $calendar_event_tags->map(function($calendar_event_tags) use ($request){

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $calendar_event_tags->calendar_event = $calendar_event_tags->calendar_event ;
         $calendar_event_tags->calendar_event_category = $calendar_event_tags->calendar_event_category ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

                return $calendar_event_tags ;
            });
            $calendar_event_tags = $calendar_event_tags->toArray();

            return ApiResponse::success(compact('calendar_event_tags'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/calendar-event-tag/{id}",
     *      operationId="ReadCalendarEventTag",
     *      tags={"Calendar Event Tags"},
     *      summary="Read calendar_event_tags",
     *      description="Read calendar_event_tags",
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

            $calendar_event_tags = CalendarEventTag::find($id);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $calendar_event_tags->calendar_event = $calendar_event_tags->calendar_event ;
         $calendar_event_tags->calendar_event_category = $calendar_event_tags->calendar_event_category ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('calendar_event_tags'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Put(
     *      path="/module/hrm/v1/calendar-event-tag/{id}",
     *      operationId="UpdateCalendarEventTag",
     *      tags={"Calendar Event Tags"},
     *      summary="Update calendar_event_tags",
     *      description="Update calendar_event_tags",
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
     *          @OA\JsonContent(ref="#/components/schemas/CalendarEventTagInput")
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
            $calendar_event_tags_input = new CalendarEventTagInput($request);
            $calendar_event_tags = CalendarEventTag::find($id);

            $calendar_event_tags->update([
                  'calendar_event_id' => $calendar_event_tags_input->calendar_event_id == null ? $calendar_event_tags->calendar_event_id : $calendar_event_tags_input->calendar_event_id,
              'calendar_event_category_id' => $calendar_event_tags_input->calendar_event_category_id == null ? $calendar_event_tags->calendar_event_category_id : $calendar_event_tags_input->calendar_event_category_id,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $calendar_event_tags->calendar_event = $calendar_event_tags->calendar_event ;
         $calendar_event_tags->calendar_event_category = $calendar_event_tags->calendar_event_category ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('calendar_event_tags'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }


    /**
     * @OA\Delete(
     *      path="/module/hrm/v1/calendar-event-tag/{id}",
     *      operationId="DeleteCalendarEventTag",
     *      tags={"Calendar Event Tags"},
     *      summary="Delete calendar_event_tags",
     *      description="Delete calendar_event_tags",
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
            $calendar_event_tags = CalendarEventTag::find($id);

            $calendar_event_tags->delete();

            return ApiResponse::success();
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }
}

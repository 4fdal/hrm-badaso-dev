<?php

namespace Uasoft\Badaso\Module\HRM\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\HRM\Models\LunchAlert;
use Uasoft\Badaso\Module\HRM\Schema\Inputs\LunchAlertInput;

class LunchAlertController extends Controller
{
    /**
     * @OA\Post(
     *      path="/module/hrm/v1/lunch-alert",
     *      operationId="AddLunchAlert",
     *      tags={"Lunch Alerts"},
     *      summary="Add new lunch_alerts",
     *      description="Add a new lunch_alerts",
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
     *          @OA\JsonContent(ref="#/components/schemas/LunchAlertInput")
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
            $lunch_alerts_input = new LunchAlertInput($request);

            $lunch_alerts = LunchAlert::create([
                  'name' => $lunch_alerts_input->name,
              'message' => $lunch_alerts_input->message,
              'display_mode' => $lunch_alerts_input->display_mode,
              'show_until' => $lunch_alerts_input->show_until,
              'is_recurrent_monday' => $lunch_alerts_input->is_recurrent_monday,
              'is_recurrent_tuesday' => $lunch_alerts_input->is_recurrent_tuesday,
              'is_recurrent_wednesday' => $lunch_alerts_input->is_recurrent_wednesday,
              'is_recurrent_thursday' => $lunch_alerts_input->is_recurrent_thursday,
              'is_recurrent_friday' => $lunch_alerts_input->is_recurrent_friday,
              'is_recurrent_saturday' => $lunch_alerts_input->is_recurrent_saturday,
              'is_recurrent_sunday' => $lunch_alerts_input->is_recurrent_sunday,
              'is_active' => $lunch_alerts_input->is_active,
              'timezone' => $lunch_alerts_input->timezone,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
    
            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $lunch_alerts->lunch_alert_lunch_alert_locations = $lunch_alerts->lunchAlertLunchAlertLocations ;
 
            }

            return ApiResponse::success(compact('lunch_alerts'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/lunch-alert",
     *      operationId="BrowseLunchAlert",
     *      tags={"Lunch Alerts"},
     *      summary="Browse lunch_alerts",
     *      description="Browse lunch_alerts",
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

            $lunch_alerts = new LunchAlert();
            $lunch_alerts_fillable = $lunch_alerts->getFillable();

            $filter_fields = $request->get('filter_fields', '*');
            $filter_fields = explode(',', $filter_fields);
            if (array_search('*', $filter_fields) == false) {
                $new_filter_fields = [];
                foreach ($filter_fields as $index => $field) {
                    if (!in_array($field, $filter_fields)) {
                        $new_filter_fields[] = $field;
                    }
                }
                $lunch_alerts = $lunch_alerts->select($filter_fields);
            }

            $filter_fields_search = $request->get('filter_fields_search', '*');
            $filter_fields_search = explode(',', $filter_fields_search);
            if (isset($request->search)) {
                if (array_search('*', $filter_fields_search) == false) {
                    foreach ($lunch_alerts_fillable as $index => $field) {
                        $lunch_alerts = $lunch_alerts->orWhere($field, "like", "%$request->search%");
                    }
                } else {
                    foreach ($filter_fields_search as $index => $field) {
                        if (in_array($field, $lunch_alerts_fillable)) {
                            $lunch_alerts = $lunch_alerts->orWhere($field, "like", "%$request->search%");
                        }
                    }
                }
            }

            if ($request->get('show_pagination', 'true') == 'true') {
                $max_page = $request->get('max_page', 15);
                $lunch_alerts = $lunch_alerts->paginate($max_page);
            } else {
                $lunch_alerts = $lunch_alerts->get();
            }

            $lunch_alerts->map(function($lunch_alerts) use ($request){

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
    
            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $lunch_alerts->lunch_alert_lunch_alert_locations = $lunch_alerts->lunchAlertLunchAlertLocations ;
 
            }

                return $lunch_alerts ;
            });
            $lunch_alerts = $lunch_alerts->toArray();

            return ApiResponse::success(compact('lunch_alerts'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/lunch-alert/{id}",
     *      operationId="ReadLunchAlert",
     *      tags={"Lunch Alerts"},
     *      summary="Read lunch_alerts",
     *      description="Read lunch_alerts",
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

            $lunch_alerts = LunchAlert::find($id);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
    
            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $lunch_alerts->lunch_alert_lunch_alert_locations = $lunch_alerts->lunchAlertLunchAlertLocations ;
 
            }

            return ApiResponse::success(compact('lunch_alerts'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Put(
     *      path="/module/hrm/v1/lunch-alert/{id}",
     *      operationId="UpdateLunchAlert",
     *      tags={"Lunch Alerts"},
     *      summary="Update lunch_alerts",
     *      description="Update lunch_alerts",
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
     *          @OA\JsonContent(ref="#/components/schemas/LunchAlertInput")
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
            $lunch_alerts_input = new LunchAlertInput($request);
            $lunch_alerts = LunchAlert::find($id);

            $lunch_alerts->update([
                  'name' => $lunch_alerts_input->name == null ? $lunch_alerts->name : $lunch_alerts_input->name,
              'message' => $lunch_alerts_input->message == null ? $lunch_alerts->message : $lunch_alerts_input->message,
              'display_mode' => $lunch_alerts_input->display_mode == null ? $lunch_alerts->display_mode : $lunch_alerts_input->display_mode,
              'show_until' => $lunch_alerts_input->show_until == null ? $lunch_alerts->show_until : $lunch_alerts_input->show_until,
              'is_recurrent_monday' => $lunch_alerts_input->is_recurrent_monday == null ? $lunch_alerts->is_recurrent_monday : $lunch_alerts_input->is_recurrent_monday,
              'is_recurrent_tuesday' => $lunch_alerts_input->is_recurrent_tuesday == null ? $lunch_alerts->is_recurrent_tuesday : $lunch_alerts_input->is_recurrent_tuesday,
              'is_recurrent_wednesday' => $lunch_alerts_input->is_recurrent_wednesday == null ? $lunch_alerts->is_recurrent_wednesday : $lunch_alerts_input->is_recurrent_wednesday,
              'is_recurrent_thursday' => $lunch_alerts_input->is_recurrent_thursday == null ? $lunch_alerts->is_recurrent_thursday : $lunch_alerts_input->is_recurrent_thursday,
              'is_recurrent_friday' => $lunch_alerts_input->is_recurrent_friday == null ? $lunch_alerts->is_recurrent_friday : $lunch_alerts_input->is_recurrent_friday,
              'is_recurrent_saturday' => $lunch_alerts_input->is_recurrent_saturday == null ? $lunch_alerts->is_recurrent_saturday : $lunch_alerts_input->is_recurrent_saturday,
              'is_recurrent_sunday' => $lunch_alerts_input->is_recurrent_sunday == null ? $lunch_alerts->is_recurrent_sunday : $lunch_alerts_input->is_recurrent_sunday,
              'is_active' => $lunch_alerts_input->is_active == null ? $lunch_alerts->is_active : $lunch_alerts_input->is_active,
              'timezone' => $lunch_alerts_input->timezone == null ? $lunch_alerts->timezone : $lunch_alerts_input->timezone,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
    
            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $lunch_alerts->lunch_alert_lunch_alert_locations = $lunch_alerts->lunchAlertLunchAlertLocations ;
 
            }

            return ApiResponse::success(compact('lunch_alerts'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }


    /**
     * @OA\Delete(
     *      path="/module/hrm/v1/lunch-alert/{id}",
     *      operationId="DeleteLunchAlert",
     *      tags={"Lunch Alerts"},
     *      summary="Delete lunch_alerts",
     *      description="Delete lunch_alerts",
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
            $lunch_alerts = LunchAlert::find($id);

            $lunch_alerts->delete();

            return ApiResponse::success();
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }
}

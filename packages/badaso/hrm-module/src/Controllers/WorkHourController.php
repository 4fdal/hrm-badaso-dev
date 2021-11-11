<?php

namespace Uasoft\Badaso\Module\HRM\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\HRM\Models\WorkHour;
use Uasoft\Badaso\Module\HRM\Schema\Inputs\WorkHourInput;

class WorkHourController extends Controller
{
    /**
     * @OA\Post(
     *      path="/module/hrm/v1/work-hour",
     *      operationId="AddWorkHour",
     *      tags={"Work Hours"},
     *      summary="Add new work_hours",
     *      description="Add a new work_hours",
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
     *          @OA\JsonContent(ref="#/components/schemas/WorkHourInput")
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
            $work_hours_input = new WorkHourInput($request);

            $work_hours = WorkHour::create([
                  'work_id' => $work_hours_input->work_id,
              'name' => $work_hours_input->name,
              'day_of_week' => $work_hours_input->day_of_week,
              'day_period' => $work_hours_input->day_period,
              'work_from' => $work_hours_input->work_from,
              'work_to' => $work_hours_input->work_to,
              'start_date' => $work_hours_input->start_date,
              'end_date' => $work_hours_input->end_date,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $work_hours->work = $work_hours->work ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('work_hours'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/work-hour",
     *      operationId="BrowseWorkHour",
     *      tags={"Work Hours"},
     *      summary="Browse work_hours",
     *      description="Browse work_hours",
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

            $work_hours = new WorkHour();
            $work_hours_fillable = $work_hours->getFillable();

            $filter_fields = $request->get('filter_fields', '*');
            $filter_fields = explode(',', $filter_fields);
            if (array_search('*', $filter_fields) == false) {
                $new_filter_fields = [];
                foreach ($filter_fields as $index => $field) {
                    if (!in_array($field, $filter_fields)) {
                        $new_filter_fields[] = $field;
                    }
                }
                $work_hours = $work_hours->select($filter_fields);
            }

            $filter_fields_search = $request->get('filter_fields_search', '*');
            $filter_fields_search = explode(',', $filter_fields_search);
            if (isset($request->search)) {
                if (array_search('*', $filter_fields_search) == false) {
                    foreach ($work_hours_fillable as $index => $field) {
                        $work_hours = $work_hours->orWhere($field, "like", "%$request->search%");
                    }
                } else {
                    foreach ($filter_fields_search as $index => $field) {
                        if (in_array($field, $work_hours_fillable)) {
                            $work_hours = $work_hours->orWhere($field, "like", "%$request->search%");
                        }
                    }
                }
            }

            if ($request->get('show_pagination', 'true') == 'true') {
                $max_page = $request->get('max_page', 15);
                $work_hours = $work_hours->paginate($max_page);
            } else {
                $work_hours = $work_hours->get();
            }

            $work_hours->map(function($work_hours) use ($request){

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $work_hours->work = $work_hours->work ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

                return $work_hours ;
            });
            $work_hours = $work_hours->toArray();

            return ApiResponse::success(compact('work_hours'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/work-hour/{id}",
     *      operationId="ReadWorkHour",
     *      tags={"Work Hours"},
     *      summary="Read work_hours",
     *      description="Read work_hours",
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

            $work_hours = WorkHour::find($id);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $work_hours->work = $work_hours->work ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('work_hours'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Put(
     *      path="/module/hrm/v1/work-hour/{id}",
     *      operationId="UpdateWorkHour",
     *      tags={"Work Hours"},
     *      summary="Update work_hours",
     *      description="Update work_hours",
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
     *          @OA\JsonContent(ref="#/components/schemas/WorkHourInput")
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
            $work_hours_input = new WorkHourInput($request);
            $work_hours = WorkHour::find($id);

            $work_hours->update([
                  'work_id' => $work_hours_input->work_id == null ? $work_hours->work_id : $work_hours_input->work_id,
              'name' => $work_hours_input->name == null ? $work_hours->name : $work_hours_input->name,
              'day_of_week' => $work_hours_input->day_of_week == null ? $work_hours->day_of_week : $work_hours_input->day_of_week,
              'day_period' => $work_hours_input->day_period == null ? $work_hours->day_period : $work_hours_input->day_period,
              'work_from' => $work_hours_input->work_from == null ? $work_hours->work_from : $work_hours_input->work_from,
              'work_to' => $work_hours_input->work_to == null ? $work_hours->work_to : $work_hours_input->work_to,
              'start_date' => $work_hours_input->start_date == null ? $work_hours->start_date : $work_hours_input->start_date,
              'end_date' => $work_hours_input->end_date == null ? $work_hours->end_date : $work_hours_input->end_date,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $work_hours->work = $work_hours->work ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('work_hours'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }


    /**
     * @OA\Delete(
     *      path="/module/hrm/v1/work-hour/{id}",
     *      operationId="DeleteWorkHour",
     *      tags={"Work Hours"},
     *      summary="Delete work_hours",
     *      description="Delete work_hours",
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
            $work_hours = WorkHour::find($id);

            $work_hours->delete();

            return ApiResponse::success();
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }
}

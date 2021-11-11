<?php

namespace Uasoft\Badaso\Module\HRM\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\HRM\Models\Worke;
use Uasoft\Badaso\Module\HRM\Schema\Inputs\WorkeInput;

class WorkeController extends Controller
{
    /**
     * @OA\Post(
     *      path="/module/hrm/v1/worke",
     *      operationId="AddWorke",
     *      tags={"Workes"},
     *      summary="Add new workes",
     *      description="Add a new workes",
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
     *          @OA\JsonContent(ref="#/components/schemas/WorkeInput")
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
            $workes_input = new WorkeInput($request);

            $workes = Worke::create([
                  'company_id' => $workes_input->company_id,
              'average_hours_per_day' => $workes_input->average_hours_per_day,
              'timezone' => $workes_input->timezone,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $workes->company = $workes->company ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $workes->work_work_hours = $workes->workWorkHours ;
            $workes->worke_global_time_offs = $workes->workeGlobalTimeOffs ;
            $workes->work_employees = $workes->workEmployees ;
 
            }

            return ApiResponse::success(compact('workes'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/worke",
     *      operationId="BrowseWorke",
     *      tags={"Workes"},
     *      summary="Browse workes",
     *      description="Browse workes",
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

            $workes = new Worke();
            $workes_fillable = $workes->getFillable();

            $filter_fields = $request->get('filter_fields', '*');
            $filter_fields = explode(',', $filter_fields);
            if (array_search('*', $filter_fields) == false) {
                $new_filter_fields = [];
                foreach ($filter_fields as $index => $field) {
                    if (!in_array($field, $filter_fields)) {
                        $new_filter_fields[] = $field;
                    }
                }
                $workes = $workes->select($filter_fields);
            }

            $filter_fields_search = $request->get('filter_fields_search', '*');
            $filter_fields_search = explode(',', $filter_fields_search);
            if (isset($request->search)) {
                if (array_search('*', $filter_fields_search) == false) {
                    foreach ($workes_fillable as $index => $field) {
                        $workes = $workes->orWhere($field, "like", "%$request->search%");
                    }
                } else {
                    foreach ($filter_fields_search as $index => $field) {
                        if (in_array($field, $workes_fillable)) {
                            $workes = $workes->orWhere($field, "like", "%$request->search%");
                        }
                    }
                }
            }

            if ($request->get('show_pagination', 'true') == 'true') {
                $max_page = $request->get('max_page', 15);
                $workes = $workes->paginate($max_page);
            } else {
                $workes = $workes->get();
            }

            $workes->map(function($workes) use ($request){

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $workes->company = $workes->company ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $workes->work_work_hours = $workes->workWorkHours ;
            $workes->worke_global_time_offs = $workes->workeGlobalTimeOffs ;
            $workes->work_employees = $workes->workEmployees ;
 
            }

                return $workes ;
            });
            $workes = $workes->toArray();

            return ApiResponse::success(compact('workes'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/worke/{id}",
     *      operationId="ReadWorke",
     *      tags={"Workes"},
     *      summary="Read workes",
     *      description="Read workes",
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

            $workes = Worke::find($id);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $workes->company = $workes->company ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $workes->work_work_hours = $workes->workWorkHours ;
            $workes->worke_global_time_offs = $workes->workeGlobalTimeOffs ;
            $workes->work_employees = $workes->workEmployees ;
 
            }

            return ApiResponse::success(compact('workes'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Put(
     *      path="/module/hrm/v1/worke/{id}",
     *      operationId="UpdateWorke",
     *      tags={"Workes"},
     *      summary="Update workes",
     *      description="Update workes",
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
     *          @OA\JsonContent(ref="#/components/schemas/WorkeInput")
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
            $workes_input = new WorkeInput($request);
            $workes = Worke::find($id);

            $workes->update([
                  'company_id' => $workes_input->company_id == null ? $workes->company_id : $workes_input->company_id,
              'average_hours_per_day' => $workes_input->average_hours_per_day == null ? $workes->average_hours_per_day : $workes_input->average_hours_per_day,
              'timezone' => $workes_input->timezone == null ? $workes->timezone : $workes_input->timezone,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $workes->company = $workes->company ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $workes->work_work_hours = $workes->workWorkHours ;
            $workes->worke_global_time_offs = $workes->workeGlobalTimeOffs ;
            $workes->work_employees = $workes->workEmployees ;
 
            }

            return ApiResponse::success(compact('workes'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }


    /**
     * @OA\Delete(
     *      path="/module/hrm/v1/worke/{id}",
     *      operationId="DeleteWorke",
     *      tags={"Workes"},
     *      summary="Delete workes",
     *      description="Delete workes",
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
            $workes = Worke::find($id);

            $workes->delete();

            return ApiResponse::success();
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }
}

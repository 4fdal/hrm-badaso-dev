<?php

namespace Uasoft\Badaso\Module\HRM\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\HRM\Models\Departement;
use Uasoft\Badaso\Module\HRM\Schema\Inputs\DepartementInput;

class DepartementController extends Controller
{
    /**
     * @OA\Post(
     *      path="/module/hrm/v1/departement",
     *      operationId="AddDepartement",
     *      tags={"Departements"},
     *      summary="Add new departements",
     *      description="Add a new departements",
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
     *          @OA\JsonContent(ref="#/components/schemas/DepartementInput")
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
            $departements_input = new DepartementInput($request);

            $departements = Departement::create([
                  'name' => $departements_input->name,
              'complete_name' => $departements_input->complete_name,
              'is_active' => $departements_input->is_active,
              'company_id' => $departements_input->company_id,
              'parent_id' => $departements_input->parent_id,
              'manager_id' => $departements_input->manager_id,
              'note' => $departements_input->note,
              'color' => $departements_input->color,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $departements->company = $departements->company ;
         $departements->parent = $departements->parent ;
         $departements->manager = $departements->manager ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $departements->parent_departements = $departements->parentDepartements ;
            $departements->departement_jobs = $departements->departementJobs ;
            $departements->departement_applicants = $departements->departementApplicants ;
            $departements->for_departement_time_off_allocations = $departements->forDepartementTimeOffAllocations ;
            $departements->departement_time_offs = $departements->departementTimeOffs ;
 
            }

            return ApiResponse::success(compact('departements'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/departement",
     *      operationId="BrowseDepartement",
     *      tags={"Departements"},
     *      summary="Browse departements",
     *      description="Browse departements",
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

            $departements = new Departement();
            $departements_fillable = $departements->getFillable();

            $filter_fields = $request->get('filter_fields', '*');
            $filter_fields = explode(',', $filter_fields);
            if (array_search('*', $filter_fields) == false) {
                $new_filter_fields = [];
                foreach ($filter_fields as $index => $field) {
                    if (!in_array($field, $filter_fields)) {
                        $new_filter_fields[] = $field;
                    }
                }
                $departements = $departements->select($filter_fields);
            }

            $filter_fields_search = $request->get('filter_fields_search', '*');
            $filter_fields_search = explode(',', $filter_fields_search);
            if (isset($request->search)) {
                if (array_search('*', $filter_fields_search) == false) {
                    foreach ($departements_fillable as $index => $field) {
                        $departements = $departements->orWhere($field, "like", "%$request->search%");
                    }
                } else {
                    foreach ($filter_fields_search as $index => $field) {
                        if (in_array($field, $departements_fillable)) {
                            $departements = $departements->orWhere($field, "like", "%$request->search%");
                        }
                    }
                }
            }

            if ($request->get('show_pagination', 'true') == 'true') {
                $max_page = $request->get('max_page', 15);
                $departements = $departements->paginate($max_page);
            } else {
                $departements = $departements->get();
            }

            $departements->map(function($departements) use ($request){

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $departements->company = $departements->company ;
         $departements->parent = $departements->parent ;
         $departements->manager = $departements->manager ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $departements->parent_departements = $departements->parentDepartements ;
            $departements->departement_jobs = $departements->departementJobs ;
            $departements->departement_applicants = $departements->departementApplicants ;
            $departements->for_departement_time_off_allocations = $departements->forDepartementTimeOffAllocations ;
            $departements->departement_time_offs = $departements->departementTimeOffs ;
 
            }

                return $departements ;
            });
            $departements = $departements->toArray();

            return ApiResponse::success(compact('departements'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/departement/{id}",
     *      operationId="ReadDepartement",
     *      tags={"Departements"},
     *      summary="Read departements",
     *      description="Read departements",
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

            $departements = Departement::find($id);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $departements->company = $departements->company ;
         $departements->parent = $departements->parent ;
         $departements->manager = $departements->manager ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $departements->parent_departements = $departements->parentDepartements ;
            $departements->departement_jobs = $departements->departementJobs ;
            $departements->departement_applicants = $departements->departementApplicants ;
            $departements->for_departement_time_off_allocations = $departements->forDepartementTimeOffAllocations ;
            $departements->departement_time_offs = $departements->departementTimeOffs ;
 
            }

            return ApiResponse::success(compact('departements'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Put(
     *      path="/module/hrm/v1/departement/{id}",
     *      operationId="UpdateDepartement",
     *      tags={"Departements"},
     *      summary="Update departements",
     *      description="Update departements",
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
     *          @OA\JsonContent(ref="#/components/schemas/DepartementInput")
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
            $departements_input = new DepartementInput($request);
            $departements = Departement::find($id);

            $departements->update([
                  'name' => $departements_input->name == null ? $departements->name : $departements_input->name,
              'complete_name' => $departements_input->complete_name == null ? $departements->complete_name : $departements_input->complete_name,
              'is_active' => $departements_input->is_active == null ? $departements->is_active : $departements_input->is_active,
              'company_id' => $departements_input->company_id == null ? $departements->company_id : $departements_input->company_id,
              'parent_id' => $departements_input->parent_id == null ? $departements->parent_id : $departements_input->parent_id,
              'manager_id' => $departements_input->manager_id == null ? $departements->manager_id : $departements_input->manager_id,
              'note' => $departements_input->note == null ? $departements->note : $departements_input->note,
              'color' => $departements_input->color == null ? $departements->color : $departements_input->color,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $departements->company = $departements->company ;
         $departements->parent = $departements->parent ;
         $departements->manager = $departements->manager ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $departements->parent_departements = $departements->parentDepartements ;
            $departements->departement_jobs = $departements->departementJobs ;
            $departements->departement_applicants = $departements->departementApplicants ;
            $departements->for_departement_time_off_allocations = $departements->forDepartementTimeOffAllocations ;
            $departements->departement_time_offs = $departements->departementTimeOffs ;
 
            }

            return ApiResponse::success(compact('departements'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }


    /**
     * @OA\Delete(
     *      path="/module/hrm/v1/departement/{id}",
     *      operationId="DeleteDepartement",
     *      tags={"Departements"},
     *      summary="Delete departements",
     *      description="Delete departements",
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
            $departements = Departement::find($id);

            $departements->delete();

            return ApiResponse::success();
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }
}

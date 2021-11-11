<?php

namespace Uasoft\Badaso\Module\HRM\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\HRM\Models\FleetContractService;
use Uasoft\Badaso\Module\HRM\Schema\Inputs\FleetContractServiceInput;

class FleetContractServiceController extends Controller
{
    /**
     * @OA\Post(
     *      path="/module/hrm/v1/fleet-contract-service",
     *      operationId="AddFleetContractService",
     *      tags={"Fleet Contract Services"},
     *      summary="Add new fleet_contract_services",
     *      description="Add a new fleet_contract_services",
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
     *          @OA\JsonContent(ref="#/components/schemas/FleetContractServiceInput")
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
            $fleet_contract_services_input = new FleetContractServiceInput($request);

            $fleet_contract_services = FleetContractService::create([
                  'fleet_contract_id' => $fleet_contract_services_input->fleet_contract_id,
              'fleet_service_type_id' => $fleet_contract_services_input->fleet_service_type_id,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $fleet_contract_services->fleet_contract = $fleet_contract_services->fleet_contract ;
         $fleet_contract_services->fleet_service_type = $fleet_contract_services->fleet_service_type ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('fleet_contract_services'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/fleet-contract-service",
     *      operationId="BrowseFleetContractService",
     *      tags={"Fleet Contract Services"},
     *      summary="Browse fleet_contract_services",
     *      description="Browse fleet_contract_services",
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

            $fleet_contract_services = new FleetContractService();
            $fleet_contract_services_fillable = $fleet_contract_services->getFillable();

            $filter_fields = $request->get('filter_fields', '*');
            $filter_fields = explode(',', $filter_fields);
            if (array_search('*', $filter_fields) == false) {
                $new_filter_fields = [];
                foreach ($filter_fields as $index => $field) {
                    if (!in_array($field, $filter_fields)) {
                        $new_filter_fields[] = $field;
                    }
                }
                $fleet_contract_services = $fleet_contract_services->select($filter_fields);
            }

            $filter_fields_search = $request->get('filter_fields_search', '*');
            $filter_fields_search = explode(',', $filter_fields_search);
            if (isset($request->search)) {
                if (array_search('*', $filter_fields_search) == false) {
                    foreach ($fleet_contract_services_fillable as $index => $field) {
                        $fleet_contract_services = $fleet_contract_services->orWhere($field, "like", "%$request->search%");
                    }
                } else {
                    foreach ($filter_fields_search as $index => $field) {
                        if (in_array($field, $fleet_contract_services_fillable)) {
                            $fleet_contract_services = $fleet_contract_services->orWhere($field, "like", "%$request->search%");
                        }
                    }
                }
            }

            if ($request->get('show_pagination', 'true') == 'true') {
                $max_page = $request->get('max_page', 15);
                $fleet_contract_services = $fleet_contract_services->paginate($max_page);
            } else {
                $fleet_contract_services = $fleet_contract_services->get();
            }

            $fleet_contract_services->map(function($fleet_contract_services) use ($request){

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $fleet_contract_services->fleet_contract = $fleet_contract_services->fleet_contract ;
         $fleet_contract_services->fleet_service_type = $fleet_contract_services->fleet_service_type ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

                return $fleet_contract_services ;
            });
            $fleet_contract_services = $fleet_contract_services->toArray();

            return ApiResponse::success(compact('fleet_contract_services'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/fleet-contract-service/{id}",
     *      operationId="ReadFleetContractService",
     *      tags={"Fleet Contract Services"},
     *      summary="Read fleet_contract_services",
     *      description="Read fleet_contract_services",
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

            $fleet_contract_services = FleetContractService::find($id);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $fleet_contract_services->fleet_contract = $fleet_contract_services->fleet_contract ;
         $fleet_contract_services->fleet_service_type = $fleet_contract_services->fleet_service_type ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('fleet_contract_services'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Put(
     *      path="/module/hrm/v1/fleet-contract-service/{id}",
     *      operationId="UpdateFleetContractService",
     *      tags={"Fleet Contract Services"},
     *      summary="Update fleet_contract_services",
     *      description="Update fleet_contract_services",
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
     *          @OA\JsonContent(ref="#/components/schemas/FleetContractServiceInput")
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
            $fleet_contract_services_input = new FleetContractServiceInput($request);
            $fleet_contract_services = FleetContractService::find($id);

            $fleet_contract_services->update([
                  'fleet_contract_id' => $fleet_contract_services_input->fleet_contract_id == null ? $fleet_contract_services->fleet_contract_id : $fleet_contract_services_input->fleet_contract_id,
              'fleet_service_type_id' => $fleet_contract_services_input->fleet_service_type_id == null ? $fleet_contract_services->fleet_service_type_id : $fleet_contract_services_input->fleet_service_type_id,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $fleet_contract_services->fleet_contract = $fleet_contract_services->fleet_contract ;
         $fleet_contract_services->fleet_service_type = $fleet_contract_services->fleet_service_type ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
    
            }

            return ApiResponse::success(compact('fleet_contract_services'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }


    /**
     * @OA\Delete(
     *      path="/module/hrm/v1/fleet-contract-service/{id}",
     *      operationId="DeleteFleetContractService",
     *      tags={"Fleet Contract Services"},
     *      summary="Delete fleet_contract_services",
     *      description="Delete fleet_contract_services",
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
            $fleet_contract_services = FleetContractService::find($id);

            $fleet_contract_services->delete();

            return ApiResponse::success();
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }
}

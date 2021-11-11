<?php

namespace Uasoft\Badaso\Module\HRM\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\HRM\Models\LunchVendor;
use Uasoft\Badaso\Module\HRM\Schema\Inputs\LunchVendorInput;

class LunchVendorController extends Controller
{
    /**
     * @OA\Post(
     *      path="/module/hrm/v1/lunch-vendor",
     *      operationId="AddLunchVendor",
     *      tags={"Lunch Vendors"},
     *      summary="Add new lunch_vendors",
     *      description="Add a new lunch_vendors",
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
     *          @OA\JsonContent(ref="#/components/schemas/LunchVendorInput")
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
            $lunch_vendors_input = new LunchVendorInput($request);

            $lunch_vendors = LunchVendor::create([
                  'partner_id' => $lunch_vendors_input->partner_id,
              'company_id' => $lunch_vendors_input->company_id,
              'responsible_user_id' => $lunch_vendors_input->responsible_user_id,
              'send_by' => $lunch_vendors_input->send_by,
              'automatic_email_time' => $lunch_vendors_input->automatic_email_time,
              'is_recurrent_monday' => $lunch_vendors_input->is_recurrent_monday,
              'is_recurrent_tuesday' => $lunch_vendors_input->is_recurrent_tuesday,
              'is_recurrent_wednesday' => $lunch_vendors_input->is_recurrent_wednesday,
              'is_recurrent_thursday' => $lunch_vendors_input->is_recurrent_thursday,
              'is_recurrent_friday' => $lunch_vendors_input->is_recurrent_friday,
              'is_recurrent_saturday' => $lunch_vendors_input->is_recurrent_saturday,
              'is_recurrent_sunday' => $lunch_vendors_input->is_recurrent_sunday,
              'timezone' => $lunch_vendors_input->timezone,
              'is_active' => $lunch_vendors_input->is_active,
              'moment' => $lunch_vendors_input->moment,
              'delivery' => $lunch_vendors_input->delivery,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $lunch_vendors->partner = $lunch_vendors->partner ;
         $lunch_vendors->company = $lunch_vendors->company ;
         $lunch_vendors->responsible_user = $lunch_vendors->responsible_user ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $lunch_vendors->lunch_vendor_lunch_vendors_location_orders = $lunch_vendors->lunchVendorLunchVendorsLocationOrders ;
            $lunch_vendors->lunch_vendor_lunch_products = $lunch_vendors->lunchVendorLunchProducts ;
 
            }

            return ApiResponse::success(compact('lunch_vendors'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/lunch-vendor",
     *      operationId="BrowseLunchVendor",
     *      tags={"Lunch Vendors"},
     *      summary="Browse lunch_vendors",
     *      description="Browse lunch_vendors",
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

            $lunch_vendors = new LunchVendor();
            $lunch_vendors_fillable = $lunch_vendors->getFillable();

            $filter_fields = $request->get('filter_fields', '*');
            $filter_fields = explode(',', $filter_fields);
            if (array_search('*', $filter_fields) == false) {
                $new_filter_fields = [];
                foreach ($filter_fields as $index => $field) {
                    if (!in_array($field, $filter_fields)) {
                        $new_filter_fields[] = $field;
                    }
                }
                $lunch_vendors = $lunch_vendors->select($filter_fields);
            }

            $filter_fields_search = $request->get('filter_fields_search', '*');
            $filter_fields_search = explode(',', $filter_fields_search);
            if (isset($request->search)) {
                if (array_search('*', $filter_fields_search) == false) {
                    foreach ($lunch_vendors_fillable as $index => $field) {
                        $lunch_vendors = $lunch_vendors->orWhere($field, "like", "%$request->search%");
                    }
                } else {
                    foreach ($filter_fields_search as $index => $field) {
                        if (in_array($field, $lunch_vendors_fillable)) {
                            $lunch_vendors = $lunch_vendors->orWhere($field, "like", "%$request->search%");
                        }
                    }
                }
            }

            if ($request->get('show_pagination', 'true') == 'true') {
                $max_page = $request->get('max_page', 15);
                $lunch_vendors = $lunch_vendors->paginate($max_page);
            } else {
                $lunch_vendors = $lunch_vendors->get();
            }

            $lunch_vendors->map(function($lunch_vendors) use ($request){

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $lunch_vendors->partner = $lunch_vendors->partner ;
         $lunch_vendors->company = $lunch_vendors->company ;
         $lunch_vendors->responsible_user = $lunch_vendors->responsible_user ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $lunch_vendors->lunch_vendor_lunch_vendors_location_orders = $lunch_vendors->lunchVendorLunchVendorsLocationOrders ;
            $lunch_vendors->lunch_vendor_lunch_products = $lunch_vendors->lunchVendorLunchProducts ;
 
            }

                return $lunch_vendors ;
            });
            $lunch_vendors = $lunch_vendors->toArray();

            return ApiResponse::success(compact('lunch_vendors'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Get(
     *      path="/module/hrm/v1/lunch-vendor/{id}",
     *      operationId="ReadLunchVendor",
     *      tags={"Lunch Vendors"},
     *      summary="Read lunch_vendors",
     *      description="Read lunch_vendors",
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

            $lunch_vendors = LunchVendor::find($id);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $lunch_vendors->partner = $lunch_vendors->partner ;
         $lunch_vendors->company = $lunch_vendors->company ;
         $lunch_vendors->responsible_user = $lunch_vendors->responsible_user ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $lunch_vendors->lunch_vendor_lunch_vendors_location_orders = $lunch_vendors->lunchVendorLunchVendorsLocationOrders ;
            $lunch_vendors->lunch_vendor_lunch_products = $lunch_vendors->lunchVendorLunchProducts ;
 
            }

            return ApiResponse::success(compact('lunch_vendors'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    /**
     * @OA\Put(
     *      path="/module/hrm/v1/lunch-vendor/{id}",
     *      operationId="UpdateLunchVendor",
     *      tags={"Lunch Vendors"},
     *      summary="Update lunch_vendors",
     *      description="Update lunch_vendors",
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
     *          @OA\JsonContent(ref="#/components/schemas/LunchVendorInput")
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
            $lunch_vendors_input = new LunchVendorInput($request);
            $lunch_vendors = LunchVendor::find($id);

            $lunch_vendors->update([
                  'partner_id' => $lunch_vendors_input->partner_id == null ? $lunch_vendors->partner_id : $lunch_vendors_input->partner_id,
              'company_id' => $lunch_vendors_input->company_id == null ? $lunch_vendors->company_id : $lunch_vendors_input->company_id,
              'responsible_user_id' => $lunch_vendors_input->responsible_user_id == null ? $lunch_vendors->responsible_user_id : $lunch_vendors_input->responsible_user_id,
              'send_by' => $lunch_vendors_input->send_by == null ? $lunch_vendors->send_by : $lunch_vendors_input->send_by,
              'automatic_email_time' => $lunch_vendors_input->automatic_email_time == null ? $lunch_vendors->automatic_email_time : $lunch_vendors_input->automatic_email_time,
              'is_recurrent_monday' => $lunch_vendors_input->is_recurrent_monday == null ? $lunch_vendors->is_recurrent_monday : $lunch_vendors_input->is_recurrent_monday,
              'is_recurrent_tuesday' => $lunch_vendors_input->is_recurrent_tuesday == null ? $lunch_vendors->is_recurrent_tuesday : $lunch_vendors_input->is_recurrent_tuesday,
              'is_recurrent_wednesday' => $lunch_vendors_input->is_recurrent_wednesday == null ? $lunch_vendors->is_recurrent_wednesday : $lunch_vendors_input->is_recurrent_wednesday,
              'is_recurrent_thursday' => $lunch_vendors_input->is_recurrent_thursday == null ? $lunch_vendors->is_recurrent_thursday : $lunch_vendors_input->is_recurrent_thursday,
              'is_recurrent_friday' => $lunch_vendors_input->is_recurrent_friday == null ? $lunch_vendors->is_recurrent_friday : $lunch_vendors_input->is_recurrent_friday,
              'is_recurrent_saturday' => $lunch_vendors_input->is_recurrent_saturday == null ? $lunch_vendors->is_recurrent_saturday : $lunch_vendors_input->is_recurrent_saturday,
              'is_recurrent_sunday' => $lunch_vendors_input->is_recurrent_sunday == null ? $lunch_vendors->is_recurrent_sunday : $lunch_vendors_input->is_recurrent_sunday,
              'timezone' => $lunch_vendors_input->timezone == null ? $lunch_vendors->timezone : $lunch_vendors_input->timezone,
              'is_active' => $lunch_vendors_input->is_active == null ? $lunch_vendors->is_active : $lunch_vendors_input->is_active,
              'moment' => $lunch_vendors_input->moment == null ? $lunch_vendors->moment : $lunch_vendors_input->moment,
              'delivery' => $lunch_vendors_input->delivery == null ? $lunch_vendors->delivery : $lunch_vendors_input->delivery,

            ]);

            if($request->get("show_belogsto_relation", "false") == "true") {
                // belogs to relation
             $lunch_vendors->partner = $lunch_vendors->partner ;
         $lunch_vendors->company = $lunch_vendors->company ;
         $lunch_vendors->responsible_user = $lunch_vendors->responsible_user ;

            }

            if($request->get("show_hasmany_relation", "false") == "true") {
                // has many relation
               $lunch_vendors->lunch_vendor_lunch_vendors_location_orders = $lunch_vendors->lunchVendorLunchVendorsLocationOrders ;
            $lunch_vendors->lunch_vendor_lunch_products = $lunch_vendors->lunchVendorLunchProducts ;
 
            }

            return ApiResponse::success(compact('lunch_vendors'));
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }


    /**
     * @OA\Delete(
     *      path="/module/hrm/v1/lunch-vendor/{id}",
     *      operationId="DeleteLunchVendor",
     *      tags={"Lunch Vendors"},
     *      summary="Delete lunch_vendors",
     *      description="Delete lunch_vendors",
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
            $lunch_vendors = LunchVendor::find($id);

            $lunch_vendors->delete();

            return ApiResponse::success();
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }
}

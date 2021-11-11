<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="LunchVendorsLocationOrderInput",
 *     description="",
 *     @OA\Xml(
 *         name="LunchVendorsLocationOrderInput"
 *     )
 * )
 */

class LunchVendorsLocationOrderInput {
    /**
     * @OA\Property(
     *     title="lunch_vendor_id",
     *     description="lunch_vendor_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $lunch_vendor_id;
    /**
     * @OA\Property(
     *     title="lunch_locations_id",
     *     description="lunch_locations_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $lunch_locations_id;


    public function __construct(Request $request)
    {
        $request->validate([
           'lunch_vendor_id' => ['nullable', 'integer'],
           'lunch_locations_id' => ['nullable', 'integer'],

        ]);

        $this->lunch_vendor_id = $request->lunch_vendor_id ;
        $this->lunch_locations_id = $request->lunch_locations_id ;

    }
}

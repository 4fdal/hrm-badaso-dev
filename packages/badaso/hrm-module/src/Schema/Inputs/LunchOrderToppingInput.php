<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="LunchOrderToppingInput",
 *     description="",
 *     @OA\Xml(
 *         name="LunchOrderToppingInput"
 *     )
 * )
 */

class LunchOrderToppingInput {
    /**
     * @OA\Property(
     *     title="lunch_order_id",
     *     description="lunch_order_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $lunch_order_id;
    /**
     * @OA\Property(
     *     title="lunch_topping_id",
     *     description="lunch_topping_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $lunch_topping_id;


    public function __construct(Request $request)
    {
        $request->validate([
           'lunch_order_id' => ['nullable', 'integer'],
           'lunch_topping_id' => ['nullable', 'integer'],

        ]);

        $this->lunch_order_id = $request->lunch_order_id ;
        $this->lunch_topping_id = $request->lunch_topping_id ;

    }
}

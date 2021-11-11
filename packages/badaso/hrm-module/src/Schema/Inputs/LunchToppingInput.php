<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="LunchToppingInput",
 *     description="",
 *     @OA\Xml(
 *         name="LunchToppingInput"
 *     )
 * )
 */

class LunchToppingInput {
    /**
     * @OA\Property(
     *     title="name",
     *     description="name",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $name;
    /**
     * @OA\Property(
     *     title="company_id",
     *     description="company_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $company_id;
    /**
     * @OA\Property(
     *     title="price",
     *     description="price",
     *     type="double",
     *     example="0"
     * )
     *
     * @var double
     */
    public $price;
    /**
     * @OA\Property(
     *     title="lunch_product_category_topping_id",
     *     description="lunch_product_category_topping_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $lunch_product_category_topping_id;


    public function __construct(Request $request)
    {
        $request->validate([
           'name' => ['nullable', 'string'],
           'company_id' => ['nullable', 'integer'],
           'price' => ['nullable', 'numeric'],
           'lunch_product_category_topping_id' => ['nullable', 'integer'],

        ]);

        $this->name = $request->name ;
        $this->company_id = $request->company_id ;
        $this->price = $request->price ;
        $this->lunch_product_category_topping_id = $request->lunch_product_category_topping_id ;

    }
}

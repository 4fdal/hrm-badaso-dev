<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="LunchProductCategoryToppingItemInput",
 *     description="",
 *     @OA\Xml(
 *         name="LunchProductCategoryToppingItemInput"
 *     )
 * )
 */

class LunchProductCategoryToppingItemInput {
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
     *     title="price",
     *     description="price",
     *     type="double",
     *     example="0"
     * )
     *
     * @var double
     */
    public $price;


    public function __construct(Request $request)
    {
        $request->validate([
           'lunch_product_category_topping_id' => ['nullable', 'integer'],
           'name' => ['nullable', 'string'],
           'price' => ['nullable', 'numeric'],

        ]);

        $this->lunch_product_category_topping_id = $request->lunch_product_category_topping_id ;
        $this->name = $request->name ;
        $this->price = $request->price ;

    }
}

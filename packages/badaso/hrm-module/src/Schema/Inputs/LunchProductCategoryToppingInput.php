<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="LunchProductCategoryToppingInput",
 *     description="",
 *     @OA\Xml(
 *         name="LunchProductCategoryToppingInput"
 *     )
 * )
 */

class LunchProductCategoryToppingInput {
    /**
     * @OA\Property(
     *     title="lunch_product_category_id",
     *     description="lunch_product_category_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $lunch_product_category_id;
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


    public function __construct(Request $request)
    {
        $request->validate([
           'lunch_product_category_id' => ['nullable', 'integer'],
           'name' => ['nullable', 'string'],

        ]);

        $this->lunch_product_category_id = $request->lunch_product_category_id ;
        $this->name = $request->name ;

    }
}

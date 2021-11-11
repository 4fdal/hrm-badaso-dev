<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="LunchProductInput",
 *     description="",
 *     @OA\Xml(
 *         name="LunchProductInput"
 *     )
 * )
 */

class LunchProductInput {
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
     *     title="description",
     *     description="description",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $description;
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
     *     title="is_active",
     *     description="is_active",
     *     type="boolean",
     *     example=""
     * )
     *
     * @var boolean
     */
    public $is_active;
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
     *     title="new_until",
     *     description="new_until",
     *     type="string",
     *     example="2021-10-28"
     * )
     *
     * @var string
     */
    public $new_until;


    public function __construct(Request $request)
    {
        $request->validate([
           'name' => ['nullable', 'string'],
           'lunch_product_category_id' => ['nullable', 'integer'],
           'description' => ['nullable', 'string'],
           'price' => ['nullable', 'numeric'],
           'lunch_vendor_id' => ['nullable', 'integer'],
           'is_active' => ['nullable', 'boolean'],
           'company_id' => ['nullable', 'integer'],
           'new_until' => ['nullable', 'date_format:Y-m-d'],

        ]);

        $this->name = $request->name ;
        $this->lunch_product_category_id = $request->lunch_product_category_id ;
        $this->description = $request->description ;
        $this->price = $request->price ;
        $this->lunch_vendor_id = $request->lunch_vendor_id ;
        $this->is_active = $request->is_active ;
        $this->company_id = $request->company_id ;
        $this->new_until = $request->new_until ;

    }
}

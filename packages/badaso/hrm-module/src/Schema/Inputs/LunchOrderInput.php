<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="LunchOrderInput",
 *     description="",
 *     @OA\Xml(
 *         name="LunchOrderInput"
 *     )
 * )
 */

class LunchOrderInput {
    /**
     * @OA\Property(
     *     title="lunch_product_id",
     *     description="lunch_product_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $lunch_product_id;
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
     *     title="date",
     *     description="date",
     *     type="string",
     *     example="2021-10-28"
     * )
     *
     * @var string
     */
    public $date;
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
     *     title="user_id",
     *     description="user_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $user_id;
    /**
     * @OA\Property(
     *     title="note",
     *     description="note",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $note;
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
     *     title="state",
     *     description="state",
     *     type="enumu",
     *     example=""
     * )
     *
     * @var enumu
     */
    public $state;
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
     *     title="currency_id",
     *     description="currency_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $currency_id;
    /**
     * @OA\Property(
     *     title="quantity",
     *     description="quantity",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $quantity;
    /**
     * @OA\Property(
     *     title="display_topping",
     *     description="display_topping",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $display_topping;


    public function __construct(Request $request)
    {
        $request->validate([
           'lunch_product_id' => ['nullable', 'integer'],
           'lunch_product_category_id' => ['nullable', 'integer'],
           'date' => ['nullable', 'date_format:Y-m-d'],
           'lunch_vendor_id' => ['nullable', 'integer'],
           'user_id' => ['nullable', 'integer'],
           'note' => ['nullable', 'string'],
           'price' => ['nullable', 'numeric'],
           'is_active' => ['nullable', 'boolean'],
           'state' => ['nullable', 'enumu'],
           'company_id' => ['nullable', 'integer'],
           'currency_id' => ['nullable', 'integer'],
           'quantity' => ['nullable', 'integer'],
           'display_topping' => ['nullable', 'string'],

        ]);

        $this->lunch_product_id = $request->lunch_product_id ;
        $this->lunch_product_category_id = $request->lunch_product_category_id ;
        $this->date = $request->date ;
        $this->lunch_vendor_id = $request->lunch_vendor_id ;
        $this->user_id = $request->user_id ;
        $this->note = $request->note ;
        $this->price = $request->price ;
        $this->is_active = $request->is_active ;
        $this->state = $request->state ;
        $this->company_id = $request->company_id ;
        $this->currency_id = $request->currency_id ;
        $this->quantity = $request->quantity ;
        $this->display_topping = $request->display_topping ;

    }
}

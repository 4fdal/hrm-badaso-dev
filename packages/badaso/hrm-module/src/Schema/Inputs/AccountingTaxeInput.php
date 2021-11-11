<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="AccountingTaxeInput",
 *     description="",
 *     @OA\Xml(
 *         name="AccountingTaxeInput"
 *     )
 * )
 */

class AccountingTaxeInput {
    /**
     * @OA\Property(
     *     title="tax_name",
     *     description="tax_name",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $tax_name;
    /**
     * @OA\Property(
     *     title="tax_computation",
     *     description="tax_computation",
     *     type="string",
     *     example="lorem type"
     * )
     *
     * @var string
     */
    public $tax_computation;
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
     *     title="tax_type",
     *     description="tax_type",
     *     type="string",
     *     example="lorem type"
     * )
     *
     * @var string
     */
    public $tax_type;
    /**
     * @OA\Property(
     *     title="tax_score",
     *     description="tax_score",
     *     type="string",
     *     example="lorem type"
     * )
     *
     * @var string
     */
    public $tax_score;
    /**
     * @OA\Property(
     *     title="amount",
     *     description="amount",
     *     type="double",
     *     example="0"
     * )
     *
     * @var double
     */
    public $amount;
    /**
     * @OA\Property(
     *     title="accountig_type",
     *     description="accountig_type",
     *     type="string",
     *     example="lorem type"
     * )
     *
     * @var string
     */
    public $accountig_type;
    /**
     * @OA\Property(
     *     title="label_invoice",
     *     description="label_invoice",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $label_invoice;
    /**
     * @OA\Property(
     *     title="taxes_group_id",
     *     description="taxes_group_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $taxes_group_id;
    /**
     * @OA\Property(
     *     title="is_include_price",
     *     description="is_include_price",
     *     type="boolean",
     *     example=""
     * )
     *
     * @var boolean
     */
    public $is_include_price;
    /**
     * @OA\Property(
     *     title="is_subsequent_tax",
     *     description="is_subsequent_tax",
     *     type="boolean",
     *     example=""
     * )
     *
     * @var boolean
     */
    public $is_subsequent_tax;


    public function __construct(Request $request)
    {
        $request->validate([
           'tax_name' => ['nullable', 'string'],
           'tax_computation' => ['nullable', 'string'],
           'is_active' => ['nullable', 'boolean'],
           'tax_type' => ['nullable', 'string'],
           'tax_score' => ['nullable', 'string'],
           'amount' => ['nullable', 'numeric'],
           'accountig_type' => ['nullable', 'string'],
           'label_invoice' => ['nullable', 'string'],
           'taxes_group_id' => ['nullable', 'integer'],
           'is_include_price' => ['nullable', 'boolean'],
           'is_subsequent_tax' => ['nullable', 'boolean'],

        ]);

        $this->tax_name = $request->tax_name ;
        $this->tax_computation = $request->tax_computation ;
        $this->is_active = $request->is_active ;
        $this->tax_type = $request->tax_type ;
        $this->tax_score = $request->tax_score ;
        $this->amount = $request->amount ;
        $this->accountig_type = $request->accountig_type ;
        $this->label_invoice = $request->label_invoice ;
        $this->taxes_group_id = $request->taxes_group_id ;
        $this->is_include_price = $request->is_include_price ;
        $this->is_subsequent_tax = $request->is_subsequent_tax ;

    }
}

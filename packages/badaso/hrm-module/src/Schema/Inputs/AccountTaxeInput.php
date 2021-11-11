<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="AccountTaxeInput",
 *     description="",
 *     @OA\Xml(
 *         name="AccountTaxeInput"
 *     )
 * )
 */

class AccountTaxeInput {
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
     *     title="type_tax_use",
     *     description="type_tax_use",
     *     type="string",
     *     example="lorem type"
     * )
     *
     * @var string
     */
    public $type_tax_use;
    /**
     * @OA\Property(
     *     title="tax_scope",
     *     description="tax_scope",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $tax_scope;
    /**
     * @OA\Property(
     *     title="amount_type",
     *     description="amount_type",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $amount_type;
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
     *     title="sequnce",
     *     description="sequnce",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $sequnce;
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
     *     title="description",
     *     description="description",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $description;


    public function __construct(Request $request)
    {
        $request->validate([
           'name' => ['nullable', 'string'],
           'type_tax_use' => ['nullable', 'string'],
           'tax_scope' => ['nullable', 'string'],
           'amount_type' => ['nullable', 'string'],
           'is_active' => ['nullable', 'boolean'],
           'company_id' => ['nullable', 'integer'],
           'sequnce' => ['nullable', 'integer'],
           'amount' => ['nullable', 'numeric'],
           'description' => ['nullable', 'string'],

        ]);

        $this->name = $request->name ;
        $this->type_tax_use = $request->type_tax_use ;
        $this->tax_scope = $request->tax_scope ;
        $this->amount_type = $request->amount_type ;
        $this->is_active = $request->is_active ;
        $this->company_id = $request->company_id ;
        $this->sequnce = $request->sequnce ;
        $this->amount = $request->amount ;
        $this->description = $request->description ;

    }
}

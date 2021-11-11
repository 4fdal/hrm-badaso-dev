<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="AccountingDistributionInvoiceInput",
 *     description="",
 *     @OA\Xml(
 *         name="AccountingDistributionInvoiceInput"
 *     )
 * )
 */

class AccountingDistributionInvoiceInput {
    /**
     * @OA\Property(
     *     title="accounting_tax_id",
     *     description="accounting_tax_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $accounting_tax_id;
    /**
     * @OA\Property(
     *     title="percent",
     *     description="percent",
     *     type="double",
     *     example="0"
     * )
     *
     * @var double
     */
    public $percent;
    /**
     * @OA\Property(
     *     title="base_on",
     *     description="base_on",
     *     type="string",
     *     example="lorem type"
     * )
     *
     * @var string
     */
    public $base_on;
    /**
     * @OA\Property(
     *     title="account_id",
     *     description="account_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $account_id;
    /**
     * @OA\Property(
     *     title="tax_grids",
     *     description="tax_grids",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $tax_grids;
    /**
     * @OA\Property(
     *     title="is_close_entry",
     *     description="is_close_entry",
     *     type="boolean",
     *     example=""
     * )
     *
     * @var boolean
     */
    public $is_close_entry;


    public function __construct(Request $request)
    {
        $request->validate([
           'accounting_tax_id' => ['nullable', 'integer'],
           'percent' => ['nullable', 'numeric'],
           'base_on' => ['nullable', 'string'],
           'account_id' => ['nullable', 'integer'],
           'tax_grids' => ['nullable', 'string'],
           'is_close_entry' => ['nullable', 'boolean'],

        ]);

        $this->accounting_tax_id = $request->accounting_tax_id ;
        $this->percent = $request->percent ;
        $this->base_on = $request->base_on ;
        $this->account_id = $request->account_id ;
        $this->tax_grids = $request->tax_grids ;
        $this->is_close_entry = $request->is_close_entry ;

    }
}

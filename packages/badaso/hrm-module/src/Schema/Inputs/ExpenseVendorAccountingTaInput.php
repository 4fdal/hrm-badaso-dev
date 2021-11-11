<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="ExpenseVendorAccountingTaInput",
 *     description="",
 *     @OA\Xml(
 *         name="ExpenseVendorAccountingTaInput"
 *     )
 * )
 */

class ExpenseVendorAccountingTaInput {
    /**
     * @OA\Property(
     *     title="expense_product_id",
     *     description="expense_product_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $expense_product_id;
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


    public function __construct(Request $request)
    {
        $request->validate([
           'expense_product_id' => ['nullable', 'integer'],
           'accounting_tax_id' => ['nullable', 'integer'],

        ]);

        $this->expense_product_id = $request->expense_product_id ;
        $this->accounting_tax_id = $request->accounting_tax_id ;

    }
}

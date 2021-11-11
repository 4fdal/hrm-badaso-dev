<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="TaxGroupInput",
 *     description="",
 *     @OA\Xml(
 *         name="TaxGroupInput"
 *     )
 * )
 */

class TaxGroupInput {
    /**
     * @OA\Property(
     *     title="current_tax_account_payable_id",
     *     description="current_tax_account_payable_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $current_tax_account_payable_id;
    /**
     * @OA\Property(
     *     title="advanced_tax_account_payable_id",
     *     description="advanced_tax_account_payable_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $advanced_tax_account_payable_id;
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
     *     title="receiver_current_tax_account_payable_id",
     *     description="receiver_current_tax_account_payable_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $receiver_current_tax_account_payable_id;


    public function __construct(Request $request)
    {
        $request->validate([
           'current_tax_account_payable_id' => ['nullable', 'integer'],
           'advanced_tax_account_payable_id' => ['nullable', 'integer'],
           'sequnce' => ['nullable', 'integer'],
           'receiver_current_tax_account_payable_id' => ['nullable', 'integer'],

        ]);

        $this->current_tax_account_payable_id = $request->current_tax_account_payable_id ;
        $this->advanced_tax_account_payable_id = $request->advanced_tax_account_payable_id ;
        $this->sequnce = $request->sequnce ;
        $this->receiver_current_tax_account_payable_id = $request->receiver_current_tax_account_payable_id ;

    }
}

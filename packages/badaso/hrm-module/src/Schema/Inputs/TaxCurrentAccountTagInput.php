<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="TaxCurrentAccountTagInput",
 *     description="",
 *     @OA\Xml(
 *         name="TaxCurrentAccountTagInput"
 *     )
 * )
 */

class TaxCurrentAccountTagInput {
    /**
     * @OA\Property(
     *     title="tax_account_payables",
     *     description="tax_account_payables",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $tax_account_payables;
    /**
     * @OA\Property(
     *     title="account_tag_id",
     *     description="account_tag_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $account_tag_id;


    public function __construct(Request $request)
    {
        $request->validate([
           'tax_account_payables' => ['nullable', 'integer'],
           'account_tag_id' => ['nullable', 'integer'],

        ]);

        $this->tax_account_payables = $request->tax_account_payables ;
        $this->account_tag_id = $request->account_tag_id ;

    }
}

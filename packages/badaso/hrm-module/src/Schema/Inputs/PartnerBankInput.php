<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="PartnerBankInput",
 *     description="",
 *     @OA\Xml(
 *         name="PartnerBankInput"
 *     )
 * )
 */

class PartnerBankInput {
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
     *     title="acc_number",
     *     description="acc_number",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $acc_number;
    /**
     * @OA\Property(
     *     title="sanitize_acc_number",
     *     description="sanitize_acc_number",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $sanitize_acc_number;
    /**
     * @OA\Property(
     *     title="acc_holder_name",
     *     description="acc_holder_name",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $acc_holder_name;
    /**
     * @OA\Property(
     *     title="partner_id",
     *     description="partner_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $partner_id;
    /**
     * @OA\Property(
     *     title="bank_id",
     *     description="bank_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $bank_id;
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
     *     title="company_id",
     *     description="company_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $company_id;


    public function __construct(Request $request)
    {
        $request->validate([
           'is_active' => ['nullable', 'boolean'],
           'acc_number' => ['nullable', 'string'],
           'sanitize_acc_number' => ['nullable', 'string'],
           'acc_holder_name' => ['nullable', 'string'],
           'partner_id' => ['nullable', 'integer'],
           'bank_id' => ['nullable', 'integer'],
           'sequnce' => ['nullable', 'integer'],
           'currency_id' => ['nullable', 'integer'],
           'company_id' => ['nullable', 'integer'],

        ]);

        $this->is_active = $request->is_active ;
        $this->acc_number = $request->acc_number ;
        $this->sanitize_acc_number = $request->sanitize_acc_number ;
        $this->acc_holder_name = $request->acc_holder_name ;
        $this->partner_id = $request->partner_id ;
        $this->bank_id = $request->bank_id ;
        $this->sequnce = $request->sequnce ;
        $this->currency_id = $request->currency_id ;
        $this->company_id = $request->company_id ;

    }
}

<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="AccountJournalInput",
 *     description="",
 *     @OA\Xml(
 *         name="AccountJournalInput"
 *     )
 * )
 */

class AccountJournalInput {
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
     *     title="code",
     *     description="code",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $code;
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
     *     title="type",
     *     description="type",
     *     type="string",
     *     example="lorem type"
     * )
     *
     * @var string
     */
    public $type;
    /**
     * @OA\Property(
     *     title="default_account_id",
     *     description="default_account_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $default_account_id;
    /**
     * @OA\Property(
     *     title="payment_debit_account_id",
     *     description="payment_debit_account_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $payment_debit_account_id;
    /**
     * @OA\Property(
     *     title="payment_credit_account_id",
     *     description="payment_credit_account_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $payment_credit_account_id;
    /**
     * @OA\Property(
     *     title="suspensi_account_id",
     *     description="suspensi_account_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $suspensi_account_id;
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
     *     title="invoice_reference_type",
     *     description="invoice_reference_type",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $invoice_reference_type;
    /**
     * @OA\Property(
     *     title="invoice_reference_model",
     *     description="invoice_reference_model",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $invoice_reference_model;
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
    /**
     * @OA\Property(
     *     title="is_refund_squence",
     *     description="is_refund_squence",
     *     type="boolean",
     *     example=""
     * )
     *
     * @var boolean
     */
    public $is_refund_squence;
    /**
     * @OA\Property(
     *     title="is_least_one_inbound",
     *     description="is_least_one_inbound",
     *     type="boolean",
     *     example=""
     * )
     *
     * @var boolean
     */
    public $is_least_one_inbound;
    /**
     * @OA\Property(
     *     title="is_least_one_outbound",
     *     description="is_least_one_outbound",
     *     type="boolean",
     *     example=""
     * )
     *
     * @var boolean
     */
    public $is_least_one_outbound;
    /**
     * @OA\Property(
     *     title="profit_account_id",
     *     description="profit_account_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $profit_account_id;
    /**
     * @OA\Property(
     *     title="lost_account_id",
     *     description="lost_account_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $lost_account_id;
    /**
     * @OA\Property(
     *     title="partner_bank_id",
     *     description="partner_bank_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $partner_bank_id;


    public function __construct(Request $request)
    {
        $request->validate([
           'name' => ['nullable', 'string'],
           'code' => ['nullable', 'string'],
           'is_active' => ['nullable', 'boolean'],
           'type' => ['nullable', 'string'],
           'default_account_id' => ['nullable', 'integer'],
           'payment_debit_account_id' => ['nullable', 'integer'],
           'payment_credit_account_id' => ['nullable', 'integer'],
           'suspensi_account_id' => ['nullable', 'integer'],
           'sequnce' => ['nullable', 'integer'],
           'invoice_reference_type' => ['nullable', 'string'],
           'invoice_reference_model' => ['nullable', 'string'],
           'currency_id' => ['nullable', 'integer'],
           'company_id' => ['nullable', 'integer'],
           'is_refund_squence' => ['nullable', 'boolean'],
           'is_least_one_inbound' => ['nullable', 'boolean'],
           'is_least_one_outbound' => ['nullable', 'boolean'],
           'profit_account_id' => ['nullable', 'integer'],
           'lost_account_id' => ['nullable', 'integer'],
           'partner_bank_id' => ['nullable', 'integer'],

        ]);

        $this->name = $request->name ;
        $this->code = $request->code ;
        $this->is_active = $request->is_active ;
        $this->type = $request->type ;
        $this->default_account_id = $request->default_account_id ;
        $this->payment_debit_account_id = $request->payment_debit_account_id ;
        $this->payment_credit_account_id = $request->payment_credit_account_id ;
        $this->suspensi_account_id = $request->suspensi_account_id ;
        $this->sequnce = $request->sequnce ;
        $this->invoice_reference_type = $request->invoice_reference_type ;
        $this->invoice_reference_model = $request->invoice_reference_model ;
        $this->currency_id = $request->currency_id ;
        $this->company_id = $request->company_id ;
        $this->is_refund_squence = $request->is_refund_squence ;
        $this->is_least_one_inbound = $request->is_least_one_inbound ;
        $this->is_least_one_outbound = $request->is_least_one_outbound ;
        $this->profit_account_id = $request->profit_account_id ;
        $this->lost_account_id = $request->lost_account_id ;
        $this->partner_bank_id = $request->partner_bank_id ;

    }
}

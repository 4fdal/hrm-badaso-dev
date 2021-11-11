<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="ExpenseReportInput",
 *     description="",
 *     @OA\Xml(
 *         name="ExpenseReportInput"
 *     )
 * )
 */

class ExpenseReportInput {
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
     *     title="unit_price",
     *     description="unit_price",
     *     type="double",
     *     example="0"
     * )
     *
     * @var double
     */
    public $unit_price;
    /**
     * @OA\Property(
     *     title="quantity",
     *     description="quantity",
     *     type="double",
     *     example="0"
     * )
     *
     * @var double
     */
    public $quantity;
    /**
     * @OA\Property(
     *     title="total",
     *     description="total",
     *     type="double",
     *     example="0"
     * )
     *
     * @var double
     */
    public $total;
    /**
     * @OA\Property(
     *     title="amount_due",
     *     description="amount_due",
     *     type="double",
     *     example="0"
     * )
     *
     * @var double
     */
    public $amount_due;
    /**
     * @OA\Property(
     *     title="paid_by",
     *     description="paid_by",
     *     type="string",
     *     example="lorem type"
     * )
     *
     * @var string
     */
    public $paid_by;
    /**
     * @OA\Property(
     *     title="bill_reference",
     *     description="bill_reference",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $bill_reference;
    /**
     * @OA\Property(
     *     title="expense_date",
     *     description="expense_date",
     *     type="string",
     *     example="2021-10-28"
     * )
     *
     * @var string
     */
    public $expense_date;
    /**
     * @OA\Property(
     *     title="employee_id",
     *     description="employee_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $employee_id;
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
     *     title="state_report",
     *     description="state_report",
     *     type="string",
     *     example="lorem type"
     * )
     *
     * @var string
     */
    public $state_report;
    /**
     * @OA\Property(
     *     title="register_payment_id",
     *     description="register_payment_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $register_payment_id;


    public function __construct(Request $request)
    {
        $request->validate([
           'description' => ['nullable', 'string'],
           'expense_product_id' => ['nullable', 'integer'],
           'unit_price' => ['nullable', 'numeric'],
           'quantity' => ['nullable', 'numeric'],
           'total' => ['nullable', 'numeric'],
           'amount_due' => ['nullable', 'numeric'],
           'paid_by' => ['nullable', 'string'],
           'bill_reference' => ['nullable', 'string'],
           'expense_date' => ['nullable', 'date_format:Y-m-d'],
           'employee_id' => ['nullable', 'integer'],
           'company_id' => ['nullable', 'integer'],
           'note' => ['nullable', 'string'],
           'state_report' => ['nullable', 'string'],
           'register_payment_id' => ['nullable', 'integer'],

        ]);

        $this->description = $request->description ;
        $this->expense_product_id = $request->expense_product_id ;
        $this->unit_price = $request->unit_price ;
        $this->quantity = $request->quantity ;
        $this->total = $request->total ;
        $this->amount_due = $request->amount_due ;
        $this->paid_by = $request->paid_by ;
        $this->bill_reference = $request->bill_reference ;
        $this->expense_date = $request->expense_date ;
        $this->employee_id = $request->employee_id ;
        $this->company_id = $request->company_id ;
        $this->note = $request->note ;
        $this->state_report = $request->state_report ;
        $this->register_payment_id = $request->register_payment_id ;

    }
}

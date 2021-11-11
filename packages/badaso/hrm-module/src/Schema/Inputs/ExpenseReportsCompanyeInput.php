<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="ExpenseReportsCompanyeInput",
 *     description="",
 *     @OA\Xml(
 *         name="ExpenseReportsCompanyeInput"
 *     )
 * )
 */

class ExpenseReportsCompanyeInput {
    /**
     * @OA\Property(
     *     title="report_summary",
     *     description="report_summary",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $report_summary;
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
     *     title="manager_user_id",
     *     description="manager_user_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $manager_user_id;
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
     *     title="expense_journal",
     *     description="expense_journal",
     *     type="string",
     *     example="lorem type"
     * )
     *
     * @var string
     */
    public $expense_journal;


    public function __construct(Request $request)
    {
        $request->validate([
           'report_summary' => ['nullable', 'string'],
           'employee_id' => ['nullable', 'integer'],
           'manager_user_id' => ['nullable', 'integer'],
           'paid_by' => ['nullable', 'string'],
           'company_id' => ['nullable', 'integer'],
           'expense_journal' => ['nullable', 'string'],

        ]);

        $this->report_summary = $request->report_summary ;
        $this->employee_id = $request->employee_id ;
        $this->manager_user_id = $request->manager_user_id ;
        $this->paid_by = $request->paid_by ;
        $this->company_id = $request->company_id ;
        $this->expense_journal = $request->expense_journal ;

    }
}

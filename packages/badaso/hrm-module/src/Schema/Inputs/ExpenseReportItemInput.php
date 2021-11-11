<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="ExpenseReportItemInput",
 *     description="",
 *     @OA\Xml(
 *         name="ExpenseReportItemInput"
 *     )
 * )
 */

class ExpenseReportItemInput {
    /**
     * @OA\Property(
     *     title="expense_reports_company_id",
     *     description="expense_reports_company_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $expense_reports_company_id;
    /**
     * @OA\Property(
     *     title="expense_report_id",
     *     description="expense_report_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $expense_report_id;


    public function __construct(Request $request)
    {
        $request->validate([
           'expense_reports_company_id' => ['nullable', 'integer'],
           'expense_report_id' => ['nullable', 'integer'],

        ]);

        $this->expense_reports_company_id = $request->expense_reports_company_id ;
        $this->expense_report_id = $request->expense_report_id ;

    }
}

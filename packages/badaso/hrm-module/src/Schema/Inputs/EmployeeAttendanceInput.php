<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="EmployeeAttendanceInput",
 *     description="",
 *     @OA\Xml(
 *         name="EmployeeAttendanceInput"
 *     )
 * )
 */

class EmployeeAttendanceInput {
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
     *     title="check_in",
     *     description="check_in",
     *     type="string",
     *     example="2021-10-28 08:11:17"
     * )
     *
     * @var string
     */
    public $check_in;
    /**
     * @OA\Property(
     *     title="check_out",
     *     description="check_out",
     *     type="string",
     *     example="2021-10-28 08:11:17"
     * )
     *
     * @var string
     */
    public $check_out;
    /**
     * @OA\Property(
     *     title="worked_hours",
     *     description="worked_hours",
     *     type="double",
     *     example="0"
     * )
     *
     * @var double
     */
    public $worked_hours;


    public function __construct(Request $request)
    {
        $request->validate([
           'employee_id' => ['nullable', 'integer'],
           'check_in' => ['nullable', 'date_format:Y-m-d H:i:s'],
           'check_out' => ['nullable', 'date_format:Y-m-d H:i:s'],
           'worked_hours' => ['nullable', 'numeric'],

        ]);

        $this->employee_id = $request->employee_id ;
        $this->check_in = $request->check_in ;
        $this->check_out = $request->check_out ;
        $this->worked_hours = $request->worked_hours ;

    }
}

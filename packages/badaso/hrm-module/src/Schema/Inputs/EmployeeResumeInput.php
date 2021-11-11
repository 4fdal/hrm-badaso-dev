<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="EmployeeResumeInput",
 *     description="",
 *     @OA\Xml(
 *         name="EmployeeResumeInput"
 *     )
 * )
 */

class EmployeeResumeInput {
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
     *     title="resume_line_type_id",
     *     description="resume_line_type_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $resume_line_type_id;
    /**
     * @OA\Property(
     *     title="display_type",
     *     description="display_type",
     *     type="string",
     *     example="lorem type"
     * )
     *
     * @var string
     */
    public $display_type;
    /**
     * @OA\Property(
     *     title="start",
     *     description="start",
     *     type="string",
     *     example="2021-10-28"
     * )
     *
     * @var string
     */
    public $start;
    /**
     * @OA\Property(
     *     title="end",
     *     description="end",
     *     type="string",
     *     example="2021-10-28"
     * )
     *
     * @var string
     */
    public $end;
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


    public function __construct(Request $request)
    {
        $request->validate([
           'employee_id' => ['nullable', 'integer'],
           'resume_line_type_id' => ['nullable', 'integer'],
           'display_type' => ['nullable', 'string'],
           'start' => ['nullable', 'date_format:Y-m-d'],
           'end' => ['nullable', 'date_format:Y-m-d'],
           'description' => ['nullable', 'string'],

        ]);

        $this->employee_id = $request->employee_id ;
        $this->resume_line_type_id = $request->resume_line_type_id ;
        $this->display_type = $request->display_type ;
        $this->start = $request->start ;
        $this->end = $request->end ;
        $this->description = $request->description ;

    }
}

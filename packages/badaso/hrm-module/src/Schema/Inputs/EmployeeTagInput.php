<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="EmployeeTagInput",
 *     description="",
 *     @OA\Xml(
 *         name="EmployeeTagInput"
 *     )
 * )
 */

class EmployeeTagInput {
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
     *     title="employee_categorie_id",
     *     description="employee_categorie_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $employee_categorie_id;


    public function __construct(Request $request)
    {
        $request->validate([
           'employee_id' => ['nullable', 'integer'],
           'employee_categorie_id' => ['nullable', 'integer'],

        ]);

        $this->employee_id = $request->employee_id ;
        $this->employee_categorie_id = $request->employee_categorie_id ;

    }
}

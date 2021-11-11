<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="EmployeeCategoryInput",
 *     description="",
 *     @OA\Xml(
 *         name="EmployeeCategoryInput"
 *     )
 * )
 */

class EmployeeCategoryInput {
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
     *     title="color",
     *     description="color",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $color;


    public function __construct(Request $request)
    {
        $request->validate([
           'name' => ['nullable', 'string'],
           'color' => ['nullable', 'string'],

        ]);

        $this->name = $request->name ;
        $this->color = $request->color ;

    }
}

<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="IndustryInput",
 *     description="",
 *     @OA\Xml(
 *         name="IndustryInput"
 *     )
 * )
 */

class IndustryInput {
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
     *     title="full_name",
     *     description="full_name",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $full_name;
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


    public function __construct(Request $request)
    {
        $request->validate([
           'name' => ['nullable', 'string'],
           'full_name' => ['nullable', 'string'],
           'is_active' => ['nullable', 'boolean'],

        ]);

        $this->name = $request->name ;
        $this->full_name = $request->full_name ;
        $this->is_active = $request->is_active ;

    }
}

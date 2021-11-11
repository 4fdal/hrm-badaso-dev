<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="MetsosSourceInput",
 *     description="",
 *     @OA\Xml(
 *         name="MetsosSourceInput"
 *     )
 * )
 */

class MetsosSourceInput {
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


    public function __construct(Request $request)
    {
        $request->validate([
           'name' => ['nullable', 'string'],

        ]);

        $this->name = $request->name ;

    }
}

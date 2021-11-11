<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="PartnerTitleInput",
 *     description="",
 *     @OA\Xml(
 *         name="PartnerTitleInput"
 *     )
 * )
 */

class PartnerTitleInput {
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
     *     title="shortcut",
     *     description="shortcut",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $shortcut;


    public function __construct(Request $request)
    {
        $request->validate([
           'name' => ['nullable', 'string'],
           'shortcut' => ['nullable', 'string'],

        ]);

        $this->name = $request->name ;
        $this->shortcut = $request->shortcut ;

    }
}

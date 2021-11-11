<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="FleetContractTypeInput",
 *     description="",
 *     @OA\Xml(
 *         name="FleetContractTypeInput"
 *     )
 * )
 */

class FleetContractTypeInput {
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
     *     title="category",
     *     description="category",
     *     type="string",
     *     example="lorem type"
     * )
     *
     * @var string
     */
    public $category;


    public function __construct(Request $request)
    {
        $request->validate([
           'name' => ['nullable', 'string'],
           'category' => ['nullable', 'string'],

        ]);

        $this->name = $request->name ;
        $this->category = $request->category ;

    }
}

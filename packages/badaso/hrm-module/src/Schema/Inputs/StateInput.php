<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="StateInput",
 *     description="",
 *     @OA\Xml(
 *         name="StateInput"
 *     )
 * )
 */

class StateInput {
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
     *     title="country_id",
     *     description="country_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $country_id;
    /**
     * @OA\Property(
     *     title="code",
     *     description="code",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $code;


    public function __construct(Request $request)
    {
        $request->validate([
           'name' => ['nullable', 'string'],
           'country_id' => ['nullable', 'integer'],
           'code' => ['nullable', 'string'],

        ]);

        $this->name = $request->name ;
        $this->country_id = $request->country_id ;
        $this->code = $request->code ;

    }
}

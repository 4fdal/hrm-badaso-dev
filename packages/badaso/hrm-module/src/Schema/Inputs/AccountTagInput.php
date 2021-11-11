<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="AccountTagInput",
 *     description="",
 *     @OA\Xml(
 *         name="AccountTagInput"
 *     )
 * )
 */

class AccountTagInput {
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
     *     title="applicability",
     *     description="applicability",
     *     type="string",
     *     example="lorem type"
     * )
     *
     * @var string
     */
    public $applicability;
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


    public function __construct(Request $request)
    {
        $request->validate([
           'name' => ['nullable', 'string'],
           'applicability' => ['nullable', 'string'],
           'is_active' => ['nullable', 'boolean'],
           'country_id' => ['nullable', 'integer'],

        ]);

        $this->name = $request->name ;
        $this->applicability = $request->applicability ;
        $this->is_active = $request->is_active ;
        $this->country_id = $request->country_id ;

    }
}

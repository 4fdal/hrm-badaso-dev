<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="FleetVehicleCategoryInput",
 *     description="",
 *     @OA\Xml(
 *         name="FleetVehicleCategoryInput"
 *     )
 * )
 */

class FleetVehicleCategoryInput {
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
    /**
     * @OA\Property(
     *     title="user_id",
     *     description="user_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $user_id;


    public function __construct(Request $request)
    {
        $request->validate([
           'name' => ['nullable', 'string'],
           'color' => ['nullable', 'string'],
           'user_id' => ['nullable', 'integer'],

        ]);

        $this->name = $request->name ;
        $this->color = $request->color ;
        $this->user_id = $request->user_id ;

    }
}

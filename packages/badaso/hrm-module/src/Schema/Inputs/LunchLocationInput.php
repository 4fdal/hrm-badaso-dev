<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="LunchLocationInput",
 *     description="",
 *     @OA\Xml(
 *         name="LunchLocationInput"
 *     )
 * )
 */

class LunchLocationInput {
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
     *     title="address",
     *     description="address",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $address;
    /**
     * @OA\Property(
     *     title="company_id",
     *     description="company_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $company_id;


    public function __construct(Request $request)
    {
        $request->validate([
           'name' => ['nullable', 'string'],
           'address' => ['nullable', 'string'],
           'company_id' => ['nullable', 'integer'],

        ]);

        $this->name = $request->name ;
        $this->address = $request->address ;
        $this->company_id = $request->company_id ;

    }
}

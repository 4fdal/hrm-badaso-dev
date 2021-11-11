<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="LunchProductCategoryInput",
 *     description="",
 *     @OA\Xml(
 *         name="LunchProductCategoryInput"
 *     )
 * )
 */

class LunchProductCategoryInput {
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
     *     title="company_id",
     *     description="company_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $company_id;
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
           'company_id' => ['nullable', 'integer'],
           'is_active' => ['nullable', 'boolean'],

        ]);

        $this->name = $request->name ;
        $this->company_id = $request->company_id ;
        $this->is_active = $request->is_active ;

    }
}

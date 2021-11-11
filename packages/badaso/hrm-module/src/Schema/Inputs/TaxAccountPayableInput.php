<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="TaxAccountPayableInput",
 *     description="",
 *     @OA\Xml(
 *         name="TaxAccountPayableInput"
 *     )
 * )
 */

class TaxAccountPayableInput {
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
    /**
     * @OA\Property(
     *     title="group_account_type_id",
     *     description="group_account_type_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $group_account_type_id;
    /**
     * @OA\Property(
     *     title="is_deprecated",
     *     description="is_deprecated",
     *     type="boolean",
     *     example=""
     * )
     *
     * @var boolean
     */
    public $is_deprecated;
    /**
     * @OA\Property(
     *     title="default_account_tax_id",
     *     description="default_account_tax_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $default_account_tax_id;


    public function __construct(Request $request)
    {
        $request->validate([
           'code' => ['nullable', 'string'],
           'group_account_type_id' => ['nullable', 'integer'],
           'is_deprecated' => ['nullable', 'boolean'],
           'default_account_tax_id' => ['nullable', 'integer'],

        ]);

        $this->code = $request->code ;
        $this->group_account_type_id = $request->group_account_type_id ;
        $this->is_deprecated = $request->is_deprecated ;
        $this->default_account_tax_id = $request->default_account_tax_id ;

    }
}

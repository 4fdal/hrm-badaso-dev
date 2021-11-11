<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="CurrencyInput",
 *     description="",
 *     @OA\Xml(
 *         name="CurrencyInput"
 *     )
 * )
 */

class CurrencyInput {
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
     *     title="sysmbol",
     *     description="sysmbol",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $sysmbol;
    /**
     * @OA\Property(
     *     title="rounding",
     *     description="rounding",
     *     type="double",
     *     example="0"
     * )
     *
     * @var double
     */
    public $rounding;
    /**
     * @OA\Property(
     *     title="decimal_place",
     *     description="decimal_place",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $decimal_place;
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
     *     title="position",
     *     description="position",
     *     type="string",
     *     example="lorem type"
     * )
     *
     * @var string
     */
    public $position;
    /**
     * @OA\Property(
     *     title="currency_unit_label",
     *     description="currency_unit_label",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $currency_unit_label;
    /**
     * @OA\Property(
     *     title="currency_subunit_label",
     *     description="currency_subunit_label",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $currency_subunit_label;


    public function __construct(Request $request)
    {
        $request->validate([
           'name' => ['nullable', 'string'],
           'sysmbol' => ['nullable', 'string'],
           'rounding' => ['nullable', 'numeric'],
           'decimal_place' => ['nullable', 'integer'],
           'is_active' => ['nullable', 'boolean'],
           'position' => ['nullable', 'string'],
           'currency_unit_label' => ['nullable', 'string'],
           'currency_subunit_label' => ['nullable', 'string'],

        ]);

        $this->name = $request->name ;
        $this->sysmbol = $request->sysmbol ;
        $this->rounding = $request->rounding ;
        $this->decimal_place = $request->decimal_place ;
        $this->is_active = $request->is_active ;
        $this->position = $request->position ;
        $this->currency_unit_label = $request->currency_unit_label ;
        $this->currency_subunit_label = $request->currency_subunit_label ;

    }
}

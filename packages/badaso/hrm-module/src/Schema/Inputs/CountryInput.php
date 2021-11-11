<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="CountryInput",
 *     description="",
 *     @OA\Xml(
 *         name="CountryInput"
 *     )
 * )
 */

class CountryInput {
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
     *     title="currency_id",
     *     description="currency_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $currency_id;
    /**
     * @OA\Property(
     *     title="phone_code",
     *     description="phone_code",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $phone_code;
    /**
     * @OA\Property(
     *     title="name_position",
     *     description="name_position",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $name_position;
    /**
     * @OA\Property(
     *     title="vat_label",
     *     description="vat_label",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $vat_label;


    public function __construct(Request $request)
    {
        $request->validate([
           'name' => ['nullable', 'string'],
           'code' => ['nullable', 'string'],
           'currency_id' => ['nullable', 'integer'],
           'phone_code' => ['nullable', 'string'],
           'name_position' => ['nullable', 'string'],
           'vat_label' => ['nullable', 'string'],

        ]);

        $this->name = $request->name ;
        $this->code = $request->code ;
        $this->currency_id = $request->currency_id ;
        $this->phone_code = $request->phone_code ;
        $this->name_position = $request->name_position ;
        $this->vat_label = $request->vat_label ;

    }
}

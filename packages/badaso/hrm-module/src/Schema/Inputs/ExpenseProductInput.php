<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="ExpenseProductInput",
 *     description="",
 *     @OA\Xml(
 *         name="ExpenseProductInput"
 *     )
 * )
 */

class ExpenseProductInput {
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
     *     title="cost",
     *     description="cost",
     *     type="double",
     *     example="0"
     * )
     *
     * @var double
     */
    public $cost;
    /**
     * @OA\Property(
     *     title="internal_reference",
     *     description="internal_reference",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $internal_reference;
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
     *     title="invoice_policy",
     *     description="invoice_policy",
     *     type="string",
     *     example="lorem type"
     * )
     *
     * @var string
     */
    public $invoice_policy;
    /**
     * @OA\Property(
     *     title="re_invoice_exoense",
     *     description="re_invoice_exoense",
     *     type="string",
     *     example="lorem type"
     * )
     *
     * @var string
     */
    public $re_invoice_exoense;
    /**
     * @OA\Property(
     *     title="image_path",
     *     description="image_path",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $image_path;


    public function __construct(Request $request)
    {
        $request->validate([
           'name' => ['nullable', 'string'],
           'cost' => ['nullable', 'numeric'],
           'internal_reference' => ['nullable', 'string'],
           'company_id' => ['nullable', 'integer'],
           'invoice_policy' => ['nullable', 'string'],
           're_invoice_exoense' => ['nullable', 'string'],
           'image_path' => ['nullable', 'string'],

        ]);

        $this->name = $request->name ;
        $this->cost = $request->cost ;
        $this->internal_reference = $request->internal_reference ;
        $this->company_id = $request->company_id ;
        $this->invoice_policy = $request->invoice_policy ;
        $this->re_invoice_exoense = $request->re_invoice_exoense ;
        $this->image_path = $request->image_path ;

    }
}

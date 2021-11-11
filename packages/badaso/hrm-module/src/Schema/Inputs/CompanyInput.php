<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="CompanyInput",
 *     description="",
 *     @OA\Xml(
 *         name="CompanyInput"
 *     )
 * )
 */

class CompanyInput {
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
     *     title="parent_id",
     *     description="parent_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $parent_id;
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
     *     title="sequnce",
     *     description="sequnce",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $sequnce;
    /**
     * @OA\Property(
     *     title="partner_id",
     *     description="partner_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $partner_id;
    /**
     * @OA\Property(
     *     title="report_header",
     *     description="report_header",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $report_header;
    /**
     * @OA\Property(
     *     title="report_footer",
     *     description="report_footer",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $report_footer;
    /**
     * @OA\Property(
     *     title="img_logo_path",
     *     description="img_logo_path",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $img_logo_path;
    /**
     * @OA\Property(
     *     title="email",
     *     description="email",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $email;
    /**
     * @OA\Property(
     *     title="phone",
     *     description="phone",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $phone;


    public function __construct(Request $request)
    {
        $request->validate([
           'name' => ['nullable', 'string'],
           'parent_id' => ['nullable', 'integer'],
           'currency_id' => ['nullable', 'integer'],
           'sequnce' => ['nullable', 'integer'],
           'partner_id' => ['nullable', 'integer'],
           'report_header' => ['nullable', 'string'],
           'report_footer' => ['nullable', 'string'],
           'img_logo_path' => ['nullable', 'string'],
           'email' => ['nullable', 'string'],
           'phone' => ['nullable', 'string'],

        ]);

        $this->name = $request->name ;
        $this->parent_id = $request->parent_id ;
        $this->currency_id = $request->currency_id ;
        $this->sequnce = $request->sequnce ;
        $this->partner_id = $request->partner_id ;
        $this->report_header = $request->report_header ;
        $this->report_footer = $request->report_footer ;
        $this->img_logo_path = $request->img_logo_path ;
        $this->email = $request->email ;
        $this->phone = $request->phone ;

    }
}

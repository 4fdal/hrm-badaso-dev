<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="PartnerInput",
 *     description="",
 *     @OA\Xml(
 *         name="PartnerInput"
 *     )
 * )
 */

class PartnerInput {
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
     *     title="display_name",
     *     description="display_name",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $display_name;
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
     *     title="lang",
     *     description="lang",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $lang;
    /**
     * @OA\Property(
     *     title="timezone",
     *     description="timezone",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $timezone;
    /**
     * @OA\Property(
     *     title="vat",
     *     description="vat",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $vat;
    /**
     * @OA\Property(
     *     title="website",
     *     description="website",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $website;
    /**
     * @OA\Property(
     *     title="credit_limit",
     *     description="credit_limit",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $credit_limit;
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
     *     title="type",
     *     description="type",
     *     type="string",
     *     example="lorem type"
     * )
     *
     * @var string
     */
    public $type;
    /**
     * @OA\Property(
     *     title="street1",
     *     description="street1",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $street1;
    /**
     * @OA\Property(
     *     title="street2",
     *     description="street2",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $street2;
    /**
     * @OA\Property(
     *     title="zip",
     *     description="zip",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $zip;
    /**
     * @OA\Property(
     *     title="city",
     *     description="city",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $city;
    /**
     * @OA\Property(
     *     title="state_id",
     *     description="state_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $state_id;
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
     *     title="latitude",
     *     description="latitude",
     *     type="double",
     *     example="0"
     * )
     *
     * @var double
     */
    public $latitude;
    /**
     * @OA\Property(
     *     title="longitute",
     *     description="longitute",
     *     type="double",
     *     example="0"
     * )
     *
     * @var double
     */
    public $longitute;
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
    /**
     * @OA\Property(
     *     title="mobile",
     *     description="mobile",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $mobile;
    /**
     * @OA\Property(
     *     title="is_comapany",
     *     description="is_comapany",
     *     type="double",
     *     example="0"
     * )
     *
     * @var double
     */
    public $is_comapany;
    /**
     * @OA\Property(
     *     title="industry_id",
     *     description="industry_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $industry_id;
    /**
     * @OA\Property(
     *     title="commercial_partner_id",
     *     description="commercial_partner_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $commercial_partner_id;
    /**
     * @OA\Property(
     *     title="commercial_company_name",
     *     description="commercial_company_name",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $commercial_company_name;
    /**
     * @OA\Property(
     *     title="company_name",
     *     description="company_name",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $company_name;


    public function __construct(Request $request)
    {
        $request->validate([
           'company_id' => ['nullable', 'integer'],
           'name' => ['nullable', 'string'],
           'display_name' => ['nullable', 'string'],
           'parent_id' => ['nullable', 'integer'],
           'lang' => ['nullable', 'string'],
           'timezone' => ['nullable', 'string'],
           'vat' => ['nullable', 'string'],
           'website' => ['nullable', 'string'],
           'credit_limit' => ['nullable', 'string'],
           'is_active' => ['nullable', 'boolean'],
           'type' => ['nullable', 'string'],
           'street1' => ['nullable', 'string'],
           'street2' => ['nullable', 'string'],
           'zip' => ['nullable', 'string'],
           'city' => ['nullable', 'string'],
           'state_id' => ['nullable', 'integer'],
           'country_id' => ['nullable', 'integer'],
           'latitude' => ['nullable', 'numeric'],
           'longitute' => ['nullable', 'numeric'],
           'email' => ['nullable', 'string'],
           'phone' => ['nullable', 'string'],
           'mobile' => ['nullable', 'string'],
           'is_comapany' => ['nullable', 'numeric'],
           'industry_id' => ['nullable', 'integer'],
           'commercial_partner_id' => ['nullable', 'integer'],
           'commercial_company_name' => ['nullable', 'string'],
           'company_name' => ['nullable', 'string'],

        ]);

        $this->company_id = $request->company_id ;
        $this->name = $request->name ;
        $this->display_name = $request->display_name ;
        $this->parent_id = $request->parent_id ;
        $this->lang = $request->lang ;
        $this->timezone = $request->timezone ;
        $this->vat = $request->vat ;
        $this->website = $request->website ;
        $this->credit_limit = $request->credit_limit ;
        $this->is_active = $request->is_active ;
        $this->type = $request->type ;
        $this->street1 = $request->street1 ;
        $this->street2 = $request->street2 ;
        $this->zip = $request->zip ;
        $this->city = $request->city ;
        $this->state_id = $request->state_id ;
        $this->country_id = $request->country_id ;
        $this->latitude = $request->latitude ;
        $this->longitute = $request->longitute ;
        $this->email = $request->email ;
        $this->phone = $request->phone ;
        $this->mobile = $request->mobile ;
        $this->is_comapany = $request->is_comapany ;
        $this->industry_id = $request->industry_id ;
        $this->commercial_partner_id = $request->commercial_partner_id ;
        $this->commercial_company_name = $request->commercial_company_name ;
        $this->company_name = $request->company_name ;

    }
}

<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="CompanyContactInput",
 *     description="",
 *     @OA\Xml(
 *         name="CompanyContactInput"
 *     )
 * )
 */

class CompanyContactInput {
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
     *     title="partner_title_id",
     *     description="partner_title_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $partner_title_id;
    /**
     * @OA\Property(
     *     title="job_title",
     *     description="job_title",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $job_title;
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
     *     title="notes",
     *     description="notes",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $notes;
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
           'type' => ['nullable', 'string'],
           'name' => ['nullable', 'string'],
           'partner_title_id' => ['nullable', 'integer'],
           'job_title' => ['nullable', 'string'],
           'email' => ['nullable', 'string'],
           'phone' => ['nullable', 'string'],
           'mobile' => ['nullable', 'string'],
           'notes' => ['nullable', 'string'],
           'street1' => ['nullable', 'string'],
           'street2' => ['nullable', 'string'],
           'city' => ['nullable', 'string'],
           'state_id' => ['nullable', 'integer'],
           'zip' => ['nullable', 'string'],
           'country_id' => ['nullable', 'integer'],
           'image_path' => ['nullable', 'string'],

        ]);

        $this->type = $request->type ;
        $this->name = $request->name ;
        $this->partner_title_id = $request->partner_title_id ;
        $this->job_title = $request->job_title ;
        $this->email = $request->email ;
        $this->phone = $request->phone ;
        $this->mobile = $request->mobile ;
        $this->notes = $request->notes ;
        $this->street1 = $request->street1 ;
        $this->street2 = $request->street2 ;
        $this->city = $request->city ;
        $this->state_id = $request->state_id ;
        $this->zip = $request->zip ;
        $this->country_id = $request->country_id ;
        $this->image_path = $request->image_path ;

    }
}

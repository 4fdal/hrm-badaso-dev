<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="BankInput",
 *     description="",
 *     @OA\Xml(
 *         name="BankInput"
 *     )
 * )
 */

class BankInput {
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
     *     title="bic",
     *     description="bic",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $bic;


    public function __construct(Request $request)
    {
        $request->validate([
           'name' => ['nullable', 'string'],
           'street1' => ['nullable', 'string'],
           'street2' => ['nullable', 'string'],
           'zip' => ['nullable', 'string'],
           'state_id' => ['nullable', 'integer'],
           'company_id' => ['nullable', 'integer'],
           'email' => ['nullable', 'string'],
           'phone' => ['nullable', 'string'],
           'is_active' => ['nullable', 'boolean'],
           'bic' => ['nullable', 'string'],

        ]);

        $this->name = $request->name ;
        $this->street1 = $request->street1 ;
        $this->street2 = $request->street2 ;
        $this->zip = $request->zip ;
        $this->state_id = $request->state_id ;
        $this->company_id = $request->company_id ;
        $this->email = $request->email ;
        $this->phone = $request->phone ;
        $this->is_active = $request->is_active ;
        $this->bic = $request->bic ;

    }
}

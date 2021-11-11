<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="JobInput",
 *     description="",
 *     @OA\Xml(
 *         name="JobInput"
 *     )
 * )
 */

class JobInput {
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
     *     title="no_of_employee",
     *     description="no_of_employee",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $no_of_employee;
    /**
     * @OA\Property(
     *     title="no_of_recruitment",
     *     description="no_of_recruitment",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $no_of_recruitment;
    /**
     * @OA\Property(
     *     title="no_of_hired_employee",
     *     description="no_of_hired_employee",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $no_of_hired_employee;
    /**
     * @OA\Property(
     *     title="reqruitment",
     *     description="reqruitment",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $reqruitment;
    /**
     * @OA\Property(
     *     title="departement_id",
     *     description="departement_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $departement_id;
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
     *     title="description",
     *     description="description",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $description;
    /**
     * @OA\Property(
     *     title="state",
     *     description="state",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $state;
    /**
     * @OA\Property(
     *     title="address_id",
     *     description="address_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $address_id;
    /**
     * @OA\Property(
     *     title="manager_id",
     *     description="manager_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $manager_id;


    public function __construct(Request $request)
    {
        $request->validate([
           'name' => ['nullable', 'string'],
           'no_of_employee' => ['nullable', 'integer'],
           'no_of_recruitment' => ['nullable', 'integer'],
           'no_of_hired_employee' => ['nullable', 'integer'],
           'reqruitment' => ['nullable', 'string'],
           'departement_id' => ['nullable', 'integer'],
           'company_id' => ['nullable', 'integer'],
           'description' => ['nullable', 'string'],
           'state' => ['nullable', 'string'],
           'address_id' => ['nullable', 'integer'],
           'manager_id' => ['nullable', 'integer'],

        ]);

        $this->name = $request->name ;
        $this->no_of_employee = $request->no_of_employee ;
        $this->no_of_recruitment = $request->no_of_recruitment ;
        $this->no_of_hired_employee = $request->no_of_hired_employee ;
        $this->reqruitment = $request->reqruitment ;
        $this->departement_id = $request->departement_id ;
        $this->company_id = $request->company_id ;
        $this->description = $request->description ;
        $this->state = $request->state ;
        $this->address_id = $request->address_id ;
        $this->manager_id = $request->manager_id ;

    }
}

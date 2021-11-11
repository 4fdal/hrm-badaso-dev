<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="TimeOffAllocationInput",
 *     description="",
 *     @OA\Xml(
 *         name="TimeOffAllocationInput"
 *     )
 * )
 */

class TimeOffAllocationInput {
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
     *     title="time_off_type_id",
     *     description="time_off_type_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $time_off_type_id;
    /**
     * @OA\Property(
     *     title="allocation_types",
     *     description="allocation_types",
     *     type="string",
     *     example="lorem type"
     * )
     *
     * @var string
     */
    public $allocation_types;
    /**
     * @OA\Property(
     *     title="number_of_day",
     *     description="number_of_day",
     *     type="double",
     *     example="0"
     * )
     *
     * @var double
     */
    public $number_of_day;
    /**
     * @OA\Property(
     *     title="holiday_mode",
     *     description="holiday_mode",
     *     type="string",
     *     example="lorem type"
     * )
     *
     * @var string
     */
    public $holiday_mode;
    /**
     * @OA\Property(
     *     title="for_employee_id",
     *     description="for_employee_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $for_employee_id;
    /**
     * @OA\Property(
     *     title="for_company_id",
     *     description="for_company_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $for_company_id;
    /**
     * @OA\Property(
     *     title="for_departement_id",
     *     description="for_departement_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $for_departement_id;
    /**
     * @OA\Property(
     *     title="for_employee_categorie_id",
     *     description="for_employee_categorie_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $for_employee_categorie_id;
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
     *     title="first_approve_employee_id",
     *     description="first_approve_employee_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $first_approve_employee_id;
    /**
     * @OA\Property(
     *     title="second_approve_employee_id",
     *     description="second_approve_employee_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $second_approve_employee_id;


    public function __construct(Request $request)
    {
        $request->validate([
           'name' => ['nullable', 'string'],
           'time_off_type_id' => ['nullable', 'integer'],
           'allocation_types' => ['nullable', 'string'],
           'number_of_day' => ['nullable', 'numeric'],
           'holiday_mode' => ['nullable', 'string'],
           'for_employee_id' => ['nullable', 'integer'],
           'for_company_id' => ['nullable', 'integer'],
           'for_departement_id' => ['nullable', 'integer'],
           'for_employee_categorie_id' => ['nullable', 'integer'],
           'description' => ['nullable', 'string'],
           'first_approve_employee_id' => ['nullable', 'integer'],
           'second_approve_employee_id' => ['nullable', 'integer'],

        ]);

        $this->name = $request->name ;
        $this->time_off_type_id = $request->time_off_type_id ;
        $this->allocation_types = $request->allocation_types ;
        $this->number_of_day = $request->number_of_day ;
        $this->holiday_mode = $request->holiday_mode ;
        $this->for_employee_id = $request->for_employee_id ;
        $this->for_company_id = $request->for_company_id ;
        $this->for_departement_id = $request->for_departement_id ;
        $this->for_employee_categorie_id = $request->for_employee_categorie_id ;
        $this->description = $request->description ;
        $this->first_approve_employee_id = $request->first_approve_employee_id ;
        $this->second_approve_employee_id = $request->second_approve_employee_id ;

    }
}

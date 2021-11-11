<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="DepartementInput",
 *     description="",
 *     @OA\Xml(
 *         name="DepartementInput"
 *     )
 * )
 */

class DepartementInput {
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
     *     title="complete_name",
     *     description="complete_name",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $complete_name;
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
     *     title="manager_id",
     *     description="manager_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $manager_id;
    /**
     * @OA\Property(
     *     title="note",
     *     description="note",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $note;
    /**
     * @OA\Property(
     *     title="color",
     *     description="color",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $color;


    public function __construct(Request $request)
    {
        $request->validate([
           'name' => ['nullable', 'string'],
           'complete_name' => ['nullable', 'string'],
           'is_active' => ['nullable', 'boolean'],
           'company_id' => ['nullable', 'integer'],
           'parent_id' => ['nullable', 'integer'],
           'manager_id' => ['nullable', 'integer'],
           'note' => ['nullable', 'string'],
           'color' => ['nullable', 'string'],

        ]);

        $this->name = $request->name ;
        $this->complete_name = $request->complete_name ;
        $this->is_active = $request->is_active ;
        $this->company_id = $request->company_id ;
        $this->parent_id = $request->parent_id ;
        $this->manager_id = $request->manager_id ;
        $this->note = $request->note ;
        $this->color = $request->color ;

    }
}

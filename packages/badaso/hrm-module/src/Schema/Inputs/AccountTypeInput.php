<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="AccountTypeInput",
 *     description="",
 *     @OA\Xml(
 *         name="AccountTypeInput"
 *     )
 * )
 */

class AccountTypeInput {
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
     *     title="include_initial_balence",
     *     description="include_initial_balence",
     *     type="boolean",
     *     example=""
     * )
     *
     * @var boolean
     */
    public $include_initial_balence;
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
     *     title="internal_group",
     *     description="internal_group",
     *     type="string",
     *     example="lorem type"
     * )
     *
     * @var string
     */
    public $internal_group;
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


    public function __construct(Request $request)
    {
        $request->validate([
           'name' => ['nullable', 'string'],
           'company_id' => ['nullable', 'integer'],
           'include_initial_balence' => ['nullable', 'boolean'],
           'type' => ['nullable', 'string'],
           'internal_group' => ['nullable', 'string'],
           'note' => ['nullable', 'string'],

        ]);

        $this->name = $request->name ;
        $this->company_id = $request->company_id ;
        $this->include_initial_balence = $request->include_initial_balence ;
        $this->type = $request->type ;
        $this->internal_group = $request->internal_group ;
        $this->note = $request->note ;

    }
}

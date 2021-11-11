<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="AccountGroupInput",
 *     description="",
 *     @OA\Xml(
 *         name="AccountGroupInput"
 *     )
 * )
 */

class AccountGroupInput {
    /**
     * @OA\Property(
     *     title="parent_path",
     *     description="parent_path",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $parent_path;
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
     *     title="code_prefix_start",
     *     description="code_prefix_start",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $code_prefix_start;
    /**
     * @OA\Property(
     *     title="code_prefix_end",
     *     description="code_prefix_end",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $code_prefix_end;
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


    public function __construct(Request $request)
    {
        $request->validate([
           'parent_path' => ['nullable', 'string'],
           'name' => ['nullable', 'string'],
           'code_prefix_start' => ['nullable', 'string'],
           'code_prefix_end' => ['nullable', 'string'],
           'company_id' => ['nullable', 'integer'],

        ]);

        $this->parent_path = $request->parent_path ;
        $this->name = $request->name ;
        $this->code_prefix_start = $request->code_prefix_start ;
        $this->code_prefix_end = $request->code_prefix_end ;
        $this->company_id = $request->company_id ;

    }
}

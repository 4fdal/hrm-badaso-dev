<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="ResumeLineTypeInput",
 *     description="",
 *     @OA\Xml(
 *         name="ResumeLineTypeInput"
 *     )
 * )
 */

class ResumeLineTypeInput {
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
     *     title="sequnce",
     *     description="sequnce",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $sequnce;


    public function __construct(Request $request)
    {
        $request->validate([
           'name' => ['nullable', 'string'],
           'sequnce' => ['nullable', 'integer'],

        ]);

        $this->name = $request->name ;
        $this->sequnce = $request->sequnce ;

    }
}

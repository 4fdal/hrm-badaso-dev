<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="SkillInput",
 *     description="",
 *     @OA\Xml(
 *         name="SkillInput"
 *     )
 * )
 */

class SkillInput {
    /**
     * @OA\Property(
     *     title="skill_type_id",
     *     description="skill_type_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $skill_type_id;
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


    public function __construct(Request $request)
    {
        $request->validate([
           'skill_type_id' => ['nullable', 'integer'],
           'name' => ['nullable', 'string'],

        ]);

        $this->skill_type_id = $request->skill_type_id ;
        $this->name = $request->name ;

    }
}

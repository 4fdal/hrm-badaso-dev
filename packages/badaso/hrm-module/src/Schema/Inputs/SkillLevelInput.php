<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="SkillLevelInput",
 *     description="",
 *     @OA\Xml(
 *         name="SkillLevelInput"
 *     )
 * )
 */

class SkillLevelInput {
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
    /**
     * @OA\Property(
     *     title="level_progress",
     *     description="level_progress",
     *     type="double",
     *     example="0"
     * )
     *
     * @var double
     */
    public $level_progress;


    public function __construct(Request $request)
    {
        $request->validate([
           'skill_type_id' => ['nullable', 'integer'],
           'name' => ['nullable', 'string'],
           'level_progress' => ['nullable', 'numeric'],

        ]);

        $this->skill_type_id = $request->skill_type_id ;
        $this->name = $request->name ;
        $this->level_progress = $request->level_progress ;

    }
}

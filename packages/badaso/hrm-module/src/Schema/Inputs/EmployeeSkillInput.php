<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="EmployeeSkillInput",
 *     description="",
 *     @OA\Xml(
 *         name="EmployeeSkillInput"
 *     )
 * )
 */

class EmployeeSkillInput {
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
     *     title="skill_id",
     *     description="skill_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $skill_id;
    /**
     * @OA\Property(
     *     title="skill_level_id",
     *     description="skill_level_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $skill_level_id;


    public function __construct(Request $request)
    {
        $request->validate([
           'skill_type_id' => ['nullable', 'integer'],
           'skill_id' => ['nullable', 'integer'],
           'skill_level_id' => ['nullable', 'integer'],

        ]);

        $this->skill_type_id = $request->skill_type_id ;
        $this->skill_id = $request->skill_id ;
        $this->skill_level_id = $request->skill_level_id ;

    }
}

<?php

namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="RecruitmentInput",
 *     description="",
 *     @OA\Xml(
 *         name="RecruitmentInput"
 *     )
 * )
 */

class RecruitmentInput
{
    /**
     * @OA\Property(
     *     title="job_id",
     *     description="job_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $job_id;

    /**
     * @OA\Property(
     *     title="recruiter_id",
     *     description="recruiter_id from user id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $recruiter_id;

    /**
     * @OA\Property(
     *     title="is_favorite",
     *     description="is_favorite",
     *     type="double",
     *     example="0"
     * )
     *
     * @var double
     */
    public $is_favorite;
    /**
     * @OA\Property(
     *     title="no_of_application",
     *     description="no_of_application",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $no_of_application;
    /**
     * @OA\Property(
     *     title="no_of_to_recruit",
     *     description="no_of_to_recruit",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $no_of_to_recruit;
    /**
     * @OA\Property(
     *     title="no_of_new_application",
     *     description="no_of_new_application",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $no_of_new_application;
    /**
     * @OA\Property(
     *     title="is_recruitment_done",
     *     description="is_recruitment_done",
     *     type="boolean",
     *     example=false
     * )
     *
     * @var boolean
     */
    public $is_recruitment_done;
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
            'job_id' => ['nullable', 'integer'],
            'is_favorite' => ['nullable', 'numeric'],
            'no_of_application' => ['nullable', 'integer'],
            'no_of_to_recruit' => ['nullable', 'integer'],
            'no_of_new_application' => ['nullable', 'integer'],
            'color' => ['nullable', 'string'],
            'recruiter_id' => ['nullable', "exists:" . config('badaso.database.prefix') . "users,id"],
            'is_recruitment_done' => ['nullable', 'boolean']
        ]);

        $this->job_id = $request->job_id;
        $this->is_favorite = $request->is_favorite;
        $this->no_of_application = $request->no_of_application;
        $this->no_of_to_recruit = $request->no_of_to_recruit;
        $this->no_of_new_application = $request->no_of_new_application;
        $this->color = $request->color;
        $this->recruiter_id = $request->recruiter_id;
        $this->is_recruitment_done = $request->is_recruitment_done ;
    }
}

<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="ApplicantFollowerInput",
 *     description="",
 *     @OA\Xml(
 *         name="ApplicantFollowerInput"
 *     )
 * )
 */

class ApplicantFollowerInput {
    /**
     * @OA\Property(
     *     title="applicant_id",
     *     description="applicant_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $applicant_id;
    /**
     * @OA\Property(
     *     title="user_id",
     *     description="user_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $user_id;


    public function __construct(Request $request)
    {
        $request->validate([
           'applicant_id' => ['nullable', 'integer'],
           'user_id' => ['nullable', 'integer'],

        ]);

        $this->applicant_id = $request->applicant_id ;
        $this->user_id = $request->user_id ;

    }
}

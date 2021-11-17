<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="ApplicantCreateEmployeeInput",
 *     description="",
 *     @OA\Xml(
 *         name="ApplicantCreateEmployeeInput"
 *     )
 * )
 */


class ApplicantCreateEmployeeInput{

    /**
     * @OA\Property(
     *     title="recruitment_id",
     *     description="recruitement_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $recruitment_id;

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

    public function __construct(Request $request)
    {
        $request->validate([
            'recruitment_id' => 'required|integer',
            'applicant_id' => 'required|integer',
        ]);

        $this->recruitment_id = $request->recruitment_id;
        $this->applicant_id = $request->applicant_id;
    }
}

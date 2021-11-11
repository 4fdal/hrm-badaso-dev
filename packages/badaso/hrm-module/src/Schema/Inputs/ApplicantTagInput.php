<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="ApplicantTagInput",
 *     description="",
 *     @OA\Xml(
 *         name="ApplicantTagInput"
 *     )
 * )
 */

class ApplicantTagInput {
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
     *     title="applicant_category_id",
     *     description="applicant_category_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $applicant_category_id;


    public function __construct(Request $request)
    {
        $request->validate([
           'applicant_id' => ['nullable', 'integer'],
           'applicant_category_id' => ['nullable', 'integer'],

        ]);

        $this->applicant_id = $request->applicant_id ;
        $this->applicant_category_id = $request->applicant_category_id ;

    }
}

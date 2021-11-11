<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="ApplicantCommentInput",
 *     description="",
 *     @OA\Xml(
 *         name="ApplicantCommentInput"
 *     )
 * )
 */

class ApplicantCommentInput {
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
    /**
     * @OA\Property(
     *     title="message",
     *     description="message",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $message;
    /**
     * @OA\Property(
     *     title="attachments",
     *     description="attachments",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $attachments;


    public function __construct(Request $request)
    {
        $request->validate([
           'applicant_id' => ['nullable', 'integer'],
           'user_id' => ['nullable', 'integer'],
           'message' => ['nullable', 'string'],
           'attachments' => ['nullable', 'string'],

        ]);

        $this->applicant_id = $request->applicant_id ;
        $this->user_id = $request->user_id ;
        $this->message = $request->message ;
        $this->attachments = $request->attachments ;

    }
}

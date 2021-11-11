<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="RecruitmentSourceInput",
 *     description="",
 *     @OA\Xml(
 *         name="RecruitmentSourceInput"
 *     )
 * )
 */

class RecruitmentSourceInput {
    /**
     * @OA\Property(
     *     title="source",
     *     description="source",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $source;
    /**
     * @OA\Property(
     *     title="recruitment_id",
     *     description="recruitment_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $recruitment_id;


    public function __construct(Request $request)
    {
        $request->validate([
           'source' => ['nullable', 'string'],
           'recruitment_id' => ['nullable', 'integer'],

        ]);

        $this->source = $request->source ;
        $this->recruitment_id = $request->recruitment_id ;

    }
}

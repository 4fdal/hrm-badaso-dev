<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="WorkeInput",
 *     description="",
 *     @OA\Xml(
 *         name="WorkeInput"
 *     )
 * )
 */

class WorkeInput {
    /**
     * @OA\Property(
     *     title="company_id",
     *     description="company_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $company_id;
    /**
     * @OA\Property(
     *     title="average_hours_per_day",
     *     description="average_hours_per_day",
     *     type="string",
     *     example="08:11:17"
     * )
     *
     * @var string
     */
    public $average_hours_per_day;
    /**
     * @OA\Property(
     *     title="timezone",
     *     description="timezone",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $timezone;


    public function __construct(Request $request)
    {
        $request->validate([
           'company_id' => ['nullable', 'integer'],
           'average_hours_per_day' => ['nullable', 'date_format:H:i:s'],
           'timezone' => ['nullable', 'string'],

        ]);

        $this->company_id = $request->company_id ;
        $this->average_hours_per_day = $request->average_hours_per_day ;
        $this->timezone = $request->timezone ;

    }
}

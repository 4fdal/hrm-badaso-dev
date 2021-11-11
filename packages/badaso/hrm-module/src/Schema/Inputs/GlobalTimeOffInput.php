<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="GlobalTimeOffInput",
 *     description="",
 *     @OA\Xml(
 *         name="GlobalTimeOffInput"
 *     )
 * )
 */

class GlobalTimeOffInput {
    /**
     * @OA\Property(
     *     title="worke_id",
     *     description="worke_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $worke_id;
    /**
     * @OA\Property(
     *     title="reason",
     *     description="reason",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $reason;
    /**
     * @OA\Property(
     *     title="start_date",
     *     description="start_date",
     *     type="string",
     *     example="2021-10-28 08:11:17"
     * )
     *
     * @var string
     */
    public $start_date;
    /**
     * @OA\Property(
     *     title="end_date",
     *     description="end_date",
     *     type="string",
     *     example="2021-10-28 08:11:17"
     * )
     *
     * @var string
     */
    public $end_date;


    public function __construct(Request $request)
    {
        $request->validate([
           'worke_id' => ['nullable', 'integer'],
           'reason' => ['nullable', 'string'],
           'start_date' => ['nullable', 'date_format:Y-m-d H:i:s'],
           'end_date' => ['nullable', 'date_format:Y-m-d H:i:s'],

        ]);

        $this->worke_id = $request->worke_id ;
        $this->reason = $request->reason ;
        $this->start_date = $request->start_date ;
        $this->end_date = $request->end_date ;

    }
}

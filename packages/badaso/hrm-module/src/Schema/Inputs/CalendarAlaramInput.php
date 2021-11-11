<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="CalendarAlaramInput",
 *     description="",
 *     @OA\Xml(
 *         name="CalendarAlaramInput"
 *     )
 * )
 */

class CalendarAlaramInput {
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
     *     title="alaram_type",
     *     description="alaram_type",
     *     type="string",
     *     example="lorem type"
     * )
     *
     * @var string
     */
    public $alaram_type;
    /**
     * @OA\Property(
     *     title="duration",
     *     description="duration",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $duration;
    /**
     * @OA\Property(
     *     title="interval",
     *     description="interval",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $interval;


    public function __construct(Request $request)
    {
        $request->validate([
           'name' => ['nullable', 'string'],
           'alaram_type' => ['nullable', 'string'],
           'duration' => ['nullable', 'integer'],
           'interval' => ['nullable', 'string'],

        ]);

        $this->name = $request->name ;
        $this->alaram_type = $request->alaram_type ;
        $this->duration = $request->duration ;
        $this->interval = $request->interval ;

    }
}

<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="LunchCashmoveInput",
 *     description="",
 *     @OA\Xml(
 *         name="LunchCashmoveInput"
 *     )
 * )
 */

class LunchCashmoveInput {
    /**
     * @OA\Property(
     *     title="currency_id",
     *     description="currency_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $currency_id;
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
     *     title="date",
     *     description="date",
     *     type="string",
     *     example="2021-10-28"
     * )
     *
     * @var string
     */
    public $date;
    /**
     * @OA\Property(
     *     title="amount",
     *     description="amount",
     *     type="double",
     *     example="0"
     * )
     *
     * @var double
     */
    public $amount;
    /**
     * @OA\Property(
     *     title="description",
     *     description="description",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $description;


    public function __construct(Request $request)
    {
        $request->validate([
           'currency_id' => ['nullable', 'integer'],
           'user_id' => ['nullable', 'integer'],
           'date' => ['nullable', 'date_format:Y-m-d'],
           'amount' => ['nullable', 'numeric'],
           'description' => ['nullable', 'string'],

        ]);

        $this->currency_id = $request->currency_id ;
        $this->user_id = $request->user_id ;
        $this->date = $request->date ;
        $this->amount = $request->amount ;
        $this->description = $request->description ;

    }
}

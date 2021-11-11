<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="LunchProductFavoriteInput",
 *     description="",
 *     @OA\Xml(
 *         name="LunchProductFavoriteInput"
 *     )
 * )
 */

class LunchProductFavoriteInput {
    /**
     * @OA\Property(
     *     title="lunch_product_id",
     *     description="lunch_product_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $lunch_product_id;
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
           'lunch_product_id' => ['nullable', 'integer'],
           'user_id' => ['nullable', 'integer'],

        ]);

        $this->lunch_product_id = $request->lunch_product_id ;
        $this->user_id = $request->user_id ;

    }
}

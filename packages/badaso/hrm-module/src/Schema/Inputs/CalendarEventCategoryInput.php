<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="CalendarEventCategoryInput",
 *     description="",
 *     @OA\Xml(
 *         name="CalendarEventCategoryInput"
 *     )
 * )
 */

class CalendarEventCategoryInput {
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


    public function __construct(Request $request)
    {
        $request->validate([
           'name' => ['nullable', 'string'],

        ]);

        $this->name = $request->name ;

    }
}

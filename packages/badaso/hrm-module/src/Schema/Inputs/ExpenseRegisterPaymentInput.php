<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="ExpenseRegisterPaymentInput",
 *     description="",
 *     @OA\Xml(
 *         name="ExpenseRegisterPaymentInput"
 *     )
 * )
 */

class ExpenseRegisterPaymentInput {


    public function __construct(Request $request)
    {
        $request->validate([
 
        ]);


    }
}

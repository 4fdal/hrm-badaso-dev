<?php
namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="AccountInput",
 *     description="",
 *     @OA\Xml(
 *         name="AccountInput"
 *     )
 * )
 */

class AccountInput {
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
     *     title="code",
     *     description="code",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $code;
    /**
     * @OA\Property(
     *     title="is_deprecated",
     *     description="is_deprecated",
     *     type="boolean",
     *     example=""
     * )
     *
     * @var boolean
     */
    public $is_deprecated;
    /**
     * @OA\Property(
     *     title="account_type_id",
     *     description="account_type_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $account_type_id;
    /**
     * @OA\Property(
     *     title="internal_type",
     *     description="internal_type",
     *     type="string",
     *     example="lorem type"
     * )
     *
     * @var string
     */
    public $internal_type;
    /**
     * @OA\Property(
     *     title="internal_global",
     *     description="internal_global",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $internal_global;
    /**
     * @OA\Property(
     *     title="is_reconcile",
     *     description="is_reconcile",
     *     type="boolean",
     *     example=""
     * )
     *
     * @var boolean
     */
    public $is_reconcile;
    /**
     * @OA\Property(
     *     title="note",
     *     description="note",
     *     type="string",
     *     example="Lorem ibsum siamet"
     * )
     *
     * @var string
     */
    public $note;
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
     *     title="account_group_id",
     *     description="account_group_id",
     *     type="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $account_group_id;
    /**
     * @OA\Property(
     *     title="root_id",
     *     description="root_id",
     *     type="boolean",
     *     example=""
     * )
     *
     * @var boolean
     */
    public $root_id;
    /**
     * @OA\Property(
     *     title="is_off_balance",
     *     description="is_off_balance",
     *     type="boolean",
     *     example=""
     * )
     *
     * @var boolean
     */
    public $is_off_balance;


    public function __construct(Request $request)
    {
        $request->validate([
           'name' => ['nullable', 'string'],
           'currency_id' => ['nullable', 'integer'],
           'code' => ['nullable', 'string'],
           'is_deprecated' => ['nullable', 'boolean'],
           'account_type_id' => ['nullable', 'integer'],
           'internal_type' => ['nullable', 'string'],
           'internal_global' => ['nullable', 'string'],
           'is_reconcile' => ['nullable', 'boolean'],
           'note' => ['nullable', 'string'],
           'company_id' => ['nullable', 'integer'],
           'account_group_id' => ['nullable', 'integer'],
           'root_id' => ['nullable', 'boolean'],
           'is_off_balance' => ['nullable', 'boolean'],

        ]);

        $this->name = $request->name ;
        $this->currency_id = $request->currency_id ;
        $this->code = $request->code ;
        $this->is_deprecated = $request->is_deprecated ;
        $this->account_type_id = $request->account_type_id ;
        $this->internal_type = $request->internal_type ;
        $this->internal_global = $request->internal_global ;
        $this->is_reconcile = $request->is_reconcile ;
        $this->note = $request->note ;
        $this->company_id = $request->company_id ;
        $this->account_group_id = $request->account_group_id ;
        $this->root_id = $request->root_id ;
        $this->is_off_balance = $request->is_off_balance ;

    }
}

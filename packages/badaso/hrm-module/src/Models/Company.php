<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "name", "parent_id", "currency_id", "sequnce", "partner_id", "report_header", "report_footer", "img_logo_path", "email", "phone"] ;

    public $public_data_rows = [['name','varchar'],['parent_id','int'],['currency_id','int'],['sequnce','int'],['partner_id','int'],['report_header','text'],['report_footer','text'],['img_logo_path','varchar'],['email','varchar'],['phone','varchar']] ;

    public $belongs_relation = [["foreign" => 'currency_id', "references" => 'id', "on" => 'currencies', "model_on" => Currency::class],["foreign" => 'parent_id', "references" => 'id', "on" => 'companies', "model_on" => Company::class],["foreign" => 'partner_id', "references" => 'id', "on" => 'partners', "model_on" => Partner::class]] ;

    public $many_relation = [["foreign" => 'company_id', "references" => 'id', "on" => 'partners', "model_on" => Partner::class],["foreign" => 'parent_id', "references" => 'id', "on" => 'companies', "model_on" => Company::class],["foreign" => 'company_id', "references" => 'id', "on" => 'workes', "model_on" => Worke::class],["foreign" => 'company_id', "references" => 'id', "on" => 'departements', "model_on" => Departement::class],["foreign" => 'company_id', "references" => 'id', "on" => 'jobs', "model_on" => Job::class],["foreign" => 'company_id', "references" => 'id', "on" => 'applicants', "model_on" => Applicant::class],["foreign" => 'company_id', "references" => 'id', "on" => 'time_off_types', "model_on" => TimeOffType::class],["foreign" => 'for_company_id', "references" => 'id', "on" => 'time_off_allocations', "model_on" => TimeOffAllocation::class],["foreign" => 'company_id', "references" => 'id', "on" => 'lunch_vendors', "model_on" => LunchVendor::class],["foreign" => 'company_id', "references" => 'id', "on" => 'lunch_locations', "model_on" => LunchLocation::class],["foreign" => 'company_id', "references" => 'id', "on" => 'lunch_product_categories', "model_on" => LunchProductCategory::class],["foreign" => 'company_id', "references" => 'id', "on" => 'lunch_orders', "model_on" => LunchOrder::class],["foreign" => 'company_id', "references" => 'id', "on" => 'fleet_vehicles', "model_on" => FleetVehicle::class],["foreign" => 'company_id', "references" => 'id', "on" => 'account_types', "model_on" => AccountType::class],["foreign" => 'company_id', "references" => 'id', "on" => 'account_taxes', "model_on" => AccountTaxe::class],["foreign" => 'company_id', "references" => 'id', "on" => 'account_groups', "model_on" => AccountGroup::class],["foreign" => 'company_id', "references" => 'id', "on" => 'accounts', "model_on" => Account::class],["foreign" => 'company_id', "references" => 'id', "on" => 'banks', "model_on" => Bank::class],["foreign" => 'company_id', "references" => 'id', "on" => 'partner_banks', "model_on" => PartnerBank::class],["foreign" => 'company_id', "references" => 'id', "on" => 'account_journals', "model_on" => AccountJournal::class],["foreign" => 'company_id', "references" => 'id', "on" => 'expense_reports', "model_on" => ExpenseReport::class]] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'companies';
        parent::__construct($attributes);
    }

    public function currency(){ return $this->belongsTo(Currency::class, "currency_id"); }
    public function parent(){ return $this->belongsTo(Company::class, "parent_id"); }
    public function partner(){ return $this->belongsTo(Partner::class, "partner_id"); }


    public function companyPartners(){ return $this->hasMany(Partner::class, "company_id"); }
    public function parentCompanies(){ return $this->hasMany(Company::class, "parent_id"); }
    public function companyWorkes(){ return $this->hasMany(Worke::class, "company_id"); }
    public function companyDepartements(){ return $this->hasMany(Departement::class, "company_id"); }
    public function companyJobs(){ return $this->hasMany(Job::class, "company_id"); }
    public function companyApplicants(){ return $this->hasMany(Applicant::class, "company_id"); }
    public function companyTimeOffTypes(){ return $this->hasMany(TimeOffType::class, "company_id"); }
    public function forCompanyTimeOffAllocations(){ return $this->hasMany(TimeOffAllocation::class, "for_company_id"); }
    public function companyLunchVendors(){ return $this->hasMany(LunchVendor::class, "company_id"); }
    public function companyLunchLocations(){ return $this->hasMany(LunchLocation::class, "company_id"); }
    public function companyLunchProductCategories(){ return $this->hasMany(LunchProductCategory::class, "company_id"); }
    public function companyLunchOrders(){ return $this->hasMany(LunchOrder::class, "company_id"); }
    public function companyFleetVehicles(){ return $this->hasMany(FleetVehicle::class, "company_id"); }
    public function companyAccountTypes(){ return $this->hasMany(AccountType::class, "company_id"); }
    public function companyAccountTaxes(){ return $this->hasMany(AccountTaxe::class, "company_id"); }
    public function companyAccountGroups(){ return $this->hasMany(AccountGroup::class, "company_id"); }
    public function companyAccounts(){ return $this->hasMany(Account::class, "company_id"); }
    public function companyBanks(){ return $this->hasMany(Bank::class, "company_id"); }
    public function companyPartnerBanks(){ return $this->hasMany(PartnerBank::class, "company_id"); }
    public function companyAccountJournals(){ return $this->hasMany(AccountJournal::class, "company_id"); }
    public function companyExpenseReports(){ return $this->hasMany(ExpenseReport::class, "company_id"); }

}
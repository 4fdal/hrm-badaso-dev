<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "name", "parent_id", "currency_id", "sequnce", "partner_id", "report_header", "report_footer", "img_logo_path", "email", "phone"] ;

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

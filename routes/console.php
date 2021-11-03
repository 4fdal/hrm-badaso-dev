<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command("run", function () {
    $string = <<<TXT
    Table degrees {
    id int [pk, increment]
    name varchar
    }

    Table currencies {
    id int [pk, increment]
    name varchar
    sysmbol varchar
    rounding double
    decimal_place int
    is_active boolean
    position enum // after, before
    currency_unit_label varchar
    currency_subunit_label varchar
    }

    Table countries {
    id int [pk, increment]
    name varchar
    code varchar
    currency_id int
    phone_code varchar
    name_position varchar
    vat_label varchar
    }

    Ref: countries.currency_id > currencies.id

    Table states {
    id int [pk, increment]
    name varchar
    country_id int
    code varchar
    }

    Ref: states.country_id > countries.id

    Table industries {
    id int [pk, increment]
    name varchar
    full_name varchar
    is_active boolean
    }

    Table partners {
    id int [pk, increment]
    company_id int
    name varchar
    display_name varchar
    parent_id int
    lang varchar
    timezone varchar
    vat varchar
    website varchar
    credit_limit varchar
    is_active boolean
    type enum // private, contact,
    street1 varchar
    street2 varchar
    zip varchar
    city varchar
    state_id int
    country_id int
    latitude double
    longitute double
    email varchar
    phone varchar
    mobile varchar
    is_comapany double
    industry_id int
    commercial_partner_id int
    commercial_company_name varchar
    company_name varchar
    }

    Ref: partners.parent_id > partners.id
    Ref: partners.industry_id > industries.id
    Ref: partners.commercial_partner_id > partners.id

    Table companies{
    id int [pk, increment]
    name varchar
    parent_id int
    currency_id int
    sequnce int
    partner_id int
    report_header text
    report_footer text
    img_logo_path varchar
    email varchar
    phone varchar
    }

    Ref: partners.company_id > companies.id

    Ref: companies.currency_id > currencies.id
    Ref: companies.parent_id > companies.id
    Ref: companies.partner_id > partners.id

    Table workes{
    id int [pk, increment]
    company_id int
    average_hours_per_day time
    timezone varchar
    }

    Ref: workes.company_id > companies.id

    Table work_hours{
    id int [pk, increment]
    work_id int
    name varchar
    day_of_week varchar
    day_period varchar
    work_from time
    work_to time
    start_date datetime
    end_date datetime
    }

    Ref: work_hours.work_id > workes.id

    Table global_time_offs{
    id int [pk, increment]
    worke_id int
    reason varchar
    start_date datetime
    end_date datetime
    }

    Ref: global_time_offs.worke_id > workes.id

    Table employees{
    id int [pk, increment]
    user_id int
    name varchar
    job_postion_name varchar
    work_mobile varchar
    work_phone varchar
    work_email varchar
    departement_id int
    company_id int
    coach_id int
    is_active boolean
    // work information
    work_address_id int
    work_location varchar

    approve_time_off_user_id int
    approve_expenses_user_id int

    work_id int
    tz varchar

    // private information
    address_id int
    email varchar
    phone varchar
    home_work_distance double
    marital_status enum // single, marrid, dll.
    emergency_contanct varchar
    emergency_phone varchar
    certificate_level_id varchar
    field_of_study varchar
    school varchar
    country_id int
    identification_no varchar
    pasport_no varchar
    gender enum // male, fimale
    data_of_birth varchar
    place_of_birth varchar
    country_of_birth_id int
    no_of_children int
    visa_no varchar
    work_permit_no varchar
    visa_expire_data date

    // HR settigs
    job_id int
    mobility_card varchar
    pin_code varchar
    id_badge varchar
    }

    Ref: employees.user_id > badaso_users.id
    Ref: employees.approve_time_off_user_id > badaso_users.id
    Ref: employees.approve_expenses_user_id > badaso_users.id
    Ref: employees.work_id > workes.id
    Ref: employees.certificate_level_id > degrees.id
    Ref: employees.country_id > countries.id
    Ref: employees.country_of_birth_id > countries.id

    Table employee_categories{
    id int [pk, increment]
    name varchar
    color varchar
    }

    Table employee_tags{
    id int [pk, increment]
    employee_id int
    employee_categorie_id int
    }

    Ref: employee_tags.employee_id > employees.id
    Ref: employee_tags.employee_categorie_id > employee_categories.id

    Table resume_line_types{
    id int [pk, increment]
    name varchar
    sequnce int
    }

    Table employee_resumes{
    id int [pk, increment]
    employee_id int
    resume_line_type_id int
    display_type enum // classic
    start date
    end date
    description text
    }

    Ref: employee_resumes.employee_id > employees.id
    Ref: employee_resumes.resume_line_type_id > resume_line_types.id

    Table skill_types{
    id int [pk, increment]
    name varchar
    }

    Table skill_levels{
    id int [pk, increment]
    skill_type_id int
    name varchar
    level_progress double
    }

    Ref: skill_levels.skill_type_id > skill_types.id

    Table skills{
    id int [pk, increment]
    skill_type_id int
    name varchar
    }

    Ref: skills.skill_type_id > skill_types.id

    Table employee_skills{
    id int [pk, increment]
    skill_type_id int
    skill_id int
    skill_level_id int
    }

    Ref: employee_skills.skill_type_id > skill_types.id
    Ref: employee_skills.skill_id > skills.id
    Ref: employee_skills.skill_level_id > skill_levels.id

    Table employee_attendances{
    id int [pk, increment]
    employee_id int
    check_in datetime
    check_out datetime
    worked_hours double // selisih check out - check in
    }

    Ref: employee_attendances.employee_id > employees.id

    Table partner_titles {
    id int [pk, increment]
    name varchar // doctor, mister, madam, dll
    shortcut varchar
    }


    Table company_contacts{
    id int [pk, increment]
    type enum // contact, invoice_address, delivery_address, other_address, private_address
    name varchar
    partner_title_id int
    job_title varchar
    email varchar
    phone varchar
    mobile varchar
    notes text
    street1 varchar
    street2 varchar
    city varchar
    state_id int
    zip varchar
    country_id int
    image_path varchar
    }

    Ref: company_contacts.partner_title_id > partner_titles.id
    Ref: company_contacts.state_id > states.id
    Ref: company_contacts.country_id > countries.id

    Table departements{
    id int [pk, increment]
    name varchar
    complete_name varchar
    is_active boolean
    company_id int
    parent_id int
    manager_id int
    note text
    color varchar
    }

    Ref: departements.company_id > companies.id
    Ref: departements.parent_id > departements.id
    Ref: departements.manager_id > employees.id

    Table jobs{
    id int [pk, increment]
    name varchar
    no_of_employee int
    no_of_recruitment int
    no_of_hired_employee int
    reqruitment text
    departement_id int
    company_id int
    description text
    state text
    address_id int
    manager_id int
    }

    Ref: jobs.departement_id > departements.id
    Ref: jobs.company_id > companies.id
    Ref: jobs.manager_id > employees.id

    Table recruitments{
    id int [pk, increment]
    job_id int
    is_favorite double
    no_of_application int
    no_of_to_recruit int
    no_of_new_application int
    color varchar
    }

    Ref: recruitments.job_id > jobs.id

    Table recruitment_stages{
    id int [pk, increment]
    name varchar
    sequnce int
    }

    Table recruitment_sources{
    id int [pk, increment]
    source varchar // linkin, facebook, gmail
    recruitment_id int
    }

    Ref: recruitment_sources.recruitment_id > recruitments.id

    Table metsos_sources {
    id int [pk, increment]
    name varchar
    }

    Table applicants {
    id int [pk, increment]
    title varchar
    name varchar
    email varchar
    phone varchar
    mobile varchar
    degree_id int
    job_id int
    departement_id int
    company_id int
    // hasMany to applicant_tags
    recruiter_id int
    appreciation int
    metsos_source_id int
    expected_salary double
    expected_salary_extra double
    proposed_salary double
    proposed_salary_extra double
    availability date
    description text
    is_active boolean
    date_closed date
    date_open date
    date_last_stage_up date
    recruitment_stage_id int
    last_recruitment_stage_id int
    probability double
    user_id int
    }

    Ref: applicants.degree_id > degrees.id
    Ref: applicants.job_id > jobs.id
    Ref: applicants.departement_id > departements.id
    Ref: applicants.company_id > companies.id
    Ref: applicants.metsos_source_id > metsos_sources.id
    Ref: applicants.user_id > badaso_users.id

    Table applicant_categories{
    id int [pk, increment]
    name varchar
    color varchar
    }

    Table applicant_tags {
    id int [pk, increment]
    applicant_id int
    applicant_category_id int
    }

    Ref: applicant_tags.applicant_id > applicants.id
    Ref: applicant_tags.applicant_category_id > applicant_categories.id

    Table applicant_followers {
    id int [pk, increment]
    applicant_id int
    user_id int
    }

    Ref: applicant_followers.applicant_id > applicants.id
    Ref: applicant_followers.user_id > badaso_users.id

    Table applicant_comments {
    id int [pk, increment]
    applicant_id int
    user_id int
    message text
    attachments text // files
    }

    Ref: applicant_comments.applicant_id > applicants.id
    Ref: applicant_comments.user_id > badaso_users.id

    Table calendar_events{
    id int [pk, increment]
    name varchar
    start date
    stop date
    is_all_day boolean
    duration double
    description text
    privacy varchar // public, private, confidential
    localtion varchar
    user_id int
    is_active boolean
    is_recurrent boolean
    show_as enum // busy, free
    }

    Ref: calendar_events.user_id > badaso_users.id

    Table calendar_event_categories{
    id int [pk, increment]
    name varchar
    }

    Table calendar_event_tags{
    id int [pk, increment]
    calendar_event_id int
    calendar_event_category_id int
    }

    Ref: calendar_event_tags.calendar_event_id > calendar_events.id
    Ref: calendar_event_tags.calendar_event_category_id > calendar_event_categories.id

    Table calendar_recurrents{
    id int [pk, increment]
    calendar_event_id int
    name varchar
    event_tz varchar
    rrule varchar
    rrule_type varchar
    end_type varchar
    interval int
    count int
    mo boolean
    tu boolean
    we boolean
    th boolean
    fr boolean
    sa boolean
    su boolean
    month_by varchar
    day int
    byday varchar
    until date
    }

    Ref: calendar_recurrents.calendar_event_id > calendar_events.id

    Table calendar_attendees {
    id int [pk, increment]
    common_name varchar
    calendar_event_id int
    partner_id int
    }

    Ref: calendar_attendees.calendar_event_id > calendar_events.id
    Ref: calendar_attendees.partner_id > partners.id

    Table calendar_alarams{
    id int [pk, increment]
    name varchar
    alaram_type enum // notification, email
    duration int
    interval varchar // minutes, hours, days, duration_minutes,
    }

    Table calendar_reminders{
    id int [pk, increment]
    calendar_event_id int
    calendar_alaram_id int
    }

    Ref: calendar_reminders.calendar_event_id > calendar_events.id
    Ref: calendar_reminders.calendar_alaram_id > calendar_alarams.id

    Table calendar_recruitment_events{
    id int [pk, increment]
    done_status boolean
    calendar_event_id int
    }

    Ref: calendar_recruitment_events.calendar_event_id > calendar_events.id

    Table time_off_types{
    id int [pk, increment]

    is_create_calendar boolean
    is_active boolean
    color varchar
    company_id int

    name varchar
    payroll_code varchar
    take_time_off_types enum // day, half day,hours

    responsible_user_id int
    allocation_types enum // no => no limit, fixed => set by time off officer, fixed_allocation => allow employes request
    allocation_validation_types enum // hr => time off by officer , both => by employee manager, manager => by employee manager and time office

    validity_start date
    validity_stop date

    time_off_validation_types enum
    // no_validation => no validation
    // hr => by time off officer
    // manager => by employee manager
    // both => by employee manager and time off officer
    }

    Ref: time_off_types.company_id > companies.id
    Ref: time_off_types.responsible_user_id > badaso_users.id

    Table time_off_allocations{
    id int [pk, increment]
    name varchar
    time_off_type_id int
    allocation_types enum // regular, accrual
    number_of_day double

    holiday_mode enum // employee, company, departement, category
    for_employee_id int
    for_company_id int
    for_departement_id int
    for_employee_categorie_id int
    description text

    first_approve_employee_id int
    second_approve_employee_id int

    }

    Ref: time_off_allocations.time_off_type_id > time_off_types.id
    Ref: time_off_allocations.for_employee_id > employees.id
    Ref: time_off_allocations.for_company_id > companies.id
    Ref: time_off_allocations.for_departement_id > departements.id
    Ref: time_off_allocations.for_employee_categorie_id > employee_categories.id
    Ref: time_off_allocations.first_approve_employee_id > employees.id
    Ref: time_off_allocations.second_approve_employee_id > employees.id

    Table time_offs{
    id int [pk, increment]
    private_name varchar
    status enum // confirm, validate
    user_id int
    manager_employee_id int
    time_off_type_id int
    employee_id int
    departement_id int
    notes text
    date_from datetime
    date_to datetime
    number_of_day double
    duration_display varchar
    metting_calendar_event_id varchar
    }

    Ref: time_offs.user_id > badaso_users.id
    Ref: time_offs.manager_employee_id > employees.id
    Ref: time_offs.time_off_type_id > time_off_types.id
    Ref: time_offs.employee_id > employees.id
    Ref: time_offs.departement_id > departements.id
    Ref: time_offs.metting_calendar_event_id > calendar_events.id

    Table lunch_vendors{
    id int [pk, increment]
    partner_id int
    company_id int
    responsible_user_id int
    send_by enum // phone, mail
    automatic_email_time double
    is_recurrent_monday boolean
    is_recurrent_tuesday boolean
    is_recurrent_wednesday boolean
    is_recurrent_thursday boolean
    is_recurrent_friday boolean
    is_recurrent_saturday boolean
    is_recurrent_sunday boolean
    timezone varchar
    is_active boolean
    moment enum // am, pm
    delivery enum // delivery, no_delivery
    }

    Ref: lunch_vendors.partner_id > partners.id
    Ref: lunch_vendors.company_id > companies.id
    Ref: lunch_vendors.responsible_user_id > badaso_users.id

    Table lunch_locations{
    id int [pk, increment]
    name varchar
    address varchar
    company_id int
    }

    Ref: lunch_locations.company_id > companies.id

    Table lunch_vendors_location_orders{
    id int [pk, increment]
    lunch_vendor_id int
    lunch_locations_id int
    }

    Ref: lunch_vendors_location_orders.lunch_locations_id > lunch_locations.id
    Ref: lunch_vendors_location_orders.lunch_vendor_id > lunch_vendors.id

    Table lunch_product_categories{
    id int [pk, increment]
    name varchar
    company_id int
    is_active boolean
    }

    Ref: lunch_product_categories.company_id > companies.id

    Table lunch_product_category_toppings{
    id int [pk, increment]
    lunch_product_category_id int
    name varchar
    }

    Ref: lunch_product_category_toppings.lunch_product_category_id > lunch_product_category_toppings.id

    Table lunch_product_category_topping_items{
    id int [pk, increment]
    lunch_product_category_topping_id int
    name varchar
    price double
    }

    Ref: lunch_product_category_topping_items.lunch_product_category_topping_id > lunch_product_category_toppings.id

    Table lunch_toppings{
    id int [pk, increment]
    name varchar
    company_id int
    price double
    lunch_product_category_topping_id int
    }

    Table lunch_products{
    id int [pk, increment]
    name varchar
    lunch_product_category_id int
    description text
    price double
    lunch_vendor_id int
    is_active boolean
    company_id int
    new_until date
    }

    Ref: lunch_products.lunch_product_category_id > lunch_product_categories.id
    Ref: lunch_products.lunch_vendor_id > lunch_vendors.id

    Table lunch_product_favorites{
    id int [pk, increment]
    lunch_product_id int
    user_id int
    }

    Ref: lunch_product_favorites.lunch_product_id > lunch_products.id
    Ref: lunch_product_favorites.user_id > badaso_users.id

    Table lunch_alerts{
    id int [pk, increment]
    name varchar
    message varchar
    display_mode enum  // alert, chat
    show_until date
    is_recurrent_monday boolean
    is_recurrent_tuesday boolean
    is_recurrent_wednesday boolean
    is_recurrent_thursday boolean
    is_recurrent_friday boolean
    is_recurrent_saturday boolean
    is_recurrent_sunday boolean
    is_active boolean
    timezone varchar
    }

    Table lunch_alert_locations{
    id int [pk, increment]
    lunch_alert_id int
    lunch_location_id int
    }

    Ref: lunch_alert_locations.lunch_alert_id > lunch_alerts.id
    Ref: lunch_alert_locations.lunch_location_id > lunch_locations.id

    Table lunch_cashmoves{
    id int [pk, increment]
    currency_id int
    user_id int
    date date
    amount double
    description text
    }

    Ref: lunch_cashmoves.currency_id > currencies.id
    Ref: lunch_cashmoves.user_id > badaso_users.id

    Table lunch_orders{
    id int [pk, increment]
    lunch_product_id int
    lunch_product_category_id int
    date date
    lunch_vendor_id int
    user_id int
    note text
    price double
    is_active boolean
    state enumu // new, confirmad, cencelled
    company_id int
    currency_id int
    quantity int
    display_topping varchar
    }

    Ref: lunch_orders.lunch_product_id > lunch_products.id
    Ref: lunch_orders.lunch_product_category_id > lunch_product_categories.id
    Ref: lunch_orders.lunch_vendor_id > lunch_products.id
    Ref: lunch_orders.company_id > companies.id
    Ref: lunch_orders.currency_id > currencies.id


    Table lunch_order_toppings{
    id int [pk, increment]
    lunch_order_id int
    lunch_topping_id int
    }

    Ref: lunch_order_toppings.lunch_order_id > lunch_orders.id
    Ref: lunch_order_toppings.lunch_topping_id > lunch_toppings.id


    Table fleet_model_brands{
    id int [pk, increment]
    name varchar
    }

    Table fleet_models{
    id int [pk, increment]
    name varchar
    fleet_model_brand_id int
    manager_user_id int
    is_active boolean
    vehicle_type enum // car, bike
    }

    Ref: fleet_models.fleet_model_brand_id > fleet_model_brands.id
    Ref: fleet_models.manager_user_id > badaso_users.id

    Table fleet_vendors{
    id int [pk, increment]
    fleet_model_id int
    partner_id int
    }

    Ref: fleet_vendors.fleet_model_id > fleet_models.id
    Ref: fleet_vendors.partner_id > partners.id

    Table fleet_vehicle_categories{
    id int [pk, increment]
    name varchar
    color varchar
    user_id int
    }

    Ref: fleet_vehicle_categories.user_id > badaso_users.id

    Table fleet_states{
    id int [pk, increment]
    name varchar
    sequnce int
    }

    Table fleet_vehicles{
    id int [pk, increment]
    fleet_model_id int
    fleet_model_brand_id int
    name varchar
    is_active boolean
    vin_sn varchar
    description varchar
    license_plate varchar
    fleet_state_id int

    // driver
    driver_partner_id int
    future_driver_partner_id int
    is_plan_change_card boolean
    assignment_date date
    localtion varchar

    // contract
    manager_user_id int
    first_contract_date date

    // vehicle
    last_odometer double
    unit_odometer varchar // km, mil
    immatriculation_date date
    chassis_number varchar
    catalog_value double
    purchase_value double
    residual_value double
    company_id int

    // models
    seats_number varchar
    doors_number varchar
    color varchar
    model_year year

    // engine
    transmission enum // manual, automatic
    fuel_type enum // gasoline, diesel, lpg, electric, hybrid
    c02_emission double // g/km
    horsepower double
    horsepower_taxation double
    power double // kW
    }

    Ref: fleet_vehicles.fleet_model_id > fleet_models.id
    Ref: fleet_vehicles.fleet_model_brand_id > fleet_model_brands.id
    Ref: fleet_vehicles.fleet_state_id > fleet_states.id
    Ref: fleet_vehicles.driver_partner_id > partners.id
    Ref: fleet_vehicles.future_driver_partner_id > partners.id
    Ref: fleet_vehicles.manager_user_id > badaso_users.id
    Ref: fleet_vehicles.company_id > companies.id

    Table fleet_vehicle_tags{
    id int [pk, increment]
    fleet_vehicle_id int
    fleet_vehicle_categorie_id int
    }

    Ref: fleet_vehicle_tags.fleet_vehicle_id > fleet_vehicles.id
    Ref: fleet_vehicle_tags.fleet_vehicle_categorie_id > fleet_vehicle_categories.id

    Table fleet_contract_types{
    id int [pk, increment]
    name varchar
    category enum // contract, service
    }

    Table fleet_contracts {
    // contract information
    id int [pk, increment]
    responsible_user_id int
    fleet_contract_type_id int
    vendor_parent_id int
    reference varchar
    activation_cost double
    recurring_cost double
    recurring_cost_frequency enum // no, daily, weekly, monthly, yearly

    // vehicle information
    fleet_vehicle_id int
    invoice_date date
    contract_start_date date
    contract_expiration_date date

    // terms and contracts
    terms_conditions text
    }

    Table fleet_service_types{
    id int [pk, increment]
    name varchar
    category varchar
    }

    Table fleet_contract_services{
    id int [pk, increment]
    fleet_contract_id int
    fleet_service_type_id int
    }

    Ref: fleet_contract_services.fleet_contract_id > fleet_contracts.id
    Ref: fleet_contract_services.fleet_service_type_id > fleet_service_types.id

    Table fleet_services{
    id int [pk, increment]
    description text
    fleet_service_type_id int
    date date
    cost double
    vendor_parent_id int
    fleet_vehicle_id int
    driver_partner_id int
    odometer_value double
    notes text
    }

    Ref: fleet_services.fleet_service_type_id > fleet_service_types.id
    Ref: fleet_services.vendor_parent_id > fleet_service_types.id
    Ref: fleet_services.fleet_vehicle_id > fleet_vehicles.id
    Ref: fleet_services.driver_partner_id > partners.id

    Table fleet_odometers{
    id int [pk, increment]
    name varchar
    date  date
    value double
    fleet_vehicle_id int
    }

    Ref: fleet_odometers.fleet_vehicle_id > fleet_vehicles.id

    Table account_types{
    id int [pk, increment]
    name varchar
    company_id int
    include_initial_balence boolean
    type enum // receivable, payable, liquidity, other,
    internal_group enum // asset, liability, asset, equity
    note text
    }

    Ref: account_types.company_id > companies.id

    Table account_taxes{
    id int [pk, increment]
    name varchar
    type_tax_use enum // sale, purchase
    tax_scope varchar
    amount_type varchar
    is_active boolean
    company_id int
    sequnce int
    amount double
    description text
    }

    Ref: account_taxes.company_id > companies.id

    Table account_groups{
    id int [pk, increment]
    parent_path varchar
    name varchar
    code_prefix_start varchar
    code_prefix_end varchar
    company_id int
    }

    Ref: account_groups.company_id > companies.id

    Table accounts{
    id int [pk, increment]
    name varchar
    currency_id int
    code varchar
    is_deprecated boolean
    account_type_id int
    internal_type enum // other, liquidity, receivable
    internal_global varchar
    is_reconcile boolean
    note text
    company_id int
    account_group_id int
    root_id boolean
    is_off_balance boolean
    }

    Ref: accounts.currency_id > currencies.id
    Ref: accounts.account_type_id > account_types.id
    Ref: accounts.company_id > companies.id
    Ref: accounts.account_group_id > account_groups.id

    Table banks{
    id int [pk, increment]
    name varchar
    street1 varchar
    street2 varchar
    zip varchar
    state_id int
    company_id int
    email varchar
    phone varchar
    is_active boolean
    bic varchar
    }

    Ref: banks.state_id > states.id
    Ref: banks.company_id > companies.id

    Table partner_banks{
    id int [pk, increment]
    is_active boolean
    acc_number varchar
    sanitize_acc_number varchar
    acc_holder_name varchar
    partner_id int
    bank_id int
    sequnce int
    currency_id int
    company_id int
    }

    Ref: partner_banks.partner_id > partners.id
    Ref: partner_banks.bank_id > banks.id
    Ref: partner_banks.currency_id > currencies.id
    Ref: partner_banks.company_id > companies.id

    Table account_journals{
    id int [pk, increment]
    name varchar
    code varchar
    is_active boolean
    type enum // sale, purchase, general, bank, cash
    default_account_id int // >> ref accounts
    payment_debit_account_id int
    payment_credit_account_id int
    suspensi_account_id int
    sequnce int
    invoice_reference_type varchar
    invoice_reference_model varchar
    currency_id int
    company_id int
    is_refund_squence boolean
    is_least_one_inbound boolean
    is_least_one_outbound boolean
    profit_account_id int
    lost_account_id int
    partner_bank_id int
    }

    Ref: account_journals.default_account_id > accounts.id
    Ref: account_journals.payment_debit_account_id > accounts.id
    Ref: account_journals.payment_credit_account_id > accounts.id
    Ref: account_journals.suspensi_account_id > accounts.id
    Ref: account_journals.currency_id > currencies.id
    Ref: account_journals.company_id > companies.id
    Ref: account_journals.profit_account_id > accounts.id
    Ref: account_journals.lost_account_id > accounts.id
    Ref: account_journals.partner_bank_id > partner_banks.id

    Table tax_account_payables{
    id int [pk, increment]
    code varchar
    group_account_type_id int
    is_deprecated boolean

    // acount options
    default_account_tax_id int
    }

    Ref: tax_account_payables.group_account_type_id > account_types.id
    Ref: tax_account_payables.default_account_tax_id > account_taxes.id

    Table account_tags{
    id int [pk, increment]
    name varchar
    applicability enum // accounts, taxes
    is_active boolean
    country_id int
    }

    Ref: account_tags.country_id > countries.id

    Table tax_current_account_tags{
    id int [pk, increment]
    tax_account_payables int
    account_tag_id int
    }

    Ref: tax_current_account_tags.tax_account_payables > tax_account_payables.id
    Ref: tax_current_account_tags.account_tag_id > account_tags.id

    Table tax_current_account_journals{
    id int [pk, increment]
    tax_account_payables int
    account_journal_id int
    }

    Ref: tax_current_account_journals.tax_account_payables > tax_account_payables.id
    Ref: tax_current_account_journals.account_journal_id > account_journals.id

    Table tax_groups{
    id int [pk, increment]
    current_tax_account_payable_id int
    advanced_tax_account_payable_id int
    sequnce int
    receiver_current_tax_account_payable_id int
    }

    Ref: tax_groups.current_tax_account_payable_id > tax_account_payables.id
    Ref: tax_groups.advanced_tax_account_payable_id > tax_account_payables.id
    Ref: tax_groups.receiver_current_tax_account_payable_id > tax_account_payables.id

    Table accounting_taxes{
    id int [pk, increment]
    tax_name varchar
    tax_computation enum // group, fixed, percent, division
    is_active boolean
    tax_type enum // sale, purchase, none
    tax_score enum // services, goods
    amount double

    accountig_type enum //

    // advanced options
    label_invoice varchar
    taxes_group_id int
    is_include_price boolean
    is_subsequent_tax boolean
    }

    Table accounting_distribution_invoices{
    id int [pk, increment]
    accounting_tax_id int
    percent double
    base_on enum // base, tax
    account_id int
    tax_grids varchar
    is_close_entry boolean
    }

    Ref: accounting_distribution_invoices.accounting_tax_id > accounting_taxes.id

    Table accounting_distribution_credit_notes{
    id int [pk, increment]
    accounting_tax_id int
    percent double
    base_on enum // base, tax
    account_id int
    tax_grids varchar
    is_close_entry boolean
    }

    Ref: accounting_distribution_credit_notes.accounting_tax_id > accounting_taxes.id

    Table expense_products{
    id int [pk, increment]
    name varchar
    cost double
    internal_reference varchar
    company_id int

    // invoicing
    invoice_policy enum // ordered => Ordered Quantity, delivered => Delivered Quantity
    re_invoice_exoense enum // no, cost, sales_price

    image_path varchar
    }

    Table expense_vendor_accounting_tax{
    id int [pk, increment]
    expense_product_id int
    accounting_tax_id int
    }

    Ref: expense_vendor_accounting_tax.expense_product_id > expense_products.id
    Ref: expense_vendor_accounting_tax.accounting_tax_id > accounting_taxes.id

    Table expense_customer_accounting_tax{
    id int [pk, increment]
    expense_product_id int
    accounting_tax_id int
    }

    Ref: expense_customer_accounting_tax.expense_product_id > expense_products.id
    Ref: expense_customer_accounting_tax.accounting_tax_id > accounting_taxes.id

    Table expense_register_payments{
    id int [pk, increment]
    }

    Table expense_reports{
    id int [pk, increment]
    description text
    expense_product_id int
    unit_price double
    quantity double
    total double
    amount_due double
    paid_by enum // own_account, company_account
    bill_reference varchar
    expense_date date
    employee_id int
    company_id int
    note text
    state_report enum // approve, draft, refuse, post, register_payment, payed
    register_payment_id int
    }

    Ref: expense_reports.expense_product_id > expense_products.id
    Ref: expense_reports.employee_id > employees.id
    Ref: expense_reports.company_id > companies.id

    Table expense_reports_companyes{
    id int [pk, increment]
    report_summary varchar
    employee_id int
    manager_user_id int
    paid_by enum
    company_id int

    // other info
    expense_journal enum // expense, vendor_bills
    }

    Table expense_report_items{
    id int [pk, increment]
    expense_reports_company_id int
    expense_report_id int
    }

    Ref: expense_report_items.expense_reports_company_id > expense_reports_companyes.id
    Ref: expense_report_items.expense_report_id > expense_reports.id

    TXT;
    $m1 = [];
    $m2 = [];

    $string = str_replace(" {", "{", $string);

    // preg_match_all('/charset="([^"]+)"/', $string, $m1);
    preg_match_all('/{[^}]*}/i', $string, $m1);
    preg_match_all('/([a-zA-Z_]+){/i', $string, $m2);

    $relation = [];
    foreach (explode("\n", $string) as $key => $value) {
        if (substr($value, 0, 4) == "Ref:") {
            $new_value = trim(substr($value, 4));
            [$table_ref, $table_to] = explode(">", $new_value);
            $table_ref = trim($table_ref);
            $table_to = trim($table_to);

            [$table_ref, $field_ref] = explode(".", $table_ref);
            [$table_to, $field_to] = explode(".", $table_to);

            $relation[$table_ref][] = [$table_ref, $field_ref, $table_to, $field_to];
        }
    }

    $schema_format = <<<TXT
    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class Create{table_name_camel}Table extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create(config('badaso.database.prefix').'{table_name_snake}', function (Blueprint \$table) {
                \$table->id();
    {table_field}
    {table_relation}
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::dropIfExists(config('badaso.database.prefix').'{table_name_snake}');
        }
    }
    TXT;

    $toCamelCase = function ($input) {
        return str_replace("_", '', ucwords($input, "_"));
    };

    [$field_names] = $m1;
    [$_, $table_names] = $m2;

    // route list
    $route_list_crud_generate = "";

    foreach ($table_names as $index => $table_name) {
        $fields = explode("\n", $field_names[$index]);
        $new_fields = "";
        $new_fillable = "";
        $public_data_rows = "";

        // for inputs generate
        $validate_inputs = "";
        $variable_input_equal_with_request = "";
        $variable_inputs = "";
        for ($i = 2; $i < count($fields) - 1; $i++) {
            $explode_fields = explode(" ", $fields[$i]);

            $field = "";
            $type = "";

            if (isset($explode_fields[0]) && isset($explode_fields[1])) {
                [$field, $type] = $explode_fields;
                if ($field == 'id') {
                    continue;
                }
            } else {
                continue;
            }

            if ($field != "//") {
                $command = "";
                switch ($type) {
                    case 'int':
                        $change_data_type = "integer(\"$field\")";
                        break;
                    case 'date':
                        $change_data_type = "date(\"$field\")";
                        break;
                    case 'year':
                        $change_data_type = "year(\"$field\")";
                        break;
                    case 'time':
                        $change_data_type = "time(\"$field\")";
                        break;
                    case 'double':
                        $change_data_type = "double(\"$field\")";
                        break;
                    case 'boolean':
                        $change_data_type = "boolean(\"$field\")";
                        break;
                    case 'enum':
                        if (isset($explode_fields[2]) && isset($explode_fields[3])) {
                            $command = "";
                            for ($j = 2; $j < count($explode_fields); $j++) {
                                $command .= "$explode_fields[$j] ";
                            }
                        }
                        $change_data_type = "string(\"$field\")";
                        break;
                    default:
                        $change_data_type = "string(\"$field\")";
                }

                // relation
                $public_data_rows .= ",['$field','$type']";
                if (isset($relation[$table_name])) {
                    $is_relation = false;
                    foreach ($relation[$table_name] as $key => $value) {
                        [$table_ref, $field_ref, $table_to, $field_to] = $value;
                        if ($field_ref == $field) {
                            $is_relation = true;
                            break;
                        }
                    }

                    if ($is_relation) {
                        $new_fields .= "            \$table->unsignedBigInteger('{$field}')->nullable(); $command\n";
                    } else {
                        $new_fields .= "            \$table->{$change_data_type}->nullable(); $command\n";
                    }
                } else {
                    $new_fields .= "            \$table->{$change_data_type}->nullable(); $command\n";
                }
                $new_fillable .= ", \"$field\"";

                // inputs
                $input_type = "";
                $input_example = "";
                switch ($type) {
                    case 'int':
                        $validate_inputs .= "           '$field' => ['nullable', 'integer'],\n";
                        $input_type = "integer";
                        $input_example = 1;
                        break;
                    case 'date':
                        $validate_inputs .= "           '$field' => ['nullable', 'date_format:Y-m-d'],\n";
                        $input_type = "string";
                        $input_example = date('Y-m-d');
                        break;
                    case 'year':
                        $validate_inputs .= "           '$field' => ['nullable', 'date_format:Y'],\n";
                        $input_type = "string";
                        $input_example = date('Y');
                        break;
                    case 'time':
                        $validate_inputs .= "           '$field' => ['nullable', 'date_format:H:i:s'],\n";
                        $input_type = "string";
                        $input_example = date('H:i:s');
                        break;
                    case 'datetime':
                        $validate_inputs .= "           '$field' => ['nullable', 'date_format:Y-m-d H:i:s'],\n";
                        $input_type = "string";
                        $input_example = date('Y-m-d H:i:s');
                        break;
                    case 'enum':
                        $validate_inputs .= "           '$field' => ['nullable', 'string'],\n";
                        $input_type = "string";
                        $input_example = "lorem type";
                        break;
                    case 'text':
                        $validate_inputs .= "           '$field' => ['nullable', 'string'],\n";
                        $input_type = "string";
                        $input_example = "Lorem ibsum siamet";
                        break;
                    case 'varchar':
                        $validate_inputs .= "           '$field' => ['nullable', 'string'],\n";
                        $input_type = "string";
                        $input_example = "Lorem ibsum siamet";
                        break;
                    case 'double':
                        $validate_inputs .= "           '$field' => ['nullable', 'double'],\n";
                        $input_type = 'double';
                        $input_example = 0.0;
                        break;
                    default:
                        $validate_inputs .= "           '$field' => ['nullable', '$type'],\n";
                        $input_type = $type;
                }

                $variable_input_equal_with_request .= "        \$this->$field = \$request->$field ;\n";
                $variable_inputs .= <<<TXT
                    /**
                     * @OA\Property(
                     *     title="$field",
                     *     description="$field",
                     *     type="$input_type",
                     *     example="$input_example"
                     * )
                     *
                     * @var $input_type
                     */
                    public \$$field;\n
                TXT;
            }
        }


        $public_data_rows = substr($public_data_rows, 1);
        $public_data_rows = "public \$public_data_rows = [$public_data_rows] ;";

        $table_relation = "";
        if (isset($relation[$table_name])) {
            foreach ($relation[$table_name] as $key => $value) {
                [$table_ref, $field_ref, $table_to, $field_to] = $value;
                $table_relation .= "            \$table->foreign('{$field_ref}')->references('{$field_to}')->on(config('badaso.database.prefix').'{$table_to}')->onDelete('cascade');\n";
            }
        }

        $my_class_migration = strtr($schema_format, [
            '{table_name_camel}' => $toCamelCase($table_name),
            '{table_name_snake}' => $table_name,
            '{table_field}' => $new_fields,
            '{table_relation}' => $table_relation,
        ]);

        $date = date('Y_m_d');
        $time = "000000";
        $time = str_repeat("0", strlen($time) - strlen($index)) . $index;

        $my_class_name = "{$date}_{$time}_create_{$table_name}_table.php";

        // File::put(database_path("migrations/{$my_class_name}"), $my_class_migration);

        $model_name = str_replace(['ies'], ["ys"], $table_name);
        $model_name = $toCamelCase($model_name);
        $model_name = substr($model_name, 0, strlen($model_name) - 1);

        $new_fillable = substr($new_fillable, 1);

        $tableToModelName = function ($table_name) use ($toCamelCase) {
            $model_name = str_replace(['ies'], ["ys"], $table_name);
            $model_name = $toCamelCase($model_name);
            $model_name = substr($model_name, 0, strlen($model_name) - 1);

            return $model_name;
        };

        $public_belongs_relation = "";
        $model_relation = "";
        if (isset($relation[$table_name])) {
            foreach ($relation[$table_name] as $key => $value) {
                [$table_ref, $field_ref, $table_to, $field_to] = $value;

                $model_to = $tableToModelName($table_to);
                $fuc_name = str_replace('_id', "", $field_ref);
                $fuc_name = $toCamelCase($fuc_name);

                $first = strtolower(substr($fuc_name, 0, 1));
                $fuc_name = $first . substr($fuc_name, 1);

                $model_relation .= <<<TXT
                    public function $fuc_name(){ return \$this->belongsTo($model_to::class, "$field_ref"); }\n
                TXT;

                $public_belongs_relation .= <<<TXT
                ,["foreign" => '$field_ref', "references" => '$field_to', "on" => '$table_to', "model_on" => $model_to::class]
                TXT;
            }
        }

        if ($public_belongs_relation != "") {
            $public_belongs_relation = substr($public_belongs_relation, 1);
            $public_belongs_relation = "public \$belongs_relation = [{$public_belongs_relation}] ;";
        } else {
            $public_belongs_relation = "public \$belongs_relation = [] ;";
        }

        $public_many_relation = "";
        $model_many_relation = "";
        foreach ($relation as $key_table_name => $table_relations) {
            foreach ($table_relations as $key => [$table_ref, $field_ref, $table_to, $field_to]) {
                if ($table_to == $table_name) {

                    $model_to = $tableToModelName($table_ref);
                    $fuc_name = str_replace('_id', "", $field_ref . "_" . $table_ref);
                    $fuc_name = $toCamelCase($fuc_name);

                    $first = strtolower(substr($fuc_name, 0, 1));
                    $fuc_name = $first . substr($fuc_name, 1);

                    $model_many_relation .= <<<TXT
                        public function $fuc_name(){ return \$this->hasMany($model_to::class, "$field_ref"); }\n
                    TXT;

                    $public_many_relation .= <<<TXT
                    ,["foreign" => '$field_ref', "references" => '$field_to', "on" => '$table_ref', "model_on" => $model_to::class]
                    TXT;
                }
            }
        }

        if ($public_many_relation != "") {
            $public_many_relation = substr($public_many_relation, 1);
            $public_many_relation = "public \$many_relation = [{$public_many_relation}] ;";
        } else {
            $public_many_relation = "public \$many_relation = [] ;";
        }

        $model_format = <<<TXT
        <?php

        namespace Uasoft\Badaso\Module\HRM\Models;

        use Illuminate\Database\Eloquent\Factories\HasFactory;
        use Illuminate\Database\Eloquent\Model;

        class {model_name} extends Model
        {
            use HasFactory;

            protected \$table = null ;
            protected \$fillable = [{table_fillable}] ;

            $public_data_rows

            $public_belongs_relation

            $public_many_relation

            /**
             * Constructor for setting the table name dynamically.
             */
            public function __construct(array \$attributes = [])
            {
                \$prefix = config('badaso.database.prefix');
                \$this->table = \$prefix.'$table_name';
                parent::__construct(\$attributes);
            }

        $model_relation

        $model_many_relation
        }
        TXT;

        $my_model_class = strtr($model_format, [
            '{model_name}' => $model_name,
            '{table_name}' => $table_name,
            '{table_fillable}' => $new_fillable
        ]);

        // File::put(app_path("Models/{$model_name}.php"), $my_model_class);


        // generate input schema

        $tableToInputName = function ($table_name) use ($toCamelCase) {
            $model_name = str_replace(['ies'], ["ys"], $table_name);
            $model_name = substr($model_name, 0, strlen($model_name) - 1);
            $model_name = $toCamelCase($model_name . "_input");

            return $model_name;
        };

        // $validate_inputs;
        // $variable_input_equal_with_request;
        // $variable_inputs;
        $class_input_name = $tableToInputName($table_name);
        $validate_inputs = substr($validate_inputs, 1);
        $input_schema_format = <<<TXT
        <?php
        namespace Uasoft\Badaso\Module\HRM\Schema\Inputs;

        use Illuminate\Http\Request;

        /**
         * @OA\Schema(
         *     title="$class_input_name",
         *     description="",
         *     @OA\Xml(
         *         name="$class_input_name"
         *     )
         * )
         */

        class $class_input_name {
        $variable_inputs

            public function __construct(Request \$request)
            {
                \$request->validate([
         $validate_inputs
                ]);

        $variable_input_equal_with_request
            }
        }

        TXT;

        // File::put(app_path("Inputs/{$class_input_name}.php"), $input_schema_format);

        $strToClassName = function ($str, $prefix = "", $remove = "_") use ($toCamelCase) {
            $model_name = $str;
            if (strstr($str, "ies") || strstr($str, "ys")) {
                $model_name = str_replace(['ies'], ["ys"], $str);
                $model_name = substr($model_name, 0, strlen($model_name) - 1);
            }
            $model_name = str_replace($remove, '', ucwords($model_name . $prefix, $remove));

            return $model_name;
        };

        $strToPrefixName = function ($str) {
            $prefix_name = $str;
            if (substr($str, strlen($str) - 1) == "s") {
                $prefix_name = str_replace(['ies'], ["ys"], $str);
                $prefix_name = substr($prefix_name, 0, strlen($prefix_name) - 1);
            }
            $prefix_name = str_replace("_", "-", $prefix_name);

            return $prefix_name;
        };

        $prefix_name = $strToPrefixName($table_name);
        $controller_name = $strToClassName($prefix_name, "-controller", "-");

        $route_list_crud_generate .= <<<TXT
                    Route::prefix('/$prefix_name')->group(function () {
                        Route::post('/', '$controller_name@add');
                        Route::get('/', '$controller_name@browse');
                        Route::get('/{id}', '$controller_name@read');
                        Route::put('/{id}', '$controller_name@update');
                        Route::delete('/{id}', '$controller_name@delete');
                    });\n\n
        TXT;

        $input_to_store_field = "";
        $input_to_update_field = "";

        // relation
        $relation_belogsto = "";
        for ($i = 2; $i < count($fields) - 1; $i++) {
            $explode_fields = explode(" ", $fields[$i]);

            $field = "";
            $type = "";

            if (isset($explode_fields[0]) && isset($explode_fields[1])) {
                [$field, $type] = $explode_fields;
                if ($field == 'id') {
                    continue;
                }
            } else {
                continue;
            }

            if ($field != "//") {
                $input_to_store_field .= "              '$field' => \${$table_name}_input->$field,\n";
                $input_to_update_field .= "              '$field' => \${$table_name}_input->$field == null ? \${$table_name}->$field : \${$table_name}_input->$field,\n";

                if (isset($relation[$table_name])) {
                    foreach ($relation[$table_name] as $key_relation_table => $val_relation_table) {
                        [$table_from, $field_from, $table_to_ref, $field_to_ref] = $val_relation_table;
                        if ($field_from == $field) {
                            $attribute_from = str_replace('_id', '', $field_from);
                            $relation_belogsto .= "         \$$table_name->$attribute_from = \$$table_name->$attribute_from ;\n";
                        }
                    }
                }
            }
        }

        // hash many relation
        $relation_hasmany = "";
        foreach ($relation as $key_relation => $val_relation) {
            foreach ($val_relation as $key => $val_relation_table) {
                [$table_from, $field_from, $table_ref_to, $field_ref_to] = $val_relation_table;
                if ($table_ref_to == $table_name) {
                    $model_to = $tableToModelName($table_from);
                    $fuc_name = str_replace('_id', "", $field_from . "_" . $table_from);
                    $fuc_name = $toCamelCase($fuc_name);

                    $first = strtolower(substr($fuc_name, 0, 1));
                    $fuc_name = $first . substr($fuc_name, 1);

                    $attribute_name = str_replace('_id', "", $field_from . "_" . $table_from);

                    $relation_hasmany .= "           \$$table_name->$attribute_name = \$$table_name->$fuc_name ;\n ";
                }
            }
        }

        $tag = str_replace("_", " ", $table_name);
        $tag = ucwords($tag);

        $controller_format = <<<TXT
        <?php

        namespace Uasoft\Badaso\Module\HRM\Controllers;

        use App\Http\Controllers\Controller;
        use Exception;
        use Illuminate\Http\Request;
        use Uasoft\Badaso\Helpers\ApiResponse;
        use Uasoft\Badaso\Module\HRM\Models\\$model_name;
        use Uasoft\Badaso\Module\HRM\Schema\Inputs\\$class_input_name;

        class $controller_name extends Controller
        {
            /**
             * @OA\Post(
             *      path="/module/hrm/v1/$prefix_name",
             *      operationId="Add$model_name",
             *      tags={"$tag"},
             *      summary="Add new $table_name",
             *      description="Add a new $table_name",
             *      @OA\Parameter(
             *          name="show_belogsto_relation",
             *          in="query",
             *          example=false,
             *          required=false,
             *          @OA\Schema(
             *              type="boolean"
             *          )
             *      ),
             *      @OA\Parameter(
             *          name="show_hasmany_relation",
             *          in="query",
             *          example=false,
             *          required=false,
             *          @OA\Schema(
             *              type="boolean"
             *          )
             *      ),
             *      @OA\RequestBody(
             *          required=true,
             *          @OA\JsonContent(ref="#/components/schemas/$class_input_name")
             *      ),
             *      @OA\Response(
             *          response=201,
             *          description="Successful operation",
             *       ),
             *      @OA\Response(
             *          response=400,
             *          description="Bad Request"
             *      ),
             *      @OA\Response(
             *          response=401,
             *          description="Unauthenticated",
             *      ),
             *      @OA\Response(
             *          response=403,
             *          description="Forbidden"
             *      ),
             *      security={{"bearerAuth" : {}}}
             * )
             */
            public function add(Request \$request)
            {
                try {
                    \${$table_name}_input = new $class_input_name(\$request);

                    \${$table_name} = $model_name::create([
            $input_to_store_field
                    ]);

                    if(\$request->get("show_belogsto_relation", "false") == "true") {
                        // belogs to relation
            $relation_belogsto
                    }

                    if(\$request->get("show_hasmany_relation", "false") == "true") {
                        // has many relation
            $relation_hasmany
                    }

                    return ApiResponse::success(compact('$table_name'));
                } catch (Exception \$e) {
                    return ApiResponse::failed(\$e);
                }
            }

            /**
             * @OA\Get(
             *      path="/module/hrm/v1/$prefix_name",
             *      operationId="Browse$model_name",
             *      tags={"$tag"},
             *      summary="Browse $table_name",
             *      description="Browse $table_name",
             *      @OA\Parameter(
             *          name="filter_fields",
             *          in="query",
             *          example="*",
             *          required=false,
             *          @OA\Schema(
             *              type="string"
             *          )
             *      ),
             *      @OA\Parameter(
             *          name="filter_fields_search",
             *          in="query",
             *          example="*",
             *          required=false,
             *          @OA\Schema(
             *              type="string"
             *          )
             *      ),
             *      @OA\Parameter(
             *          name="max_page",
             *          in="query",
             *          required=false,
             *          @OA\Schema(
             *              type="integer"
             *          )
             *      ),
             *      @OA\Parameter(
             *          name="search",
             *          in="query",
             *          required=false,
             *          @OA\Schema(
             *              type="string"
             *          )
             *      ),
             *      @OA\Parameter(
             *          name="show_pagination",
             *          in="query",
             *          example=true,
             *          required=false,
             *          @OA\Schema(
             *              type="boolean"
             *          )
             *      ),
             *      @OA\Parameter(
             *          name="show_belogsto_relation",
             *          in="query",
             *          example=false,
             *          required=false,
             *          @OA\Schema(
             *              type="boolean"
             *          )
             *      ),
             *      @OA\Parameter(
             *          name="show_hasmany_relation",
             *          in="query",
             *          example=false,
             *          required=false,
             *          @OA\Schema(
             *              type="boolean"
             *          )
             *      ),
             *      @OA\Response(
             *          response=201,
             *          description="Successful operation",
             *       ),
             *      @OA\Response(
             *          response=400,
             *          description="Bad Request"
             *      ),
             *      @OA\Response(
             *          response=401,
             *          description="Unauthenticated",
             *      ),
             *      @OA\Response(
             *          response=403,
             *          description="Forbidden"
             *      ),
             *      security={{"bearerAuth" : {}}}
             * )
             */
            public function browse(Request \$request)
            {
                try {

                    \${$table_name} = new $model_name();
                    \${$table_name}_fillable = \${$table_name}->getFillable();

                    \$filter_fields = \$request->get('filter_fields', '*');
                    \$filter_fields = explode(',', \$filter_fields);
                    if (array_search('*', \$filter_fields) == false) {
                        \$new_filter_fields = [];
                        foreach (\$filter_fields as \$index => \$field) {
                            if (!in_array(\$field, \$filter_fields)) {
                                \$new_filter_fields[] = \$field;
                            }
                        }
                        \${$table_name} = \${$table_name}->select(\$filter_fields);
                    }

                    \$filter_fields_search = \$request->get('filter_fields_search', '*');
                    \$filter_fields_search = explode(',', \$filter_fields_search);
                    if (isset(\$request->search)) {
                        if (array_search('*', \$filter_fields_search) == false) {
                            foreach (\${$table_name}_fillable as \$index => \$field) {
                                \${$table_name} = \${$table_name}->orWhere(\$field, "like", "%\$request->search%");
                            }
                        } else {
                            foreach (\$filter_fields_search as \$index => \$field) {
                                if (in_array(\$field, \${$table_name}_fillable)) {
                                    \${$table_name} = \${$table_name}->orWhere(\$field, "like", "%\$request->search%");
                                }
                            }
                        }
                    }

                    if (\$request->get('show_pagination', 'true') == 'true') {
                        \$max_page = \$request->get('max_page', 15);
                        \${$table_name} = \${$table_name}->paginate(\$max_page);
                    } else {
                        \${$table_name} = \${$table_name}->get();
                    }

                    \${$table_name}->map(function(\$$table_name) use (\$request){

                    if(\$request->get("show_belogsto_relation", "false") == "true") {
                        // belogs to relation
            $relation_belogsto
                    }

                    if(\$request->get("show_hasmany_relation", "false") == "true") {
                        // has many relation
            $relation_hasmany
                    }

                        return \$$table_name ;
                    });
                    \${$table_name} = \${$table_name}->toArray();

                    return ApiResponse::success(compact('$table_name'));
                } catch (Exception \$e) {
                    return ApiResponse::failed(\$e);
                }
            }

            /**
             * @OA\Get(
             *      path="/module/hrm/v1/$prefix_name/{id}",
             *      operationId="Read$model_name",
             *      tags={"$tag"},
             *      summary="Read $table_name",
             *      description="Read $table_name",
             *      @OA\Parameter(
             *          name="id",
             *          in="path",
             *          required=true,
             *          @OA\Schema(
             *              type="integer"
             *          )
             *      ),
             *      @OA\Parameter(
             *          name="show_belogsto_relation",
             *          in="query",
             *          example=false,
             *          required=false,
             *          @OA\Schema(
             *              type="boolean"
             *          )
             *      ),
             *      @OA\Parameter(
             *          name="show_hasmany_relation",
             *          in="query",
             *          example=false,
             *          required=false,
             *          @OA\Schema(
             *              type="boolean"
             *          )
             *      ),
             *      @OA\Response(
             *          response=201,
             *          description="Successful operation",
             *       ),
             *      @OA\Response(
             *          response=400,
             *          description="Bad Request"
             *      ),
             *      @OA\Response(
             *          response=401,
             *          description="Unauthenticated",
             *      ),
             *      @OA\Response(
             *          response=403,
             *          description="Forbidden"
             *      ),
             *      security={{"bearerAuth" : {}}}
             * )
             */
            public function read(Request \$request, \$id)
            {
                try {

                    \${$table_name} = $model_name::find(\$id);

                    if(\$request->get("show_belogsto_relation", "false") == "true") {
                        // belogs to relation
            $relation_belogsto
                    }

                    if(\$request->get("show_hasmany_relation", "false") == "true") {
                        // has many relation
            $relation_hasmany
                    }

                    return ApiResponse::success(compact('$table_name'));
                } catch (Exception \$e) {
                    return ApiResponse::failed(\$e);
                }
            }

            /**
             * @OA\Put(
             *      path="/module/hrm/v1/$prefix_name/{id}",
             *      operationId="Update$model_name",
             *      tags={"$tag"},
             *      summary="Update $table_name",
             *      description="Update $table_name",
             *      @OA\Parameter(
             *          name="id",
             *          in="path",
             *          required=true,
             *          @OA\Schema(
             *              type="integer"
             *          )
             *      ),
             *      @OA\Parameter(
             *          name="show_belogsto_relation",
             *          in="query",
             *          required=false,
             *          example=false,
             *          @OA\Schema(
             *              type="boolean"
             *          )
             *      ),
             *      @OA\Parameter(
             *          name="show_hasmany_relation",
             *          in="query",
             *          required=false,
             *          example=false,
             *          @OA\Schema(
             *              type="boolean"
             *          )
             *      ),
             *      @OA\RequestBody(
             *          required=true,
             *          @OA\JsonContent(ref="#/components/schemas/$class_input_name")
             *      ),
             *      @OA\Response(
             *          response=201,
             *          description="Successful operation",
             *       ),
             *      @OA\Response(
             *          response=400,
             *          description="Bad Request"
             *      ),
             *      @OA\Response(
             *          response=401,
             *          description="Unauthenticated",
             *      ),
             *      @OA\Response(
             *          response=403,
             *          description="Forbidden"
             *      ),
             *      security={{"bearerAuth" : {}}}
             * )
             */
            public function update(Request \$request, \$id)
            {
                try {
                    \${$table_name}_input = new $class_input_name(\$request);
                    \${$table_name} = $model_name::find(\$id);

                    \${$table_name}->update([
            $input_to_update_field
                    ]);

                    if(\$request->get("show_belogsto_relation", "false") == "true") {
                        // belogs to relation
            $relation_belogsto
                    }

                    if(\$request->get("show_hasmany_relation", "false") == "true") {
                        // has many relation
            $relation_hasmany
                    }

                    return ApiResponse::success(compact('$table_name'));
                } catch (Exception \$e) {
                    return ApiResponse::failed(\$e);
                }
            }


            /**
             * @OA\Delete(
             *      path="/module/hrm/v1/$prefix_name/{id}",
             *      operationId="Delete$model_name",
             *      tags={"$tag"},
             *      summary="Delete $table_name",
             *      description="Delete $table_name",
             *      @OA\Parameter(
             *          name="id",
             *          in="path",
             *          required=true,
             *          @OA\Schema(
             *              type="integer"
             *          )
             *      ),
             *      @OA\Response(
             *          response=201,
             *          description="Successful operation",
             *       ),
             *      @OA\Response(
             *          response=400,
             *          description="Bad Request"
             *      ),
             *      @OA\Response(
             *          response=401,
             *          description="Unauthenticated",
             *      ),
             *      @OA\Response(
             *          response=403,
             *          description="Forbidden"
             *      ),
             *      security={{"bearerAuth" : {}}}
             * )
             */
            public function delete(\$id)
            {
                try {
                    \${$table_name} = $model_name::find(\$id);

                    \${$table_name}->delete();

                    return ApiResponse::success();
                } catch (Exception \$e) {
                    return ApiResponse::failed(\$e);
                }
            }
        }

        TXT;

        // File::put(base_path("packages/badaso/hrm-module/src/Controllers/$controller_name.php"), $controller_format);


        dd($relation) ;
    }

    // File::put(app_path("/router.php"), $route_list_crud_generate);
});

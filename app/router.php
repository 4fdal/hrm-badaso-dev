            Route::prefix('/degree')->group(function () {
                Route::post('/', 'DegreeController@add');
                Route::get('/', 'DegreeController@browse');
                Route::get('/{id}', 'DegreeController@read');
                Route::put('/{id}', 'DegreeController@update');
                Route::delete('/{id}', 'DegreeController@delete');
            });

            Route::prefix('/currency')->group(function () {
                Route::post('/', 'CurrencyController@add');
                Route::get('/', 'CurrencyController@browse');
                Route::get('/{id}', 'CurrencyController@read');
                Route::put('/{id}', 'CurrencyController@update');
                Route::delete('/{id}', 'CurrencyController@delete');
            });

            Route::prefix('/country')->group(function () {
                Route::post('/', 'CountryController@add');
                Route::get('/', 'CountryController@browse');
                Route::get('/{id}', 'CountryController@read');
                Route::put('/{id}', 'CountryController@update');
                Route::delete('/{id}', 'CountryController@delete');
            });

            Route::prefix('/state')->group(function () {
                Route::post('/', 'StateController@add');
                Route::get('/', 'StateController@browse');
                Route::get('/{id}', 'StateController@read');
                Route::put('/{id}', 'StateController@update');
                Route::delete('/{id}', 'StateController@delete');
            });

            Route::prefix('/industry')->group(function () {
                Route::post('/', 'IndustryController@add');
                Route::get('/', 'IndustryController@browse');
                Route::get('/{id}', 'IndustryController@read');
                Route::put('/{id}', 'IndustryController@update');
                Route::delete('/{id}', 'IndustryController@delete');
            });

            Route::prefix('/partner')->group(function () {
                Route::post('/', 'PartnerController@add');
                Route::get('/', 'PartnerController@browse');
                Route::get('/{id}', 'PartnerController@read');
                Route::put('/{id}', 'PartnerController@update');
                Route::delete('/{id}', 'PartnerController@delete');
            });

            Route::prefix('/company')->group(function () {
                Route::post('/', 'CompanyController@add');
                Route::get('/', 'CompanyController@browse');
                Route::get('/{id}', 'CompanyController@read');
                Route::put('/{id}', 'CompanyController@update');
                Route::delete('/{id}', 'CompanyController@delete');
            });

            Route::prefix('/worke')->group(function () {
                Route::post('/', 'WorkeController@add');
                Route::get('/', 'WorkeController@browse');
                Route::get('/{id}', 'WorkeController@read');
                Route::put('/{id}', 'WorkeController@update');
                Route::delete('/{id}', 'WorkeController@delete');
            });

            Route::prefix('/work-hour')->group(function () {
                Route::post('/', 'WorkHourController@add');
                Route::get('/', 'WorkHourController@browse');
                Route::get('/{id}', 'WorkHourController@read');
                Route::put('/{id}', 'WorkHourController@update');
                Route::delete('/{id}', 'WorkHourController@delete');
            });

            Route::prefix('/global-time-off')->group(function () {
                Route::post('/', 'GlobalTimeOffController@add');
                Route::get('/', 'GlobalTimeOffController@browse');
                Route::get('/{id}', 'GlobalTimeOffController@read');
                Route::put('/{id}', 'GlobalTimeOffController@update');
                Route::delete('/{id}', 'GlobalTimeOffController@delete');
            });

            Route::prefix('/employee')->group(function () {
                Route::post('/', 'EmployeeController@add');
                Route::get('/', 'EmployeeController@browse');
                Route::get('/{id}', 'EmployeeController@read');
                Route::put('/{id}', 'EmployeeController@update');
                Route::delete('/{id}', 'EmployeeController@delete');
            });

            Route::prefix('/employee-category')->group(function () {
                Route::post('/', 'EmployeeCategoryController@add');
                Route::get('/', 'EmployeeCategoryController@browse');
                Route::get('/{id}', 'EmployeeCategoryController@read');
                Route::put('/{id}', 'EmployeeCategoryController@update');
                Route::delete('/{id}', 'EmployeeCategoryController@delete');
            });

            Route::prefix('/employee-tag')->group(function () {
                Route::post('/', 'EmployeeTagController@add');
                Route::get('/', 'EmployeeTagController@browse');
                Route::get('/{id}', 'EmployeeTagController@read');
                Route::put('/{id}', 'EmployeeTagController@update');
                Route::delete('/{id}', 'EmployeeTagController@delete');
            });

            Route::prefix('/resume-line-type')->group(function () {
                Route::post('/', 'ResumeLineTypeController@add');
                Route::get('/', 'ResumeLineTypeController@browse');
                Route::get('/{id}', 'ResumeLineTypeController@read');
                Route::put('/{id}', 'ResumeLineTypeController@update');
                Route::delete('/{id}', 'ResumeLineTypeController@delete');
            });

            Route::prefix('/employee-resume')->group(function () {
                Route::post('/', 'EmployeeResumeController@add');
                Route::get('/', 'EmployeeResumeController@browse');
                Route::get('/{id}', 'EmployeeResumeController@read');
                Route::put('/{id}', 'EmployeeResumeController@update');
                Route::delete('/{id}', 'EmployeeResumeController@delete');
            });

            Route::prefix('/skill-type')->group(function () {
                Route::post('/', 'SkillTypeController@add');
                Route::get('/', 'SkillTypeController@browse');
                Route::get('/{id}', 'SkillTypeController@read');
                Route::put('/{id}', 'SkillTypeController@update');
                Route::delete('/{id}', 'SkillTypeController@delete');
            });

            Route::prefix('/skill-level')->group(function () {
                Route::post('/', 'SkillLevelController@add');
                Route::get('/', 'SkillLevelController@browse');
                Route::get('/{id}', 'SkillLevelController@read');
                Route::put('/{id}', 'SkillLevelController@update');
                Route::delete('/{id}', 'SkillLevelController@delete');
            });

            Route::prefix('/skill')->group(function () {
                Route::post('/', 'SkillController@add');
                Route::get('/', 'SkillController@browse');
                Route::get('/{id}', 'SkillController@read');
                Route::put('/{id}', 'SkillController@update');
                Route::delete('/{id}', 'SkillController@delete');
            });

            Route::prefix('/employee-skill')->group(function () {
                Route::post('/', 'EmployeeSkillController@add');
                Route::get('/', 'EmployeeSkillController@browse');
                Route::get('/{id}', 'EmployeeSkillController@read');
                Route::put('/{id}', 'EmployeeSkillController@update');
                Route::delete('/{id}', 'EmployeeSkillController@delete');
            });

            Route::prefix('/employee-attendance')->group(function () {
                Route::post('/', 'EmployeeAttendanceController@add');
                Route::get('/', 'EmployeeAttendanceController@browse');
                Route::get('/{id}', 'EmployeeAttendanceController@read');
                Route::put('/{id}', 'EmployeeAttendanceController@update');
                Route::delete('/{id}', 'EmployeeAttendanceController@delete');
            });

            Route::prefix('/partner-title')->group(function () {
                Route::post('/', 'PartnerTitleController@add');
                Route::get('/', 'PartnerTitleController@browse');
                Route::get('/{id}', 'PartnerTitleController@read');
                Route::put('/{id}', 'PartnerTitleController@update');
                Route::delete('/{id}', 'PartnerTitleController@delete');
            });

            Route::prefix('/company-contact')->group(function () {
                Route::post('/', 'CompanyContactController@add');
                Route::get('/', 'CompanyContactController@browse');
                Route::get('/{id}', 'CompanyContactController@read');
                Route::put('/{id}', 'CompanyContactController@update');
                Route::delete('/{id}', 'CompanyContactController@delete');
            });

            Route::prefix('/departement')->group(function () {
                Route::post('/', 'DepartementController@add');
                Route::get('/', 'DepartementController@browse');
                Route::get('/{id}', 'DepartementController@read');
                Route::put('/{id}', 'DepartementController@update');
                Route::delete('/{id}', 'DepartementController@delete');
            });

            Route::prefix('/job')->group(function () {
                Route::post('/', 'JobController@add');
                Route::get('/', 'JobController@browse');
                Route::get('/{id}', 'JobController@read');
                Route::put('/{id}', 'JobController@update');
                Route::delete('/{id}', 'JobController@delete');
            });

            Route::prefix('/recruitment')->group(function () {
                Route::post('/', 'RecruitmentController@add');
                Route::get('/', 'RecruitmentController@browse');
                Route::get('/{id}', 'RecruitmentController@read');
                Route::put('/{id}', 'RecruitmentController@update');
                Route::delete('/{id}', 'RecruitmentController@delete');
            });

            Route::prefix('/recruitment-stage')->group(function () {
                Route::post('/', 'RecruitmentStageController@add');
                Route::get('/', 'RecruitmentStageController@browse');
                Route::get('/{id}', 'RecruitmentStageController@read');
                Route::put('/{id}', 'RecruitmentStageController@update');
                Route::delete('/{id}', 'RecruitmentStageController@delete');
            });

            Route::prefix('/recruitment-source')->group(function () {
                Route::post('/', 'RecruitmentSourceController@add');
                Route::get('/', 'RecruitmentSourceController@browse');
                Route::get('/{id}', 'RecruitmentSourceController@read');
                Route::put('/{id}', 'RecruitmentSourceController@update');
                Route::delete('/{id}', 'RecruitmentSourceController@delete');
            });

            Route::prefix('/metsos-source')->group(function () {
                Route::post('/', 'MetsosSourceController@add');
                Route::get('/', 'MetsosSourceController@browse');
                Route::get('/{id}', 'MetsosSourceController@read');
                Route::put('/{id}', 'MetsosSourceController@update');
                Route::delete('/{id}', 'MetsosSourceController@delete');
            });

            Route::prefix('/applicant')->group(function () {
                Route::post('/', 'ApplicantController@add');
                Route::get('/', 'ApplicantController@browse');
                Route::get('/{id}', 'ApplicantController@read');
                Route::put('/{id}', 'ApplicantController@update');
                Route::delete('/{id}', 'ApplicantController@delete');
            });

            Route::prefix('/applicant-category')->group(function () {
                Route::post('/', 'ApplicantCategoryController@add');
                Route::get('/', 'ApplicantCategoryController@browse');
                Route::get('/{id}', 'ApplicantCategoryController@read');
                Route::put('/{id}', 'ApplicantCategoryController@update');
                Route::delete('/{id}', 'ApplicantCategoryController@delete');
            });

            Route::prefix('/applicant-tag')->group(function () {
                Route::post('/', 'ApplicantTagController@add');
                Route::get('/', 'ApplicantTagController@browse');
                Route::get('/{id}', 'ApplicantTagController@read');
                Route::put('/{id}', 'ApplicantTagController@update');
                Route::delete('/{id}', 'ApplicantTagController@delete');
            });

            Route::prefix('/applicant-follower')->group(function () {
                Route::post('/', 'ApplicantFollowerController@add');
                Route::get('/', 'ApplicantFollowerController@browse');
                Route::get('/{id}', 'ApplicantFollowerController@read');
                Route::put('/{id}', 'ApplicantFollowerController@update');
                Route::delete('/{id}', 'ApplicantFollowerController@delete');
            });

            Route::prefix('/applicant-comment')->group(function () {
                Route::post('/', 'ApplicantCommentController@add');
                Route::get('/', 'ApplicantCommentController@browse');
                Route::get('/{id}', 'ApplicantCommentController@read');
                Route::put('/{id}', 'ApplicantCommentController@update');
                Route::delete('/{id}', 'ApplicantCommentController@delete');
            });

            Route::prefix('/calendar-event')->group(function () {
                Route::post('/', 'CalendarEventController@add');
                Route::get('/', 'CalendarEventController@browse');
                Route::get('/{id}', 'CalendarEventController@read');
                Route::put('/{id}', 'CalendarEventController@update');
                Route::delete('/{id}', 'CalendarEventController@delete');
            });

            Route::prefix('/calendar-event-category')->group(function () {
                Route::post('/', 'CalendarEventCategoryController@add');
                Route::get('/', 'CalendarEventCategoryController@browse');
                Route::get('/{id}', 'CalendarEventCategoryController@read');
                Route::put('/{id}', 'CalendarEventCategoryController@update');
                Route::delete('/{id}', 'CalendarEventCategoryController@delete');
            });

            Route::prefix('/calendar-event-tag')->group(function () {
                Route::post('/', 'CalendarEventTagController@add');
                Route::get('/', 'CalendarEventTagController@browse');
                Route::get('/{id}', 'CalendarEventTagController@read');
                Route::put('/{id}', 'CalendarEventTagController@update');
                Route::delete('/{id}', 'CalendarEventTagController@delete');
            });

            Route::prefix('/calendar-recurrent')->group(function () {
                Route::post('/', 'CalendarRecurrentController@add');
                Route::get('/', 'CalendarRecurrentController@browse');
                Route::get('/{id}', 'CalendarRecurrentController@read');
                Route::put('/{id}', 'CalendarRecurrentController@update');
                Route::delete('/{id}', 'CalendarRecurrentController@delete');
            });

            Route::prefix('/calendar-attendee')->group(function () {
                Route::post('/', 'CalendarAttendeeController@add');
                Route::get('/', 'CalendarAttendeeController@browse');
                Route::get('/{id}', 'CalendarAttendeeController@read');
                Route::put('/{id}', 'CalendarAttendeeController@update');
                Route::delete('/{id}', 'CalendarAttendeeController@delete');
            });

            Route::prefix('/calendar-alaram')->group(function () {
                Route::post('/', 'CalendarAlaramController@add');
                Route::get('/', 'CalendarAlaramController@browse');
                Route::get('/{id}', 'CalendarAlaramController@read');
                Route::put('/{id}', 'CalendarAlaramController@update');
                Route::delete('/{id}', 'CalendarAlaramController@delete');
            });

            Route::prefix('/calendar-reminder')->group(function () {
                Route::post('/', 'CalendarReminderController@add');
                Route::get('/', 'CalendarReminderController@browse');
                Route::get('/{id}', 'CalendarReminderController@read');
                Route::put('/{id}', 'CalendarReminderController@update');
                Route::delete('/{id}', 'CalendarReminderController@delete');
            });

            Route::prefix('/calendar-recruitment-event')->group(function () {
                Route::post('/', 'CalendarRecruitmentEventController@add');
                Route::get('/', 'CalendarRecruitmentEventController@browse');
                Route::get('/{id}', 'CalendarRecruitmentEventController@read');
                Route::put('/{id}', 'CalendarRecruitmentEventController@update');
                Route::delete('/{id}', 'CalendarRecruitmentEventController@delete');
            });

            Route::prefix('/time-off-type')->group(function () {
                Route::post('/', 'TimeOffTypeController@add');
                Route::get('/', 'TimeOffTypeController@browse');
                Route::get('/{id}', 'TimeOffTypeController@read');
                Route::put('/{id}', 'TimeOffTypeController@update');
                Route::delete('/{id}', 'TimeOffTypeController@delete');
            });

            Route::prefix('/time-off-allocation')->group(function () {
                Route::post('/', 'TimeOffAllocationController@add');
                Route::get('/', 'TimeOffAllocationController@browse');
                Route::get('/{id}', 'TimeOffAllocationController@read');
                Route::put('/{id}', 'TimeOffAllocationController@update');
                Route::delete('/{id}', 'TimeOffAllocationController@delete');
            });

            Route::prefix('/time-off')->group(function () {
                Route::post('/', 'TimeOffController@add');
                Route::get('/', 'TimeOffController@browse');
                Route::get('/{id}', 'TimeOffController@read');
                Route::put('/{id}', 'TimeOffController@update');
                Route::delete('/{id}', 'TimeOffController@delete');
            });

            Route::prefix('/lunch-vendor')->group(function () {
                Route::post('/', 'LunchVendorController@add');
                Route::get('/', 'LunchVendorController@browse');
                Route::get('/{id}', 'LunchVendorController@read');
                Route::put('/{id}', 'LunchVendorController@update');
                Route::delete('/{id}', 'LunchVendorController@delete');
            });

            Route::prefix('/lunch-location')->group(function () {
                Route::post('/', 'LunchLocationController@add');
                Route::get('/', 'LunchLocationController@browse');
                Route::get('/{id}', 'LunchLocationController@read');
                Route::put('/{id}', 'LunchLocationController@update');
                Route::delete('/{id}', 'LunchLocationController@delete');
            });

            Route::prefix('/lunch-vendors-location-order')->group(function () {
                Route::post('/', 'LunchVendorsLocationOrderController@add');
                Route::get('/', 'LunchVendorsLocationOrderController@browse');
                Route::get('/{id}', 'LunchVendorsLocationOrderController@read');
                Route::put('/{id}', 'LunchVendorsLocationOrderController@update');
                Route::delete('/{id}', 'LunchVendorsLocationOrderController@delete');
            });

            Route::prefix('/lunch-product-category')->group(function () {
                Route::post('/', 'LunchProductCategoryController@add');
                Route::get('/', 'LunchProductCategoryController@browse');
                Route::get('/{id}', 'LunchProductCategoryController@read');
                Route::put('/{id}', 'LunchProductCategoryController@update');
                Route::delete('/{id}', 'LunchProductCategoryController@delete');
            });

            Route::prefix('/lunch-product-category-topping')->group(function () {
                Route::post('/', 'LunchProductCategoryToppingController@add');
                Route::get('/', 'LunchProductCategoryToppingController@browse');
                Route::get('/{id}', 'LunchProductCategoryToppingController@read');
                Route::put('/{id}', 'LunchProductCategoryToppingController@update');
                Route::delete('/{id}', 'LunchProductCategoryToppingController@delete');
            });

            Route::prefix('/lunch-product-category-topping-item')->group(function () {
                Route::post('/', 'LunchProductCategoryToppingItemController@add');
                Route::get('/', 'LunchProductCategoryToppingItemController@browse');
                Route::get('/{id}', 'LunchProductCategoryToppingItemController@read');
                Route::put('/{id}', 'LunchProductCategoryToppingItemController@update');
                Route::delete('/{id}', 'LunchProductCategoryToppingItemController@delete');
            });

            Route::prefix('/lunch-topping')->group(function () {
                Route::post('/', 'LunchToppingController@add');
                Route::get('/', 'LunchToppingController@browse');
                Route::get('/{id}', 'LunchToppingController@read');
                Route::put('/{id}', 'LunchToppingController@update');
                Route::delete('/{id}', 'LunchToppingController@delete');
            });

            Route::prefix('/lunch-product')->group(function () {
                Route::post('/', 'LunchProductController@add');
                Route::get('/', 'LunchProductController@browse');
                Route::get('/{id}', 'LunchProductController@read');
                Route::put('/{id}', 'LunchProductController@update');
                Route::delete('/{id}', 'LunchProductController@delete');
            });

            Route::prefix('/lunch-product-favorite')->group(function () {
                Route::post('/', 'LunchProductFavoriteController@add');
                Route::get('/', 'LunchProductFavoriteController@browse');
                Route::get('/{id}', 'LunchProductFavoriteController@read');
                Route::put('/{id}', 'LunchProductFavoriteController@update');
                Route::delete('/{id}', 'LunchProductFavoriteController@delete');
            });

            Route::prefix('/lunch-alert')->group(function () {
                Route::post('/', 'LunchAlertController@add');
                Route::get('/', 'LunchAlertController@browse');
                Route::get('/{id}', 'LunchAlertController@read');
                Route::put('/{id}', 'LunchAlertController@update');
                Route::delete('/{id}', 'LunchAlertController@delete');
            });

            Route::prefix('/lunch-alert-location')->group(function () {
                Route::post('/', 'LunchAlertLocationController@add');
                Route::get('/', 'LunchAlertLocationController@browse');
                Route::get('/{id}', 'LunchAlertLocationController@read');
                Route::put('/{id}', 'LunchAlertLocationController@update');
                Route::delete('/{id}', 'LunchAlertLocationController@delete');
            });

            Route::prefix('/lunch-cashmove')->group(function () {
                Route::post('/', 'LunchCashmoveController@add');
                Route::get('/', 'LunchCashmoveController@browse');
                Route::get('/{id}', 'LunchCashmoveController@read');
                Route::put('/{id}', 'LunchCashmoveController@update');
                Route::delete('/{id}', 'LunchCashmoveController@delete');
            });

            Route::prefix('/lunch-order')->group(function () {
                Route::post('/', 'LunchOrderController@add');
                Route::get('/', 'LunchOrderController@browse');
                Route::get('/{id}', 'LunchOrderController@read');
                Route::put('/{id}', 'LunchOrderController@update');
                Route::delete('/{id}', 'LunchOrderController@delete');
            });

            Route::prefix('/lunch-order-topping')->group(function () {
                Route::post('/', 'LunchOrderToppingController@add');
                Route::get('/', 'LunchOrderToppingController@browse');
                Route::get('/{id}', 'LunchOrderToppingController@read');
                Route::put('/{id}', 'LunchOrderToppingController@update');
                Route::delete('/{id}', 'LunchOrderToppingController@delete');
            });

            Route::prefix('/fleet-model-brand')->group(function () {
                Route::post('/', 'FleetModelBrandController@add');
                Route::get('/', 'FleetModelBrandController@browse');
                Route::get('/{id}', 'FleetModelBrandController@read');
                Route::put('/{id}', 'FleetModelBrandController@update');
                Route::delete('/{id}', 'FleetModelBrandController@delete');
            });

            Route::prefix('/fleet-model')->group(function () {
                Route::post('/', 'FleetModelController@add');
                Route::get('/', 'FleetModelController@browse');
                Route::get('/{id}', 'FleetModelController@read');
                Route::put('/{id}', 'FleetModelController@update');
                Route::delete('/{id}', 'FleetModelController@delete');
            });

            Route::prefix('/fleet-vendor')->group(function () {
                Route::post('/', 'FleetVendorController@add');
                Route::get('/', 'FleetVendorController@browse');
                Route::get('/{id}', 'FleetVendorController@read');
                Route::put('/{id}', 'FleetVendorController@update');
                Route::delete('/{id}', 'FleetVendorController@delete');
            });

            Route::prefix('/fleet-vehicle-category')->group(function () {
                Route::post('/', 'FleetVehicleCategoryController@add');
                Route::get('/', 'FleetVehicleCategoryController@browse');
                Route::get('/{id}', 'FleetVehicleCategoryController@read');
                Route::put('/{id}', 'FleetVehicleCategoryController@update');
                Route::delete('/{id}', 'FleetVehicleCategoryController@delete');
            });

            Route::prefix('/fleet-state')->group(function () {
                Route::post('/', 'FleetStateController@add');
                Route::get('/', 'FleetStateController@browse');
                Route::get('/{id}', 'FleetStateController@read');
                Route::put('/{id}', 'FleetStateController@update');
                Route::delete('/{id}', 'FleetStateController@delete');
            });

            Route::prefix('/fleet-vehicle')->group(function () {
                Route::post('/', 'FleetVehicleController@add');
                Route::get('/', 'FleetVehicleController@browse');
                Route::get('/{id}', 'FleetVehicleController@read');
                Route::put('/{id}', 'FleetVehicleController@update');
                Route::delete('/{id}', 'FleetVehicleController@delete');
            });

            Route::prefix('/fleet-vehicle-tag')->group(function () {
                Route::post('/', 'FleetVehicleTagController@add');
                Route::get('/', 'FleetVehicleTagController@browse');
                Route::get('/{id}', 'FleetVehicleTagController@read');
                Route::put('/{id}', 'FleetVehicleTagController@update');
                Route::delete('/{id}', 'FleetVehicleTagController@delete');
            });

            Route::prefix('/fleet-contract-type')->group(function () {
                Route::post('/', 'FleetContractTypeController@add');
                Route::get('/', 'FleetContractTypeController@browse');
                Route::get('/{id}', 'FleetContractTypeController@read');
                Route::put('/{id}', 'FleetContractTypeController@update');
                Route::delete('/{id}', 'FleetContractTypeController@delete');
            });

            Route::prefix('/fleet-contract')->group(function () {
                Route::post('/', 'FleetContractController@add');
                Route::get('/', 'FleetContractController@browse');
                Route::get('/{id}', 'FleetContractController@read');
                Route::put('/{id}', 'FleetContractController@update');
                Route::delete('/{id}', 'FleetContractController@delete');
            });

            Route::prefix('/fleet-service-type')->group(function () {
                Route::post('/', 'FleetServiceTypeController@add');
                Route::get('/', 'FleetServiceTypeController@browse');
                Route::get('/{id}', 'FleetServiceTypeController@read');
                Route::put('/{id}', 'FleetServiceTypeController@update');
                Route::delete('/{id}', 'FleetServiceTypeController@delete');
            });

            Route::prefix('/fleet-contract-service')->group(function () {
                Route::post('/', 'FleetContractServiceController@add');
                Route::get('/', 'FleetContractServiceController@browse');
                Route::get('/{id}', 'FleetContractServiceController@read');
                Route::put('/{id}', 'FleetContractServiceController@update');
                Route::delete('/{id}', 'FleetContractServiceController@delete');
            });

            Route::prefix('/fleet-service')->group(function () {
                Route::post('/', 'FleetServiceController@add');
                Route::get('/', 'FleetServiceController@browse');
                Route::get('/{id}', 'FleetServiceController@read');
                Route::put('/{id}', 'FleetServiceController@update');
                Route::delete('/{id}', 'FleetServiceController@delete');
            });

            Route::prefix('/fleet-odometer')->group(function () {
                Route::post('/', 'FleetOdometerController@add');
                Route::get('/', 'FleetOdometerController@browse');
                Route::get('/{id}', 'FleetOdometerController@read');
                Route::put('/{id}', 'FleetOdometerController@update');
                Route::delete('/{id}', 'FleetOdometerController@delete');
            });

            Route::prefix('/account-type')->group(function () {
                Route::post('/', 'AccountTypeController@add');
                Route::get('/', 'AccountTypeController@browse');
                Route::get('/{id}', 'AccountTypeController@read');
                Route::put('/{id}', 'AccountTypeController@update');
                Route::delete('/{id}', 'AccountTypeController@delete');
            });

            Route::prefix('/account-taxe')->group(function () {
                Route::post('/', 'AccountTaxeController@add');
                Route::get('/', 'AccountTaxeController@browse');
                Route::get('/{id}', 'AccountTaxeController@read');
                Route::put('/{id}', 'AccountTaxeController@update');
                Route::delete('/{id}', 'AccountTaxeController@delete');
            });

            Route::prefix('/account-group')->group(function () {
                Route::post('/', 'AccountGroupController@add');
                Route::get('/', 'AccountGroupController@browse');
                Route::get('/{id}', 'AccountGroupController@read');
                Route::put('/{id}', 'AccountGroupController@update');
                Route::delete('/{id}', 'AccountGroupController@delete');
            });

            Route::prefix('/account')->group(function () {
                Route::post('/', 'AccountController@add');
                Route::get('/', 'AccountController@browse');
                Route::get('/{id}', 'AccountController@read');
                Route::put('/{id}', 'AccountController@update');
                Route::delete('/{id}', 'AccountController@delete');
            });

            Route::prefix('/bank')->group(function () {
                Route::post('/', 'BankController@add');
                Route::get('/', 'BankController@browse');
                Route::get('/{id}', 'BankController@read');
                Route::put('/{id}', 'BankController@update');
                Route::delete('/{id}', 'BankController@delete');
            });

            Route::prefix('/partner-bank')->group(function () {
                Route::post('/', 'PartnerBankController@add');
                Route::get('/', 'PartnerBankController@browse');
                Route::get('/{id}', 'PartnerBankController@read');
                Route::put('/{id}', 'PartnerBankController@update');
                Route::delete('/{id}', 'PartnerBankController@delete');
            });

            Route::prefix('/account-journal')->group(function () {
                Route::post('/', 'AccountJournalController@add');
                Route::get('/', 'AccountJournalController@browse');
                Route::get('/{id}', 'AccountJournalController@read');
                Route::put('/{id}', 'AccountJournalController@update');
                Route::delete('/{id}', 'AccountJournalController@delete');
            });

            Route::prefix('/tax-account-payable')->group(function () {
                Route::post('/', 'TaxAccountPayableController@add');
                Route::get('/', 'TaxAccountPayableController@browse');
                Route::get('/{id}', 'TaxAccountPayableController@read');
                Route::put('/{id}', 'TaxAccountPayableController@update');
                Route::delete('/{id}', 'TaxAccountPayableController@delete');
            });

            Route::prefix('/account-tag')->group(function () {
                Route::post('/', 'AccountTagController@add');
                Route::get('/', 'AccountTagController@browse');
                Route::get('/{id}', 'AccountTagController@read');
                Route::put('/{id}', 'AccountTagController@update');
                Route::delete('/{id}', 'AccountTagController@delete');
            });

            Route::prefix('/tax-current-account-tag')->group(function () {
                Route::post('/', 'TaxCurrentAccountTagController@add');
                Route::get('/', 'TaxCurrentAccountTagController@browse');
                Route::get('/{id}', 'TaxCurrentAccountTagController@read');
                Route::put('/{id}', 'TaxCurrentAccountTagController@update');
                Route::delete('/{id}', 'TaxCurrentAccountTagController@delete');
            });

            Route::prefix('/tax-current-account-journal')->group(function () {
                Route::post('/', 'TaxCurrentAccountJournalController@add');
                Route::get('/', 'TaxCurrentAccountJournalController@browse');
                Route::get('/{id}', 'TaxCurrentAccountJournalController@read');
                Route::put('/{id}', 'TaxCurrentAccountJournalController@update');
                Route::delete('/{id}', 'TaxCurrentAccountJournalController@delete');
            });

            Route::prefix('/tax-group')->group(function () {
                Route::post('/', 'TaxGroupController@add');
                Route::get('/', 'TaxGroupController@browse');
                Route::get('/{id}', 'TaxGroupController@read');
                Route::put('/{id}', 'TaxGroupController@update');
                Route::delete('/{id}', 'TaxGroupController@delete');
            });

            Route::prefix('/accounting-taxe')->group(function () {
                Route::post('/', 'AccountingTaxeController@add');
                Route::get('/', 'AccountingTaxeController@browse');
                Route::get('/{id}', 'AccountingTaxeController@read');
                Route::put('/{id}', 'AccountingTaxeController@update');
                Route::delete('/{id}', 'AccountingTaxeController@delete');
            });

            Route::prefix('/accounting-distribution-invoice')->group(function () {
                Route::post('/', 'AccountingDistributionInvoiceController@add');
                Route::get('/', 'AccountingDistributionInvoiceController@browse');
                Route::get('/{id}', 'AccountingDistributionInvoiceController@read');
                Route::put('/{id}', 'AccountingDistributionInvoiceController@update');
                Route::delete('/{id}', 'AccountingDistributionInvoiceController@delete');
            });

            Route::prefix('/accounting-distribution-credit-note')->group(function () {
                Route::post('/', 'AccountingDistributionCreditNoteController@add');
                Route::get('/', 'AccountingDistributionCreditNoteController@browse');
                Route::get('/{id}', 'AccountingDistributionCreditNoteController@read');
                Route::put('/{id}', 'AccountingDistributionCreditNoteController@update');
                Route::delete('/{id}', 'AccountingDistributionCreditNoteController@delete');
            });

            Route::prefix('/expense-product')->group(function () {
                Route::post('/', 'ExpenseProductController@add');
                Route::get('/', 'ExpenseProductController@browse');
                Route::get('/{id}', 'ExpenseProductController@read');
                Route::put('/{id}', 'ExpenseProductController@update');
                Route::delete('/{id}', 'ExpenseProductController@delete');
            });

            Route::prefix('/expense-vendor-accounting-tax')->group(function () {
                Route::post('/', 'ExpenseVendorAccountingTaxController@add');
                Route::get('/', 'ExpenseVendorAccountingTaxController@browse');
                Route::get('/{id}', 'ExpenseVendorAccountingTaxController@read');
                Route::put('/{id}', 'ExpenseVendorAccountingTaxController@update');
                Route::delete('/{id}', 'ExpenseVendorAccountingTaxController@delete');
            });

            Route::prefix('/expense-customer-accounting-tax')->group(function () {
                Route::post('/', 'ExpenseCustomerAccountingTaxController@add');
                Route::get('/', 'ExpenseCustomerAccountingTaxController@browse');
                Route::get('/{id}', 'ExpenseCustomerAccountingTaxController@read');
                Route::put('/{id}', 'ExpenseCustomerAccountingTaxController@update');
                Route::delete('/{id}', 'ExpenseCustomerAccountingTaxController@delete');
            });

            Route::prefix('/expense-register-payment')->group(function () {
                Route::post('/', 'ExpenseRegisterPaymentController@add');
                Route::get('/', 'ExpenseRegisterPaymentController@browse');
                Route::get('/{id}', 'ExpenseRegisterPaymentController@read');
                Route::put('/{id}', 'ExpenseRegisterPaymentController@update');
                Route::delete('/{id}', 'ExpenseRegisterPaymentController@delete');
            });

            Route::prefix('/expense-report')->group(function () {
                Route::post('/', 'ExpenseReportController@add');
                Route::get('/', 'ExpenseReportController@browse');
                Route::get('/{id}', 'ExpenseReportController@read');
                Route::put('/{id}', 'ExpenseReportController@update');
                Route::delete('/{id}', 'ExpenseReportController@delete');
            });

            Route::prefix('/expense-reports-companye')->group(function () {
                Route::post('/', 'ExpenseReportsCompanyeController@add');
                Route::get('/', 'ExpenseReportsCompanyeController@browse');
                Route::get('/{id}', 'ExpenseReportsCompanyeController@read');
                Route::put('/{id}', 'ExpenseReportsCompanyeController@update');
                Route::delete('/{id}', 'ExpenseReportsCompanyeController@delete');
            });

            Route::prefix('/expense-report-item')->group(function () {
                Route::post('/', 'ExpenseReportItemController@add');
                Route::get('/', 'ExpenseReportItemController@browse');
                Route::get('/{id}', 'ExpenseReportItemController@read');
                Route::put('/{id}', 'ExpenseReportItemController@update');
                Route::delete('/{id}', 'ExpenseReportItemController@delete');
            });


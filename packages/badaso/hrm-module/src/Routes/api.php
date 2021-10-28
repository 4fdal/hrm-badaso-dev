<?php

use Uasoft\Badaso\Middleware\ApiRequest;

$api_route_prefix = \config('badaso.api_route_prefix');

Route::group(
    [
        'prefix' => $api_route_prefix,
        'namespace' => 'Uasoft\Badaso\Module\HRM\Controllers',
        'as' => 'badaso.',
        'middleware' => [ApiRequest::class],
    ],
    function () {
        Route::group(['prefix' => 'module/hrm/v1', 'middleware' => []], function () {
            Route::prefix('/recruitment')->group(function () {
                Route::post('/job/add', 'RecruitmentJobController@add');
                Route::post('/job/applicant', 'RecruitmentJobController@applicant');
            });
            Route::prefix('/degree')->group(function () {
                Route::post('/add', 'DegreeController@add');
            });
            Route::prefix('/metsos-source')->group(function () {
                Route::post('/add', 'MetsosSourceController@add');
            });
            Route::prefix('/applicant-category')->group(function () {
                Route::post('/add', 'ApplicantCategoryController@add');
            });
        });
    }
);

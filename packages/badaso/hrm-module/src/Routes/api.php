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
            // Route::get('/', 'ExampleController@exampleFunction')->middleware(BadasoCheckPermissions::class . ':browse_content');
            Route::post('/job', 'JobController@store');
        });
    }
);

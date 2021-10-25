<?php

namespace Uasoft\Badaso\Module\HRM\Facades;

use Illuminate\Support\Facades\Facade;

class BadasoHRMModule extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'badaso-hrm-module';
    }
}

<?php

namespace Uasoft\Badaso\Module\HRM\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Uasoft\Badaso\Module\HRM\BadasoHRMModule;
use Uasoft\Badaso\Module\HRM\Commands\BadasoHRMModuleSetupCommand;
use Uasoft\Badaso\Module\HRM\Facades\BadasoHRMModule as FacadesBadasoHRMModule;
use Uasoft\Badaso\Module\HRM\Models\Applicant;
use Uasoft\Badaso\Module\HRM\Models\Job;
use Uasoft\Badaso\Module\HRM\Observer\ApplicantObserver;
use Uasoft\Badaso\Module\HRM\Observer\JobObserver;

class BadasoHRMModuleServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->init();
        $this->initObserver();
        $this->loadFile();
        $this->publisFile();
    }

    // init file library
    public function init()
    {
        $loader = AliasLoader::getInstance();
        $loader->alias('Badaso', FacadesBadasoHRMModule::class);
        $router = $this->app['router'];
        $this->app->singleton('badaso', function () {
            return new BadasoHRMModule();
        });
    }

    // load file observer
    public function initObserver(){
        // ExampleModel::observe(ExampleObserver::class);
        Job::observe(JobObserver::class) ;
        Applicant::observe(ApplicantObserver::class) ;
    }

    // load all file in library
    public function loadFile()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Migrations');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'badaso');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/api.php');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'badaso');
    }

    // publish all file in library to main project
    public function publisFile()
    {
        $this->publishes([
            __DIR__ . '/../Config' => config_path('/'),
            __DIR__ . '/../Seeder' => database_path('/seeders/Badaso/HRM'),
        ], 'Badaso');
    }

    public function register()
    {
        $this->registerConsoleCommands();
    }

    /**
     * Register the commands accessible from the Console.
     */
    private function registerConsoleCommands()
    {
        $this->commands(BadasoHRMModuleSetupCommand::class);
    }
}

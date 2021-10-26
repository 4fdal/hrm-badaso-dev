<?php

namespace Uasoft\Badaso\Module\HRM\Commands;

use Illuminate\Console\Command;

class BadasoHRMModuleSetupCommand extends Command
{
    private $force;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'badaso-hrm:setup {--force=false}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command Badaso HRM Module';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $this->force = $this->option('force');
            if ($this->force == null) {
                $this->force = true;
            }

            $this->vendorPublishBadasoHRMModule();
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }

    private function vendorPublishBadasoHRMModule()
    {
        $this->call('vendor:publish', [
            '--tag' => 'badaso-hrm-module',
            '--force' => $this->force,
        ]);
    }
}

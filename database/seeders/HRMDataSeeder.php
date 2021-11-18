<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Uasoft\Badaso\Module\HRM\Models\Company;

class HRMDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $company = factory(Company::class)->create();
    }
}

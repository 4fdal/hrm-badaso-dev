<?php

namespace Database\Seeders\Badaso\HRM;

use Illuminate\Database\Seeder;
use Uasoft\Badaso\Models\Permission;

class BadasoHRMPermissionsSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        $keys = [

        ];

        foreach ($keys as $key) {
            Permission::firstOrCreate([

            ]);
        }

        Permission::generateFor('hrm');
    }
}

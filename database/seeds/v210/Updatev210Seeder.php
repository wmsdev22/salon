<?php
/*
 * File name: Updatev210Seeder.php
 * Last modified: 2022.10.16 at 11:45:57
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2022
 */

use Illuminate\Database\Seeder;

class Updatev210Seeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionsTableV210Seeder::class);
        $this->call(RoleHasPermissionsTableV210Seeder::class);
    }
}

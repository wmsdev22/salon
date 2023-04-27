<?php
/*
 * File name: Updatev200Seeder.php
 * Last modified: 2022.08.11 at 16:37:11
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2022
 */

use Illuminate\Database\Seeder;

class Updatev200Seeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AppSettingsTableV200Seeder::class);
    }
}

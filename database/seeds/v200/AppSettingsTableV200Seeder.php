<?php
/*
 * File name: AppSettingsTableV200Seeder.php
 * Last modified: 2022.08.11 at 16:37:11
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2022
 */

use Illuminate\Database\Seeder;

class AppSettingsTableV200Seeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('app_settings')->insert(array(
            array(
                'key' => 'enable_otp',
                'value' => '1',
            ),
        ));
    }
}

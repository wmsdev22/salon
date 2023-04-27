<?php
/*
 * File name: RoleHasPermissionsTableV210Seeder.php
 * Last modified: 2022.10.16 at 11:45:57
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2022
 */

use Illuminate\Database\Seeder;

class RoleHasPermissionsTableV210Seeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('role_has_permissions')->where('permission_id', '=', 219)->count() == 0) {
            DB::table('role_has_permissions')->insert(array(
                array(
                    'permission_id' => 219,
                    'role_id' => 2,
                ),
                array(
                    'permission_id' => 220,
                    'role_id' => 2,
                ),
                array(
                    'permission_id' => 221,
                    'role_id' => 2,
                ),
                array(
                    'permission_id' => 222,
                    'role_id' => 2,
                ),
            ));
        }


    }
}

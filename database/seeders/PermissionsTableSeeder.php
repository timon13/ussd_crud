<?php

namespace Database\Seeders;

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'ussd_create',
            ],
            [
                'id'    => 18,
                'title' => 'ussd_edit',
            ],
            [
                'id'    => 19,
                'title' => 'ussd_show',
            ],
            [
                'id'    => 20,
                'title' => 'ussd_delete',
            ],
            [
                'id'    => 21,
                'title' => 'ussd_access',
            ],
            [
                'id'    => 22,
                'title' => 'ussd_menu_create',
            ],
            [
                'id'    => 23,
                'title' => 'ussd_menu_edit',
            ],
            [
                'id'    => 24,
                'title' => 'ussd_menu_show',
            ],
            [
                'id'    => 25,
                'title' => 'ussd_menu_delete',
            ],
            [
                'id'    => 26,
                'title' => 'ussd_menu_access',
            ],
            [
                'id'    => 27,
                'title' => 'payment_show',
            ],
            [
                'id'    => 28,
                'title' => 'payment_access',
            ],
            [
                'id'    => 29,
                'title' => 'session_show',
            ],
            [
                'id'    => 30,
                'title' => 'session_access',
            ],
            [
                'id'    => 31,
                'title' => 'user_session_show',
            ],
            [
                'id'    => 32,
                'title' => 'user_session_access',
            ],
            [
                'id'    => 33,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 34,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 35,
                'title' => 'team_create',
            ],
            [
                'id'    => 36,
                'title' => 'team_edit',
            ],
            [
                'id'    => 37,
                'title' => 'team_show',
            ],
            [
                'id'    => 38,
                'title' => 'team_delete',
            ],
            [
                'id'    => 39,
                'title' => 'team_access',
            ],
            [
                'id'    => 40,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}

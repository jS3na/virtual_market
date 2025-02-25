<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionsSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role_permissions = [
            [
                'role_id' => 2,
                'permission_id' => 1
            ],
            [
                'role_id' => 2,
                'permission_id' => 2
            ],
            [
                'role_id' => 2,
                'permission_id' => 3
            ],
            [
                'role_id' => 2,
                'permission_id' => 4
            ],

            [
                'role_id' => 3,
                'permissions_id' => 1
            ],

            [
                'role_id' => 4,
                'permissions_id' => 2
            ],

            [
                'role_id' => 5,
                'permissions_id' => 3
            ],
        ];

        DB::table('role_permissions')->insert($role_permissions);
    }
}

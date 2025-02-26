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
        $permissions = range(1, 12);
        $role_id = 2;

        foreach ($permissions as $permission_id) {
            DB::table('role_permissions')->insert([
                'role_id' => $role_id,
                'permission_id' => $permission_id
            ]);
        }
    }
}

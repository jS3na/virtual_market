<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $admin_role = [
            [
                'name' => 'Admin',
                'created_at' => Carbon::now()
            ]
        ];

        DB::table('roles')->insert($admin_role);

        $permissions_count = DB::table('permissions')->count();

        $permissions = range(1, $permissions_count);
        $admin_role_id = 1;

        foreach ($permissions as $permission_id) {
            DB::table('role_permissions')->insert([
                'role_id' => $admin_role_id,
                'permission_id' => $permission_id
            ]);
        }

        $admin_user = [
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('admin'),
                'created_at' => Carbon::now(),
                'role_id' => 1
            ]
        ];

        DB::table('users')->insert($admin_user);
    }
}

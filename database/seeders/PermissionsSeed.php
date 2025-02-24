<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            [
                'permissions_list' => '["products.create","products.update","products.delete"]'
            ],
            [
                'permissions_list' => '["categories.create","categories.update","categories.delete"]'
            ],
            [
                'permissions_list' => '["users.create","users.update","users.delete"]'
            ],
            [
                'permissions_list' => '["roles.create","roles.update","roles.delete"]'
            ]
        ];

        DB::table('permissions')->insert($permissions);
    }
}

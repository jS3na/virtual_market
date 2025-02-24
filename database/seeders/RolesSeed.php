<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'Admin'
            ],
            [
                'name' => 'onlyProducts'
            ],
            [
                'name' => 'onlyCategories'
            ],
            [
                'name' => 'onlyUsers'
            ],
        ];

        DB::table('roles')->insert($roles);
    }
}

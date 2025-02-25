<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('senha'),
                'role_id' => 2
            ],
            [
                'name' => 'products',
                'email' => 'products@gmail.com',
                'password' => bcrypt('senha'),
                'role_id' => 3
            ],
        ];

        DB::table('users')->insert($users);
    }
}

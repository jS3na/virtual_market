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
            'products.create', 'products.update', 'products.delete', 'products.read',
            'categories.create', 'categories.update', 'categories.delete', 'categories.read',
            'users.create', 'users.update', 'users.delete', 'users.read',
            'roles.create', 'roles.update', 'roles.delete', 'roles.read'
        ];
        
        foreach ($permissions as $permission) {
            $permission_split = explode(".", $permission);
            DB::table('permissions')->insert([
                'name' => strtoupper($permission_split[1]) . ' ' . strtoupper($permission_split[0]),
                'permissions' => json_encode([$permission])
            ]);
        }
    }
}

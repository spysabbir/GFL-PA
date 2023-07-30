<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::insert([
            ['name' => 'style.create', 'group_name' => 'style', 'guard_name' => 'web'],
            ['name' => 'style.index', 'group_name' => 'style', 'guard_name' => 'web'],
            ['name' => 'style.edit', 'group_name' => 'style', 'guard_name' => 'web'],
            ['name' => 'style.delete', 'group_name' => 'style', 'guard_name' => 'web'],
            ['name' => 'buyer.create', 'group_name' => 'buyer', 'guard_name' => 'web'],
            ['name' => 'buyer.index', 'group_name' => 'buyer', 'guard_name' => 'web'],
            ['name' => 'buyer.edit', 'group_name' => 'buyer', 'guard_name' => 'web'],
            ['name' => 'buyer.delete', 'group_name' => 'buyer', 'guard_name' => 'web'],
        ]);
    }
}

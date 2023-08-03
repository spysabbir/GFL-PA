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
            ['name' => 'RoleManagementMenu', 'group_name' => 'RoleManagement', 'guard_name' => 'web'],
            ['name' => 'role.index', 'group_name' => 'RoleManagement', 'guard_name' => 'web'],
            ['name' => 'role-permission.index', 'group_name' => 'RoleManagement', 'guard_name' => 'web'],

            ['name' => 'UserMenu', 'group_name' => 'User', 'guard_name' => 'web'],
            ['name' => 'user.create', 'group_name' => 'User', 'guard_name' => 'web'],
            ['name' => 'user.index', 'group_name' => 'User', 'guard_name' => 'web'],

            ['name' => 'EmployeeResourcesMenu', 'group_name' => 'EmployeeResources', 'guard_name' => 'web'],
            ['name' => 'department.index', 'group_name' => 'EmployeeResources', 'guard_name' => 'web'],
            ['name' => 'designation.index', 'group_name' => 'EmployeeResources', 'guard_name' => 'web'],

            ['name' => 'SettingMenu', 'group_name' => 'Setting', 'guard_name' => 'web'],
            ['name' => 'default.setting', 'group_name' => 'Setting', 'guard_name' => 'web'],

            ['name' => 'EmployeeMenu', 'group_name' => 'Employee', 'guard_name' => 'web'],
            ['name' => 'employee.create', 'group_name' => 'Employee', 'guard_name' => 'web'],
            ['name' => 'employee.index', 'group_name' => 'Employee', 'guard_name' => 'web'],

            ['name' => 'StyleResourcesMenu', 'group_name' => 'StyleResources', 'guard_name' => 'web'],
            ['name' => 'buyer.index', 'group_name' => 'StyleResources', 'guard_name' => 'web'],
            ['name' => 'style.index', 'group_name' => 'StyleResources', 'guard_name' => 'web'],
            ['name' => 'season.index', 'group_name' => 'StyleResources', 'guard_name' => 'web'],
            ['name' => 'color.index', 'group_name' => 'StyleResources', 'guard_name' => 'web'],
            ['name' => 'wash.index', 'group_name' => 'StyleResources', 'guard_name' => 'web'],
            ['name' => 'garment-type.index', 'group_name' => 'StyleResources', 'guard_name' => 'web'],

            ['name' => 'MasterStyleMenu', 'group_name' => 'MasterStyle', 'guard_name' => 'web'],
            ['name' => 'master-style.create', 'group_name' => 'MasterStyle', 'guard_name' => 'web'],
            ['name' => 'master-style.index', 'group_name' => 'MasterStyle', 'guard_name' => 'web'],

            ['name' => 'OthersResourcesMenu', 'group_name' => 'OthersResources', 'guard_name' => 'web'],
            ['name' => 'line.index', 'group_name' => 'OthersResources', 'guard_name' => 'web'],

            ['name' => 'CuttingMenu', 'group_name' => 'Cutting', 'guard_name' => 'web'],
            ['name' => 'new-cutting.index', 'group_name' => 'Cutting', 'guard_name' => 'web'],
            ['name' => 'sewing-input.index', 'group_name' => 'Cutting', 'guard_name' => 'web'],

            ['name' => 'SewingMenu', 'group_name' => 'Sewing', 'guard_name' => 'web'],
            ['name' => 'sewing-production.index', 'group_name' => 'Sewing', 'guard_name' => 'web'],

            ['name' => 'WashingMenu', 'group_name' => 'Washing', 'guard_name' => 'web'],
            ['name' => 'delivery-washing.index', 'group_name' => 'Washing', 'guard_name' => 'web'],
            ['name' => 'receive-washing.index', 'group_name' => 'Washing', 'guard_name' => 'web'],

            ['name' => 'FinishingMenu', 'group_name' => 'Finishing', 'guard_name' => 'web'],
            ['name' => 'delivery-finishing.index', 'group_name' => 'Finishing', 'guard_name' => 'web'],
            ['name' => 'delivery-packed.index', 'group_name' => 'Finishing', 'guard_name' => 'web'],

            ['name' => 'ShippingMenu', 'group_name' => 'Shipping', 'guard_name' => 'web'],
            ['name' => 'shipping.index', 'group_name' => 'Shipping', 'guard_name' => 'web'],
        ]);
    }
}

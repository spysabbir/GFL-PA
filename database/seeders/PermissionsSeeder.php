<?php

namespace Database\Seeders;

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
            ['name' => 'role.list', 'group_name' => 'RoleManagement', 'guard_name' => 'web'],
            ['name' => 'role.create', 'group_name' => 'RoleManagement', 'guard_name' => 'web'],
            ['name' => 'role.edit', 'group_name' => 'RoleManagement', 'guard_name' => 'web'],
            ['name' => 'role.delete', 'group_name' => 'RoleManagement', 'guard_name' => 'web'],

            ['name' => 'role-permission.list', 'group_name' => 'RoleManagement', 'guard_name' => 'web'],
            ['name' => 'role-permission.create', 'group_name' => 'RoleManagement', 'guard_name' => 'web'],
            ['name' => 'role-permission.edit', 'group_name' => 'RoleManagement', 'guard_name' => 'web'],
            ['name' => 'role-permission.delete', 'group_name' => 'RoleManagement', 'guard_name' => 'web'],

            ['name' => 'UserMenu', 'group_name' => 'User', 'guard_name' => 'web'],
            ['name' => 'user.create', 'group_name' => 'User', 'guard_name' => 'web'],
            ['name' => 'user.list', 'group_name' => 'User', 'guard_name' => 'web'],
            ['name' => 'user.edit', 'group_name' => 'User', 'guard_name' => 'web'],
            ['name' => 'user.delete', 'group_name' => 'User', 'guard_name' => 'web'],
            ['name' => 'user.trashed', 'group_name' => 'User', 'guard_name' => 'web'],
            ['name' => 'user.forceDelete', 'group_name' => 'User', 'guard_name' => 'web'],

            ['name' => 'EmployeeResourcesMenu', 'group_name' => 'EmployeeResources', 'guard_name' => 'web'],
            ['name' => 'department.list', 'group_name' => 'EmployeeResources', 'guard_name' => 'web'],
            ['name' => 'department.create', 'group_name' => 'EmployeeResources', 'guard_name' => 'web'],
            ['name' => 'department.edit', 'group_name' => 'EmployeeResources', 'guard_name' => 'web'],
            ['name' => 'department.delete', 'group_name' => 'EmployeeResources', 'guard_name' => 'web'],

            ['name' => 'designation.list', 'group_name' => 'EmployeeResources', 'guard_name' => 'web'],
            ['name' => 'designation.create', 'group_name' => 'EmployeeResources', 'guard_name' => 'web'],
            ['name' => 'designation.edit', 'group_name' => 'EmployeeResources', 'guard_name' => 'web'],
            ['name' => 'designation.delete', 'group_name' => 'EmployeeResources', 'guard_name' => 'web'],

            ['name' => 'SettingMenu', 'group_name' => 'Setting', 'guard_name' => 'web'],
            ['name' => 'default.setting', 'group_name' => 'Setting', 'guard_name' => 'web'],

            ['name' => 'EmployeeMenu', 'group_name' => 'Employee', 'guard_name' => 'web'],
            ['name' => 'employee.create', 'group_name' => 'Employee', 'guard_name' => 'web'],
            ['name' => 'employee.list', 'group_name' => 'Employee', 'guard_name' => 'web'],
            ['name' => 'employee.edit', 'group_name' => 'Employee', 'guard_name' => 'web'],
            ['name' => 'employee.delete', 'group_name' => 'Employee', 'guard_name' => 'web'],
            ['name' => 'employee.trashed', 'group_name' => 'Employee', 'guard_name' => 'web'],
            ['name' => 'employee.forceDelete', 'group_name' => 'Employee', 'guard_name' => 'web'],

            ['name' => 'StyleResourcesMenu', 'group_name' => 'StyleResources', 'guard_name' => 'web'],
            ['name' => 'buyer.create', 'group_name' => 'StyleResources', 'guard_name' => 'web'],
            ['name' => 'buyer.list', 'group_name' => 'StyleResources', 'guard_name' => 'web'],
            ['name' => 'buyer.edit', 'group_name' => 'StyleResources', 'guard_name' => 'web'],
            ['name' => 'buyer.delete', 'group_name' => 'StyleResources', 'guard_name' => 'web'],
            ['name' => 'buyer.trashed', 'group_name' => 'StyleResources', 'guard_name' => 'web'],
            ['name' => 'buyer.forceDelete', 'group_name' => 'StyleResources', 'guard_name' => 'web'],

            ['name' => 'style.create', 'group_name' => 'StyleResources', 'guard_name' => 'web'],
            ['name' => 'style.list', 'group_name' => 'StyleResources', 'guard_name' => 'web'],
            ['name' => 'style.edit', 'group_name' => 'StyleResources', 'guard_name' => 'web'],
            ['name' => 'style.delete', 'group_name' => 'StyleResources', 'guard_name' => 'web'],
            ['name' => 'style.trashed', 'group_name' => 'StyleResources', 'guard_name' => 'web'],
            ['name' => 'style.forceDelete', 'group_name' => 'StyleResources', 'guard_name' => 'web'],

            ['name' => 'season.create', 'group_name' => 'StyleResources', 'guard_name' => 'web'],
            ['name' => 'season.list', 'group_name' => 'StyleResources', 'guard_name' => 'web'],
            ['name' => 'season.edit', 'group_name' => 'StyleResources', 'guard_name' => 'web'],
            ['name' => 'season.delete', 'group_name' => 'StyleResources', 'guard_name' => 'web'],
            ['name' => 'season.trashed', 'group_name' => 'StyleResources', 'guard_name' => 'web'],
            ['name' => 'season.forceDelete', 'group_name' => 'StyleResources', 'guard_name' => 'web'],

            ['name' => 'color.create', 'group_name' => 'StyleResources', 'guard_name' => 'web'],
            ['name' => 'color.list', 'group_name' => 'StyleResources', 'guard_name' => 'web'],
            ['name' => 'color.edit', 'group_name' => 'StyleResources', 'guard_name' => 'web'],
            ['name' => 'color.delete', 'group_name' => 'StyleResources', 'guard_name' => 'web'],
            ['name' => 'color.trashed', 'group_name' => 'StyleResources', 'guard_name' => 'web'],
            ['name' => 'color.forceDelete', 'group_name' => 'StyleResources', 'guard_name' => 'web'],

            ['name' => 'wash.create', 'group_name' => 'StyleResources', 'guard_name' => 'web'],
            ['name' => 'wash.list', 'group_name' => 'StyleResources', 'guard_name' => 'web'],
            ['name' => 'wash.edit', 'group_name' => 'StyleResources', 'guard_name' => 'web'],
            ['name' => 'wash.delete', 'group_name' => 'StyleResources', 'guard_name' => 'web'],
            ['name' => 'wash.trashed', 'group_name' => 'StyleResources', 'guard_name' => 'web'],
            ['name' => 'wash.forceDelete', 'group_name' => 'StyleResources', 'guard_name' => 'web'],

            ['name' => 'garment-type.create', 'group_name' => 'StyleResources', 'guard_name' => 'web'],
            ['name' => 'garment-type.list', 'group_name' => 'StyleResources', 'guard_name' => 'web'],
            ['name' => 'garment-type.edit', 'group_name' => 'StyleResources', 'guard_name' => 'web'],
            ['name' => 'garment-type.delete', 'group_name' => 'StyleResources', 'guard_name' => 'web'],
            ['name' => 'garment-type.trashed', 'group_name' => 'StyleResources', 'guard_name' => 'web'],
            ['name' => 'garment-type.forceDelete', 'group_name' => 'StyleResources', 'guard_name' => 'web'],

            ['name' => 'MasterStyleMenu', 'group_name' => 'MasterStyle', 'guard_name' => 'web'],
            ['name' => 'master-style.list', 'group_name' => 'MasterStyle', 'guard_name' => 'web'],
            ['name' => 'master-style.create', 'group_name' => 'MasterStyle', 'guard_name' => 'web'],
            ['name' => 'master-style.edit', 'group_name' => 'MasterStyle', 'guard_name' => 'web'],
            ['name' => 'master-style.delete', 'group_name' => 'MasterStyle', 'guard_name' => 'web'],
            ['name' => 'master-style.trashed', 'group_name' => 'MasterStyle', 'guard_name' => 'web'],
            ['name' => 'master-style.forceDelete', 'group_name' => 'MasterStyle', 'guard_name' => 'web'],
            ['name' => 'bpoOrderList', 'group_name' => 'MasterStyle', 'guard_name' => 'web'],
            ['name' => 'manageBpoOrder', 'group_name' => 'MasterStyle', 'guard_name' => 'web'],

            ['name' => 'OthersResourcesMenu', 'group_name' => 'OthersResources', 'guard_name' => 'web'],
            ['name' => 'line.list', 'group_name' => 'OthersResources', 'guard_name' => 'web'],
            ['name' => 'line.create', 'group_name' => 'OthersResources', 'guard_name' => 'web'],
            ['name' => 'line.edit', 'group_name' => 'OthersResources', 'guard_name' => 'web'],
            ['name' => 'line.delete', 'group_name' => 'OthersResources', 'guard_name' => 'web'],
            ['name' => 'line.trashed', 'group_name' => 'OthersResources', 'guard_name' => 'web'],
            ['name' => 'line.forceDelete', 'group_name' => 'OthersResources', 'guard_name' => 'web'],

            ['name' => 'CuttingMenu', 'group_name' => 'Cutting', 'guard_name' => 'web'],
            ['name' => 'new-cutting.list', 'group_name' => 'Cutting', 'guard_name' => 'web'],
            ['name' => 'sewing-input.list', 'group_name' => 'Cutting', 'guard_name' => 'web'],

            ['name' => 'SewingMenu', 'group_name' => 'Sewing', 'guard_name' => 'web'],
            ['name' => 'sewing-production.list', 'group_name' => 'Sewing', 'guard_name' => 'web'],

            ['name' => 'WashingMenu', 'group_name' => 'Washing', 'guard_name' => 'web'],
            ['name' => 'wash-delivery.list', 'group_name' => 'Washing', 'guard_name' => 'web'],
            ['name' => 'wash-receive.list', 'group_name' => 'Washing', 'guard_name' => 'web'],

            ['name' => 'FinishingMenu', 'group_name' => 'Finishing', 'guard_name' => 'web'],
            ['name' => 'finishing-input.list', 'group_name' => 'Finishing', 'guard_name' => 'web'],
            ['name' => 'finishing-production.list', 'group_name' => 'Finishing', 'guard_name' => 'web'],

            ['name' => 'ShipmentMenu', 'group_name' => 'Shipment', 'guard_name' => 'web'],
            ['name' => 'shipment.list', 'group_name' => 'Shipment', 'guard_name' => 'web'],
        ]);
    }
}

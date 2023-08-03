<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'employee_id' => 0,
            'name' => 'Super Admin',
            'user_name' => 'superadmin',
            'email' => 'superadmin@email.com',
            'role' => 'Admin',
            'password' => Hash::make('12345678'),
            'created_by' => 1,
            'created_at' => Carbon::now(),
        ]);

        $role = Role::create(['name' => 'Super Admin']);

        $permissions = Permission::pluck('id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
    }
}

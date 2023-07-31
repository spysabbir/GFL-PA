<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'employee_id' => 0,
                'name' => 'Admin',
                'user_name' => 'admin',
                'email' => 'admin@email.com',
                'password' => Hash::make('12345678'),
                'role' => 'Admin',
                'created_at' => Carbon::now(),
            ]
        ]);
    }
}

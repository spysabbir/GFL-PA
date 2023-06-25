<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
                'name' => 'Admin',
                'email' => 'admin@email.com',
                'password' => Hash::make('12345678'),
                'role' => 'Admin',
            ],
            [
                'name' => 'Employee',
                'email' => 'employee@email.com',
                'password' => Hash::make('12345678'),
                'role' => 'Employee',
            ],
            [
                'name' => 'User',
                'email' => 'user@email.com',
                'password' => Hash::make('12345678'),
                'role' => 'User',
            ],
        ]);
    }
}

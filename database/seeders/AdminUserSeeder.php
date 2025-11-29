<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        if (!User::where('email', 'admin@example.com')->exists()) {
            User::create([
                'name'     => 'Main Admin',
                'email'    => 'admin@example.com',
                'password' => Hash::make('admin123'),
                'phone'    => '9999999999',
                'role'     => 'admin',
            ]);
        }

        if (!User::where('email', 'subadmin@example.com')->exists()) {
            User::create([
                'name'     => 'Sub Admin',
                'email'    => 'subadmin@example.com',
                'password' => Hash::make('subadmin123'),
                'phone'    => '8888888888',
                'role'     => 'subadmin',
            ]);
        }
    }
}

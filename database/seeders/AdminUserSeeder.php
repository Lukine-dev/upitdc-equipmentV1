<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'], // unique check
            [
                'name' => 'System Administrator',
                'password' => Hash::make('admin12345'),
                'role' => 'administrator',
                'cu' => 'Main Campus',
                'designation' => 'Super Admin',
                'department' => 'ICT Department',
                'email_verified_at' => now(),
            ]
        );
    }
}

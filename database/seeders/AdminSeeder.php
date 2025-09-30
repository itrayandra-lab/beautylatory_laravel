<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create default admin user if not exists
        if (!Admin::where('username', 'admin')->exists()) {
            Admin::create([
                'username' => 'admin',
                'password_hash' => Hash::make('password123'),
            ]);
        }
    }
}
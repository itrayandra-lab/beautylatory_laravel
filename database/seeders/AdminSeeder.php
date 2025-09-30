<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!Admin::where('username', 'admin')->exists()) {
            Admin::create([
                'username' => 'admin',
                'password' => env('ADMIN_DEFAULT_PASSWORD', 'password123'),
            ]);
        }
    }
}

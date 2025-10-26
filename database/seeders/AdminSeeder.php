<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $admin = Admin::where('email', 'BBIGenteng@gmail.com')->first();

        if (!$admin) {
            Admin::create([
                'name' => 'Admin',
                'email' => 'BBIGenteng@gmail.com',
                'password' => Hash::make('BBIGenteng123'),
            ]);
            $this->command->info('✅ Admin user created successfully!');
        } else {
            $this->command->warn('⚠️ Admin with this email already exists, skipping...');
        }
    }
}

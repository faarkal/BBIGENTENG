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
        $obj = new admin();
        $obj->name = "Admin";
        $obj->email = "BBIGenteng@gmail.com";
        $obj->password = Hash::make("BBIGenteng123");
        $obj->save();
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    public function run(): void
    {
        \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'Administrator']);
        \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'Pos attendant']);
        // Add other roles as needed
    }
} 
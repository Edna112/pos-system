<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->updateOrInsert(
            ['email' => 'edna@superu.com'],
            [
                'name' => 'Chenwi Edna',
                'username' => 'superadmin',
                'email' => 'edna@superu.com',
                'password' => Hash::make('edna123'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        $user = \App\Models\User::where('email', 'edna@superu.com')->first();
        if ($user) {
            $user->assignRole('Administrator');
        }
    }
} 
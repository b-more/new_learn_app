<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Wezi Munthali',
                'email' => 'wezi@ontech.co.zm',
                'password' => Hash::make('Admin.1234'),
                'role_id' => 1,
                'user_id' => 1,
                'branch_id' => 1,
                "created_at" => now(),
                "updated_at" => now(),

            ],
            [
                'name' => 'Prisca Mwanza',
                'email' => 'prisca@ontech.co.zm',
                'password' => Hash::make('Admin.1234'),
                'role_id' => 1,
                'user_id' => 1,
                'branch_id' => 1,
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                'name' => 'Dennis Zitha',
                'email' => 'dennis@ontech.co.zm',
                'password' => Hash::make('Admin.1234'),
                'role_id' => 1,
                'user_id' => 1,
                'branch_id' => 1,
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                'name' => 'Blessmore Mulenga',
                'email' => 'blessmore@ontech.co.zm',
                'password' => Hash::make('Admin.1234'),
                'role_id' => 1,
                'user_id' => 1,
                'branch_id' => 1,
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                'name' => 'Moola Milupi',
                'email' => 'moola@ontech.co.zm',
                'password' => Hash::make('Admin.1234'),
                'role_id' => 1,
                'user_id' => 1,
                'branch_id' => 1,
                "created_at" => now(),
                "updated_at" => now()
            ]
        ]);
    }
}

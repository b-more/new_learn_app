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
                'name' => 'Admin',
                'email' => 'admin@natsave.co.zm',
                'password' => Hash::make('Admin.1234'),
                'role_id' => 1,
                'user_id' => 1,
                'branch_id' => 1,
                "created_at" => now(),
                "updated_at" => now(),

            ],
            [
                'name' => 'Blessmore Mulenga',
                'email' => 'blessmore@ontech.co.zm',
                'password' => Hash::make('Admin.1234'),
                'role_id' => 1,
                'user_id' => 2,
                'branch_id' => 1,
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                'name' => 'Nickson Mulila',
                'email' => 'nickson.mulila@natsave.co.zm',
                'password' => Hash::make('Admin.1234'),
                'role_id' => 1,
                'user_id' => 3,
                'branch_id' => 1,
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                'name' => 'Chapwe Telebwe',
                'email' => 'Chapwe.Telebwe@natsave.co.zm',
                'password' => Hash::make('Admin.1234'),
                'role_id' => 1,
                'user_id' => 4,
                'branch_id' => 1,
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                'name' => 'Munune Mainza',
                'email' => 'Munene.Mainza@natsave.co.zm',
                'password' => Hash::make('Admin.1234'),
                'role_id' => 2,
                'user_id' => 5,
                'branch_id' => 1,
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                'name' => 'Niza Shakspuku',
                'email' => 'Niza.Shakapuku@natsave.co.zm',
                'password' => Hash::make('Admin.1234'),
                'role_id' => 2,
                'user_id' => 6,
                'branch_id' => 1,
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                'name' => 'Sepiso',
                'email' => 'sepiso@natsave.co.zm',
                'password' => Hash::make('Admin.1234'),
                'role_id' => 2,
                'user_id' => 6,
                'branch_id' => 1,
                "created_at" => now(),
                "updated_at" => now()
            ],
        ]);
    }
}

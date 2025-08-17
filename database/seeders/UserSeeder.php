<?php

namespace Database\Seeders;

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
                'id' => 1,
                'role_id' => 1,
                'user_id' => 1,
                'branch_id' => 1,
                'updated_by' => null,
                'name' => 'Admin',
                'email' => 'admin@natsave.co.zm',
                'email_verified_at' => null,
                'password' => Hash::make('Admin.1234!!!!'),
                'remember_token' => 'BzATtYAhhqKKnXS03AvRcg7KAyEImkEK3cFfIj7XqXeYpjaKh2rN7UMSZRvs',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'role_id' => 1,
                'user_id' => 2,
                'branch_id' => 1,
                'updated_by' => null,
                'name' => 'Blessmore Mulenga',
                'email' => 'blessmore@ontech.co.zm',
                'email_verified_at' => null,
                'password' => Hash::make('Admin.1234!!!!'),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'role_id' => 2,
                'user_id' => 3,
                'branch_id' => 4,
                'updated_by' => null,
                'name' => 'Nickson Mulila',
                'email' => 'Nickson.Mulila@natsave.co.zm',
                'email_verified_at' => null,
                'password' => Hash::make('Admin.1234!!!!'),
                'remember_token' => 'ekEFmI8o26osgIYdjhXHSrVTM8DahHdiqP65glPUU9gWU9GjTzChDSkOpoQH',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // ...continue for other users...
        ]);
    }
}

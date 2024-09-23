<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('permissions')->insert([
            [
                "role_id" => 1,
                "module" => "Audit Trails",
                "create" => 1,
                "read" => 1,
                "update" => 1,
                "delete" => 1
            ],
            [
                "role_id" => 1,
                "module" => "Branch",
                "create" => 1,
                "read" => 1,
                "update" => 1,
                "delete" => 1
            ],
            [
                "role_id" => 1,
                "module" => "Permission",
                "create" => 1,
                "read" => 1,
                "update" => 1,
                "delete" => 1
            ],
            [
                "role_id" => 1,
                "module" => "Role",
                "create" => 1,
                "read" => 1,
                "update" => 1,
                "delete" => 1
            ],
            [
                "role_id" => 1,
                "module" => "User",
                "create" => 1,
                "read" => 1,
                "update" => 1,
                "delete" => 1
            ],
            [
                "role_id" => 1,
                "module" => "Module",
                "create" => 1,
                "read" => 1,
                "update" => 1,
                "delete" => 1
            ],
            [
                "role_id" => 1,
                "module" => "Lesson",
                "create" => 1,
                "read" => 1,
                "update" => 1,
                "delete" => 1
            ]
        ]);
    }
}

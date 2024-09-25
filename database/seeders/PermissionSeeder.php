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
                "module" => "Assigned Modules",
                "create" => 1,
                "read" => 1,
                "update" => 1,
                "delete" => 1
            ],
            [
                "role_id" => 1,
                "module" => "Attempted Answers",
                "create" => 1,
                "read" => 1,
                "update" => 1,
                "delete" => 1
            ],
            [
                "role_id" => 1,
                "module" => "Modules",
                "create" => 1,
                "read" => 1,
                "update" => 1,
                "delete" => 1
            ],
            [
                "role_id" => 1,
                "module" => "Lessons",
                "create" => 1,
                "read" => 1,
                "update" => 1,
                "delete" => 1
            ],
            [
                "role_id" => 1,
                "module" => "Quizes",
                "create" => 1,
                "read" => 1,
                "update" => 1,
                "delete" => 1
            ],
            [
                "role_id" => 1,
                "module" => "System Users",
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
                "role_id" => 2,
                "module" => "Assigned Modules",
                "create" => 1,
                "read" => 1,
                "update" => 1,
                "delete" => 1
            ],
            [
                "role_id" => 2,
                "module" => "Attempted Answers",
                "create" => 0,
                "read" => 0,
                "update" => 0,
                "delete" => 0
            ],
            [
                "role_id" => 2,
                "module" => "Modules",
                "create" => 0,
                "read" => 0,
                "update" => 0,
                "delete" => 0
            ],
            [
                "role_id" => 2,
                "module" => "Lessons",
                "create" => 0,
                "read" => 0,
                "update" => 0,
                "delete" => 0
            ],
            [
                "role_id" => 2,
                "module" => "Quizes",
                "create" => 0,
                "read" => 0,
                "update" => 0,
                "delete" => 0
            ],
            [
                "role_id" => 2,
                "module" => "System Users",
                "create" => 0,
                "read" => 0,
                "update" => 0,
                "delete" => 0
            ],
            [
                "role_id" => 2,
                "module" => "Branch",
                "create" => 0,
                "read" => 0,
                "update" => 0,
                "delete" => 0
            ],
        ]);
    }
}

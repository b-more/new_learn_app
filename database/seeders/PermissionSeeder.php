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
                "module" => "Assigned Module",
                "create" => 1,
                "read" => 1,
                "update" => 1,
                "delete" => 1
            ],
            [
                "role_id" => 1,
                "module" => "QuizScore",
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
            ],
            [
                "role_id" => 1,
                "module" => "Quiz",
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
                "module" => "Branch",
                "create" => 1,
                "read" => 1,
                "update" => 1,
                "delete" => 1
            ],
            [
                "role_id" => 2,
                "module" => "Assigned Module",
                "create" => 1,
                "read" => 1,
                "update" => 1,
                "delete" => 1
            ],
            [
                "role_id" => 2,
                "module" => "QuizScore",
                "create" => 0,
                "read" => 0,
                "update" => 0,
                "delete" => 0
            ],
            [
                "role_id" => 2,
                "module" => "Module",
                "create" => 0,
                "read" => 0,
                "update" => 0,
                "delete" => 0
            ],
            [
                "role_id" => 2,
                "module" => "Lesson",
                "create" => 0,
                "read" => 0,
                "update" => 0,
                "delete" => 0
            ],
            [
                "role_id" => 2,
                "module" => "Quiz",
                "create" => 0,
                "read" => 0,
                "update" => 0,
                "delete" => 0
            ],
            [
                "role_id" => 2,
                "module" => "User",
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

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuizzSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("quizzs")->insert([
           [
               "lesson_id" => 1,
               "question" => "What are the major features of this AML & Realtime Transaction Monitoring System",
               "question_image" => "",
               "correct_answer" => "B",
               "answer_option_a" => "Basic Account Management, Regular Compliance Checks, Manual Transaction Review",
               "answer_option_b" => "KYC Scanning, Realtime Transaction Monitoring, Customer Profiling",
               "answer_option_c" => "Web Hosting, Email Marketing Integration, Social Media Analytics",
               "answer_option_d" => "Paper-based Documentation, Quarterly Report Generation, Physical Branch Visits",
               "duration" => "1"
           ],
            [
                "lesson_id" => 2,
                "question" => "What settings are you able to add on user management?",
                "question_image" => "",
                "correct_answer" => "C",
                "answer_option_a" => "Roles and Permissions only",
                "answer_option_b" => "Users and their respective roles",
                "answer_option_c" => "New Roles, Permissions and New Users",
                "answer_option_d" => "User and Permissions Categories",
                "duration" => "1"
            ]
        ]);
    }
}

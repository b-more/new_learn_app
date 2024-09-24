<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("lessons")->insert([
            [
                "module_id" => 1,
                "title" => "Introduction to Anti-Money Laundering & Transaction Monitoring System",
                "video_thumbnail" => "/storage/thumbnail/introduction_to_aml.png",
                "description" => "Introduction to Anti-Money Laundering & Transaction Monitoring System",
                "video_url" =>"/storage/lessons/introduction_to_aml.mp4",
                "video_length" => "00:05 mins"
            ],
            [
                "module_id" => 2,
                "title" => "System User Management",
                "video_thumbnail" => "/storage/thumbnail/user_management.png",
                "description" => "Configuring and management of all the system users",
                "video_url" =>"/storage/lessons/user_management.mp4",
                "video_length" => "00:05 mins"
            ]
        ]);
    }
}

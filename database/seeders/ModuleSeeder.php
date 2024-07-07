<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("modules")->insert([
            [
                "title" => "Introduction to Anti-Money Laundering & Transaction Monitoring System",
                "icon" => "/thumbnail/introduction_to_aml.png",
                "description" => "Introduction to Anti-Money Laundering & Transaction Monitoring System"
            ],
            [
                "title" => "System User Management",
                "icon" => "/thumbnail/user_management.png",
                "description" => "Configuring and management of all the system users"
            ]
        ]);
    }
}

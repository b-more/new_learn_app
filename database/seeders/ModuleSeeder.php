<?php
// ModuleSeeder.php - Expanded with 8 comprehensive AML modules

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModuleSeeder extends Seeder
{
    public function run(): void
    {
        DB::table("modules")->insert([
            [
                "title" => "Introduction to Anti-Money Laundering & Transaction Monitoring System",
                "icon" => "/storage/thumbnail/introduction_to_aml.png",
                "description" => "Comprehensive introduction to AML concepts, regulations, and the three stages of money laundering"
            ],
            [
                "title" => "System User Management",
                "icon" => "/storage/thumbnail/user_management.png",
                "description" => "Configuring and management of all system users, roles, and permissions"
            ],
            [
                "title" => "Customer Due Diligence and KYC Procedures",
                "icon" => "/storage/thumbnail/kyc_procedures.png",
                "description" => "Know Your Customer procedures, identity verification, and customer risk assessment"
            ],
            [
                "title" => "Transaction Monitoring Rules and Scenarios",
                "icon" => "/storage/thumbnail/transaction_monitoring.png",
                "description" => "Setting up monitoring rules, scenarios, and real-time transaction screening"
            ],
            [
                "title" => "Suspicious Activity Detection and Reporting",
                "icon" => "/storage/thumbnail/suspicious_activity.png",
                "description" => "Identifying suspicious activities and filing Suspicious Activity Reports (SARs)"
            ],
            [
                "title" => "Risk Assessment and Customer Profiling",
                "icon" => "/storage/thumbnail/risk_assessment.png",
                "description" => "Customer risk categorization, PEP screening, and enhanced due diligence"
            ],
            [
                "title" => "Sanctions Screening and Watch Lists",
                "icon" => "/storage/thumbnail/sanctions_screening.png",
                "description" => "Implementing sanctions screening, watch list management, and compliance checks"
            ],
            [
                "title" => "Case Management and Investigation Procedures",
                "icon" => "/storage/thumbnail/case_management.png",
                "description" => "Managing AML cases, investigation workflows, and regulatory reporting"
            ]
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LessonSeeder extends Seeder
{
    public function run(): void
    {
        DB::table("lessons")->insert([
            // Module 1: Introduction to AML (3 lessons)
            [
                "module_id" => 1,
                "title" => "Introduction to Anti-Money Laundering & Transaction Monitoring System",
                "video_thumbnail" => "/storage/thumbnail/introduction_to_aml.png",
                "description" => "Understanding money laundering, its impact, and the three stages: placement, layering, and integration",
                "video_url" => "/storage/lessons/introduction_to_aml.mp4",
                "video_length" => "12:30 mins"
            ],
            [
                "module_id" => 1,
                "title" => "AML Regulatory Framework and Legal Requirements",
                "video_thumbnail" => "/storage/thumbnail/regulatory_framework.png",
                "description" => "Understanding BSA, FATF recommendations, and regulatory obligations for financial institutions",
                "video_url" => "/storage/lessons/regulatory_framework.mp4",
                "video_length" => "14:15 mins"
            ],
            [
                "module_id" => 1,
                "title" => "Money Laundering Typologies and Red Flags",
                "video_thumbnail" => "/storage/thumbnail/ml_typologies.png",
                "description" => "Common money laundering methods, emerging threats, and suspicious activity indicators",
                "video_url" => "/storage/lessons/ml_typologies.mp4",
                "video_length" => "17:30 mins"
            ],

            // Module 2: User Management (3 lessons)
            [
                "module_id" => 2,
                "title" => "System User Management",
                "video_thumbnail" => "/storage/thumbnail/user_management.png",
                "description" => "Configuring user accounts, roles, permissions, and access controls in the AML system",
                "video_url" => "/storage/lessons/user_management.mp4",
                "video_length" => "08:45 mins"
            ],
            [
                "module_id" => 2,
                "title" => "Access Controls and Segregation of Duties",
                "video_thumbnail" => "/storage/thumbnail/access_controls.png",
                "description" => "Implementing proper access controls and maintaining segregation of duties in AML operations",
                "video_url" => "/storage/lessons/access_controls.mp4",
                "video_length" => "10:20 mins"
            ],
            [
                "module_id" => 2,
                "title" => "Audit Trails and User Activity Monitoring",
                "video_thumbnail" => "/storage/thumbnail/audit_trails.png",
                "description" => "Maintaining comprehensive audit trails and monitoring user activities for compliance",
                "video_url" => "/storage/lessons/audit_trails.mp4",
                "video_length" => "12:45 mins"
            ],

            // Module 3: KYC Procedures (3 lessons)
            [
                "module_id" => 3,
                "title" => "Customer Due Diligence and KYC Implementation",
                "video_thumbnail" => "/storage/thumbnail/kyc_procedures.png",
                "description" => "Implementing Know Your Customer procedures, identity verification, and customer onboarding",
                "video_url" => "/storage/lessons/kyc_procedures.mp4",
                "video_length" => "15:20 mins"
            ],
            [
                "module_id" => 3,
                "title" => "Enhanced Due Diligence for High-Risk Customers",
                "video_thumbnail" => "/storage/thumbnail/enhanced_dd.png",
                "description" => "Implementing EDD procedures for PEPs, high-risk jurisdictions, and complex entities",
                "video_url" => "/storage/lessons/enhanced_dd.mp4",
                "video_length" => "18:50 mins"
            ],
            [
                "module_id" => 3,
                "title" => "Ongoing Monitoring and Customer Information Updates",
                "video_thumbnail" => "/storage/thumbnail/ongoing_monitoring.png",
                "description" => "Maintaining current customer information and conducting periodic reviews",
                "video_url" => "/storage/lessons/ongoing_monitoring.mp4",
                "video_length" => "13:25 mins"
            ],

            // Module 4: Transaction Monitoring (3 lessons)
            [
                "module_id" => 4,
                "title" => "Real-time Transaction Monitoring Setup",
                "video_thumbnail" => "/storage/thumbnail/transaction_monitoring.png",
                "description" => "Configuring monitoring rules, thresholds, and automated scenario detection",
                "video_url" => "/storage/lessons/transaction_monitoring.mp4",
                "video_length" => "18:10 mins"
            ],
            [
                "module_id" => 4,
                "title" => "Alert Investigation and Disposition",
                "video_thumbnail" => "/storage/thumbnail/alert_investigation.png",
                "description" => "Effective investigation techniques and proper alert disposition procedures",
                "video_url" => "/storage/lessons/alert_investigation.mp4",
                "video_length" => "16:15 mins"
            ],
            [
                "module_id" => 4,
                "title" => "Transaction Monitoring Tuning and Performance",
                "video_thumbnail" => "/storage/thumbnail/monitoring_tuning.png",
                "description" => "Optimizing monitoring scenarios and improving system performance",
                "video_url" => "/storage/lessons/monitoring_tuning.mp4",
                "video_length" => "14:30 mins"
            ],

            // Module 5: Suspicious Activity (3 lessons)
            [
                "module_id" => 5,
                "title" => "Suspicious Activity Detection and SAR Filing",
                "video_thumbnail" => "/storage/thumbnail/suspicious_activity.png",
                "description" => "Identifying red flags, investigating alerts, and filing Suspicious Activity Reports",
                "video_url" => "/storage/lessons/suspicious_activity.mp4",
                "video_length" => "14:25 mins"
            ],
            [
                "module_id" => 5,
                "title" => "Investigation Techniques and Evidence Gathering",
                "video_thumbnail" => "/storage/thumbnail/investigation_techniques.png",
                "description" => "Advanced investigation methods and proper evidence collection procedures",
                "video_url" => "/storage/lessons/investigation_techniques.mp4",
                "video_length" => "19:20 mins"
            ],
            [
                "module_id" => 5,
                "title" => "Regulatory Reporting and Communication",
                "video_thumbnail" => "/storage/thumbnail/regulatory_reporting.png",
                "description" => "Effective communication with regulators and proper reporting procedures",
                "video_url" => "/storage/lessons/regulatory_reporting.mp4",
                "video_length" => "15:10 mins"
            ],

            // Module 6: Risk Assessment (3 lessons)
            [
                "module_id" => 6,
                "title" => "Customer Risk Assessment and Profiling",
                "video_thumbnail" => "/storage/thumbnail/risk_assessment.png",
                "description" => "Risk categorization, PEP identification, and enhanced due diligence procedures",
                "video_url" => "/storage/lessons/risk_assessment.mp4",
                "video_length" => "13:55 mins"
            ],
            [
                "module_id" => 6,
                "title" => "Country and Geographic Risk Assessment",
                "video_thumbnail" => "/storage/thumbnail/country_risk.png",
                "description" => "Evaluating country risk factors and geographic compliance considerations",
                "video_url" => "/storage/lessons/country_risk.mp4",
                "video_length" => "16:35 mins"
            ],
            [
                "module_id" => 6,
                "title" => "Product and Service Risk Assessment",
                "video_thumbnail" => "/storage/thumbnail/product_risk.png",
                "description" => "Assessing inherent risks in banking products and services",
                "video_url" => "/storage/lessons/product_risk.mp4",
                "video_length" => "14:45 mins"
            ],

            // Module 7: Sanctions Screening (3 lessons)
            [
                "module_id" => 7,
                "title" => "Sanctions and Watch List Screening",
                "video_thumbnail" => "/storage/thumbnail/sanctions_screening.png",
                "description" => "Implementing automated sanctions screening and managing watch list updates",
                "video_url" => "/storage/lessons/sanctions_screening.mp4",
                "video_length" => "11:30 mins"
            ],
            [
                "module_id" => 7,
                "title" => "Sanctions Compliance Program Management",
                "video_thumbnail" => "/storage/thumbnail/sanctions_program.png",
                "description" => "Developing and maintaining effective sanctions compliance programs",
                "video_url" => "/storage/lessons/sanctions_program.mp4",
                "video_length" => "17:25 mins"
            ],
            [
                "module_id" => 7,
                "title" => "International Sanctions and Trade Finance",
                "video_thumbnail" => "/storage/thumbnail/trade_finance.png",
                "description" => "Managing sanctions compliance in international trade finance operations",
                "video_url" => "/storage/lessons/trade_finance.mp4",
                "video_length" => "20:15 mins"
            ],

            // Module 8: Case Management (3 lessons)
            [
                "module_id" => 8,
                "title" => "AML Case Management and Investigations",
                "video_thumbnail" => "/storage/thumbnail/case_management.png",
                "description" => "Managing investigation workflows, case documentation, and regulatory reporting",
                "video_url" => "/storage/lessons/case_management.mp4",
                "video_length" => "16:40 mins"
            ],
            [
                "module_id" => 8,
                "title" => "Quality Assurance and Case Review Procedures",
                "video_thumbnail" => "/storage/thumbnail/qa_procedures.png",
                "description" => "Implementing quality assurance programs and independent case review processes",
                "video_url" => "/storage/lessons/qa_procedures.mp4",
                "video_length" => "13:55 mins"
            ],
            [
                "module_id" => 8,
                "title" => "Management Information and Reporting",
                "video_thumbnail" => "/storage/thumbnail/management_reporting.png",
                "description" => "Creating effective MI reports and communicating AML program performance",
                "video_url" => "/storage/lessons/management_reporting.mp4",
                "video_length" => "15:30 mins"
            ]
        ]);
    }
}

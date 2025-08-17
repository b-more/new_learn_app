<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuizzSeeder extends Seeder
{
    public function run(): void
    {
        DB::table("quizzs")->insert([

            // ===== LESSON 1: Introduction to AML (10 questions) =====
            [
                "lesson_id" => 1,
                "question" => "What does AML stand for?",
                "question_image" => "",
                "correct_answer" => "B",
                "answer_option_a" => "Anti-Money Lending",
                "answer_option_b" => "Anti-Money Laundering",
                "answer_option_c" => "Account Management Law",
                "answer_option_d" => "Authorized Money Law",
                "duration" => "2"
            ],
            [
                "lesson_id" => 1,
                "question" => "How many stages are there in the money laundering process?",
                "question_image" => "",
                "correct_answer" => "C",
                "answer_option_a" => "Two",
                "answer_option_b" => "Four",
                "answer_option_c" => "Three",
                "answer_option_d" => "Five",
                "duration" => "2"
            ],
            [
                "lesson_id" => 1,
                "question" => "Which is the first stage of money laundering?",
                "question_image" => "",
                "correct_answer" => "A",
                "answer_option_a" => "Placement",
                "answer_option_b" => "Layering",
                "answer_option_c" => "Integration",
                "answer_option_d" => "Investigation",
                "duration" => "2"
            ],
            [
                "lesson_id" => 1,
                "question" => "What is the primary purpose of the layering stage?",
                "question_image" => "",
                "correct_answer" => "B",
                "answer_option_a" => "To deposit illegal funds into the financial system",
                "answer_option_b" => "To obscure the audit trail through complex transactions",
                "answer_option_c" => "To withdraw clean money from the system",
                "answer_option_d" => "To report suspicious activities",
                "duration" => "3"
            ],
            [
                "lesson_id" => 1,
                "question" => "During which stage does illegally obtained money re-enter the legitimate economy?",
                "question_image" => "",
                "correct_answer" => "C",
                "answer_option_a" => "Placement",
                "answer_option_b" => "Layering",
                "answer_option_c" => "Integration",
                "answer_option_d" => "Structuring",
                "duration" => "2"
            ],
            [
                "lesson_id" => 1,
                "question" => "What are the major features of this AML & Real-time Transaction Monitoring System?",
                "question_image" => "",
                "correct_answer" => "B",
                "answer_option_a" => "Basic Account Management, Regular Compliance Checks, Manual Transaction Review",
                "answer_option_b" => "KYC Scanning, Real-time Transaction Monitoring, Customer Profiling",
                "answer_option_c" => "Web Hosting, Email Marketing Integration, Social Media Analytics",
                "answer_option_d" => "Paper-based Documentation, Quarterly Report Generation, Physical Branch Visits",
                "duration" => "3"
            ],
            [
                "lesson_id" => 1,
                "question" => "Which regulatory framework primarily governs AML compliance?",
                "question_image" => "",
                "correct_answer" => "A",
                "answer_option_a" => "Bank Secrecy Act and FATF Recommendations",
                "answer_option_b" => "Securities Exchange Commission Rules",
                "answer_option_c" => "International Accounting Standards",
                "answer_option_d" => "Consumer Protection Laws",
                "duration" => "3"
            ],
            [
                "lesson_id" => 1,
                "question" => "What is structuring in the context of money laundering?",
                "question_image" => "",
                "correct_answer" => "D",
                "answer_option_a" => "Organizing financial documents",
                "answer_option_b" => "Creating investment portfolios",
                "answer_option_c" => "Building financial institutions",
                "answer_option_d" => "Breaking large transactions into smaller amounts to avoid reporting thresholds",
                "duration" => "3"
            ],
            [
                "lesson_id" => 1,
                "question" => "Why is real-time transaction monitoring important?",
                "question_image" => "",
                "correct_answer" => "C",
                "answer_option_a" => "To increase transaction processing speed",
                "answer_option_b" => "To reduce operational costs",
                "answer_option_c" => "To detect suspicious activities as they occur",
                "answer_option_d" => "To improve customer satisfaction",
                "duration" => "2"
            ],
            [
                "lesson_id" => 1,
                "question" => "What is the potential consequence of inadequate AML compliance?",
                "question_image" => "",
                "correct_answer" => "A",
                "answer_option_a" => "Regulatory fines, reputational damage, and criminal liability",
                "answer_option_b" => "Increased customer acquisition",
                "answer_option_c" => "Higher profit margins",
                "answer_option_d" => "Simplified reporting requirements",
                "duration" => "3"
            ],// ===== LESSON 2: AML Regulatory Framework (5 questions) =====
            [
                "lesson_id" => 2,
                "question" => "Which organization sets international AML standards that most countries adopt?",
                "question_image" => "",
                "correct_answer" => "B",
                "answer_option_a" => "World Bank",
                "answer_option_b" => "Financial Action Task Force (FATF)",
                "answer_option_c" => "International Monetary Fund (IMF)",
                "answer_option_d" => "United Nations Security Council",
                "duration" => "2"
            ],
            [
                "lesson_id" => 2,
                "question" => "A compliance officer discovers that a customer's transaction pattern has changed significantly. Under BSA requirements, what should be the primary consideration?",
                "question_image" => "",
                "correct_answer" => "C",
                "answer_option_a" => "Immediately close the account",
                "answer_option_b" => "Increase the customer's transaction limits",
                "answer_option_c" => "Conduct additional analysis to determine if the activity is suspicious",
                "answer_option_d" => "Ignore it if the customer is profitable",
                "duration" => "3"
            ],
            [
                "lesson_id" => 2,
                "question" => "What is the maximum penalty for willful BSA violations by financial institutions?",
                "question_image" => "",
                "correct_answer" => "A",
                "answer_option_a" => "Criminal prosecution and substantial civil penalties",
                "answer_option_b" => "Warning letter only",
                "answer_option_c" => "Temporary business suspension",
                "answer_option_d" => "Customer notification requirement",
                "duration" => "2"
            ],
            [
                "lesson_id" => 2,
                "question" => "During a regulatory examination, an examiner asks about your bank's AML training program. What key element must be demonstrated?",
                "question_image" => "",
                "correct_answer" => "D",
                "answer_option_a" => "Training is provided only to senior staff",
                "answer_option_b" => "Training occurs once per year for all staff",
                "answer_option_c" => "Training focuses solely on technology systems",
                "answer_option_d" => "Ongoing training appropriate to employee responsibilities with documented attendance",
                "duration" => "3"
            ],
            [
                "lesson_id" => 2,
                "question" => "Which FATF recommendation specifically addresses customer due diligence requirements?",
                "question_image" => "",
                "correct_answer" => "B",
                "answer_option_a" => "Recommendation 8",
                "answer_option_b" => "Recommendation 10",
                "answer_option_c" => "Recommendation 15",
                "answer_option_d" => "Recommendation 25",
                "duration" => "2"
            ],// ===== LESSON 3: Money Laundering Typologies (5 questions) =====
            [
                "lesson_id" => 3,
                "question" => "A customer regularly deposits cash amounts of $9,500 across multiple branch locations. This pattern most likely indicates:",
                "question_image" => "",
                "correct_answer" => "A",
                "answer_option_a" => "Structuring to avoid currency transaction reporting",
                "answer_option_b" => "Normal business operations",
                "answer_option_c" => "Customer convenience preference",
                "answer_option_d" => "Banking relationship optimization",
                "duration" => "3"
            ],
            [
                "lesson_id" => 3,
                "question" => "What is 'trade-based money laundering'?",
                "question_image" => "",
                "correct_answer" => "C",
                "answer_option_a" => "Money laundering through stock market trades",
                "answer_option_b" => "Laundering money through cryptocurrency trading",
                "answer_option_c" => "Disguising illicit funds through legitimate international trade transactions",
                "answer_option_d" => "Using trade unions to launder money",
                "duration" => "3"
            ],
            [
                "lesson_id" => 3,
                "question" => "A compliance officer notices a customer receiving multiple small wire transfers from different countries, then immediately transferring equivalent amounts to a high-risk jurisdiction. This suggests:",
                "question_image" => "",
                "correct_answer" => "B",
                "answer_option_a" => "Legitimate international business",
                "answer_option_b" => "Possible layering stage of money laundering",
                "answer_option_c" => "Normal remittance activity",
                "answer_option_d" => "Currency arbitrage opportunity",
                "duration" => "3"
            ],
            [
                "lesson_id" => 3,
                "question" => "Which red flag is most indicative of potential terrorist financing?",
                "question_image" => "",
                "correct_answer" => "D",
                "answer_option_a" => "Large cash deposits from business operations",
                "answer_option_b" => "Regular international wire transfers to family",
                "answer_option_c" => "Multiple credit card transactions in one day",
                "answer_option_d" => "Small donations to charities with unclear purposes or in high-risk areas",
                "duration" => "3"
            ],
            [
                "lesson_id" => 3,
                "question" => "What is 'cuckoo smurfing'?",
                "question_image" => "",
                "correct_answer" => "A",
                "answer_option_a" => "Using legitimate customer accounts unknowingly as conduits for illicit funds",
                "answer_option_b" => "Multiple small deposits by the same person",
                "answer_option_c" => "Using fake identities to open accounts",
                "answer_option_d" => "Converting cash to digital currency",
                "duration" => "3"
            ],// ===== LESSON 4: System User Management (10 questions) =====
            [
                "lesson_id" => 4,
                "question" => "What settings are you able to configure in user management?",
                "question_image" => "",
                "correct_answer" => "C",
                "answer_option_a" => "Roles and Permissions only",
                "answer_option_b" => "Users and their respective roles",
                "answer_option_c" => "New Roles, Permissions and New Users",
                "answer_option_d" => "User and Permissions Categories",
                "duration" => "2"
            ],
            [
                "lesson_id" => 4,
                "question" => "What is the principle of least privilege in user management?",
                "question_image" => "",
                "correct_answer" => "B",
                "answer_option_a" => "Users should have maximum access to all systems",
                "answer_option_b" => "Users should have only the minimum access required for their job",
                "answer_option_c" => "All users should have the same level of access",
                "answer_option_d" => "Access should be granted based on seniority",
                "duration" => "3"
            ],
            [
                "lesson_id" => 4,
                "question" => "How often should user access rights be reviewed?",
                "question_image" => "",
                "correct_answer" => "A",
                "answer_option_a" => "Regularly, at least annually or when roles change",
                "answer_option_b" => "Only when users request changes",
                "answer_option_c" => "Every five years",
                "answer_option_d" => "Never, once set they remain permanent",
                "duration" => "2"
            ],
            [
                "lesson_id" => 4,
                "question" => "What should happen to user accounts when an employee leaves the organization?",
                "question_image" => "",
                "correct_answer" => "D",
                "answer_option_a" => "Keep them active for future reference",
                "answer_option_b" => "Transfer to another employee",
                "answer_option_c" => "Reduce their permissions",
                "answer_option_d" => "Immediately disable or delete the accounts",
                "duration" => "2"
            ],
            [
                "lesson_id" => 4,
                "question" => "Which role typically has the highest level of system access?",
                "question_image" => "",
                "correct_answer" => "A",
                "answer_option_a" => "System Administrator",
                "answer_option_b" => "Compliance Officer",
                "answer_option_c" => "Data Entry Clerk",
                "answer_option_d" => "Customer Service Representative",
                "duration" => "2"
            ],
            [
                "lesson_id" => 4,
                "question" => "What is role-based access control (RBAC)?",
                "question_image" => "",
                "correct_answer" => "C",
                "answer_option_a" => "Access based on user location",
                "answer_option_b" => "Access based on time of day",
                "answer_option_c" => "Access permissions assigned based on user's job function",
                "answer_option_d" => "Random access assignment",
                "duration" => "3"
            ],
            [
                "lesson_id" => 4,
                "question" => "Why is user activity logging important?",
                "question_image" => "",
                "correct_answer" => "B",
                "answer_option_a" => "To slow down system performance",
                "answer_option_b" => "To maintain audit trails and detect unauthorized access",
                "answer_option_c" => "To increase storage costs",
                "answer_option_d" => "To complicate user operations",
                "duration" => "3"
            ],
            [
                "lesson_id" => 4,
                "question" => "What is two-factor authentication?",
                "question_image" => "",
                "correct_answer" => "A",
                "answer_option_a" => "Using two different methods to verify user identity",
                "answer_option_b" => "Using two different passwords",
                "answer_option_c" => "Having two user accounts",
                "answer_option_d" => "Logging in twice per day",
                "duration" => "2"
            ],
            [
                "lesson_id" => 4,
                "question" => "What should be done if a user account shows suspicious activity?",
                "question_image" => "",
                "correct_answer" => "D",
                "answer_option_a" => "Ignore it if the user is senior",
                "answer_option_b" => "Wait and monitor for more activity",
                "answer_option_c" => "Send a warning email",
                "answer_option_d" => "Immediately investigate and potentially suspend the account",
                "duration" => "3"
            ],
            [
                "lesson_id" => 4,
                "question" => "Which information should be included in user account documentation?",
                "question_image" => "",
                "correct_answer" => "C",
                "answer_option_a" => "Only username and password",
                "answer_option_b" => "Personal phone numbers only",
                "answer_option_c" => "User role, permissions, access history, and approval records",
                "answer_option_d" => "Social media profiles",
                "duration" => "3"
            ], // ===== LESSON 5: Access Controls and Segregation of Duties (5 questions) =====
            [
                "lesson_id" => 5,
                "question" => "Why is segregation of duties critical in AML compliance?",
                "question_image" => "",
                "correct_answer" => "C",
                "answer_option_a" => "To increase processing speed",
                "answer_option_b" => "To reduce operational costs",
                "answer_option_c" => "To prevent conflicts of interest and reduce fraud risk",
                "answer_option_d" => "To improve customer satisfaction",
                "duration" => "3"
            ],
            [
                "lesson_id" => 5,
                "question" => "A compliance officer discovers that the same employee can both investigate alerts and approve SAR filings. What should be the immediate action?",
                "question_image" => "",
                "correct_answer" => "A",
                "answer_option_a" => "Implement proper segregation of duties by separating these functions",
                "answer_option_b" => "Increase monitoring of that employee",
                "answer_option_c" => "Document the finding but take no action",
                "answer_option_d" => "Reduce the employee's workload",
                "duration" => "3"
            ],
            [
                "lesson_id" => 5,
                "question" => "What is the principle of 'need to know' in access control?",
                "question_image" => "",
                "correct_answer" => "B",
                "answer_option_a" => "All employees should know everything about customers",
                "answer_option_b" => "Employees should only access information necessary for their job functions",
                "answer_option_c" => "Information should be shared freely within departments",
                "answer_option_d" => "Access should be based on seniority levels",
                "duration" => "2"
            ],
            [
                "lesson_id" => 5,
                "question" => "How often should access rights be reviewed and recertified?",
                "question_image" => "",
                "correct_answer" => "D",
                "answer_option_a" => "Only when employees leave",
                "answer_option_b" => "Every five years",
                "answer_option_c" => "When requested by employees",
                "answer_option_d" => "At least annually and when job responsibilities change",
                "duration" => "2"
            ],
            [
                "lesson_id" => 5,
                "question" => "A department manager requests administrative access to review their team's SAR investigations for performance evaluation. How should this be handled?",
                "question_image" => "",
                "correct_answer" => "C",
                "answer_option_a" => "Grant immediate access since they're the manager",
                "answer_option_b" => "Deny access completely",
                "answer_option_c" => "Provide summary reports without case-specific details to maintain confidentiality",
                "answer_option_d" => "Allow access only during business hours",
                "duration" => "3"
            ],// ===== LESSON 6: Audit Trails and User Activity Monitoring (5 questions) =====
            [
                "lesson_id" => 6,
                "question" => "What is the primary purpose of maintaining comprehensive audit trails in AML systems?",
                "question_image" => "",
                "correct_answer" => "A",
                "answer_option_a" => "To provide evidence of compliance activities and system integrity",
                "answer_option_b" => "To increase system processing speed",
                "answer_option_c" => "To reduce storage costs",
                "answer_option_d" => "To improve user experience",
                "duration" => "2"
            ],
            [
                "lesson_id" => 6,
                "question" => "During an internal audit, you discover gaps in user activity logs for a critical period. What should be your immediate response?",
                "question_image" => "",
                "correct_answer" => "C",
                "answer_option_a" => "Ignore it if no suspicious activity was reported",
                "answer_option_b" => "Recreate the logs from memory",
                "answer_option_c" => "Document the gap, investigate the cause, and implement corrective measures",
                "answer_option_d" => "Delete the entire log to start fresh",
                "duration" => "3"
            ],
            [
                "lesson_id" => 6,
                "question" => "Which activity should trigger an immediate alert in user activity monitoring?",
                "question_image" => "",
                "correct_answer" => "B",
                "answer_option_a" => "User logging in during business hours",
                "answer_option_b" => "Multiple failed login attempts followed by successful access",
                "answer_option_c" => "User accessing customer records they normally review",
                "answer_option_d" => "User printing standard reports",
                "duration" => "3"
            ],
            [
                "lesson_id" => 6,
                "question" => "How long should audit trail data be retained for AML compliance purposes?",
                "question_image" => "",
                "correct_answer" => "D",
                "answer_option_a" => "6 months",
                "answer_option_b" => "1 year",
                "answer_option_c" => "3 years",
                "answer_option_d" => "At least 5 years or as required by regulation",
                "duration" => "2"
            ],
            [
                "lesson_id" => 6,
                "question" => "A compliance officer notices unusual after-hours system access by an employee who normally works standard business hours. What action is most appropriate?",
                "question_image" => "",
                "correct_answer" => "A",
                "answer_option_a" => "Investigate the access to determine if it was authorized and legitimate",
                "answer_option_b" => "Immediately suspend the employee's access",
                "answer_option_c" => "Ignore it since employees sometimes work overtime",
                "answer_option_d" => "Send a general reminder about working hours to all staff",
                "duration" => "3"
            ],// ===== LESSON 7: Customer Due Diligence and KYC Implementation (10 questions) =====
            [
                "lesson_id" => 7,
                "question" => "What does KYC stand for?",
                "question_image" => "",
                "correct_answer" => "A",
                "answer_option_a" => "Know Your Customer",
                "answer_option_b" => "Keep Your Cash",
                "answer_option_c" => "Know Your Country",
                "answer_option_d" => "Key Yearly Compliance",
                "duration" => "1"
            ],
            [
                "lesson_id" => 7,
                "question" => "Why is KYC important in AML compliance?",
                "question_image" => "",
                "correct_answer" => "C",
                "answer_option_a" => "To sell more products to customers",
                "answer_option_b" => "To reduce customer service workload",
                "answer_option_c" => "To identify and prevent financial crime",
                "answer_option_d" => "To increase profit margins",
                "duration" => "2"
            ],
            [
                "lesson_id" => 7,
                "question" => "Which document is typically required for identity verification?",
                "question_image" => "",
                "correct_answer" => "B",
                "answer_option_a" => "Utility bill from 5 years ago",
                "answer_option_b" => "Valid government-issued photo ID",
                "answer_option_c" => "Social media profile",
                "answer_option_d" => "Email signature",
                "duration" => "2"
            ],
            [
                "lesson_id" => 7,
                "question" => "What is Enhanced Due Diligence (EDD)?",
                "question_image" => "",
                "correct_answer" => "A",
                "answer_option_a" => "Additional verification measures for high-risk customers",
                "answer_option_b" => "Standard verification for all customers",
                "answer_option_c" => "Simplified verification for low-risk customers",
                "answer_option_d" => "No verification required",
                "duration" => "3"
            ],
            [
                "lesson_id" => 7,
                "question" => "How often should customer information be updated?",
                "question_image" => "",
                "correct_answer" => "C",
                "answer_option_a" => "Never, once collected it's permanent",
                "answer_option_b" => "Only when customers request updates",
                "answer_option_c" => "Regularly, based on risk assessment and regulatory requirements",
                "answer_option_d" => "Every 10 years",
                "duration" => "3"
            ],
            [
                "lesson_id" => 7,
                "question" => "What is the purpose of collecting beneficial ownership information?",
                "question_image" => "",
                "correct_answer" => "D",
                "answer_option_a" => "To increase customer satisfaction",
                "answer_option_b" => "To reduce operational costs",
                "answer_option_c" => "To improve marketing efforts",
                "answer_option_d" => "To identify the true owners and controllers of legal entities",
                "duration" => "3"
            ],
            [
                "lesson_id" => 7,
                "question" => "Which customers typically require Enhanced Due Diligence?",
                "question_image" => "",
                "correct_answer" => "B",
                "answer_option_a" => "All customers equally",
                "answer_option_b" => "PEPs, high-risk jurisdictions, and complex business structures",
                "answer_option_c" => "Only individual customers",
                "answer_option_d" => "Customers with small account balances",
                "duration" => "3"
            ],
            [
                "lesson_id" => 7,
                "question" => "What should be done if a customer refuses to provide required KYC information?",
                "question_image" => "",
                "correct_answer" => "A",
                "answer_option_a" => "Decline to establish or continue the business relationship",
                "answer_option_b" => "Proceed with reduced verification",
                "answer_option_c" => "Accept alternative informal documentation",
                "answer_option_d" => "Wait until the customer is ready to provide information",
                "duration" => "3"
            ],
            [
                "lesson_id" => 7,
                "question" => "What is Customer Risk Assessment (CRA)?",
                "question_image" => "",
                "correct_answer" => "C",
                "answer_option_a" => "Assessment of customer's financial stability",
                "answer_option_b" => "Evaluation of customer's credit worthiness",
                "answer_option_c" => "Evaluation of the money laundering and terrorist financing risk posed by customers",
                "answer_option_d" => "Assessment of customer service quality",
                "duration" => "3"
            ],
            [
                "lesson_id" => 7,
                "question" => "How long should KYC documentation be retained?",
                "question_image" => "",
                "correct_answer" => "D",
                "answer_option_a" => "1 year after account closure",
                "answer_option_b" => "2 years after account closure",
                "answer_option_c" => "3 years after account closure",
                "answer_option_d" => "At least 5 years after account closure or as required by regulation",
                "duration" => "3"
            ],
            [
                "lesson_id" => 8,
                "question" => "When should Enhanced Due Diligence (EDD) be applied to a customer relationship?",
                "question_image" => "",
                "correct_answer" => "C",
                "answer_option_a" => "Only for customers with account balances over $1 million",
                "answer_option_b" => "For all corporate customers",
                "answer_option_c" => "When customers present higher risk for money laundering or terrorist financing",
                "answer_option_d" => "Only for non-resident customers",
                "duration" => "3"
            ],
            [
                "lesson_id" => 8,
                "question" => "A potential customer is a PEP from a high-risk jurisdiction seeking to open a private banking account. What additional EDD measure is most critical?",
                "question_image" => "",
                "correct_answer" => "A",
                "answer_option_a" => "Senior management approval and source of wealth verification",
                "answer_option_b" => "Standard identity verification only",
                "answer_option_c" => "Increased account monitoring frequency",
                "answer_option_d" => "Higher minimum balance requirements",
                "duration" => "3"
            ],
            [
                "lesson_id" => 8,
                "question" => "What is the difference between 'source of funds' and 'source of wealth' in EDD?",
                "question_image" => "",
                "correct_answer" => "B",
                "answer_option_a" => "They are the same thing",
                "answer_option_b" => "Source of funds is specific transaction origin; source of wealth is overall asset accumulation",
                "answer_option_c" => "Source of funds is for individuals; source of wealth is for corporations",
                "answer_option_d" => "Source of funds is current; source of wealth is historical",
                "duration" => "3"
            ],
            [
                "lesson_id" => 8,
                "question" => "How frequently should EDD information be updated for high-risk customers?",
                "question_image" => "",
                "correct_answer" => "A",
                "answer_option_a" => "More frequently than standard customers, based on risk assessment",
                "answer_option_b" => "Same frequency as all customers",
                "answer_option_c" => "Only when customers request updates",
                "answer_option_d" => "Every 10 years regardless of activity",
                "duration" => "2"
            ],
            [
                "lesson_id" => 8,
                "question" => "A compliance officer is reviewing a complex corporate structure with multiple layers of ownership in different jurisdictions. What EDD approach is most appropriate?",
                "question_image" => "",
                "correct_answer" => "D",
                "answer_option_a" => "Accept the complexity as normal business structure",
                "answer_option_b" => "Decline the relationship immediately",
                "answer_option_c" => "Apply standard CDD procedures",
                "answer_option_d" => "Trace ownership to identify ultimate beneficial owners and understand business rationale",
                "duration" => "3"
            ],

            // ===== LESSON 9: Ongoing Monitoring and Customer Information Updates (5 questions) =====
            [
                "lesson_id" => 9,
                "question" => "What is the primary objective of ongoing customer due diligence?",
                "question_image" => "",
                "correct_answer" => "B",
                "answer_option_a" => "To increase customer satisfaction",
                "answer_option_b" => "To ensure customer information remains current and accurate",
                "answer_option_c" => "To sell additional products",
                "answer_option_d" => "To reduce operational costs",
                "duration" => "2"
            ],
            [
                "lesson_id" => 9,
                "question" => "A long-standing customer's transaction patterns suddenly change from small, regular payments to large, irregular international transfers. What should be the compliance response?",
                "question_image" => "",
                "correct_answer" => "C",
                "answer_option_a" => "No action needed for existing customers",
                "answer_option_b" => "Immediately close the account",
                "answer_option_c" => "Update customer information and reassess risk profile",
                "answer_option_d" => "Increase transaction limits automatically",
                "duration" => "3"
            ],
            [
                "lesson_id" => 9,
                "question" => "How should negative news about a customer discovered during ongoing monitoring be handled?",
                "question_image" => "",
                "correct_answer" => "A",
                "answer_option_a" => "Document findings, reassess risk, and determine appropriate action",
                "answer_option_b" => "Ignore if the customer is profitable",
                "answer_option_c" => "Immediately file a SAR",
                "answer_option_d" => "Wait for customer to provide explanation",
                "duration" => "3"
            ],
            [
                "lesson_id" => 9,
                "question" => "What triggers a requirement for updating customer information outside of regular review cycles?",
                "question_image" => "",
                "correct_answer" => "D",
                "answer_option_a" => "Customer birthday",
                "answer_option_b" => "Annual account statements",
                "answer_option_c" => "Interest rate changes",
                "answer_option_d" => "Significant changes in customer circumstances or transaction patterns",
                "duration" => "3"
            ],
            [
                "lesson_id" => 9,
                "question" => "A customer refuses to provide updated beneficial ownership information during periodic review. What is the most appropriate response?",
                "question_image" => "",
                "correct_answer" => "B",
                "answer_option_a" => "Continue the relationship with existing information",
                "answer_option_b" => "Consider terminating the relationship if information cannot be obtained",
                "answer_option_c" => "Reduce the customer's risk rating",
                "answer_option_d" => "Ignore the requirement for this customer",
                "duration" => "3"
            ],

            // ===== LESSON 10: Real-time Transaction Monitoring Setup (10 questions) =====
            [
                "lesson_id" => 10,
                "question" => "What is the primary purpose of transaction monitoring?",
                "question_image" => "",
                "correct_answer" => "A",
                "answer_option_a" => "To detect suspicious patterns and unusual activities",
                "answer_option_b" => "To speed up transaction processing",
                "answer_option_c" => "To reduce transaction costs",
                "answer_option_d" => "To improve customer experience",
                "duration" => "2"
            ],
            [
                "lesson_id" => 10,
                "question" => "What is a monitoring scenario in transaction monitoring?",
                "question_image" => "",
                "correct_answer" => "B",
                "answer_option_a" => "A customer complaint procedure",
                "answer_option_b" => "A predefined rule set to detect specific suspicious patterns",
                "answer_option_c" => "A marketing campaign strategy",
                "answer_option_d" => "A system backup procedure",
                "duration" => "3"
            ],
            [
                "lesson_id" => 10,
                "question" => "What should trigger an alert in transaction monitoring?",
                "question_image" => "",
                "correct_answer" => "C",
                "answer_option_a" => "Every transaction above $100",
                "answer_option_b" => "All international transactions",
                "answer_option_c" => "Transactions that deviate from expected customer behavior or exceed thresholds",
                "answer_option_d" => "All cash transactions",
                "duration" => "3"
            ],
            [
                "lesson_id" => 10,
                "question" => "What is threshold monitoring?",
                "question_image" => "",
                "correct_answer" => "A",
                "answer_option_a" => "Monitoring transactions that exceed predetermined amounts",
                "answer_option_b" => "Monitoring customer satisfaction levels",
                "answer_option_c" => "Monitoring system performance",
                "answer_option_d" => "Monitoring employee productivity",
                "duration" => "2"
            ],
            [
                "lesson_id" => 10,
                "question" => "What is peer group analysis in transaction monitoring?",
                "question_image" => "",
                "correct_answer" => "D",
                "answer_option_a" => "Comparing employee performance",
                "answer_option_b" => "Analyzing customer satisfaction surveys",
                "answer_option_c" => "Reviewing system performance metrics",
                "answer_option_d" => "Comparing customer behavior against similar customer profiles",
                "duration" => "3"
            ],
            [
                "lesson_id" => 10,
                "question" => "How should false positive alerts be handled?",
                "question_image" => "",
                "correct_answer" => "B",
                "answer_option_a" => "Ignore them completely",
                "answer_option_b" => "Document the investigation and tune scenarios to reduce future false positives",
                "answer_option_c" => "Report them as suspicious activity",
                "answer_option_d" => "Delete them from the system",
                "duration" => "3"
            ],
            [
                "lesson_id" => 10,
                "question" => "What is velocity checking in transaction monitoring?",
                "question_image" => "",
                "correct_answer" => "C",
                "answer_option_a" => "Checking transaction processing speed",
                "answer_option_b" => "Verifying customer identity",
                "answer_option_c" => "Monitoring the frequency and volume of transactions over time",
                "answer_option_d" => "Checking data accuracy",
                "duration" => "3"
            ],
            [
                "lesson_id" => 10,
                "question" => "Why is real-time monitoring preferred over batch processing?",
                "question_image" => "",
                "correct_answer" => "A",
                "answer_option_a" => "It allows immediate detection and intervention",
                "answer_option_b" => "It's less expensive to implement",
                "answer_option_c" => "It requires less computing power",
                "answer_option_d" => "It's easier to maintain",
                "duration" => "3"
            ],
            [
                "lesson_id" => 10,
                "question" => "What information should be captured in alert documentation?",
                "question_image" => "",
                "correct_answer" => "D",
                "answer_option_a" => "Only the transaction amount",
                "answer_option_b" => "Only customer name and account",
                "answer_option_c" => "Only the date and time",
                "answer_option_d" => "All relevant transaction details, investigation steps, and disposition rationale",
                "duration" => "3"
            ],
            [
                "lesson_id" => 10,
                "question" => "What is the difference between rule-based and behavior-based monitoring?",
                "question_image" => "",
                "correct_answer" => "B",
                "answer_option_a" => "There is no difference",
                "answer_option_b" => "Rule-based uses fixed criteria while behavior-based learns from patterns",
                "answer_option_c" => "Rule-based is more expensive",
                "answer_option_d" => "Behavior-based only works for large transactions",
                "duration" => "3"
            ],

            // ===== LESSON 11: Alert Investigation and Disposition (5 questions) =====
            [
                "lesson_id" => 11,
                "question" => "What should be the first step when investigating a transaction monitoring alert?",
                "question_image" => "",
                "correct_answer" => "A",
                "answer_option_a" => "Review the alert details and gather all relevant customer information",
                "answer_option_b" => "Immediately file a SAR",
                "answer_option_c" => "Contact the customer for explanation",
                "answer_option_d" => "Close the alert as false positive",
                "duration" => "2"
            ],
            [
                "lesson_id" => 11,
                "question" => "An investigator finds that a customer's large cash deposits correspond to their business receipts and are consistent with their industry. How should this alert be disposed?",
                "question_image" => "",
                "correct_answer" => "C",
                "answer_option_a" => "File a SAR anyway to be safe",
                "answer_option_b" => "Escalate to senior management",
                "answer_option_c" => "Close as false positive with documentation supporting the decision",
                "answer_option_d" => "Keep the alert open indefinitely",
                "duration" => "3"
            ],
            [
                "lesson_id" => 11,
                "question" => "During alert investigation, what documentation standard should be maintained?",
                "question_image" => "",
                "correct_answer" => "D",
                "answer_option_a" => "Minimal notes to save time",
                "answer_option_b" => "Documentation only for SARs",
                "answer_option_c" => "Verbal reports to supervisors",
                "answer_option_d" => "Comprehensive written documentation of all investigation steps and conclusions",
                "duration" => "2"
            ],
            [
                "lesson_id" => 11,
                "question" => "An alert shows unusual wire transfer activity, but the investigator cannot determine a clear legitimate purpose. What should be the disposition?",
                "question_image" => "",
                "correct_answer" => "B",
                "answer_option_a" => "Close as inconclusive",
                "answer_option_b" => "File a SAR due to suspicious nature of activity",
                "answer_option_c" => "Request customer explanation before deciding",
                "answer_option_d" => "Transfer to another investigator",
                "duration" => "3"
            ],
            [
                "lesson_id" => 11,
                "question" => "What is the risk of inadequate alert investigation procedures?",
                "question_image" => "",
                "correct_answer" => "A",
                "answer_option_a" => "Regulatory violations and failure to detect suspicious activity",
                "answer_option_b" => "Increased customer satisfaction",
                "answer_option_c" => "Reduced operational costs",
                "answer_option_d" => "Faster transaction processing",
                "duration" => "2"
            ],

            // ===== LESSON 12: Transaction Monitoring Tuning and Performance (5 questions) =====
            [
                "lesson_id" => 12,
                "question" => "What is the primary goal of transaction monitoring system tuning?",
                "question_image" => "",
                "correct_answer" => "B",
                "answer_option_a" => "To eliminate all alerts",
                "answer_option_b" => "To optimize detection effectiveness while minimizing false positives",
                "answer_option_c" => "To increase transaction processing speed",
                "answer_option_d" => "To reduce system maintenance costs",
                "duration" => "3"
            ],
            [
                "lesson_id" => 12,
                "question" => "Your bank's transaction monitoring system generates 10,000 alerts monthly with a 95% false positive rate. What should be the priority action?",
                "question_image" => "",
                "correct_answer" => "C",
                "answer_option_a" => "Hire more investigators",
                "answer_option_b" => "Increase alert thresholds dramatically",
                "answer_option_c" => "Analyze false positives and refine scenarios to improve precision",
                "answer_option_d" => "Ignore low-risk alerts",
                "duration" => "3"
            ],
            [
                "lesson_id" => 12,
                "question" => "How should monitoring scenarios be validated after tuning?",
                "question_image" => "",
                "correct_answer" => "A",
                "answer_option_a" => "Test with historical data including known suspicious activity",
                "answer_option_b" => "Implement immediately without testing",
                "answer_option_c" => "Wait for customer feedback",
                "answer_option_d" => "Test only with current data",
                "duration" => "3"
            ],
            [
                "lesson_id" => 12,
                "question" => "What key performance indicator best measures monitoring system effectiveness?",
                "question_image" => "",
                "correct_answer" => "D",
                "answer_option_a" => "Total number of alerts generated",
                "answer_option_b" => "Speed of alert generation",
                "answer_option_c" => "System uptime percentage",
                "answer_option_d" => "Ratio of productive alerts to total alerts generated",
                "duration" => "3"
            ],
            [
                "lesson_id" => 12,
                "question" => "A compliance officer notices that a particular scenario hasn't generated any alerts in six months. What should be the response?",
                "question_image" => "",
                "correct_answer" => "B",
                "answer_option_a" => "Assume the scenario is working correctly",
                "answer_option_b" => "Review and test the scenario to ensure it's functioning properly",
                "answer_option_c" => "Delete the scenario as unnecessary",
                "answer_option_d" => "Lower the threshold to generate more alerts",
                "duration" => "3"
            ],

            // ===== LESSON 13: Suspicious Activity Detection and SAR Filing (10 questions) =====
            [
                "lesson_id" => 13,
                "question" => "What does SAR stand for?",
                "question_image" => "",
                "correct_answer" => "A",
                "answer_option_a" => "Suspicious Activity Report",
                "answer_option_b" => "System Activity Review",
                "answer_option_c" => "Security Alert Response",
                "answer_option_d" => "Standard Audit Report",
                "duration" => "2"
            ],
            [
                "lesson_id" => 13,
                "question" => "Who is responsible for filing SARs?",
                "question_image" => "",
                "correct_answer" => "C",
                "answer_option_a" => "Only senior management",
                "answer_option_b" => "Only compliance officers",
                "answer_option_c" => "The financial institution where the suspicious activity occurred",
                "answer_option_d" => "The customer's account manager only",
                "duration" => "3"
            ],
            [
                "lesson_id" => 13,
                "question" => "Within how many days should a SAR typically be filed after detection?",
                "question_image" => "",
                "correct_answer" => "D",
                "answer_option_a" => "7 days",
                "answer_option_b" => "15 days",
                "answer_option_c" => "21 days",
                "answer_option_d" => "30 days",
                "duration" => "2"
            ],
            [
                "lesson_id" => 13,
                "question" => "Which of the following is a red flag for suspicious activity?",
                "question_image" => "",
                "correct_answer" => "B",
                "answer_option_a" => "Regular salary deposits",
                "answer_option_b" => "Multiple cash deposits just under reporting thresholds",
                "answer_option_c" => "Monthly utility bill payments",
                "answer_option_d" => "Annual tax payments",
                "duration" => "3"
            ],
            [
                "lesson_id" => 13,
                "question" => "Should customers be notified when a SAR is filed about their activities?",
                "question_image" => "",
                "correct_answer" => "A",
                "answer_option_a" => "No, customers should never be notified",
                "answer_option_b" => "Yes, customers have a right to know",
                "answer_option_c" => "Only if they ask directly",
                "answer_option_d" => "Only for amounts over $50,000",
                "duration" => "2"
            ],
            [
                "lesson_id" => 13,
                "question" => "What constitutes suspicious activity?",
                "question_image" => "",
                "correct_answer" => "C",
                "answer_option_a" => "Only transactions over $10,000",
                "answer_option_b" => "Only cash transactions",
                "answer_option_c" => "Any transaction that deviates from normal patterns or serves no apparent purpose",
                "answer_option_d" => "Only international wire transfers",
                "duration" => "3"
            ],
            [
                "lesson_id" => 13,
                "question" => "What should happen to an account after a SAR is filed?",
                "question_image" => "",
                "correct_answer" => "D",
                "answer_option_a" => "It should be immediately closed",
                "answer_option_b" => "All transactions should be blocked",
                "answer_option_c" => "The customer should be interviewed",
                "answer_option_d" => "Continue monitoring while maintaining normal business operations",
                "duration" => "3"
            ],
            [
                "lesson_id" => 13,
                "question" => "Which government agency typically receives SARs?",
                "question_image" => "",
                "correct_answer" => "B",
                "answer_option_a" => "Internal Revenue Service (IRS)",
                "answer_option_b" => "Financial Crimes Enforcement Network (FinCEN)",
                "answer_option_c" => "Federal Trade Commission (FTC)",
                "answer_option_d" => "Securities and Exchange Commission (SEC)",
                "duration" => "3"
            ],
            [
                "lesson_id" => 13,
                "question" => "What is the minimum threshold for filing a SAR for suspicious activity?",
                "question_image" => "",
                "correct_answer" => "A",
                "answer_option_a" => "There is no minimum threshold if activity is suspicious",
                "answer_option_b" => "$5,000",
                "answer_option_c" => "$10,000",
                "answer_option_d" => "$25,000",
                "duration" => "3"
            ],
            [
                "lesson_id" => 13,
                "question" => "What information must be included in a SAR narrative?",
                "question_image" => "",
                "correct_answer" => "C",
                "answer_option_a" => "Only transaction amounts and dates",
                "answer_option_b" => "Only customer identification information",
                "answer_option_c" => "Clear description of suspicious activity, why it's suspicious, and investigation steps taken",
                "answer_option_d" => "Only account numbers and transaction codes",
                "duration" => "3"
            ],

            // ===== LESSON 14: Investigation Techniques and Evidence Gathering (5 questions) =====
            [
                "lesson_id" => 14,
                "question" => "What is the most important principle when gathering evidence during AML investigations?",
                "question_image" => "",
                "correct_answer" => "C",
                "answer_option_a" => "Speed of collection",
                "answer_option_b" => "Minimal documentation",
                "answer_option_c" => "Maintaining chain of custody and integrity",
                "answer_option_d" => "Getting customer permission first",
                "duration" => "3"
            ],
            [
                "lesson_id" => 14,
                "question" => "During an investigation, you discover potential criminal activity beyond money laundering. What should be your approach?",
                "question_image" => "",
                "correct_answer" => "A",
                "answer_option_a" => "Document findings and consider additional reporting requirements",
                "answer_option_b" => "Focus only on AML aspects",
                "answer_option_c" => "Immediately notify the customer",
                "answer_option_d" => "Stop the investigation",
                "duration" => "3"
            ],
            [
                "lesson_id" => 14,
                "question" => "What constitutes proper interview techniques when speaking with bank personnel during investigations?",
                "question_image" => "",
                "correct_answer" => "B",
                "answer_option_a" => "Leading questions to get desired answers",
                "answer_option_b" => "Open-ended questions with detailed documentation",
                "answer_option_c" => "Informal conversations without notes",
                "answer_option_d" => "Group interviews to save time",
                "duration" => "3"
            ],
            [
                "lesson_id" => 14,
                "question" => "How should external information sources be utilized in AML investigations?",
                "question_image" => "",
                "correct_answer" => "D",
                "answer_option_a" => "Rely solely on internal bank information",
                "answer_option_b" => "Use any available public information without verification",
                "answer_option_c" => "Avoid external sources to maintain confidentiality",
                "answer_option_d" => "Use appropriate external sources while ensuring reliability and legality",
                "duration" => "3"
            ],
            [
                "lesson_id" => 14,
                "question" => "An investigation reveals suspicious activity involving multiple customers who appear unrelated. What investigation approach is most appropriate?",
                "question_image" => "",
                "correct_answer" => "C",
                "answer_option_a" => "Investigate each customer separately without comparison",
                "answer_option_b" => "Close all accounts immediately",
                "answer_option_c" => "Analyze connections and patterns across the related activities",
                "answer_option_d" => "Focus only on the highest value transactions",
                "duration" => "3"
            ],

            // ===== LESSON 15: Regulatory Reporting and Communication (5 questions) =====
            [
                "lesson_id" => 15,
                "question" => "What is the most critical element of effective regulatory communication?",
                "question_image" => "",
                "correct_answer" => "A",
                "answer_option_a" => "Accuracy, completeness, and timeliness of information",
                "answer_option_b" => "Frequent communication regardless of content",
                "answer_option_c" => "Formal language and complex terminology",
                "answer_option_d" => "Limiting information to minimize scrutiny",
                "duration" => "3"
            ],
            [
                "lesson_id" => 15,
                "question" => "During a regulatory examination, examiners request additional information about a closed SAR. How should this be handled?",
                "question_image" => "",
                "correct_answer" => "C",
                "answer_option_a" => "Decline to provide information about filed SARs",
                "answer_option_b" => "Provide only summary information",
                "answer_option_c" => "Cooperate fully while ensuring appropriate confidentiality measures",
                "answer_option_d" => "Refer all questions to external counsel",
                "duration" => "3"
            ],
            [
                "lesson_id" => 15,
                "question" => "What should be included in periodic AML reports to senior management and board?",
                "question_image" => "",
                "correct_answer" => "D",
                "answer_option_a" => "Only positive developments and achievements",
                "answer_option_b" => "Detailed customer-specific information",
                "answer_option_c" => "Technical system specifications",
                "answer_option_d" => "Program effectiveness metrics, issues identified, and corrective actions",
                "duration" => "3"
            ],
            [
                "lesson_id" => 15,
                "question" => "A regulator requests information about your bank's customer risk assessment methodology. What level of detail should be provided?",
                "question_image" => "",
                "correct_answer" => "B",
                "answer_option_a" => "Refuse to provide methodology details",
                "answer_option_b" => "Provide comprehensive explanation of methodology and implementation",
                "answer_option_c" => "Provide only high-level summary",
                "answer_option_d" => "Refer to published industry standards only",
                "duration" => "3"
            ],
            [
                "lesson_id" => 15,
                "question" => "How should compliance deficiencies identified during self-assessment be reported?",
                "question_image" => "",
                "correct_answer" => "A",
                "answer_option_a" => "Promptly reported to management with remediation plans",
                "answer_option_b" => "Kept confidential to avoid regulatory attention",
                "answer_option_c" => "Reported only if specifically asked by regulators",
                "answer_option_d" => "Addressed quietly without formal reporting",
                "duration" => "3"
            ],

            // ===== LESSON 16: Customer Risk Assessment and Profiling (10 questions) =====
            [
                "lesson_id" => 16,
                "question" => "What does PEP stand for in AML context?",
                "question_image" => "",
                "correct_answer" => "B",
                "answer_option_a" => "Politically Influential People",
                "answer_option_b" => "Politically Exposed Person",
                "answer_option_c" => "Public Procurement Plan",
                "answer_option_d" => "Permanent International Profile",
                "duration" => "2"
            ],
            [
                "lesson_id" => 16,
                "question" => "Why are PEPs considered higher risk?",
                "question_image" => "",
                "correct_answer" => "A",
                "answer_option_a" => "They have greater opportunity for corruption and abuse of position",
                "answer_option_b" => "They have more money than average customers",
                "answer_option_c" => "They travel internationally more frequently",
                "answer_option_d" => "They use banking services more often",
                "duration" => "3"
            ],
            [
                "lesson_id" => 16,
                "question" => "What are the three main customer risk categories?",
                "question_image" => "",
                "correct_answer" => "C",
                "answer_option_a" => "Small, Medium, Large",
                "answer_option_b" => "Local, National, International",
                "answer_option_c" => "Low, Medium, High",
                "answer_option_d" => "Individual, Corporate, Government",
                "duration" => "2"
            ],
            [
                "lesson_id" => 16,
                "question" => "Which factor is NOT typically considered in customer risk assessment?",
                "question_image" => "",
                "correct_answer" => "D",
                "answer_option_a" => "Geographic location",
                "answer_option_b" => "Business or occupation",
                "answer_option_c" => "Transaction patterns",
                "answer_option_d" => "Customer's favorite color",
                "duration" => "2"
            ],
            [
                "lesson_id" => 16,
                "question" => "How often should customer risk ratings be reviewed?",
                "question_image" => "",
                "correct_answer" => "B",
                "answer_option_a" => "Never, once assigned they are permanent",
                "answer_option_b" => "Regularly, based on risk level and regulatory requirements",
                "answer_option_c" => "Only when customers request a review",
                "answer_option_d" => "Every 10 years regardless of risk level",
                "duration" => "3"
            ],
            [
                "lesson_id" => 16,
                "question" => "What is Enhanced Due Diligence (EDD) used for?",
                "question_image" => "",
                "correct_answer" => "A",
                "answer_option_a" => "High-risk customers requiring additional verification and monitoring",
                "answer_option_b" => "All customers equally",
                "answer_option_c" => "Only corporate customers",
                "answer_option_d" => "Low-risk customers for simplified procedures",
                "duration" => "3"
            ],
            [
                "lesson_id" => 16,
                "question" => "Which geographic locations are typically considered higher risk?",
                "question_image" => "",
                "correct_answer" => "C",
                "answer_option_a" => "Developed countries only",
                "answer_option_b" => "English-speaking countries",
                "answer_option_c" => "Countries with poor AML controls or on sanctions lists",
                "answer_option_d" => "Countries with large populations",
                "duration" => "3"
            ],
            [
                "lesson_id" => 16,
                "question" => "What is country risk assessment based on?",
                "question_image" => "",
                "correct_answer" => "D",
                "answer_option_a" => "Economic development level only",
                "answer_option_b" => "Population size",
                "answer_option_c" => "Geographic location",
                "answer_option_d" => "AML/CFT framework strength, corruption levels, and sanctions status",
                "duration" => "3"
            ],
            [
                "lesson_id" => 16,
                "question" => "How should risk assessment findings be documented?",
                "question_image" => "",
                "correct_answer" => "B",
                "answer_option_a" => "No documentation required for low-risk customers",
                "answer_option_b" => "All risk decisions should be clearly documented with supporting rationale",
                "answer_option_c" => "Only document high-risk customer decisions",
                "answer_option_d" => "Documentation is optional",
                "duration" => "3"
            ],
            [
                "lesson_id" => 16,
                "question" => "What triggers a risk rating change?",
                "question_image" => "",
                "correct_answer" => "A",
                "answer_option_a" => "Changes in customer behavior, circumstances, or external factors",
                "answer_option_b" => "Only when customers request it",
                "answer_option_c" => "Automatic system updates only",
                "answer_option_d" => "Management decisions only",
                "duration" => "3"
            ],

            // ===== LESSON 17: Country and Geographic Risk Assessment (5 questions) =====
            [
                "lesson_id" => 17,
                "question" => "Which factor is most important when assessing country risk for AML purposes?",
                "question_image" => "",
                "correct_answer" => "B",
                "answer_option_a" => "Economic development level",
                "answer_option_b" => "Strength of AML/CFT regulatory framework",
                "answer_option_c" => "Geographic proximity to your bank",
                "answer_option_d" => "Cultural similarities",
                "duration" => "3"
            ],
            [
                "lesson_id" => 17,
                "question" => "A customer requests to send funds to a country that was recently added to the FATF grey list. What should be the compliance approach?",
                "question_image" => "",
                "correct_answer" => "C",
                "answer_option_a" => "Automatically block all transactions to that country",
                "answer_option_b" => "Process normally with no additional scrutiny",
                "answer_option_c" => "Apply enhanced due diligence and scrutiny to the transaction",
                "answer_option_d" => "Advise customer to use a different bank",
                "duration" => "3"
            ],
            [
                "lesson_id" => 17,
                "question" => "What is the significance of FATF's 'blacklist' countries?",
                "question_image" => "",
                "correct_answer" => "A",
                "answer_option_a" => "Countries with serious AML/CFT deficiencies requiring countermeasures",
                "answer_option_b" => "Countries banned from international trade",
                "answer_option_c" => "Countries with poor economic performance",
                "answer_option_d" => "Countries that don't cooperate on tax matters",
                "duration" => "3"
            ],
            [
                "lesson_id" => 17,
                "question" => "How should politically unstable regions be assessed for AML risk?",
                "question_image" => "",
                "correct_answer" => "D",
                "answer_option_a" => "Political stability has no impact on AML risk",
                "answer_option_b" => "Always classify as low risk",
                "answer_option_c" => "Base assessment solely on media reports",
                "answer_option_d" => "Consider impact on regulatory oversight and potential for corruption",
                "duration" => "3"
            ],
            [
                "lesson_id" => 17,
                "question" => "A compliance officer is reviewing correspondent banking relationships with institutions in various countries. What country risk factor requires immediate attention?",
                "question_image" => "",
                "correct_answer" => "B",
                "answer_option_a" => "Countries with different time zones",
                "answer_option_b" => "Countries subject to international sanctions",
                "answer_option_c" => "Countries with developing economies",
                "answer_option_d" => "Countries with different languages",
                "duration" => "3"
            ],

            // ===== LESSON 18: Product and Service Risk Assessment (5 questions) =====
            [
                "lesson_id" => 18,
                "question" => "Which banking product typically presents the highest money laundering risk?",
                "question_image" => "",
                "correct_answer" => "A",
                "answer_option_a" => "Private banking and correspondent banking services",
                "answer_option_b" => "Basic checking accounts",
                "answer_option_c" => "Certificate of deposits",
                "answer_option_d" => "Auto loans",
                "duration" => "3"
            ],
            [
                "lesson_id" => 18,
                "question" => "Your bank is considering launching a new digital wallet service. What AML consideration is most critical during product development?",
                "question_image" => "",
                "correct_answer" => "C",
                "answer_option_a" => "Marketing strategy for the product",
                "answer_option_b" => "Competitive pricing structure",
                "answer_option_c" => "Integration of appropriate AML controls and monitoring capabilities",
                "answer_option_d" => "User interface design",
                "duration" => "3"
            ],
            [
                "lesson_id" => 18,
                "question" => "What makes trade finance products particularly vulnerable to money laundering?",
                "question_image" => "",
                "correct_answer" => "B",
                "answer_option_a" => "High transaction volumes",
                "answer_option_b" => "Complex documentation and multiple parties across jurisdictions",
                "answer_option_c" => "Long settlement timeframes",
                "answer_option_d" => "High profit margins",
                "duration" => "3"
            ],
            [
                "lesson_id" => 18,
                "question" => "How should new product risk assessments be documented and approved?",
                "question_image" => "",
                "correct_answer" => "D",
                "answer_option_a" => "Informal discussion with compliance team",
                "answer_option_b" => "Email approval from product manager",
                "answer_option_c" => "Verbal approval from senior management",
                "answer_option_d" => "Formal written assessment with documented approval process",
                "duration" => "2"
            ],
            [
                "lesson_id" => 18,
                "question" => "A bank is offering a new cryptocurrency custody service. What AML control is most essential?",
                "question_image" => "",
                "correct_answer" => "A",
                "answer_option_a" => "Enhanced transaction monitoring for crypto-related activities",
                "answer_option_b" => "Standard account opening procedures",
                "answer_option_c" => "Reduced documentation requirements",
                "answer_option_d" => "Simplified customer identification",
                "duration" => "3"
            ],

            // ===== LESSON 19: Sanctions and Watch List Screening (10 questions) =====
            [
                "lesson_id" => 19,
                "question" => "What is the primary purpose of sanctions screening?",
                "question_image" => "",
                "correct_answer" => "A",
                "answer_option_a" => "To prevent transactions with sanctioned individuals or entities",
                "answer_option_b" => "To speed up transaction processing",
                "answer_option_c" => "To reduce transaction costs",
                "answer_option_d" => "To improve customer satisfaction",
                "duration" => "3"
            ],
            [
                "lesson_id" => 19,
                "question" => "Which organization maintains the OFAC sanctions list?",
                "question_image" => "",
                "correct_answer" => "B",
                "answer_option_a" => "Federal Bureau of Investigation (FBI)",
                "answer_option_b" => "Office of Foreign Assets Control (OFAC)",
                "answer_option_c" => "Financial Crimes Enforcement Network (FinCEN)",
                "answer_option_d" => "Securities and Exchange Commission (SEC)",
                "duration" => "3"
            ],
            [
                "lesson_id" => 19,
                "question" => "How often should sanctions lists be updated?",
                "question_image" => "",
                "correct_answer" => "A",
                "answer_option_a" => "Real-time or as frequently as updates are published",
                "answer_option_b" => "Monthly",
                "answer_option_c" => "Quarterly",
                "answer_option_d" => "Annually",
                "duration" => "3"
            ],
            [
                "lesson_id" => 19,
                "question" => "What should happen when a potential sanctions match is identified?",
                "question_image" => "",
                "correct_answer" => "C",
                "answer_option_a" => "Proceed with the transaction",
                "answer_option_b" => "Notify the customer immediately",
                "answer_option_c" => "Stop the transaction and investigate the match",
                "answer_option_d" => "Reduce the transaction amount",
                "duration" => "3"
            ],
            [
                "lesson_id" => 19,
                "question" => "What is fuzzy matching in sanctions screening?",
                "question_image" => "",
                "correct_answer" => "D",
                "answer_option_a" => "Exact name matching only",
                "answer_option_b" => "Matching based on account numbers",
                "answer_option_c" => "Matching based on transaction amounts",
                "answer_option_d" => "Approximate matching that accounts for variations in names and spellings",
                "duration" => "3"
            ],
            [
                "lesson_id" => 19,
                "question" => "Which elements should be screened against sanctions lists?",
                "question_image" => "",
                "correct_answer" => "B",
                "answer_option_a" => "Only customer names",
                "answer_option_b" => "Customer names, beneficiaries, addresses, and related parties",
                "answer_option_c" => "Only transaction amounts",
                "answer_option_d" => "Only account numbers",
                "duration" => "3"
            ],
            [
                "lesson_id" => 19,
                "question" => "What is a false positive in sanctions screening?",
                "question_image" => "",
                "correct_answer" => "A",
                "answer_option_a" => "A match that appears suspicious but is actually legitimate",
                "answer_option_b" => "A confirmed sanctions violation",
                "answer_option_c" => "A missed sanctions match",
                "answer_option_d" => "A system error",
                "duration" => "3"
            ],
            [
                "lesson_id" => 19,
                "question" => "How should sanctions screening results be documented?",
                "question_image" => "",
                "correct_answer" => "C",
                "answer_option_a" => "Only document confirmed matches",
                "answer_option_b" => "No documentation needed for cleared matches",
                "answer_option_c" => "Document all matches, investigations, and clearance decisions",
                "answer_option_d" => "Only document if requested by regulators",
                "duration" => "3"
            ],
            [
                "lesson_id" => 19,
                "question" => "What happens to assets of sanctioned individuals?",
                "question_image" => "",
                "correct_answer" => "B",
                "answer_option_a" => "They can be used normally",
                "answer_option_b" => "They must be frozen or blocked",
                "answer_option_c" => "They are automatically transferred to government",
                "answer_option_d" => "They are returned to the customer",
                "duration" => "3"
            ],
            [
                "lesson_id" => 19,
                "question" => "Who should be notified when a true sanctions match is confirmed?",
                "question_image" => "",
                "correct_answer" => "D",
                "answer_option_a" => "Only the customer",
                "answer_option_b" => "Only internal management",
                "answer_option_c" => "No one needs to be notified",
                "answer_option_d" => "Relevant regulatory authorities as required by law",
                "duration" => "3"
            ],

            // ===== LESSON 20: Sanctions Compliance Program Management (5 questions) =====
            [
                "lesson_id" => 20,
                "question" => "What are the core components of an effective sanctions compliance program?",
                "question_image" => "",
                "correct_answer" => "C",
                "answer_option_a" => "Only screening systems and procedures",
                "answer_option_b" => "Training and awareness programs only",
                "answer_option_c" => "Policies, procedures, screening, training, testing, and oversight",
                "answer_option_d" => "Senior management involvement only",
                "duration" => "3"
            ],
            [
                "lesson_id" => 20,
                "question" => "A compliance officer discovers that sanctions list updates have been delayed for two weeks due to technical issues. What should be the immediate priority?",
                "question_image" => "",
                "correct_answer" => "A",
                "answer_option_a" => "Implement manual screening procedures and expedite system fixes",
                "answer_option_b" => "Wait for technical issues to be resolved",
                "answer_option_c" => "Reduce transaction processing temporarily",
                "answer_option_d" => "Notify customers about potential delays",
                "duration" => "3"
            ],
            [
                "lesson_id" => 20,
                "question" => "How should sanctions compliance be integrated with other bank functions?",
                "question_image" => "",
                "correct_answer" => "D",
                "answer_option_a" => "Keep sanctions separate from other compliance functions",
                "answer_option_b" => "Only integrate with legal department",
                "answer_option_c" => "Focus integration on operations only",
                "answer_option_d" => "Integrate across all relevant business lines and support functions",
                "duration" => "3"
            ],
            [
                "lesson_id" => 20,
                "question" => "What is the appropriate response when sanctions regulations change?",
                "question_image" => "",
                "correct_answer" => "B",
                "answer_option_a" => "Wait for industry guidance before implementing",
                "answer_option_b" => "Promptly assess impact and update procedures accordingly",
                "answer_option_c" => "Continue existing procedures until formal notification",
                "answer_option_d" => "Implement changes only if specifically required",
                "duration" => "3"
            ],
            [
                "lesson_id" => 20,
                "question" => "A bank's sanctions compliance testing reveals systematic screening gaps. How should this be addressed?",
                "question_image" => "",
                "correct_answer" => "C",
                "answer_option_a" => "Address the gaps quietly without formal reporting",
                "answer_option_b" => "Wait for next testing cycle to confirm findings",
                "answer_option_c" => "Immediately remediate gaps and report to appropriate management",
                "answer_option_d" => "Reduce testing frequency to avoid finding more issues",
                "duration" => "3"
            ],

            // ===== LESSON 21: International Sanctions and Trade Finance (5 questions) =====
            [
                "lesson_id" => 21,
                "question" => "What makes trade finance particularly complex from a sanctions perspective?",
                "question_image" => "",
                "correct_answer" => "A",
                "answer_option_a" => "Multiple parties, jurisdictions, and transaction stages requiring screening",
                "answer_option_b" => "High transaction values only",
                "answer_option_c" => "Limited documentation requirements",
                "answer_option_d" => "Simple bilateral relationships",
                "duration" => "3"
            ],
            [
                "lesson_id" => 21,
                "question" => "In a letter of credit transaction involving multiple jurisdictions, one party appears on a sanctions list. What should be the bank's response?",
                "question_image" => "",
                "correct_answer" => "C",
                "answer_option_a" => "Complete the transaction but monitor closely",
                "answer_option_b" => "Process the transaction with higher fees",
                "answer_option_c" => "Reject the transaction and freeze any related funds",
                "answer_option_d" => "Seek customer explanation before deciding",
                "duration" => "3"
            ],
            [
                "lesson_id" => 21,
                "question" => "What is 'dual-use' goods in the context of trade finance sanctions?",
                "question_image" => "",
                "correct_answer" => "B",
                "answer_option_a" => "Goods that can be sold in two different countries",
                "answer_option_b" => "Goods that have both civilian and military applications",
                "answer_option_c" => "Goods with two different pricing structures",
                "answer_option_d" => "Goods that require two licenses",
                "duration" => "3"
            ],
            [
                "lesson_id" => 21,
                "question" => "How should banks handle trade finance documents that reference goods potentially subject to sanctions?",
                "question_image" => "",
                "correct_answer" => "D",
                "answer_option_a" => "Process normally if customer is not sanctioned",
                "answer_option_b" => "Ignore goods descriptions in documents",
                "answer_option_c" => "Only review monetary amounts",
                "answer_option_d" => "Screen goods descriptions against restricted items lists",
                "duration" => "3"
            ],
            [
                "lesson_id" => 21,
                "question" => "A compliance officer reviewing trade finance transactions notices goods being shipped through multiple countries including a high-risk jurisdiction. What analysis is most important?",
                "question_image" => "",
                "correct_answer" => "A",
                "answer_option_a" => "Assess if the routing is legitimate or potentially sanctions evasion",
                "answer_option_b" => "Calculate additional shipping costs",
                "answer_option_c" => "Verify insurance coverage for all countries",
                "answer_option_d" => "Confirm currency exchange rates",
                "duration" => "3"
            ],

            // ===== LESSON 22: AML Case Management and Investigations (10 questions) =====
            [
                "lesson_id" => 22,
                "question" => "What is the primary purpose of AML case management?",
                "question_image" => "",
                "correct_answer" => "A",
                "answer_option_a" => "To systematically investigate and document suspicious activities",
                "answer_option_b" => "To speed up customer onboarding",
                "answer_option_c" => "To reduce operational costs",
                "answer_option_d" => "To improve marketing effectiveness",
                "duration" => "3"
            ],
            [
                "lesson_id" => 22,
                "question" => "What should be the first step when a suspicious activity alert is generated?",
                "question_image" => "",
                "correct_answer" => "B",
                "answer_option_a" => "File a SAR immediately",
                "answer_option_b" => "Assign the case for investigation",
                "answer_option_c" => "Close the customer account",
                "answer_option_d" => "Notify the customer",
                "duration" => "2"
            ],
            [
                "lesson_id" => 22,
                "question" => "How long should AML case documentation be retained?",
                "question_image" => "",
                "correct_answer" => "D",
                "answer_option_a" => "1 year",
                "answer_option_b" => "2 years",
                "answer_option_c" => "3 years",
                "answer_option_d" => "At least 5 years or as required by regulation",
                "duration" => "2"
            ],
            [
                "lesson_id" => 22,
                "question" => "What information should be included in case investigation notes?",
                "question_image" => "",
                "correct_answer" => "C",
                "answer_option_a" => "Only final conclusions",
                "answer_option_b" => "Only customer identification",
                "answer_option_c" => "All investigation steps, findings, and rationale for decisions",
                "answer_option_d" => "Only transaction amounts",
                "duration" => "3"
            ],
            [
                "lesson_id" => 22,
                "question" => "Who should have access to AML case files?",
                "question_image" => "",
                "correct_answer" => "B",
                "answer_option_a" => "All employees",
                "answer_option_b" => "Only authorized personnel with a need to know",
                "answer_option_c" => "Only senior management",
                "answer_option_d" => "Anyone in the compliance department",
                "duration" => "3"
            ],
            [
                "lesson_id" => 22,
                "question" => "What constitutes proper case escalation?",
                "question_image" => "",
                "correct_answer" => "A",
                "answer_option_a" => "Complex or high-risk cases referred to senior investigators or management",
                "answer_option_b" => "All cases automatically sent to management",
                "answer_option_c" => "Only cases involving large amounts",
                "answer_option_d" => "Cases escalated randomly",
                "duration" => "3"
            ],
            [
                "lesson_id" => 22,
                "question" => "How should case closure decisions be documented?",
                "question_image" => "",
                "correct_answer" => "D",
                "answer_option_a" => "No documentation needed for cleared cases",
                "answer_option_b" => "Simple notation is sufficient",
                "answer_option_c" => "Only document if filing a SAR",
                "answer_option_d" => "Clear rationale and supporting evidence for all closure decisions",
                "duration" => "3"
            ],
            [
                "lesson_id" => 22,
                "question" => "What should happen to cases that remain open beyond normal timeframes?",
                "question_image" => "",
                "correct_answer" => "C",
                "answer_option_a" => "Automatically close them",
                "answer_option_b" => "Transfer to external investigators",
                "answer_option_c" => "Review for proper prioritization and resource allocation",
                "answer_option_d" => "Convert them all to SARs",
                "duration" => "3"
            ],
            [
                "lesson_id" => 22,
                "question" => "What is the benefit of case tracking and metrics?",
                "question_image" => "",
                "correct_answer" => "B",
                "answer_option_a" => "To reduce the number of cases",
                "answer_option_b" => "To monitor productivity and identify process improvements",
                "answer_option_c" => "To eliminate the need for documentation",
                "answer_option_d" => "To speed up customer transactions",
                "duration" => "3"
            ],
            [
                "lesson_id" => 22,
                "question" => "How should quality assurance be implemented in case management?",
                "question_image" => "",
                "correct_answer" => "A",
                "answer_option_a" => "Regular independent review of completed cases",
                "answer_option_b" => "Self-review by the same investigator",
                "answer_option_c" => "No review needed for experienced investigators",
                "answer_option_d" => "Review only cases that result in SARs",
                "duration" => "3"
            ],

            // ===== LESSON 23: Quality Assurance and Case Review Procedures (5 questions) =====
            [
                "lesson_id" => 23,
                "question" => "What is the primary objective of quality assurance in AML case management?",
                "question_image" => "",
                "correct_answer" => "B",
                "answer_option_a" => "To speed up case processing",
                "answer_option_b" => "To ensure consistent, accurate, and compliant case handling",
                "answer_option_c" => "To reduce the number of cases",
                "answer_option_d" => "To minimize regulatory interaction",
                "duration" => "3"
            ],
            [
                "lesson_id" => 23,
                "question" => "How should quality assurance reviews be structured to maintain objectivity?",
                "question_image" => "",
                "correct_answer" => "A",
                "answer_option_a" => "Independent reviewers not involved in original case work",
                "answer_option_b" => "Same team members reviewing each other's work",
                "answer_option_c" => "Customer service staff conducting reviews",
                "answer_option_d" => "Automated system reviews only",
                "duration" => "3"
            ],
            [
                "lesson_id" => 23,
                "question" => "A quality assurance review identifies inconsistent case dispositions for similar fact patterns. What should be the response?",
                "question_image" => "",
                "correct_answer" => "C",
                "answer_option_a" => "Ignore the inconsistencies if cases were closed",
                "answer_option_b" => "Blame individual investigators",
                "answer_option_c" => "Review procedures, provide additional training, and improve guidance",
                "answer_option_d" => "Reduce the number of cases assigned",
                "duration" => "3"
            ],
            [
                "lesson_id" => 23,
                "question" => "What percentage of completed cases should typically be subject to quality assurance review?",
                "question_image" => "",
                "correct_answer" => "B",
                "answer_option_a" => "5% or less",
                "answer_option_b" => "10-15% or risk-based selection",
                "answer_option_c" => "50% or more",
                "answer_option_d" => "100% of all cases",
                "duration" => "2"
            ],
            [
                "lesson_id" => 23,
                "question" => "How should quality assurance findings be documented and tracked?",
                "question_image" => "",
                "correct_answer" => "D",
                "answer_option_a" => "Informal verbal feedback only",
                "answer_option_b" => "Email notifications without formal tracking",
                "answer_option_c" => "Annual summary reports only",
                "answer_option_d" => "Formal documentation with tracking of corrective actions",
                "duration" => "2"
            ],

            // ===== LESSON 24: Management Information and Reporting (5 questions) =====
            [
                "lesson_id" => 24,
                "question" => "What is the primary purpose of AML management information (MI) reporting?",
                "question_image" => "",
                "correct_answer" => "A",
                "answer_option_a" => "To provide oversight and enable informed decision-making about AML program effectiveness",
                "answer_option_b" => "To satisfy regulatory reporting requirements only",
                "answer_option_c" => "To demonstrate activity levels to justify resources",
                "answer_option_d" => "To replace detailed case documentation",
                "duration" => "3"
            ],
            [
                "lesson_id" => 24,
                "question" => "Which metric is most important for assessing transaction monitoring effectiveness?",
                "question_image" => "",
                "correct_answer" => "C",
                "answer_option_a" => "Total number of alerts generated",
                "answer_option_b" => "Speed of alert processing",
                "answer_option_c" => "Percentage of alerts resulting in SARs or productive outcomes",
                "answer_option_d" => "Number of staff assigned to alert review",
                "duration" => "3"
            ],
            [
                "lesson_id" => 24,
                "question" => "How frequently should comprehensive AML program reports be provided to the board of directors?",
                "question_image" => "",
                "correct_answer" => "B",
                "answer_option_a" => "Monthly",
                "answer_option_b" => "Quarterly or as required by board charter",
                "answer_option_c" => "Annually",
                "answer_option_d" => "Only when problems arise",
                "duration" => "2"
            ],
            [
                "lesson_id" => 24,
                "question" => "A compliance officer prepares an MI report showing a 40% increase in SARs filed. How should this trend be presented to management?",
                "question_image" => "",
                "correct_answer" => "D",
                "answer_option_a" => "As evidence of improved compliance",
                "answer_option_b" => "As a negative development requiring concern",
                "answer_option_c" => "Without context or analysis",
                "answer_option_d" => "With analysis of underlying causes and quality assessment",
                "duration" => "3"
            ],
            [
                "lesson_id" => 24,
                "question" => "What should be included in management reporting when AML deficiencies are identified?",
                "question_image" => "",
                "correct_answer" => "A",
                "answer_option_a" => "Description of deficiency, impact assessment, and remediation plan with timelines",
                "answer_option_b" => "Deficiency description only",
                "answer_option_c" => "Remediation costs only",
                "answer_option_d" => "Comparison to peer institutions only",
                "duration" => "3"
            ]
        ]);
    }
}

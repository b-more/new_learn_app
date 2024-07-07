<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $quotes = [
            "Effective AML programs are essential for maintaining the integrity of financial systems.",
            "Transaction monitoring is a critical component of a bank's AML strategy.",
            "Compliance with AML regulations helps prevent financial crime.",
            "Monitoring transactions helps detect suspicious activities in real-time.",
            "AML policies protect banks from being used as conduits for money laundering.",
            "Regulatory compliance is crucial for banks to avoid hefty fines.",
            "AML systems should be robust and adaptable to emerging threats.",
            "Continuous training is vital for effective AML compliance.",
            "Technology plays a significant role in modern AML solutions.",
            "Customer due diligence is the first step in AML compliance.",
            "Banks must report any suspicious transactions to relevant authorities.",
            "AML compliance helps build trust with customers and regulators.",
            "Transaction monitoring systems should be regularly updated.",
            "Effective AML practices can deter criminals from using banking channels.",
            "Know Your Customer (KYC) is a cornerstone of AML compliance.",
            "Real-time transaction monitoring can prevent fraudulent activities.",
            "AML compliance requires cooperation between banks and regulatory bodies.",
            "Banks must maintain detailed records of customer transactions.",
            "AML policies should be tailored to the bank's risk profile.",
            "Regular audits are essential for ensuring AML compliance.",
            "Transaction monitoring helps identify patterns indicative of money laundering.",
            "Banks should invest in advanced analytics for AML purposes.",
            "AML compliance is an ongoing process, not a one-time effort.",
            "Risk-based approach is fundamental in AML compliance.",
            "Financial institutions must stay updated on AML regulations.",
            "Suspicious Activity Reports (SARs) are crucial in AML.",
            "Banks must implement effective internal controls for AML.",
            "Cross-border transactions require heightened AML vigilance.",
            "Continuous improvement is key in AML compliance programs.",
            "AML programs must be comprehensive and well-documented.",
            "Transaction monitoring systems should be able to handle large volumes of data.",
            "AML compliance is essential for the bank's reputation.",
            "Effective AML programs require top-down commitment from the bank's leadership.",
            "Regulatory penalties for non-compliance can be severe.",
            "AML systems must adapt to changing regulatory requirements.",
            "Collaboration with law enforcement is vital for AML efforts.",
            "Banks should leverage AI and machine learning for AML.",
            "Transparency in transactions is essential for AML.",
            "Effective AML programs require a combination of technology and human oversight.",
            "AML compliance helps safeguard the global financial system.",
            "Transaction monitoring should cover all types of transactions.",
            "Banks must ensure their AML systems are user-friendly and efficient.",
            "AML compliance involves both detection and prevention of money laundering.",
            "Regulatory bodies provide guidelines for effective AML practices.",
            "Banks must conduct regular risk assessments for AML.",
            "AML regulations vary across different jurisdictions.",
            "Employee awareness and training are crucial for AML success.",
            "Banks must establish clear policies and procedures for AML.",
            "AML compliance requires accurate and timely data collection.",
            "Effective AML programs protect banks from reputational damage.",
            "AML technology should be scalable and flexible.",
            "Banks must perform enhanced due diligence for high-risk customers.",
            "Transaction monitoring helps uncover hidden patterns of illicit activities.",
            "AML programs should include regular testing and validation.",
            "Banks must report AML compliance to regulatory authorities periodically.",
            "AML systems should integrate seamlessly with other banking systems.",
            "Customer segmentation can enhance the effectiveness of AML monitoring.",
            "Regulatory frameworks provide a baseline for AML programs.",
            "AML compliance is critical for the long-term sustainability of banks.",
            "Banks must prioritize AML in their strategic planning.",
            "Effective AML programs can reduce the risk of financial crime.",
            "Transaction monitoring systems should support real-time alerts.",
            "Banks must ensure data privacy while implementing AML measures.",
            "AML compliance helps prevent the financing of terrorism.",
            "Transaction monitoring should be risk-based and adaptive.",
            "Banks must collaborate with each other to combat money laundering.",
            "Effective AML requires a combination of prevention, detection, and reporting.",
            "Regular updates and maintenance of AML systems are necessary.",
            "AML programs must align with international standards and regulations.",
            "Transaction monitoring helps protect the bank's assets.",
            "AML compliance is a key aspect of corporate governance.",
            "Banks must ensure all employees understand their AML responsibilities.",
            "Effective AML programs require a proactive approach.",
            "Technology advancements are reshaping AML practices.",
            "Banks must conduct ongoing due diligence for existing customers.",
            "AML systems should be able to identify unusual transaction patterns.",
            "Banks must keep abreast of emerging money laundering techniques.",
            "Compliance officers play a critical role in AML efforts.",
            "AML compliance helps maintain market integrity.",
            "Transaction monitoring should be both comprehensive and precise.",
            "Banks must ensure their AML measures are cost-effective.",
            "AML regulations help create a level playing field in the financial sector.",
            "Effective AML programs enhance customer confidence.",
            "Banks should use predictive analytics to improve AML efforts.",
            "AML compliance requires robust data management practices.",
            "Transaction monitoring systems should be customizable.",
            "Banks must regularly review and update their AML policies.",
            "Effective AML programs can mitigate legal and regulatory risks.",
            "Transaction monitoring should be integrated with other compliance systems.",
            "AML compliance is essential for financial stability.",
            "Banks must foster a culture of compliance to succeed in AML.",
            "Technology can help automate many aspects of AML compliance.",
            "AML programs should be designed to detect and deter money laundering.",
            "Banks must provide regular AML training to their employees.",
            "Effective AML requires strong internal controls and governance.",
            "Banks must ensure transparency in their AML reporting.",
            "AML compliance involves continuous monitoring and reporting.",
            "Banks should invest in cutting-edge technology for AML.",
            "Effective AML programs can enhance operational efficiency.",
            "Transaction monitoring is a vital tool in the fight against financial crime."
        ];

        foreach ($quotes as $quote) {
            DB::table('quotes')->insert([
                'quote' => $quote,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

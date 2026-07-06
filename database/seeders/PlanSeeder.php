<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    public function run(): void
    {
        $plans = [
            [
                'name' => 'Basic',
                'price' => 50000,
                'billing_cycle' => 'monthly',
                'max_agents' => 5,
                'max_calls_per_month' => 1000,
                'max_storage_mb' => 1024,
                'features' => ['call_logging', 'ticket_management', 'basic_reports'],
                'is_active' => true,
            ],
            [
                'name' => 'Pro',
                'price' => 150000,
                'billing_cycle' => 'monthly',
                'max_agents' => 20,
                'max_calls_per_month' => 5000,
                'max_storage_mb' => 5120,
                'features' => ['call_logging', 'ticket_management', 'advanced_reports', 'campaigns', 'callbacks', 'live_monitor'],
                'is_active' => true,
            ],
            [
                'name' => 'Enterprise',
                'price' => 500000,
                'billing_cycle' => 'monthly',
                'max_agents' => 100,
                'max_calls_per_month' => 50000,
                'max_storage_mb' => 20480,
                'features' => ['call_logging', 'ticket_management', 'advanced_reports', 'campaigns', 'callbacks', 'live_monitor', 'qa_evaluations', 'api_access', 'priority_support'],
                'is_active' => true,
            ],
        ];

        foreach ($plans as $plan) {
            Plan::firstOrCreate(['name' => $plan['name']], $plan);
        }
    }
}

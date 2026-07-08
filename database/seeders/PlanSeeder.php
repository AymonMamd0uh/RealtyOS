<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    public function run(): void
    {
        Plan::updateOrCreate(
            ['name' => 'Starter'],
            [
                'price' => 20,
                'max_users' => 10,
                'max_properties' => 500,
                'trial_days' => 14,
                'is_active' => true,
                'sort_order' => 1,
            ]
        );

        Plan::updateOrCreate(
            ['name' => 'Professional'],
            [
                'price' => 60,
                'max_users' => 50,
                'max_properties' => 1500,
                'trial_days' => 14,
                'is_active' => true,
                'sort_order' => 2,
            ]
        );

        Plan::updateOrCreate(
            ['name' => 'Enterprise'],
            [
                'price' => 100,
                'max_users' => -1,
                'max_properties' => -1,
                'trial_days' => 14,
                'is_active' => true,
                'sort_order' => 3,
            ]
        );
    }
}
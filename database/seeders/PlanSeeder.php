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
                'price' => 999,
                'max_users' => 5,
                'max_properties' => 300,
                'trial_days' => 14,
                'is_active' => true,
                'sort_order' => 1,
            ]
        );

        Plan::updateOrCreate(
            ['name' => 'Professional'],
            [
                'price' => 1999,
                'max_users' => 15,
                'max_properties' => 2000,
                'trial_days' => 14,
                'is_active' => true,
                'sort_order' => 2,
            ]
        );

        Plan::updateOrCreate(
            ['name' => 'Business'],
            [
                'price' => 3499,
                'max_users' => 50,
                'max_properties' => 10000,
                'trial_days' => 14,
                'is_active' => true,
                'sort_order' => 3,
            ]
        );
    }
}
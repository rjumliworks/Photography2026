<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PlanPricingsTableSeeder extends Seeder
{
    /**
     * Auto generated seeder file.
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('plan_pricings')->delete();
        
        \DB::table('plan_pricings')->insert(array (
            0 => 
            array (
                'id' => 1,
                'billing_cycle' => 'Daily',
                'amount' => '0.00',
                'discount' => '0.00',
                'currency_id' => 1,
                'plan_id' => 1,
                'created_at' => '2025-08-19 17:41:42',
                'updated_at' => '2025-08-19 17:41:42',
            ),
            1 => 
            array (
                'id' => 2,
                'billing_cycle' => 'Monthly',
                'amount' => '19.00',
                'discount' => '0.00',
                'currency_id' => 1,
                'plan_id' => 2,
                'created_at' => '2025-08-19 17:55:54',
                'updated_at' => '2025-08-19 17:55:54',
            ),
            2 => 
            array (
                'id' => 3,
                'billing_cycle' => 'Yearly',
                'amount' => '171.00',
                'discount' => '0.00',
                'currency_id' => 1,
                'plan_id' => 2,
                'created_at' => '2025-08-19 17:55:54',
                'updated_at' => '2025-08-19 17:55:54',
            ),
            3 => 
            array (
                'id' => 4,
                'billing_cycle' => 'Monthly',
                'amount' => '29.00',
                'discount' => '0.00',
                'currency_id' => 1,
                'plan_id' => 3,
                'created_at' => '2025-08-19 17:57:24',
                'updated_at' => '2025-08-19 17:57:24',
            ),
            4 => 
            array (
                'id' => 5,
                'billing_cycle' => 'Yearly',
                'amount' => '261.00',
                'discount' => '0.00',
                'currency_id' => 1,
                'plan_id' => 3,
                'created_at' => '2025-08-19 17:57:24',
                'updated_at' => '2025-08-19 17:57:24',
            ),
            5 => 
            array (
                'id' => 6,
                'billing_cycle' => 'Monthly',
                'amount' => '39.00',
                'discount' => '0.00',
                'currency_id' => 1,
                'plan_id' => 4,
                'created_at' => '2025-08-19 17:58:32',
                'updated_at' => '2025-08-19 17:58:32',
            ),
            6 => 
            array (
                'id' => 7,
                'billing_cycle' => 'Yearly',
                'amount' => '351.00',
                'discount' => '0.00',
                'currency_id' => 1,
                'plan_id' => 4,
                'created_at' => '2025-08-19 17:58:32',
                'updated_at' => '2025-08-19 17:58:32',
            ),
        ));

        
    }
}
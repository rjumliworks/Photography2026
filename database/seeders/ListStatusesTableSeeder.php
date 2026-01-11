<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ListStatusesTableSeeder extends Seeder
{
    /**
     * Auto generated seeder file.
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('list_statuses')->delete();
        
        \DB::table('list_statuses')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'n/a',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
                'created_at' => '2025-08-20 17:04:09',
                'updated_at' => '2025-08-20 17:04:09',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Trialing',
                'type' => 'Subscription',
                'color' => 'text-primary',
                'others' => 'bg-primary',
                'is_active' => 1,
                'created_at' => '2025-08-20 17:04:09',
                'updated_at' => '2025-08-20 17:04:09',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Active',
                'type' => 'Subscription',
                'color' => 'text-success',
                'others' => 'bg-success',
                'is_active' => 1,
                'created_at' => '2025-08-20 17:04:09',
                'updated_at' => '2025-08-20 17:04:09',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Expired',
                'type' => 'Subscription',
                'color' => 'text-danger',
                'others' => 'bg-danger',
                'is_active' => 1,
                'created_at' => '2025-08-20 17:04:09',
                'updated_at' => '2025-08-20 17:04:09',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Cancelled',
                'type' => 'Subscription',
                'color' => 'text-warning',
                'others' => 'bg-warning',
                'is_active' => 1,
                'created_at' => '2025-08-20 17:04:09',
                'updated_at' => '2025-08-20 17:04:09',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Payment Failed',
                'type' => 'Subscription',
                'color' => 'text-dark',
                'others' => 'bg-dark',
                'is_active' => 1,
                'created_at' => '2025-08-20 17:04:09',
                'updated_at' => '2025-08-20 17:04:09',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Draft',
                'type' => 'Invoive',
                'color' => 'text-warning',
                'others' => 'bg-warning',
                'is_active' => 1,
                'created_at' => '2025-08-20 17:04:09',
                'updated_at' => '2025-08-20 17:04:09',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Open',
                'type' => 'Invoive',
                'color' => 'text-info',
                'others' => 'bg-info',
                'is_active' => 1,
                'created_at' => '2025-08-20 17:04:09',
                'updated_at' => '2025-08-20 17:04:09',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Paid',
                'type' => 'Invoive',
                'color' => 'text-success',
                'others' => 'bg-success',
                'is_active' => 1,
                'created_at' => '2025-08-20 17:04:09',
                'updated_at' => '2025-08-20 17:04:09',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Void',
                'type' => 'Invoive',
                'color' => 'text-danger',
                'others' => 'bg-danger',
                'is_active' => 1,
                'created_at' => '2025-08-20 17:04:09',
                'updated_at' => '2025-08-20 17:04:09',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Trialing',
                'type' => 'History',
                'color' => 'text-primary',
                'others' => 'bg-primary',
                'is_active' => 1,
                'created_at' => '2025-08-20 17:04:09',
                'updated_at' => '2025-08-20 17:04:09',
            ),
        ));

        
    }
}
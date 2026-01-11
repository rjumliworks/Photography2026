<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PlansTableSeeder extends Seeder
{
    /**
     * Auto generated seeder file.
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('plans')->delete();
        
        \DB::table('plans')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => '7-Day Free Trial',
                'icon' => 'aw',
                'description' => 'Start your free trial and explore seamless uploads, storage, and sharing',
                'storage_size' => 5,
                'storage_unit' => 'MB',
                'storage_limit' => 5242880,
                'folders_limit' => 5,
                'features' => '[{"label": "1 Folders Limit", "value": "folders_limit", "active": true}, {"label": "5 MB Storage", "value": "storage_limit", "active": true}, {"label": "Watermark removal", "value": "watermark_removal", "active": false}, {"label": "Custom branding", "value": "custom_branding", "active": false}, {"label": "Priority support", "value": "priority_support", "active": false}]',
                'is_trial' => 0,
                'is_active' => 1,
                'created_at' => '2025-08-19 17:40:13',
                'updated_at' => '2025-08-19 17:40:13',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Starter Plan',
                'icon' => 'ri-camera-line',
                'description' => 'For individual photographers',
                'storage_size' => 100,
                'storage_unit' => 'GB',
                'storage_limit' => 107374182400,
                'folders_limit' => 20,
                'features' => '[{"label": "100 GB Storage", "value": "storage_limit", "active": true}, {"label": "5 Folders Limit", "value": "folders_limit", "active": true}, {"label": "Watermark removal", "value": "watermark_removal", "active": false}, {"label": "Custom branding", "value": "custom_branding", "active": false}, {"label": "Priority support", "value": "priority_support", "active": false}]',
                'is_trial' => 0,
                'is_active' => 1,
                'created_at' => '2025-08-19 17:55:54',
                'updated_at' => '2025-08-19 17:55:54',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Pro Plan',
                'icon' => 'ri-medal-fill',
                'description' => 'For growing studios',
                'storage_size' => 500,
                'storage_unit' => 'GB',
                'storage_limit' => 536870912000,
                'folders_limit' => 50,
                'features' => '[{"label": "500 GB Storage", "value": "storage_limit", "active": true}, {"label": "50 Folders Limit", "value": "folders_limit", "active": true}, {"label": "Watermark removal", "value": "watermark_removal", "active": true}, {"label": "Custom branding", "value": "custom_branding", "active": false}, {"label": "Priority support", "value": "priority_support", "active": false}]',
                'is_trial' => 0,
                'is_active' => 1,
                'created_at' => '2025-08-19 17:57:24',
                'updated_at' => '2025-08-19 17:57:24',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Studio Plan',
                'icon' => 'ri-stack-fill',
                'description' => 'For agencies & enterprises',
                'storage_size' => 2,
                'storage_unit' => 'TB',
                'storage_limit' => 2199023255552,
                'folders_limit' => 100,
                'features' => '[{"label": "2 TB Storage", "value": "storage_limit", "active": true}, {"label": "100 Folders Limit", "value": "folders_limit", "active": true}, {"label": "Watermark removal", "value": "watermark_removal", "active": true}, {"label": "Custom branding", "value": "custom_branding", "active": true}, {"label": "Priority support", "value": "priority_support", "active": true}]',
                'is_trial' => 0,
                'is_active' => 1,
                'created_at' => '2025-08-19 17:58:32',
                'updated_at' => '2025-08-19 17:58:32',
            ),
        ));

        
    }
}
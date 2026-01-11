<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ListGearsTableSeeder extends Seeder
{
    /**
     * Auto generated seeder file.
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('list_gears')->delete();
        
        \DB::table('list_gears')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Canon EOS 90D',
                'description' => '32.5MP APS-C DSLR camera',
                'brand_id' => 14,
                'type_id' => 103,
                'created_at' => '2025-08-16 17:54:54',
                'updated_at' => '2025-08-16 17:54:54',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Sony Alpha a7 III',
                'description' => 'Full-frame mirrorless camera',
                'brand_id' => 16,
                'type_id' => 103,
                'created_at' => '2025-08-16 17:56:45',
                'updated_at' => '2025-08-16 17:56:45',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Nikon D7500',
                'description' => '20.9MP DSLR camera',
                'brand_id' => 15,
                'type_id' => 103,
                'created_at' => '2025-08-16 17:56:45',
                'updated_at' => '2025-08-16 17:56:45',
            ),
        ));

        
    }
}
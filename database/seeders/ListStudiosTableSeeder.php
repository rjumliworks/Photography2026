<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ListStudiosTableSeeder extends Seeder
{
    /**
     * Auto generated seeder file.
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('list_studios')->delete();
        
        \DB::table('list_studios')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Default Studio',
                'email' => 'no-email@gmail.com',
                'phone' => '09123456789',
                'website' => NULL,
                'address' => NULL,
                'country_id' => 35,
                'created_at' => '2025-08-16 17:51:49',
                'updated_at' => '2025-08-16 17:51:52',
            ),
        ));

        
    }
}
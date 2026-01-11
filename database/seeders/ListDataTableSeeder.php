<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ListDataTableSeeder extends Seeder
{
    /**
     * Auto generated seeder file.
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('list_data')->delete();
        
        \DB::table('list_data')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'n/a',
                'type' => 'n/a',
                'is_active' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Male',
                'type' => 'Sex',
                'is_active' => 1,
            ),
            166 => 
            array (
                'id' => 167,
                'name' => 'Female',
                'type' => 'Sex',
                'is_active' => 1,
            ),
            167 => 
            array (
                'id' => 168,
                'name' => 'Jr.',
                'type' => 'Suffix',
                'is_active' => 1,
            ),
            168 => 
            array (
                'id' => 169,
                'name' => 'Sr.',
                'type' => 'Suffix',
                'is_active' => 1,
            ),
            169 => 
            array (
                'id' => 170,
                'name' => 'II',
                'type' => 'Suffix',
                'is_active' => 1,
            ),
            170 => 
            array (
                'id' => 171,
                'name' => 'III',
                'type' => 'Suffix',
                'is_active' => 1,
            ),
            171 => 
            array (
                'id' => 172,
                'name' => 'IV',
                'type' => 'Suffix',
                'is_active' => 1,
            )
        ));

        
    }
}
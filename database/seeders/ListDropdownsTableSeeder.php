<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ListDropdownsTableSeeder extends Seeder
{
    /**
     * Auto generated seeder file.
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('list_dropdowns')->delete();
        
        \DB::table('list_dropdowns')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'n/a',
                'classification' => 'n/a',
                'type' => 'n/a',
                'color' => 'n/a',
                'icon' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Only Me',
                'classification' => 'Visibility',
                'type' => 'Private',
                'color' => 'text-danger',
                'icon' => 'ri-lock-fill',
                'others' => 'Only the owner can see/access the folder.',
                'is_active' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Shared',
                'classification' => 'Visibility',
                'type' => 'Specific People / Groups',
                'color' => 'text-info',
                'icon' => 'ri-folder-user-fill',
            'others' => 'Visible to invited users, with permissions (view/comment/edit).',
                'is_active' => 1,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Public',
                'classification' => 'Visibility',
                'type' => 'Anyone with Link',
                'color' => 'text-primary',
                'icon' => 'ri-earth-fill',
            'others' => 'Anyone with the link can access, no login required (read-only or editable).',
                'is_active' => 1,
            ),
        ));

        
    }
}
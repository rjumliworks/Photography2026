<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ListRolesTableSeeder extends Seeder
{
    /**
     * Auto generated seeder file.
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('list_roles')->delete();
        
        \DB::table('list_roles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Administrator',
                'type' => 'Staff',
                'is_active' => 1,
                'definition' => 'Has full system access, including managing users, roles, and all system configurations',
                'created_at' => '2025-10-11 14:15:07',
                'updated_at' => '2025-10-11 14:15:07',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Photographer',
                'type' => 'Staff',
                'is_active' => 1,
                'definition' => 'Standard user role with access to personal records, DTR, leave filing, and travel requests.',
                'created_at' => '2025-10-11 14:15:07',
                'updated_at' => '2025-10-11 14:15:07',
            )
        ));

        
    }
}
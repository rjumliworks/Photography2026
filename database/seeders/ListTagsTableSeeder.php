<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ListTagsTableSeeder extends Seeder
{
    /**
     * Auto generated seeder file.
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('list_tags')->delete();
        
        \DB::table('list_tags')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Wedding',
                'category_id' => 104,
                'is_active' => 1,
                'created_at' => '2025-08-21 08:12:51',
                'updated_at' => '2025-08-21 08:12:51',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Engagement',
                'category_id' => 104,
                'is_active' => 1,
                'created_at' => '2025-08-21 08:12:51',
                'updated_at' => '2025-08-21 08:12:51',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Proposal',
                'category_id' => 104,
                'is_active' => 1,
                'created_at' => '2025-08-21 08:12:51',
                'updated_at' => '2025-08-21 08:12:51',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Anniversary',
                'category_id' => 104,
                'is_active' => 1,
                'created_at' => '2025-08-21 08:12:51',
                'updated_at' => '2025-08-21 08:12:51',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Pre-wedding / Prenup',
                'category_id' => 104,
                'is_active' => 1,
                'created_at' => '2025-08-21 08:12:51',
                'updated_at' => '2025-08-21 08:12:51',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Bridal Shower',
                'category_id' => 104,
                'is_active' => 1,
                'created_at' => '2025-08-21 08:12:51',
                'updated_at' => '2025-08-21 08:12:51',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Birthday',
                'category_id' => 105,
                'is_active' => 1,
                'created_at' => '2025-08-21 08:12:51',
                'updated_at' => '2025-08-21 08:12:51',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Christening / Baptism',
                'category_id' => 105,
                'is_active' => 1,
                'created_at' => '2025-08-21 08:12:51',
                'updated_at' => '2025-08-21 08:12:51',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'First Communion',
                'category_id' => 105,
                'is_active' => 1,
                'created_at' => '2025-08-21 08:12:51',
                'updated_at' => '2025-08-21 08:12:51',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Graduation',
                'category_id' => 105,
                'is_active' => 1,
                'created_at' => '2025-08-21 08:12:51',
                'updated_at' => '2025-08-21 08:12:51',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Family Portrait',
                'category_id' => 105,
                'is_active' => 1,
                'created_at' => '2025-08-21 08:12:51',
                'updated_at' => '2025-08-21 08:12:51',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'Newborn / Baby Shoot',
                'category_id' => 105,
                'is_active' => 1,
                'created_at' => '2025-08-21 08:12:51',
                'updated_at' => '2025-08-21 08:12:51',
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'Gender Reveal',
                'category_id' => 105,
                'is_active' => 1,
                'created_at' => '2025-08-21 08:12:51',
                'updated_at' => '2025-08-21 08:12:51',
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'Maternity',
                'category_id' => 105,
                'is_active' => 1,
                'created_at' => '2025-08-21 08:12:51',
                'updated_at' => '2025-08-21 08:12:51',
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'Party',
                'category_id' => 106,
                'is_active' => 1,
                'created_at' => '2025-08-21 08:12:51',
                'updated_at' => '2025-08-21 08:12:51',
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'Festival',
                'category_id' => 106,
                'is_active' => 1,
                'created_at' => '2025-08-21 08:12:51',
                'updated_at' => '2025-08-21 08:12:51',
            ),
            16 => 
            array (
                'id' => 17,
            'name' => 'Holiday (Christmas, New Year, Halloween, etc.)',
                'category_id' => 106,
                'is_active' => 1,
                'created_at' => '2025-08-21 08:12:51',
                'updated_at' => '2025-08-21 08:12:51',
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'Reunion',
                'category_id' => 106,
                'is_active' => 1,
                'created_at' => '2025-08-21 08:12:51',
                'updated_at' => '2025-08-21 08:12:51',
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'Corporate Event',
                'category_id' => 106,
                'is_active' => 1,
                'created_at' => '2025-08-21 08:12:51',
                'updated_at' => '2025-08-21 08:12:51',
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'Award Ceremony',
                'category_id' => 106,
                'is_active' => 1,
                'created_at' => '2025-08-21 08:12:51',
                'updated_at' => '2025-08-21 08:12:51',
            ),
            20 => 
            array (
                'id' => 21,
                'name' => 'Corporate Headshot',
                'category_id' => 107,
                'is_active' => 1,
                'created_at' => '2025-08-21 08:12:51',
                'updated_at' => '2025-08-21 08:12:51',
            ),
            21 => 
            array (
                'id' => 22,
                'name' => 'Business Event',
                'category_id' => 107,
                'is_active' => 1,
                'created_at' => '2025-08-21 08:12:51',
                'updated_at' => '2025-08-21 08:12:51',
            ),
            22 => 
            array (
                'id' => 23,
                'name' => 'Product Photography',
                'category_id' => 107,
                'is_active' => 1,
                'created_at' => '2025-08-21 08:12:51',
                'updated_at' => '2025-08-21 08:12:51',
            ),
            23 => 
            array (
                'id' => 24,
                'name' => 'Fashion Shoot',
                'category_id' => 107,
                'is_active' => 1,
                'created_at' => '2025-08-21 08:12:51',
                'updated_at' => '2025-08-21 08:12:51',
            ),
            24 => 
            array (
                'id' => 25,
                'name' => 'Editorial',
                'category_id' => 107,
                'is_active' => 1,
                'created_at' => '2025-08-21 08:12:51',
                'updated_at' => '2025-08-21 08:12:51',
            ),
            25 => 
            array (
                'id' => 26,
                'name' => 'Model Portfolio',
                'category_id' => 107,
                'is_active' => 1,
                'created_at' => '2025-08-21 08:12:51',
                'updated_at' => '2025-08-21 08:12:51',
            ),
            26 => 
            array (
                'id' => 27,
                'name' => 'Workshop / Seminar',
                'category_id' => 107,
                'is_active' => 1,
                'created_at' => '2025-08-21 08:12:51',
                'updated_at' => '2025-08-21 08:12:51',
            ),
            27 => 
            array (
                'id' => 28,
                'name' => 'Travel',
                'category_id' => 108,
                'is_active' => 1,
                'created_at' => '2025-08-21 08:12:51',
                'updated_at' => '2025-08-21 08:12:51',
            ),
            28 => 
            array (
                'id' => 29,
                'name' => 'Adventure',
                'category_id' => 108,
                'is_active' => 1,
                'created_at' => '2025-08-21 08:12:51',
                'updated_at' => '2025-08-21 08:12:51',
            ),
            29 => 
            array (
                'id' => 30,
                'name' => 'Nature',
                'category_id' => 108,
                'is_active' => 1,
                'created_at' => '2025-08-21 08:12:51',
                'updated_at' => '2025-08-21 08:12:51',
            ),
            30 => 
            array (
                'id' => 31,
                'name' => 'Landscape',
                'category_id' => 108,
                'is_active' => 1,
                'created_at' => '2025-08-21 08:12:51',
                'updated_at' => '2025-08-21 08:12:51',
            ),
            31 => 
            array (
                'id' => 32,
                'name' => 'Street Photography',
                'category_id' => 108,
                'is_active' => 1,
                'created_at' => '2025-08-21 08:12:51',
                'updated_at' => '2025-08-21 08:12:51',
            ),
            32 => 
            array (
                'id' => 33,
                'name' => 'Wildlife',
                'category_id' => 108,
                'is_active' => 1,
                'created_at' => '2025-08-21 08:12:51',
                'updated_at' => '2025-08-21 08:12:51',
            ),
            33 => 
            array (
                'id' => 34,
                'name' => 'Sports',
                'category_id' => 108,
                'is_active' => 1,
                'created_at' => '2025-08-21 08:12:51',
                'updated_at' => '2025-08-21 08:12:51',
            ),
            34 => 
            array (
                'id' => 35,
                'name' => 'Concert',
                'category_id' => 109,
                'is_active' => 1,
                'created_at' => '2025-08-21 08:12:51',
                'updated_at' => '2025-08-21 08:12:51',
            ),
            35 => 
            array (
                'id' => 36,
                'name' => 'Theater / Performance',
                'category_id' => 109,
                'is_active' => 1,
                'created_at' => '2025-08-21 08:12:51',
                'updated_at' => '2025-08-21 08:12:51',
            ),
            36 => 
            array (
                'id' => 37,
                'name' => 'Exhibition',
                'category_id' => 109,
                'is_active' => 1,
                'created_at' => '2025-08-21 08:12:51',
                'updated_at' => '2025-08-21 08:12:51',
            ),
            37 => 
            array (
                'id' => 38,
                'name' => 'Art Shoot',
                'category_id' => 109,
                'is_active' => 1,
                'created_at' => '2025-08-21 08:12:51',
                'updated_at' => '2025-08-21 08:12:51',
            ),
            38 => 
            array (
                'id' => 39,
                'name' => 'Dance Recital',
                'category_id' => 109,
                'is_active' => 1,
                'created_at' => '2025-08-21 08:12:51',
                'updated_at' => '2025-08-21 08:12:51',
            ),
        ));

        
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ListNamesTableSeeder extends Seeder
{
    /**
     * Auto generated seeder file.
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('list_names')->delete();
        
        \DB::table('list_names')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'n/a',
                'short' => NULL,
                'type' => 'n/a',
                'is_active' => 1,
                'created_at' => '2025-08-16 16:56:49',
                'updated_at' => '2025-08-16 16:56:49',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Camera Body',
                'short' => NULL,
                'type' => 'Gear Type',
                'is_active' => 1,
                'created_at' => '2025-08-16 16:57:10',
                'updated_at' => '2025-08-16 16:57:10',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Lens',
                'short' => NULL,
                'type' => 'Gear Type',
                'is_active' => 1,
                'created_at' => '2025-08-16 16:57:10',
                'updated_at' => '2025-08-16 16:57:10',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Flash / Speedlight',
                'short' => NULL,
                'type' => 'Gear Type',
                'is_active' => 1,
                'created_at' => '2025-08-16 16:57:10',
                'updated_at' => '2025-08-16 16:57:10',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Lighting Equipment',
                'short' => NULL,
                'type' => 'Gear Type',
                'is_active' => 1,
                'created_at' => '2025-08-16 16:57:10',
                'updated_at' => '2025-08-16 16:57:10',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Light Modifier',
                'short' => NULL,
                'type' => 'Gear Type',
                'is_active' => 1,
                'created_at' => '2025-08-16 16:57:10',
                'updated_at' => '2025-08-16 16:57:10',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Tripod / Support',
                'short' => NULL,
                'type' => 'Gear Type',
                'is_active' => 1,
                'created_at' => '2025-08-16 16:57:10',
                'updated_at' => '2025-08-16 16:57:10',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Drone',
                'short' => NULL,
                'type' => 'Gear Type',
                'is_active' => 1,
                'created_at' => '2025-08-16 16:57:10',
                'updated_at' => '2025-08-16 16:57:10',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Action Camera',
                'short' => NULL,
                'type' => 'Gear Type',
                'is_active' => 1,
                'created_at' => '2025-08-16 16:57:10',
                'updated_at' => '2025-08-16 16:57:10',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Audio Equipment',
                'short' => NULL,
                'type' => 'Gear Type',
                'is_active' => 1,
                'created_at' => '2025-08-16 16:57:10',
                'updated_at' => '2025-08-16 16:57:10',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Bag / Case',
                'short' => NULL,
                'type' => 'Gear Type',
                'is_active' => 1,
                'created_at' => '2025-08-16 16:57:10',
                'updated_at' => '2025-08-16 16:57:10',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'Computer / Editing Gear',
                'short' => NULL,
                'type' => 'Gear Type',
                'is_active' => 1,
                'created_at' => '2025-08-16 16:57:10',
                'updated_at' => '2025-08-16 16:57:10',
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'Accessory',
                'short' => NULL,
                'type' => 'Gear Type',
                'is_active' => 1,
                'created_at' => '2025-08-16 16:57:10',
                'updated_at' => '2025-08-16 16:57:10',
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'Canon',
                'short' => NULL,
                'type' => 'Brand',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:00:40',
                'updated_at' => '2025-08-16 17:00:40',
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'Nikon',
                'short' => NULL,
                'type' => 'Brand',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:00:40',
                'updated_at' => '2025-08-16 17:00:40',
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'Sony',
                'short' => NULL,
                'type' => 'Brand',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:00:40',
                'updated_at' => '2025-08-16 17:00:40',
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'Fujifilm',
                'short' => NULL,
                'type' => 'Brand',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:00:40',
                'updated_at' => '2025-08-16 17:00:40',
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'Panasonic',
                'short' => NULL,
                'type' => 'Brand',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:00:40',
                'updated_at' => '2025-08-16 17:00:40',
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'Olympus',
                'short' => NULL,
                'type' => 'Brand',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:00:40',
                'updated_at' => '2025-08-16 17:00:40',
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'Leica',
                'short' => NULL,
                'type' => 'Brand',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:00:40',
                'updated_at' => '2025-08-16 17:00:40',
            ),
            20 => 
            array (
                'id' => 21,
                'name' => 'Pentax',
                'short' => NULL,
                'type' => 'Brand',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:00:40',
                'updated_at' => '2025-08-16 17:00:40',
            ),
            21 => 
            array (
                'id' => 22,
                'name' => 'Hasselblad',
                'short' => NULL,
                'type' => 'Brand',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:00:40',
                'updated_at' => '2025-08-16 17:00:40',
            ),
            22 => 
            array (
                'id' => 23,
                'name' => 'Phase One',
                'short' => NULL,
                'type' => 'Brand',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:00:40',
                'updated_at' => '2025-08-16 17:00:40',
            ),
            23 => 
            array (
                'id' => 24,
                'name' => 'Sigma',
                'short' => NULL,
                'type' => 'Brand',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:00:40',
                'updated_at' => '2025-08-16 17:00:40',
            ),
            24 => 
            array (
                'id' => 25,
                'name' => 'Tamron',
                'short' => NULL,
                'type' => 'Brand',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:00:40',
                'updated_at' => '2025-08-16 17:00:40',
            ),
            25 => 
            array (
                'id' => 26,
                'name' => 'Zeiss',
                'short' => NULL,
                'type' => 'Brand',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:00:40',
                'updated_at' => '2025-08-16 17:00:40',
            ),
            26 => 
            array (
                'id' => 27,
                'name' => 'Samyang',
                'short' => NULL,
                'type' => 'Brand',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:00:40',
                'updated_at' => '2025-08-16 17:00:40',
            ),
            27 => 
            array (
                'id' => 28,
                'name' => 'Rokinon',
                'short' => NULL,
                'type' => 'Brand',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:00:40',
                'updated_at' => '2025-08-16 17:00:40',
            ),
            28 => 
            array (
                'id' => 29,
                'name' => 'Laowa',
                'short' => NULL,
                'type' => 'Brand',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:00:40',
                'updated_at' => '2025-08-16 17:00:40',
            ),
            29 => 
            array (
                'id' => 30,
                'name' => 'Tokina',
                'short' => NULL,
                'type' => 'Brand',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:00:40',
                'updated_at' => '2025-08-16 17:00:40',
            ),
            30 => 
            array (
                'id' => 31,
                'name' => 'Godox',
                'short' => NULL,
                'type' => 'Brand',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:00:40',
                'updated_at' => '2025-08-16 17:00:40',
            ),
            31 => 
            array (
                'id' => 32,
                'name' => 'Yongnuo',
                'short' => NULL,
                'type' => 'Brand',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:00:40',
                'updated_at' => '2025-08-16 17:00:40',
            ),
            32 => 
            array (
                'id' => 33,
                'name' => 'Nissin',
                'short' => NULL,
                'type' => 'Brand',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:00:40',
                'updated_at' => '2025-08-16 17:00:40',
            ),
            33 => 
            array (
                'id' => 34,
                'name' => 'Metz',
                'short' => NULL,
                'type' => 'Brand',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:00:40',
                'updated_at' => '2025-08-16 17:00:40',
            ),
            34 => 
            array (
                'id' => 35,
                'name' => 'Profoto',
                'short' => NULL,
                'type' => 'Brand',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:00:40',
                'updated_at' => '2025-08-16 17:00:40',
            ),
            35 => 
            array (
                'id' => 36,
                'name' => 'Elinchrom',
                'short' => NULL,
                'type' => 'Brand',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:00:40',
                'updated_at' => '2025-08-16 17:00:40',
            ),
            36 => 
            array (
                'id' => 37,
                'name' => 'Broncolor',
                'short' => NULL,
                'type' => 'Brand',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:00:40',
                'updated_at' => '2025-08-16 17:00:40',
            ),
            37 => 
            array (
                'id' => 38,
                'name' => 'Neewer',
                'short' => NULL,
                'type' => 'Brand',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:00:40',
                'updated_at' => '2025-08-16 17:00:40',
            ),
            38 => 
            array (
                'id' => 39,
                'name' => 'Aputure',
                'short' => NULL,
                'type' => 'Brand',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:00:40',
                'updated_at' => '2025-08-16 17:00:40',
            ),
            39 => 
            array (
                'id' => 40,
                'name' => 'Westcott',
                'short' => NULL,
                'type' => 'Brand',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:00:40',
                'updated_at' => '2025-08-16 17:00:40',
            ),
            40 => 
            array (
                'id' => 41,
                'name' => 'Lastolite',
                'short' => NULL,
                'type' => 'Brand',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:00:40',
                'updated_at' => '2025-08-16 17:00:40',
            ),
            41 => 
            array (
                'id' => 42,
                'name' => 'Phottix',
                'short' => NULL,
                'type' => 'Brand',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:00:40',
                'updated_at' => '2025-08-16 17:00:40',
            ),
            42 => 
            array (
                'id' => 43,
                'name' => 'Manfrotto',
                'short' => NULL,
                'type' => 'Brand',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:00:40',
                'updated_at' => '2025-08-16 17:00:40',
            ),
            43 => 
            array (
                'id' => 44,
                'name' => 'Gitzo',
                'short' => NULL,
                'type' => 'Brand',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:00:40',
                'updated_at' => '2025-08-16 17:00:40',
            ),
            44 => 
            array (
                'id' => 45,
                'name' => 'Benro',
                'short' => NULL,
                'type' => 'Brand',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:00:40',
                'updated_at' => '2025-08-16 17:00:40',
            ),
            45 => 
            array (
                'id' => 46,
                'name' => 'Vanguard',
                'short' => NULL,
                'type' => 'Brand',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:00:40',
                'updated_at' => '2025-08-16 17:00:40',
            ),
            46 => 
            array (
                'id' => 47,
                'name' => 'Joby',
                'short' => NULL,
                'type' => 'Brand',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:00:40',
                'updated_at' => '2025-08-16 17:00:40',
            ),
            47 => 
            array (
                'id' => 48,
                'name' => 'Peak Design',
                'short' => NULL,
                'type' => 'Brand',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:00:40',
                'updated_at' => '2025-08-16 17:00:40',
            ),
            48 => 
            array (
                'id' => 49,
                'name' => 'SmallRig',
                'short' => NULL,
                'type' => 'Brand',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:00:40',
                'updated_at' => '2025-08-16 17:00:40',
            ),
            49 => 
            array (
                'id' => 50,
                'name' => 'DJI',
                'short' => NULL,
                'type' => 'Brand',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:00:40',
                'updated_at' => '2025-08-16 17:00:40',
            ),
            50 => 
            array (
                'id' => 51,
                'name' => 'Autel Robotics',
                'short' => NULL,
                'type' => 'Brand',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:00:40',
                'updated_at' => '2025-08-16 17:00:40',
            ),
            51 => 
            array (
                'id' => 52,
                'name' => 'Parrot',
                'short' => NULL,
                'type' => 'Brand',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:00:40',
                'updated_at' => '2025-08-16 17:00:40',
            ),
            52 => 
            array (
                'id' => 53,
                'name' => 'GoPro',
                'short' => NULL,
                'type' => 'Brand',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:00:40',
                'updated_at' => '2025-08-16 17:00:40',
            ),
            53 => 
            array (
                'id' => 54,
                'name' => 'Insta360',
                'short' => NULL,
                'type' => 'Brand',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:00:40',
                'updated_at' => '2025-08-16 17:00:40',
            ),
            54 => 
            array (
                'id' => 55,
                'name' => 'DJI Osmo Action',
                'short' => NULL,
                'type' => 'Brand',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:00:40',
                'updated_at' => '2025-08-16 17:00:40',
            ),
            55 => 
            array (
                'id' => 56,
                'name' => 'Rode',
                'short' => NULL,
                'type' => 'Brand',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:00:40',
                'updated_at' => '2025-08-16 17:00:40',
            ),
            56 => 
            array (
                'id' => 57,
                'name' => 'Zoom',
                'short' => NULL,
                'type' => 'Brand',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:00:40',
                'updated_at' => '2025-08-16 17:00:40',
            ),
            57 => 
            array (
                'id' => 58,
                'name' => 'Sennheiser',
                'short' => NULL,
                'type' => 'Brand',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:00:40',
                'updated_at' => '2025-08-16 17:00:40',
            ),
            58 => 
            array (
                'id' => 59,
                'name' => 'Shure',
                'short' => NULL,
                'type' => 'Brand',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:00:40',
                'updated_at' => '2025-08-16 17:00:40',
            ),
            59 => 
            array (
                'id' => 60,
                'name' => 'Tascam',
                'short' => NULL,
                'type' => 'Brand',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:00:40',
                'updated_at' => '2025-08-16 17:00:40',
            ),
            60 => 
            array (
                'id' => 61,
                'name' => 'Lowepro',
                'short' => NULL,
                'type' => 'Brand',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:00:40',
                'updated_at' => '2025-08-16 17:00:40',
            ),
            61 => 
            array (
                'id' => 62,
                'name' => 'Think Tank Photo',
                'short' => NULL,
                'type' => 'Brand',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:00:40',
                'updated_at' => '2025-08-16 17:00:40',
            ),
            62 => 
            array (
                'id' => 63,
                'name' => 'Apple',
                'short' => NULL,
                'type' => 'Brand',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:00:40',
                'updated_at' => '2025-08-16 17:00:40',
            ),
            63 => 
            array (
                'id' => 64,
                'name' => 'Dell',
                'short' => NULL,
                'type' => 'Brand',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:00:40',
                'updated_at' => '2025-08-16 17:00:40',
            ),
            64 => 
            array (
                'id' => 65,
                'name' => 'Eizo',
                'short' => NULL,
                'type' => 'Brand',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:00:40',
                'updated_at' => '2025-08-16 17:00:40',
            ),
            65 => 
            array (
                'id' => 66,
                'name' => 'BenQ',
                'short' => NULL,
                'type' => 'Brand',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:00:40',
                'updated_at' => '2025-08-16 17:00:40',
            ),
            66 => 
            array (
                'id' => 67,
                'name' => 'Wacom',
                'short' => NULL,
                'type' => 'Brand',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:00:40',
                'updated_at' => '2025-08-16 17:00:40',
            ),
            67 => 
            array (
                'id' => 68,
                'name' => 'SanDisk',
                'short' => NULL,
                'type' => 'Brand',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:00:40',
                'updated_at' => '2025-08-16 17:00:40',
            ),
            68 => 
            array (
                'id' => 69,
                'name' => 'Lexar',
                'short' => NULL,
                'type' => 'Brand',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:00:40',
                'updated_at' => '2025-08-16 17:00:40',
            ),
            69 => 
            array (
                'id' => 70,
                'name' => 'Samsung',
                'short' => NULL,
                'type' => 'Brand',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:00:40',
                'updated_at' => '2025-08-16 17:00:40',
            ),
            70 => 
            array (
                'id' => 71,
                'name' => 'Kingston',
                'short' => NULL,
                'type' => 'Brand',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:00:40',
                'updated_at' => '2025-08-16 17:00:40',
            ),
            71 => 
            array (
                'id' => 72,
                'name' => 'Transcend',
                'short' => NULL,
                'type' => 'Brand',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:00:40',
                'updated_at' => '2025-08-16 17:00:40',
            ),
            72 => 
            array (
                'id' => 73,
                'name' => 'Angelbird',
                'short' => NULL,
                'type' => 'Brand',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:00:40',
                'updated_at' => '2025-08-16 17:00:40',
            ),
            73 => 
            array (
                'id' => 74,
                'name' => 'Seagate',
                'short' => NULL,
                'type' => 'Brand',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:00:40',
                'updated_at' => '2025-08-16 17:00:40',
            ),
            74 => 
            array (
                'id' => 75,
                'name' => 'Western Digital',
                'short' => NULL,
                'type' => 'Brand',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:00:40',
                'updated_at' => '2025-08-16 17:00:40',
            ),
            75 => 
            array (
                'id' => 76,
                'name' => 'Wedding Photography',
                'short' => NULL,
                'type' => 'Specialization',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:35:04',
                'updated_at' => '2025-08-16 17:35:04',
            ),
            76 => 
            array (
                'id' => 77,
                'name' => 'Portrait Photography',
                'short' => NULL,
                'type' => 'Specialization',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:35:04',
                'updated_at' => '2025-08-16 17:35:04',
            ),
            77 => 
            array (
                'id' => 78,
                'name' => 'Fashion Photography',
                'short' => NULL,
                'type' => 'Specialization',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:35:04',
                'updated_at' => '2025-08-16 17:35:04',
            ),
            78 => 
            array (
                'id' => 79,
                'name' => 'Event Photography',
                'short' => NULL,
                'type' => 'Specialization',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:35:04',
                'updated_at' => '2025-08-16 17:35:04',
            ),
            79 => 
            array (
                'id' => 80,
                'name' => 'Sports Photography',
                'short' => NULL,
                'type' => 'Specialization',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:35:04',
                'updated_at' => '2025-08-16 17:35:04',
            ),
            80 => 
            array (
                'id' => 81,
                'name' => 'Wildlife Photography',
                'short' => NULL,
                'type' => 'Specialization',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:35:04',
                'updated_at' => '2025-08-16 17:35:04',
            ),
            81 => 
            array (
                'id' => 82,
                'name' => 'Landscape Photography',
                'short' => NULL,
                'type' => 'Specialization',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:35:04',
                'updated_at' => '2025-08-16 17:35:04',
            ),
            82 => 
            array (
                'id' => 83,
                'name' => 'Product Photography',
                'short' => NULL,
                'type' => 'Specialization',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:35:04',
                'updated_at' => '2025-08-16 17:35:04',
            ),
            83 => 
            array (
                'id' => 84,
                'name' => 'Food Photography',
                'short' => NULL,
                'type' => 'Specialization',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:35:04',
                'updated_at' => '2025-08-16 17:35:04',
            ),
            84 => 
            array (
                'id' => 85,
                'name' => 'Real Estate Photography',
                'short' => NULL,
                'type' => 'Specialization',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:35:04',
                'updated_at' => '2025-08-16 17:35:04',
            ),
            85 => 
            array (
                'id' => 86,
                'name' => 'Travel Photography',
                'short' => NULL,
                'type' => 'Specialization',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:35:04',
                'updated_at' => '2025-08-16 17:35:04',
            ),
            86 => 
            array (
                'id' => 87,
                'name' => 'Newborn / Family Photography',
                'short' => NULL,
                'type' => 'Specialization',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:35:04',
                'updated_at' => '2025-08-16 17:35:04',
            ),
            87 => 
            array (
                'id' => 88,
                'name' => 'Street Photography',
                'short' => NULL,
                'type' => 'Specialization',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:35:04',
                'updated_at' => '2025-08-16 17:35:04',
            ),
            88 => 
            array (
                'id' => 89,
                'name' => 'Aerial / Drone Photography',
                'short' => NULL,
                'type' => 'Specialization',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:35:04',
                'updated_at' => '2025-08-16 17:35:04',
            ),
            89 => 
            array (
                'id' => 90,
                'name' => 'Wedding Videography',
                'short' => NULL,
                'type' => 'Specialization',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:35:04',
                'updated_at' => '2025-08-16 17:35:04',
            ),
            90 => 
            array (
                'id' => 91,
                'name' => 'Event Videography',
                'short' => NULL,
                'type' => 'Specialization',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:35:04',
                'updated_at' => '2025-08-16 17:35:04',
            ),
            91 => 
            array (
                'id' => 92,
                'name' => 'Corporate / Commercial Videography',
                'short' => NULL,
                'type' => 'Specialization',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:35:04',
                'updated_at' => '2025-08-16 17:35:04',
            ),
            92 => 
            array (
                'id' => 93,
                'name' => 'Music Videos',
                'short' => NULL,
                'type' => 'Specialization',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:35:04',
                'updated_at' => '2025-08-16 17:35:04',
            ),
            93 => 
            array (
                'id' => 94,
                'name' => 'Short Films',
                'short' => NULL,
                'type' => 'Specialization',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:35:04',
                'updated_at' => '2025-08-16 17:35:04',
            ),
            94 => 
            array (
                'id' => 95,
                'name' => 'Documentaries',
                'short' => NULL,
                'type' => 'Specialization',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:35:04',
                'updated_at' => '2025-08-16 17:35:04',
            ),
            95 => 
            array (
                'id' => 96,
                'name' => 'Real Estate Videography',
                'short' => NULL,
                'type' => 'Specialization',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:35:04',
                'updated_at' => '2025-08-16 17:35:04',
            ),
            96 => 
            array (
                'id' => 97,
                'name' => 'Travel Videography',
                'short' => NULL,
                'type' => 'Specialization',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:35:04',
                'updated_at' => '2025-08-16 17:35:04',
            ),
            97 => 
            array (
                'id' => 98,
                'name' => 'Aerial / Drone Videography',
                'short' => NULL,
                'type' => 'Specialization',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:35:04',
                'updated_at' => '2025-08-16 17:35:04',
            ),
            98 => 
            array (
                'id' => 99,
                'name' => 'Live Event Streaming',
                'short' => NULL,
                'type' => 'Specialization',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:35:04',
                'updated_at' => '2025-08-16 17:35:04',
            ),
            99 => 
            array (
                'id' => 100,
            'name' => 'Wedding (Photo + Video)',
                'short' => NULL,
                'type' => 'Specialization',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:35:04',
                'updated_at' => '2025-08-16 17:35:04',
            ),
            100 => 
            array (
                'id' => 101,
            'name' => 'Events (Photo + Video)',
                'short' => NULL,
                'type' => 'Specialization',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:35:04',
                'updated_at' => '2025-08-16 17:35:04',
            ),
            101 => 
            array (
                'id' => 102,
                'name' => 'Commercial / Brand Content',
                'short' => NULL,
                'type' => 'Specialization',
                'is_active' => 1,
                'created_at' => '2025-08-16 17:35:04',
                'updated_at' => '2025-08-16 17:35:04',
            ),
            102 => 
            array (
                'id' => 103,
                'name' => 'DSLR',
                'short' => NULL,
                'type' => 'Gear Type',
                'is_active' => 1,
                'created_at' => '2025-08-16 16:57:10',
                'updated_at' => '2025-08-16 16:57:10',
            ),
            103 => 
            array (
                'id' => 104,
                'name' => 'Weddings & Love',
                'short' => NULL,
                'type' => 'Category',
                'is_active' => 1,
                'created_at' => '2025-08-16 16:57:10',
                'updated_at' => '2025-08-16 16:57:10',
            ),
            104 => 
            array (
                'id' => 105,
                'name' => 'Family & Personal',
                'short' => NULL,
                'type' => 'Category',
                'is_active' => 1,
                'created_at' => '2025-08-16 16:57:10',
                'updated_at' => '2025-08-16 16:57:10',
            ),
            105 => 
            array (
                'id' => 106,
                'name' => 'Celebrations & Social',
                'short' => NULL,
                'type' => 'Category',
                'is_active' => 1,
                'created_at' => '2025-08-16 16:57:10',
                'updated_at' => '2025-08-16 16:57:10',
            ),
            106 => 
            array (
                'id' => 107,
                'name' => 'Professional & Creative',
                'short' => NULL,
                'type' => 'Category',
                'is_active' => 1,
                'created_at' => '2025-08-16 16:57:10',
                'updated_at' => '2025-08-16 16:57:10',
            ),
            107 => 
            array (
                'id' => 108,
                'name' => 'Outdoor & Lifestyle',
                'short' => NULL,
                'type' => 'Category',
                'is_active' => 1,
                'created_at' => '2025-08-16 16:57:10',
                'updated_at' => '2025-08-16 16:57:10',
            ),
            108 => 
            array (
                'id' => 109,
                'name' => 'Arts & Special',
                'short' => NULL,
                'type' => 'Category',
                'is_active' => 1,
                'created_at' => '2025-08-16 16:57:10',
                'updated_at' => '2025-08-16 16:57:10',
            ),
        ));

        
    }
}
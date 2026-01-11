<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ListCurrenciesTableSeeder extends Seeder
{
    /**
     * Auto generated seeder file.
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('list_currencies')->delete();
        
        \DB::table('list_currencies')->insert(array (
            0 => 
            array (
                'id' => 1,
                'code' => 'USD',
                'symbol' => '$',
                'name' => 'US Dollar',
                'created_at' => '2025-08-17 10:58:49',
                'updated_at' => '2025-08-17 10:58:49',
            ),
            1 => 
            array (
                'id' => 2,
                'code' => 'EUR',
                'symbol' => '€',
                'name' => 'Euro',
                'created_at' => '2025-08-17 10:58:49',
                'updated_at' => '2025-08-17 10:58:49',
            ),
            2 => 
            array (
                'id' => 3,
                'code' => 'GBP',
                'symbol' => '£',
                'name' => 'British Pound Sterling',
                'created_at' => '2025-08-17 10:58:49',
                'updated_at' => '2025-08-17 10:58:49',
            ),
            3 => 
            array (
                'id' => 4,
                'code' => 'JPY',
                'symbol' => '¥',
                'name' => 'Japanese Yen',
                'created_at' => '2025-08-17 10:58:49',
                'updated_at' => '2025-08-17 10:58:49',
            ),
            4 => 
            array (
                'id' => 5,
                'code' => 'CNY',
                'symbol' => '¥',
                'name' => 'Chinese Yuan',
                'created_at' => '2025-08-17 10:58:49',
                'updated_at' => '2025-08-17 10:58:49',
            ),
            5 => 
            array (
                'id' => 6,
                'code' => 'HKD',
                'symbol' => 'HK$',
                'name' => 'Hong Kong Dollar',
                'created_at' => '2025-08-17 10:58:49',
                'updated_at' => '2025-08-17 10:58:49',
            ),
            6 => 
            array (
                'id' => 7,
                'code' => 'SGD',
                'symbol' => 'S$',
                'name' => 'Singapore Dollar',
                'created_at' => '2025-08-17 10:58:49',
                'updated_at' => '2025-08-17 10:58:49',
            ),
            7 => 
            array (
                'id' => 8,
                'code' => 'AUD',
                'symbol' => 'A$',
                'name' => 'Australian Dollar',
                'created_at' => '2025-08-17 10:58:49',
                'updated_at' => '2025-08-17 10:58:49',
            ),
            8 => 
            array (
                'id' => 9,
                'code' => 'NZD',
                'symbol' => 'NZ$',
                'name' => 'New Zealand Dollar',
                'created_at' => '2025-08-17 10:58:49',
                'updated_at' => '2025-08-17 10:58:49',
            ),
            9 => 
            array (
                'id' => 10,
                'code' => 'CAD',
                'symbol' => 'CA$',
                'name' => 'Canadian Dollar',
                'created_at' => '2025-08-17 10:58:49',
                'updated_at' => '2025-08-17 10:58:49',
            ),
            10 => 
            array (
                'id' => 11,
                'code' => 'CHF',
                'symbol' => 'CHF',
                'name' => 'Swiss Franc',
                'created_at' => '2025-08-17 10:58:49',
                'updated_at' => '2025-08-17 10:58:49',
            ),
            11 => 
            array (
                'id' => 12,
                'code' => 'SEK',
                'symbol' => 'kr',
                'name' => 'Swedish Krona',
                'created_at' => '2025-08-17 10:58:49',
                'updated_at' => '2025-08-17 10:58:49',
            ),
            12 => 
            array (
                'id' => 13,
                'code' => 'NOK',
                'symbol' => 'kr',
                'name' => 'Norwegian Krone',
                'created_at' => '2025-08-17 10:58:49',
                'updated_at' => '2025-08-17 10:58:49',
            ),
            13 => 
            array (
                'id' => 14,
                'code' => 'DKK',
                'symbol' => 'kr',
                'name' => 'Danish Krone',
                'created_at' => '2025-08-17 10:58:49',
                'updated_at' => '2025-08-17 10:58:49',
            ),
            14 => 
            array (
                'id' => 15,
                'code' => 'INR',
                'symbol' => '₹',
                'name' => 'Indian Rupee',
                'created_at' => '2025-08-17 10:58:49',
                'updated_at' => '2025-08-17 10:58:49',
            ),
            15 => 
            array (
                'id' => 16,
                'code' => 'PHP',
                'symbol' => '₱',
                'name' => 'Philippine Peso',
                'created_at' => '2025-08-17 10:58:49',
                'updated_at' => '2025-08-17 10:58:49',
            ),
            16 => 
            array (
                'id' => 17,
                'code' => 'THB',
                'symbol' => '฿',
                'name' => 'Thai Baht',
                'created_at' => '2025-08-17 10:58:49',
                'updated_at' => '2025-08-17 10:58:49',
            ),
            17 => 
            array (
                'id' => 18,
                'code' => 'MYR',
                'symbol' => 'RM',
                'name' => 'Malaysian Ringgit',
                'created_at' => '2025-08-17 10:58:49',
                'updated_at' => '2025-08-17 10:58:49',
            ),
            18 => 
            array (
                'id' => 19,
                'code' => 'IDR',
                'symbol' => 'Rp',
                'name' => 'Indonesian Rupiah',
                'created_at' => '2025-08-17 10:58:49',
                'updated_at' => '2025-08-17 10:58:49',
            ),
            19 => 
            array (
                'id' => 20,
                'code' => 'KRW',
                'symbol' => '₩',
                'name' => 'South Korean Won',
                'created_at' => '2025-08-17 10:58:49',
                'updated_at' => '2025-08-17 10:58:49',
            ),
            20 => 
            array (
                'id' => 21,
                'code' => 'AED',
                'symbol' => 'د.إ',
                'name' => 'UAE Dirham',
                'created_at' => '2025-08-17 10:58:49',
                'updated_at' => '2025-08-17 10:58:49',
            ),
            21 => 
            array (
                'id' => 22,
                'code' => 'SAR',
                'symbol' => '﷼',
                'name' => 'Saudi Riyal',
                'created_at' => '2025-08-17 10:58:49',
                'updated_at' => '2025-08-17 10:58:49',
            ),
            22 => 
            array (
                'id' => 23,
                'code' => 'BRL',
                'symbol' => 'R$',
                'name' => 'Brazilian Real',
                'created_at' => '2025-08-17 10:58:49',
                'updated_at' => '2025-08-17 10:58:49',
            ),
            23 => 
            array (
                'id' => 24,
                'code' => 'MXN',
                'symbol' => 'Mex$',
                'name' => 'Mexican Peso',
                'created_at' => '2025-08-17 10:58:49',
                'updated_at' => '2025-08-17 10:58:49',
            ),
            24 => 
            array (
                'id' => 25,
                'code' => 'ZAR',
                'symbol' => 'R',
                'name' => 'South African Rand',
                'created_at' => '2025-08-17 10:58:49',
                'updated_at' => '2025-08-17 10:58:49',
            ),
        ));

        
    }
}
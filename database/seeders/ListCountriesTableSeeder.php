<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ListCountriesTableSeeder extends Seeder
{
    /**
     * Auto generated seeder file.
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('list_countries')->delete();
        
        \DB::table('list_countries')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Afghanistan',
                'continent' => 'Asia',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Armenia',
                'continent' => 'Asia',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Azerbaijan',
                'continent' => 'Asia',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Bahrain',
                'continent' => 'Asia',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Bangladesh',
                'continent' => 'Asia',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Bhutan',
                'continent' => 'Asia',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Brunei',
                'continent' => 'Asia',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Cambodia',
                'continent' => 'Asia',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'China',
                'continent' => 'Asia',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Cyprus',
                'continent' => 'Asia',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Georgia',
                'continent' => 'Asia',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'India',
                'continent' => 'Asia',
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'Indonesia',
                'continent' => 'Asia',
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'Iran',
                'continent' => 'Asia',
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'Iraq',
                'continent' => 'Asia',
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'Israel',
                'continent' => 'Asia',
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'Japan',
                'continent' => 'Asia',
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'Jordan',
                'continent' => 'Asia',
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'Kazakhstan',
                'continent' => 'Asia',
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'Kuwait',
                'continent' => 'Asia',
            ),
            20 => 
            array (
                'id' => 21,
                'name' => 'Kyrgyzstan',
                'continent' => 'Asia',
            ),
            21 => 
            array (
                'id' => 22,
                'name' => 'Laos',
                'continent' => 'Asia',
            ),
            22 => 
            array (
                'id' => 23,
                'name' => 'Lebanon',
                'continent' => 'Asia',
            ),
            23 => 
            array (
                'id' => 24,
                'name' => 'Malaysia',
                'continent' => 'Asia',
            ),
            24 => 
            array (
                'id' => 25,
                'name' => 'Maldives',
                'continent' => 'Asia',
            ),
            25 => 
            array (
                'id' => 26,
                'name' => 'Mongolia',
                'continent' => 'Asia',
            ),
            26 => 
            array (
                'id' => 27,
                'name' => 'Myanmar',
                'continent' => 'Asia',
            ),
            27 => 
            array (
                'id' => 28,
                'name' => 'Nepal',
                'continent' => 'Asia',
            ),
            28 => 
            array (
                'id' => 29,
                'name' => 'North Korea',
                'continent' => 'Asia',
            ),
            29 => 
            array (
                'id' => 30,
                'name' => 'Oman',
                'continent' => 'Asia',
            ),
            30 => 
            array (
                'id' => 31,
                'name' => 'Pakistan',
                'continent' => 'Asia',
            ),
            31 => 
            array (
                'id' => 32,
                'name' => 'Palestine',
                'continent' => 'Asia',
            ),
            32 => 
            array (
                'id' => 33,
                'name' => 'Philippines',
                'continent' => 'Asia',
            ),
            33 => 
            array (
                'id' => 34,
                'name' => 'Qatar',
                'continent' => 'Asia',
            ),
            34 => 
            array (
                'id' => 35,
                'name' => 'Saudi Arabia',
                'continent' => 'Asia',
            ),
            35 => 
            array (
                'id' => 36,
                'name' => 'Singapore',
                'continent' => 'Asia',
            ),
            36 => 
            array (
                'id' => 37,
                'name' => 'South Korea',
                'continent' => 'Asia',
            ),
            37 => 
            array (
                'id' => 38,
                'name' => 'Sri Lanka',
                'continent' => 'Asia',
            ),
            38 => 
            array (
                'id' => 39,
                'name' => 'Syria',
                'continent' => 'Asia',
            ),
            39 => 
            array (
                'id' => 40,
                'name' => 'Tajikistan',
                'continent' => 'Asia',
            ),
            40 => 
            array (
                'id' => 41,
                'name' => 'Thailand',
                'continent' => 'Asia',
            ),
            41 => 
            array (
                'id' => 42,
                'name' => 'Timor-Leste',
                'continent' => 'Asia',
            ),
            42 => 
            array (
                'id' => 43,
                'name' => 'Turkey',
                'continent' => 'Asia',
            ),
            43 => 
            array (
                'id' => 44,
                'name' => 'Turkmenistan',
                'continent' => 'Asia',
            ),
            44 => 
            array (
                'id' => 45,
                'name' => 'United Arab Emirates',
                'continent' => 'Asia',
            ),
            45 => 
            array (
                'id' => 46,
                'name' => 'Uzbekistan',
                'continent' => 'Asia',
            ),
            46 => 
            array (
                'id' => 47,
                'name' => 'Vietnam',
                'continent' => 'Asia',
            ),
            47 => 
            array (
                'id' => 48,
                'name' => 'Yemen',
                'continent' => 'Asia',
            ),
            48 => 
            array (
                'id' => 49,
                'name' => 'Algeria',
                'continent' => 'Africa',
            ),
            49 => 
            array (
                'id' => 50,
                'name' => 'Angola',
                'continent' => 'Africa',
            ),
            50 => 
            array (
                'id' => 51,
                'name' => 'Benin',
                'continent' => 'Africa',
            ),
            51 => 
            array (
                'id' => 52,
                'name' => 'Botswana',
                'continent' => 'Africa',
            ),
            52 => 
            array (
                'id' => 53,
                'name' => 'Burkina Faso',
                'continent' => 'Africa',
            ),
            53 => 
            array (
                'id' => 54,
                'name' => 'Burundi',
                'continent' => 'Africa',
            ),
            54 => 
            array (
                'id' => 55,
                'name' => 'Cabo Verde',
                'continent' => 'Africa',
            ),
            55 => 
            array (
                'id' => 56,
                'name' => 'Cameroon',
                'continent' => 'Africa',
            ),
            56 => 
            array (
                'id' => 57,
                'name' => 'Central African Republic',
                'continent' => 'Africa',
            ),
            57 => 
            array (
                'id' => 58,
                'name' => 'Chad',
                'continent' => 'Africa',
            ),
            58 => 
            array (
                'id' => 59,
                'name' => 'Comoros',
                'continent' => 'Africa',
            ),
            59 => 
            array (
                'id' => 60,
            'name' => 'Congo (Congo-Brazzaville)',
                'continent' => 'Africa',
            ),
            60 => 
            array (
                'id' => 61,
                'name' => 'Côte d\'Ivoire',
                'continent' => 'Africa',
            ),
            61 => 
            array (
                'id' => 62,
                'name' => 'Democratic Republic of the Congo',
                'continent' => 'Africa',
            ),
            62 => 
            array (
                'id' => 63,
                'name' => 'Djibouti',
                'continent' => 'Africa',
            ),
            63 => 
            array (
                'id' => 64,
                'name' => 'Egypt',
                'continent' => 'Africa',
            ),
            64 => 
            array (
                'id' => 65,
                'name' => 'Equatorial Guinea',
                'continent' => 'Africa',
            ),
            65 => 
            array (
                'id' => 66,
                'name' => 'Eritrea',
                'continent' => 'Africa',
            ),
            66 => 
            array (
                'id' => 67,
                'name' => 'Eswatini',
                'continent' => 'Africa',
            ),
            67 => 
            array (
                'id' => 68,
                'name' => 'Ethiopia',
                'continent' => 'Africa',
            ),
            68 => 
            array (
                'id' => 69,
                'name' => 'Gabon',
                'continent' => 'Africa',
            ),
            69 => 
            array (
                'id' => 70,
                'name' => 'Gambia',
                'continent' => 'Africa',
            ),
            70 => 
            array (
                'id' => 71,
                'name' => 'Ghana',
                'continent' => 'Africa',
            ),
            71 => 
            array (
                'id' => 72,
                'name' => 'Guinea',
                'continent' => 'Africa',
            ),
            72 => 
            array (
                'id' => 73,
                'name' => 'Guinea-Bissau',
                'continent' => 'Africa',
            ),
            73 => 
            array (
                'id' => 74,
                'name' => 'Kenya',
                'continent' => 'Africa',
            ),
            74 => 
            array (
                'id' => 75,
                'name' => 'Lesotho',
                'continent' => 'Africa',
            ),
            75 => 
            array (
                'id' => 76,
                'name' => 'Liberia',
                'continent' => 'Africa',
            ),
            76 => 
            array (
                'id' => 77,
                'name' => 'Libya',
                'continent' => 'Africa',
            ),
            77 => 
            array (
                'id' => 78,
                'name' => 'Madagascar',
                'continent' => 'Africa',
            ),
            78 => 
            array (
                'id' => 79,
                'name' => 'Malawi',
                'continent' => 'Africa',
            ),
            79 => 
            array (
                'id' => 80,
                'name' => 'Mali',
                'continent' => 'Africa',
            ),
            80 => 
            array (
                'id' => 81,
                'name' => 'Mauritania',
                'continent' => 'Africa',
            ),
            81 => 
            array (
                'id' => 82,
                'name' => 'Mauritius',
                'continent' => 'Africa',
            ),
            82 => 
            array (
                'id' => 83,
                'name' => 'Morocco',
                'continent' => 'Africa',
            ),
            83 => 
            array (
                'id' => 84,
                'name' => 'Mozambique',
                'continent' => 'Africa',
            ),
            84 => 
            array (
                'id' => 85,
                'name' => 'Namibia',
                'continent' => 'Africa',
            ),
            85 => 
            array (
                'id' => 86,
                'name' => 'Niger',
                'continent' => 'Africa',
            ),
            86 => 
            array (
                'id' => 87,
                'name' => 'Nigeria',
                'continent' => 'Africa',
            ),
            87 => 
            array (
                'id' => 88,
                'name' => 'Rwanda',
                'continent' => 'Africa',
            ),
            88 => 
            array (
                'id' => 89,
                'name' => 'São Tomé and Príncipe',
                'continent' => 'Africa',
            ),
            89 => 
            array (
                'id' => 90,
                'name' => 'Senegal',
                'continent' => 'Africa',
            ),
            90 => 
            array (
                'id' => 91,
                'name' => 'Seychelles',
                'continent' => 'Africa',
            ),
            91 => 
            array (
                'id' => 92,
                'name' => 'Sierra Leone',
                'continent' => 'Africa',
            ),
            92 => 
            array (
                'id' => 93,
                'name' => 'Somalia',
                'continent' => 'Africa',
            ),
            93 => 
            array (
                'id' => 94,
                'name' => 'South Africa',
                'continent' => 'Africa',
            ),
            94 => 
            array (
                'id' => 95,
                'name' => 'South Sudan',
                'continent' => 'Africa',
            ),
            95 => 
            array (
                'id' => 96,
                'name' => 'Sudan',
                'continent' => 'Africa',
            ),
            96 => 
            array (
                'id' => 97,
                'name' => 'Tanzania',
                'continent' => 'Africa',
            ),
            97 => 
            array (
                'id' => 98,
                'name' => 'Togo',
                'continent' => 'Africa',
            ),
            98 => 
            array (
                'id' => 99,
                'name' => 'Tunisia',
                'continent' => 'Africa',
            ),
            99 => 
            array (
                'id' => 100,
                'name' => 'Uganda',
                'continent' => 'Africa',
            ),
            100 => 
            array (
                'id' => 101,
                'name' => 'Zambia',
                'continent' => 'Africa',
            ),
            101 => 
            array (
                'id' => 102,
                'name' => 'Zimbabwe',
                'continent' => 'Africa',
            ),
            102 => 
            array (
                'id' => 103,
                'name' => 'Antigua and Barbuda',
                'continent' => 'North America',
            ),
            103 => 
            array (
                'id' => 104,
                'name' => 'Bahamas',
                'continent' => 'North America',
            ),
            104 => 
            array (
                'id' => 105,
                'name' => 'Barbados',
                'continent' => 'North America',
            ),
            105 => 
            array (
                'id' => 106,
                'name' => 'Belize',
                'continent' => 'North America',
            ),
            106 => 
            array (
                'id' => 107,
                'name' => 'Canada',
                'continent' => 'North America',
            ),
            107 => 
            array (
                'id' => 108,
                'name' => 'Costa Rica',
                'continent' => 'North America',
            ),
            108 => 
            array (
                'id' => 109,
                'name' => 'Cuba',
                'continent' => 'North America',
            ),
            109 => 
            array (
                'id' => 110,
                'name' => 'Dominica',
                'continent' => 'North America',
            ),
            110 => 
            array (
                'id' => 111,
                'name' => 'Dominican Republic',
                'continent' => 'North America',
            ),
            111 => 
            array (
                'id' => 112,
                'name' => 'El Salvador',
                'continent' => 'North America',
            ),
            112 => 
            array (
                'id' => 113,
                'name' => 'Grenada',
                'continent' => 'North America',
            ),
            113 => 
            array (
                'id' => 114,
                'name' => 'Guatemala',
                'continent' => 'North America',
            ),
            114 => 
            array (
                'id' => 115,
                'name' => 'Haiti',
                'continent' => 'North America',
            ),
            115 => 
            array (
                'id' => 116,
                'name' => 'Honduras',
                'continent' => 'North America',
            ),
            116 => 
            array (
                'id' => 117,
                'name' => 'Jamaica',
                'continent' => 'North America',
            ),
            117 => 
            array (
                'id' => 118,
                'name' => 'Mexico',
                'continent' => 'North America',
            ),
            118 => 
            array (
                'id' => 119,
                'name' => 'Nicaragua',
                'continent' => 'North America',
            ),
            119 => 
            array (
                'id' => 120,
                'name' => 'Panama',
                'continent' => 'North America',
            ),
            120 => 
            array (
                'id' => 121,
                'name' => 'Saint Kitts and Nevis',
                'continent' => 'North America',
            ),
            121 => 
            array (
                'id' => 122,
                'name' => 'Saint Lucia',
                'continent' => 'North America',
            ),
            122 => 
            array (
                'id' => 123,
                'name' => 'Saint Vincent and the Grenadines',
                'continent' => 'North America',
            ),
            123 => 
            array (
                'id' => 124,
                'name' => 'Trinidad and Tobago',
                'continent' => 'North America',
            ),
            124 => 
            array (
                'id' => 125,
                'name' => 'United States',
                'continent' => 'North America',
            ),
            125 => 
            array (
                'id' => 126,
                'name' => 'Argentina',
                'continent' => 'South America',
            ),
            126 => 
            array (
                'id' => 127,
                'name' => 'Bolivia',
                'continent' => 'South America',
            ),
            127 => 
            array (
                'id' => 128,
                'name' => 'Brazil',
                'continent' => 'South America',
            ),
            128 => 
            array (
                'id' => 129,
                'name' => 'Chile',
                'continent' => 'South America',
            ),
            129 => 
            array (
                'id' => 130,
                'name' => 'Colombia',
                'continent' => 'South America',
            ),
            130 => 
            array (
                'id' => 131,
                'name' => 'Ecuador',
                'continent' => 'South America',
            ),
            131 => 
            array (
                'id' => 132,
                'name' => 'Guyana',
                'continent' => 'South America',
            ),
            132 => 
            array (
                'id' => 133,
                'name' => 'Paraguay',
                'continent' => 'South America',
            ),
            133 => 
            array (
                'id' => 134,
                'name' => 'Peru',
                'continent' => 'South America',
            ),
            134 => 
            array (
                'id' => 135,
                'name' => 'Suriname',
                'continent' => 'South America',
            ),
            135 => 
            array (
                'id' => 136,
                'name' => 'Uruguay',
                'continent' => 'South America',
            ),
            136 => 
            array (
                'id' => 137,
                'name' => 'Venezuela',
                'continent' => 'South America',
            ),
            137 => 
            array (
                'id' => 138,
                'name' => 'Albania',
                'continent' => 'Europe',
            ),
            138 => 
            array (
                'id' => 139,
                'name' => 'Andorra',
                'continent' => 'Europe',
            ),
            139 => 
            array (
                'id' => 140,
                'name' => 'Austria',
                'continent' => 'Europe',
            ),
            140 => 
            array (
                'id' => 141,
                'name' => 'Belarus',
                'continent' => 'Europe',
            ),
            141 => 
            array (
                'id' => 142,
                'name' => 'Belgium',
                'continent' => 'Europe',
            ),
            142 => 
            array (
                'id' => 143,
                'name' => 'Bosnia and Herzegovina',
                'continent' => 'Europe',
            ),
            143 => 
            array (
                'id' => 144,
                'name' => 'Bulgaria',
                'continent' => 'Europe',
            ),
            144 => 
            array (
                'id' => 145,
                'name' => 'Croatia',
                'continent' => 'Europe',
            ),
            145 => 
            array (
                'id' => 146,
                'name' => 'Czech Republic',
                'continent' => 'Europe',
            ),
            146 => 
            array (
                'id' => 147,
                'name' => 'Denmark',
                'continent' => 'Europe',
            ),
            147 => 
            array (
                'id' => 148,
                'name' => 'Estonia',
                'continent' => 'Europe',
            ),
            148 => 
            array (
                'id' => 149,
                'name' => 'Finland',
                'continent' => 'Europe',
            ),
            149 => 
            array (
                'id' => 150,
                'name' => 'France',
                'continent' => 'Europe',
            ),
            150 => 
            array (
                'id' => 151,
                'name' => 'Germany',
                'continent' => 'Europe',
            ),
            151 => 
            array (
                'id' => 152,
                'name' => 'Greece',
                'continent' => 'Europe',
            ),
            152 => 
            array (
                'id' => 153,
                'name' => 'Hungary',
                'continent' => 'Europe',
            ),
            153 => 
            array (
                'id' => 154,
                'name' => 'Iceland',
                'continent' => 'Europe',
            ),
            154 => 
            array (
                'id' => 155,
                'name' => 'Ireland',
                'continent' => 'Europe',
            ),
            155 => 
            array (
                'id' => 156,
                'name' => 'Italy',
                'continent' => 'Europe',
            ),
            156 => 
            array (
                'id' => 157,
                'name' => 'Latvia',
                'continent' => 'Europe',
            ),
            157 => 
            array (
                'id' => 158,
                'name' => 'Liechtenstein',
                'continent' => 'Europe',
            ),
            158 => 
            array (
                'id' => 159,
                'name' => 'Lithuania',
                'continent' => 'Europe',
            ),
            159 => 
            array (
                'id' => 160,
                'name' => 'Luxembourg',
                'continent' => 'Europe',
            ),
            160 => 
            array (
                'id' => 161,
                'name' => 'Malta',
                'continent' => 'Europe',
            ),
            161 => 
            array (
                'id' => 162,
                'name' => 'Moldova',
                'continent' => 'Europe',
            ),
            162 => 
            array (
                'id' => 163,
                'name' => 'Monaco',
                'continent' => 'Europe',
            ),
            163 => 
            array (
                'id' => 164,
                'name' => 'Montenegro',
                'continent' => 'Europe',
            ),
            164 => 
            array (
                'id' => 165,
                'name' => 'Netherlands',
                'continent' => 'Europe',
            ),
            165 => 
            array (
                'id' => 166,
                'name' => 'North Macedonia',
                'continent' => 'Europe',
            ),
            166 => 
            array (
                'id' => 167,
                'name' => 'Norway',
                'continent' => 'Europe',
            ),
            167 => 
            array (
                'id' => 168,
                'name' => 'Poland',
                'continent' => 'Europe',
            ),
            168 => 
            array (
                'id' => 169,
                'name' => 'Portugal',
                'continent' => 'Europe',
            ),
            169 => 
            array (
                'id' => 170,
                'name' => 'Romania',
                'continent' => 'Europe',
            ),
            170 => 
            array (
                'id' => 171,
                'name' => 'San Marino',
                'continent' => 'Europe',
            ),
            171 => 
            array (
                'id' => 172,
                'name' => 'Serbia',
                'continent' => 'Europe',
            ),
            172 => 
            array (
                'id' => 173,
                'name' => 'Slovakia',
                'continent' => 'Europe',
            ),
            173 => 
            array (
                'id' => 174,
                'name' => 'Slovenia',
                'continent' => 'Europe',
            ),
            174 => 
            array (
                'id' => 175,
                'name' => 'Spain',
                'continent' => 'Europe',
            ),
            175 => 
            array (
                'id' => 176,
                'name' => 'Sweden',
                'continent' => 'Europe',
            ),
            176 => 
            array (
                'id' => 177,
                'name' => 'Switzerland',
                'continent' => 'Europe',
            ),
            177 => 
            array (
                'id' => 178,
                'name' => 'Ukraine',
                'continent' => 'Europe',
            ),
            178 => 
            array (
                'id' => 179,
                'name' => 'United Kingdom',
                'continent' => 'Europe',
            ),
            179 => 
            array (
                'id' => 180,
                'name' => 'Vatican City',
                'continent' => 'Europe',
            ),
            180 => 
            array (
                'id' => 181,
                'name' => 'Australia',
                'continent' => 'Oceania',
            ),
            181 => 
            array (
                'id' => 182,
                'name' => 'Fiji',
                'continent' => 'Oceania',
            ),
            182 => 
            array (
                'id' => 183,
                'name' => 'Kiribati',
                'continent' => 'Oceania',
            ),
            183 => 
            array (
                'id' => 184,
                'name' => 'Marshall Islands',
                'continent' => 'Oceania',
            ),
            184 => 
            array (
                'id' => 185,
                'name' => 'Micronesia',
                'continent' => 'Oceania',
            ),
            185 => 
            array (
                'id' => 186,
                'name' => 'Nauru',
                'continent' => 'Oceania',
            ),
            186 => 
            array (
                'id' => 187,
                'name' => 'New Zealand',
                'continent' => 'Oceania',
            ),
            187 => 
            array (
                'id' => 188,
                'name' => 'Palau',
                'continent' => 'Oceania',
            ),
            188 => 
            array (
                'id' => 189,
                'name' => 'Papua New Guinea',
                'continent' => 'Oceania',
            ),
            189 => 
            array (
                'id' => 190,
                'name' => 'Samoa',
                'continent' => 'Oceania',
            ),
            190 => 
            array (
                'id' => 191,
                'name' => 'Solomon Islands',
                'continent' => 'Oceania',
            ),
            191 => 
            array (
                'id' => 192,
                'name' => 'Tonga',
                'continent' => 'Oceania',
            ),
            192 => 
            array (
                'id' => 193,
                'name' => 'Tuvalu',
                'continent' => 'Oceania',
            ),
            193 => 
            array (
                'id' => 194,
                'name' => 'Vanuatu',
                'continent' => 'Oceania',
            ),
            194 => 
            array (
                'id' => 195,
                'name' => 'Antarctica',
                'continent' => 'Antarctica',
            ),
        ));

        
    }
}
<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(ListDataTableSeeder::class);
        $this->call(ListRolesTableSeeder::class);
        $this->call(ListCountriesTableSeeder::class);
        
        User::create([
            'username' => 'rij0311',
            'email' => 'kradjumli@gmail.com',
            'kradworkz' => hash('sha256','kradjumli@gmail.com'),
            'password' => bcrypt('123456789'),
            'is_active' => 1,
            'must_change' => 1,
            'email_verified_at' => '2024-05-15 08:46:33',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        UserProfile::create([
            'lastname' => 'Jumli',
            'firstname' => 'Ra-ouf',
            'middlename' => 'Indanan',
            'mobile' => '09171531652',
            'country_id' => 33, 
            'sex_id' => 1,
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        \DB::table('user_roles')->insert([
            'user_id' => 1,
            'role_id' => 1,
            'added_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        \DB::table('user_roles')->insert([
            'user_id' => 1,
            'role_id' => 2,
            'added_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->call(ListNamesTableSeeder::class);
        $this->call(ListStudiosTableSeeder::class);
        $this->call(ListGearsTableSeeder::class);
        $this->call(ListCurrenciesTableSeeder::class);
        $this->call(PlansTableSeeder::class);
        $this->call(PlanPricingsTableSeeder::class);
        $this->call(ListStatusesTableSeeder::class);
        $this->call(ListTagsTableSeeder::class);
        $this->call(ListDropdownsTableSeeder::class);
    }
}

<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory()->create([
        //     'name' => 'Basel',
        //     'email' => 'basel123@gmail.com',
        //     'password' => bcrypt('123456')
        // ]);

        $this->call([
            AdminUserSeeder::class,
            // ProductSeeder::class,
            CountrySeeder::class,
            CustomerSeeder::class
        ]);
    }
}

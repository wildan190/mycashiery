<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $user = User::create([
            'name' => 'Faker',
            'last_name' => 'Faker',
            'email' => 'superadmin@mpn.com',
            'password' => bcrypt('password'),
        ]);

        $user->assignRole('Admin');
    }
}

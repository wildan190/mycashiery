<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Factory as Faker;
use Spatie\Permission\Models\Role;

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
            'password' => bcrypt('password')
        ]);

        $user->assignRole('Admin');
    }
}


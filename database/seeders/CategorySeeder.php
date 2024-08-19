<?php

namespace Database\Seeders;

use App\Models\Category;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $categories = [
            'Snack', 'Soft Drink', 'Makanan', 'Body Care', 'Aminities', 'Bahan / Barang Dapur', 'Sembako',
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
                'description' => $faker->sentence(),
            ]);
        }
    }
}

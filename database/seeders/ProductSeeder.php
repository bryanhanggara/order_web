<?php

namespace Database\Seeders;

use App\Models\products;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Insert 500 data produk
        for ($i = 0; $i < 500; $i++) {
            products::create([
                'name' => $faker->word,
                'description' => $faker->text,
                'price' => $faker->randomFloat(2, 1, 1000),
                'stock' => $faker->numberBetween(1, 100),
                'category' => $faker->word
            ]);
        }
    }
}

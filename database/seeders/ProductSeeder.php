<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        foreach (range(1, 15) as $index) {
            DB::table('products')->insert([
                [
                    'name' => 'Product'.$index,
                    'price' => $faker->randomFloat(2, 10, 1000),
                    'description' => 'Description for Product'.$index,
                ],
            ]);
        }
    }
}

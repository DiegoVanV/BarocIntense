<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Product::getCategories();
        for ($i = 1; $i <= 10; $i++) {
            Product::create([
                'naam' => 'Product ' . $i,
                'categorie' => $categories[array_rand($categories)],
                'product_code' => 'P' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'prijs' => rand(1000, 5000) / 100,
                'voorraad' => rand(10, 100),
                'installatiekosten' => rand(500, 2000) / 100,
            ]);
        }
    }
}

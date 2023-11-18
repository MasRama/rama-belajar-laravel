<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Products;

class ProductSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $product = [
            'product_name' => 'Product 1',
            'product_code' => 'Testtt11',
            'price' => 100000,
            'stock' => 10,
            'category_id' => 1,
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla euismod, nisl eget ultricies aliquam, quam libero ultricies nisl, eget ultricies nisl libero eget ultricies nisl.',
            'image' => 'https://via.placeholder.com/150',
        ];

        Products::create($product);
    }
}

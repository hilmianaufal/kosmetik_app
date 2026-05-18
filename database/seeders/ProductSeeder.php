<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Lip Cream Matte',
                'brand' => 'Wardah',
                'category' => 'Makeup',
                'barcode' => '8991001',
                'stock' => 20,
                'price' => 45000,
                'cost_price' => 30000,
                'image' => 'https://images.unsplash.com/photo-1631730486572-2266b7c6b0b5?q=80&w=600&auto=format&fit=crop',
            ],
            [
                'name' => 'Face Serum Niacinamide',
                'brand' => 'Somethinc',
                'category' => 'Skincare',
                'barcode' => '8991002',
                'stock' => 15,
                'price' => 89000,
                'cost_price' => 60000,
                'image' => 'https://images.unsplash.com/photo-1620916566398-39f1143ab7be?q=80&w=600&auto=format&fit=crop',
            ],
            [
                'name' => 'Cushion Glow',
                'brand' => 'Make Over',
                'category' => 'Makeup',
                'barcode' => '8991003',
                'stock' => 10,
                'price' => 125000,
                'cost_price' => 90000,
                'image' => 'https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?q=80&w=600&auto=format&fit=crop',
            ],
            [
                'name' => 'Hydrating Toner',
                'brand' => 'Avoskin',
                'category' => 'Skincare',
                'barcode' => '8991004',
                'stock' => 18,
                'price' => 75000,
                'cost_price' => 50000,
                'image' => 'https://images.unsplash.com/photo-1556228578-8c89e6adf883?q=80&w=600&auto=format&fit=crop',
            ],
            [
                'name' => 'Parfum Floral',
                'brand' => 'HMNS',
                'category' => 'Fragrance',
                'barcode' => '8991005',
                'stock' => 8,
                'price' => 149000,
                'cost_price' => 100000,
                'image' => 'https://images.unsplash.com/photo-1541643600914-78b084683601?q=80&w=600&auto=format&fit=crop',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
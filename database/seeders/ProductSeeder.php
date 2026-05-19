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

            [
                'name' => 'Sunscreen Gel',
                'brand' => 'Azarine',
                'category' => 'Skincare',
                'barcode' => '8991006',
                'stock' => 22,
                'price' => 65000,
                'cost_price' => 45000,
                'image' => 'https://images.unsplash.com/photo-1619451334792-150fd785ee74?q=80&w=600&auto=format&fit=crop',
            ],

            [
                'name' => 'Tinted Lip Balm',
                'brand' => 'Emina',
                'category' => 'Makeup',
                'barcode' => '8991007',
                'stock' => 25,
                'price' => 35000,
                'cost_price' => 22000,
                'image' => 'https://images.unsplash.com/photo-1583241800698-9e8b3f0d0d2c?q=80&w=600&auto=format&fit=crop',
            ],

            [
                'name' => 'Brightening Cleanser',
                'brand' => 'Whitelab',
                'category' => 'Skincare',
                'barcode' => '8991008',
                'stock' => 17,
                'price' => 55000,
                'cost_price' => 37000,
                'image' => 'https://images.unsplash.com/photo-1571781926291-c477ebfd024b?q=80&w=600&auto=format&fit=crop',
            ],

            [
                'name' => 'Loose Powder',
                'brand' => 'Implora',
                'category' => 'Makeup',
                'barcode' => '8991009',
                'stock' => 19,
                'price' => 40000,
                'cost_price' => 26000,
                'image' => 'https://images.unsplash.com/photo-1596755389378-c31d21fd1273?q=80&w=600&auto=format&fit=crop',
            ],

            [
                'name' => 'Body Mist Sweet',
                'brand' => 'Victoria',
                'category' => 'Fragrance',
                'barcode' => '8991010',
                'stock' => 14,
                'price' => 99000,
                'cost_price' => 70000,
                'image' => 'https://images.unsplash.com/photo-1594035910387-fea47794261f?q=80&w=600&auto=format&fit=crop',
            ],

            [
                'name' => 'Retinol Night Cream',
                'brand' => 'Skintific',
                'category' => 'Skincare',
                'barcode' => '8991011',
                'stock' => 11,
                'price' => 135000,
                'cost_price' => 98000,
                'image' => 'https://images.unsplash.com/photo-1625772452859-1c03d5bf1137?q=80&w=600&auto=format&fit=crop',
            ],

            [
                'name' => 'Velvet Matte Lipstick',
                'brand' => 'Pinkflash',
                'category' => 'Makeup',
                'barcode' => '8991012',
                'stock' => 24,
                'price' => 28000,
                'cost_price' => 18000,
                'image' => 'https://images.unsplash.com/photo-1586495777744-4413f21062fa?q=80&w=600&auto=format&fit=crop',
            ],

            [
                'name' => 'Facial Wash Acne',
                'brand' => 'Kahf',
                'category' => 'Skincare',
                'barcode' => '8991013',
                'stock' => 30,
                'price' => 39000,
                'cost_price' => 25000,
                'image' => 'https://images.unsplash.com/photo-1556228720-195a672e8a03?q=80&w=600&auto=format&fit=crop',
            ],

            [
                'name' => 'Setting Spray',
                'brand' => 'Luxcrime',
                'category' => 'Makeup',
                'barcode' => '8991014',
                'stock' => 16,
                'price' => 79000,
                'cost_price' => 54000,
                'image' => 'https://images.unsplash.com/photo-1590156209349-6ebd5b8d3e70?q=80&w=600&auto=format&fit=crop',
            ],

            [
                'name' => 'Parfum Vanilla',
                'brand' => 'Carl & Claire',
                'category' => 'Fragrance',
                'barcode' => '8991015',
                'stock' => 9,
                'price' => 165000,
                'cost_price' => 120000,
                'image' => 'https://images.unsplash.com/photo-1592945403244-b3fbafd7f539?q=80&w=600&auto=format&fit=crop',
            ],

            [
                'name' => 'Moisturizer Ceramide',
                'brand' => 'Npure',
                'category' => 'Skincare',
                'barcode' => '8991016',
                'stock' => 13,
                'price' => 99000,
                'cost_price' => 70000,
                'image' => 'https://images.unsplash.com/photo-1626784215021-2e39ccf971cd?q=80&w=600&auto=format&fit=crop',
            ],

            [
                'name' => 'Eyeliner Waterproof',
                'brand' => 'Maybelline',
                'category' => 'Makeup',
                'barcode' => '8991017',
                'stock' => 21,
                'price' => 65000,
                'cost_price' => 43000,
                'image' => 'https://images.unsplash.com/photo-1512496015851-a90fb38ba796?q=80&w=600&auto=format&fit=crop',
            ],

            [
                'name' => 'Hair Mist Sakura',
                'brand' => 'Ellips',
                'category' => 'Fragrance',
                'barcode' => '8991018',
                'stock' => 12,
                'price' => 45000,
                'cost_price' => 30000,
                'image' => 'https://images.unsplash.com/photo-1523293182086-7651a899d37f?q=80&w=600&auto=format&fit=crop',
            ],

            [
                'name' => 'Glow Serum',
                'brand' => 'Facetology',
                'category' => 'Skincare',
                'barcode' => '8991019',
                'stock' => 18,
                'price' => 85000,
                'cost_price' => 60000,
                'image' => 'https://images.unsplash.com/photo-1626785774573-4b799315345d?q=80&w=600&auto=format&fit=crop',
            ],

            [
                'name' => 'Blush On Peach',
                'brand' => 'Hanasui',
                'category' => 'Makeup',
                'barcode' => '8991020',
                'stock' => 27,
                'price' => 32000,
                'cost_price' => 21000,
                'image' => 'https://images.unsplash.com/photo-1583241800698-9e8b3f0d0d2c?q=80&w=600&auto=format&fit=crop',
            ],

        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
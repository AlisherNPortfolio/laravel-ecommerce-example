<?php

namespace Modules\Product\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductMedia;

class ProductDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $products = [
            [
                'name' => 'Ayollar kiyimi',
                'sku' => 'pro-a-k-0001',
                'price' => 100000,
                'discounted_price' => 98000,
                'cost' => 50000,
                'quantity' => 100,
                'sell_out_of_stock' => false,
                'description' => "Yumshoq matoli ayollar ko'ylagi. Turli xil rangdagisi mavjud. Sizga yoqishi aniq!<br>",
                'category_id' => 10,
                'brand_id' => 1,
                'is_active' => true,
                'measure_type' => 'dona',
                'preview' => "Yumshoq matoli ayollar ko'ylagi<br>",
                'is_featured' => false,
                'is_new' => false,
                'has_warranty' => false,
                'is_popular' => false,
                'warranty_period' => 0,
                'shipping_id' => 1,
                'media' => [
                            [
                                'product_id' => 1,
                                'url' => 'products/product1.jpg',
                                'order' => 1
                            ],
                            [
                                'product_id' => 1,
                                'url' => 'products/product2.jpg',
                                'order' => 2
                            ],
                            [
                                'product_id' => 1,
                                'url' => 'products/product3.jpg',
                                'order' => 3
                            ]
                        ]
                ],
                [
                    'name' => 'Erkaklar kiyimi',
                    'sku' => 'pro-e-k-0001',
                    'price' => 300000,
                    'discounted_price' => 299000,
                    'cost' => 100000,
                    'quantity' => 100,
                    'sell_out_of_stock' => false,
                    'description' => "Zamonaviy ko'rinishdagi erkaklar ko'ylagi. 90% paxta, 10% polyster matolardan tayyorlangan.<br>",
                    'category_id' => 7,
                    'brand_id' => 3,
                    'is_active' => true,
                    'measure_type' => 'dona',
                    'preview' => "Zamonaviy erkaklar kiyimi<br>",
                    'is_featured' => false,
                    'is_new' => false,
                    'has_warranty' => false,
                    'is_popular' => false,
                    'warranty_period' => 0,
                    'shipping_id' => 1,
                    'media' => [
                        [
                            'product_id' => 1,
                            'url' => 'products/product4.jpg',
                            'order' => 1
                        ],
                        [
                            'product_id' => 1,
                            'url' => 'products/product5.jpg',
                            'order' => 2
                        ]
                    ]
                ]
        ];

        foreach ($products as $product) {
            $media = $product['media'];
            unset($product['media']);

            Product::query()->create($product);
            foreach ($media as $m) {
                ProductMedia::query()->create($m);
            }
        }
    }
}

<?php

namespace Modules\Shipping\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Shipping\Models\ShippingRule;

class ShippingRuleSeederTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $rules = [
            [
                'shipping_id' => 1,
                'price' => 5000,
                'region_id' => 13,
                'district_id' => 195,
                'shipping_hours' => 5,
                'has_pickup_address' => true,
                'pickup_price' => 30000,
                'pickup_phone' => '+998901111525',
                'pickup_city' => 'Toshkent viloyati',
                'pickup_address' => 'Toshkent tuman, Keles, 87-uy'
            ],
            [
                'shipping_id' => 1,
                'region_id' => 14,
                'district_id' => 28,
                'price' => 0,
                'shipping_hours' => 1,
                'has_pickup_address' => true,
                'pickup_price' => 0,
                'pickup_phone' => '+998905439876',
                'pickup_city' => 'Toshkent sh',
                'pickup_address' => 'Mirobod, 5-uy'
            ]
        ];

        foreach ($rules as $rule) {
            ShippingRule::query()->create($rule);
        }
    }
}

<?php

namespace Modules\Shipping\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Shipping\Models\Shipping;

class ShippingDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Shipping::query()->create([
            'name' => 'Default'
        ]);

        $this->call(ShippingRuleSeederTableSeeder::class);
    }
}

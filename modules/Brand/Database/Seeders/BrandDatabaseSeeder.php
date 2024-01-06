<?php

namespace Modules\Brand\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\Brand\Models\Brand;

class BrandDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $brands = [
            [
                'name' => 'Zara',
                'slug' => 'zara',
            ],
            [
                'name' => 'Acer',
                'slug' => 'acer',
            ],
            [
                'name' => 'Versace',
                'slug' => 'versace',
            ],
            [
                'name' => 'Salamandr',
                'slug' => 'salamandr',
            ],
        ];

        foreach ($brands as $brand) {
            Brand::query()->create($brand);
        }
    }
}

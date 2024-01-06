<?php

namespace Modules\Common\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Common\Models\Region;

class RegionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $regions = [
            ['name' => 'Республика Каракалпакстан', 'lat' => '42.45306', 'lng' => '59.61028'],
            ['name' => 'Андижанская область', 'lat' => '40.78206', 'lng' => '72.34424'],
            ['name' => 'Наманганская область', 'lat' => '40.9983', 'lng' => '71.67257'],
            ['name' => 'Ферганская область', 'lat' => '40.38421', 'lng' => '71.78432'],
            ['name' => 'Бухарская область', 'lat' => '39.77472', 'lng' => '64.42861'],
            ['name' => 'Хорезмская область', 'lat' => '41.55', 'lng' => '60.63333'],
            ['name' => 'Сурхандарьинская область', 'lat' => '37.22417', 'lng' => '67.27833'],
            ['name' => 'Кашкадарьинская область', 'lat' => '38.86056', 'lng' => '65.78905'],
            ['name' => 'Джизакская область', 'lat' => '40.11583', 'lng' => '67.84222'],
            ['name' => 'Навоийская область', 'lat' => '40.1', 'lng' => '65.36667'],
            ['name' => 'Самаркандская область', 'lat' => '39.65417', 'lng' => '66.95972'],
            ['name' => 'Сырдарьинская область', 'lat' => '40.48972', 'lng' => '68.78417'],
            ['name' => 'Ташкентская область', 'lat' => '40.8550116', 'lng' => '69.5216111'],
            ['name' => 'Ташкент', 'lat' => '41.311081', 'lng' => '69.240562']
        ];

        foreach ($regions as $region) {
            Region::query()->create($region);
        }
    }
}

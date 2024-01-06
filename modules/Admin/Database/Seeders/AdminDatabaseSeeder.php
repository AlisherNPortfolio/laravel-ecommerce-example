<?php

namespace Modules\Admin\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Modules\Admin\Models\Admin;
use Modules\Brand\Database\Seeders\BrandDatabaseSeeder;
use Modules\Category\Database\Seeders\CategoryDatabaseSeeder;
use Modules\Common\Database\Seeders\CommonDatabaseSeeder;
use Modules\Roles\Database\Seeders\RolesDatabaseSeeder;
use Modules\Shipping\Database\Seeders\ShippingDatabaseSeeder;
use Modules\TaxRule\Database\Seeders\TaxRuleDatabaseSeeder;
use Modules\User\Database\Seeders\UserDatabaseSeeder;

class AdminDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(RolesDatabaseSeeder::class);
        $this->call(UserDatabaseSeeder::class);
        $this->call(CategoryDatabaseSeeder::class);
        $this->call(BrandDatabaseSeeder::class);
        $this->call(CommonDatabaseSeeder::class);
        $this->call(ShippingDatabaseSeeder::class);
        $this->call(TaxRuleDatabaseSeeder::class);
    }
}

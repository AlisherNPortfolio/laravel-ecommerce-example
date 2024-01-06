<?php

namespace Modules\Roles\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('permissions')->truncate();
        Schema::enableForeignKeyConstraints();

        Permission::query()->firstOrCreate(['name' => 'View Admin', 'module' => 'Admin', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'View Banners', 'module' => 'Banners', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'View Cart', 'module' => 'Cart', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'View Category', 'module' => 'Category', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'View Common', 'module' => 'Common', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'View Menu', 'module' => 'Menu', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'View Order', 'module' => 'Order', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'View Page', 'module' => 'Page', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'View Payment', 'module' => 'Payment', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'View Product', 'module' => 'Product', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'View Roles', 'module' => 'Roles', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'View Shop', 'module' => 'Shop', 'guard_name' => 'api']);
        Permission::query()->firstOrCreate(['name' => 'View Shop', 'module' => 'Shop', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'View User', 'module' => 'User', 'guard_name' => 'admins']);

        Permission::query()->firstOrCreate(['name' => 'Edit Admin', 'module' => 'Admin', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'Edit Banners', 'module' => 'Banners', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'Edit Cart', 'module' => 'Cart', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'Edit Category', 'module' => 'Category', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'Edit Common', 'module' => 'Common', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'Edit Menu', 'module' => 'Menu', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'Edit Order', 'module' => 'Order', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'Edit Page', 'module' => 'Page', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'Edit Payment', 'module' => 'Payment', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'Edit Product', 'module' => 'Product', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'Edit Roles', 'module' => 'Roles', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'Edit Shop', 'module' => 'Shop', 'guard_name' => 'api']);
        Permission::query()->firstOrCreate(['name' => 'Edit Shop', 'module' => 'Shop', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'Edit User', 'module' => 'User', 'guard_name' => 'admins']);

        Permission::query()->firstOrCreate(['name' => 'Update Admin', 'module' => 'Admin', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'Update Banners', 'module' => 'Banners', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'Update Cart', 'module' => 'Cart', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'Update Category', 'module' => 'Category', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'Update Common', 'module' => 'Common', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'Update Menu', 'module' => 'Menu', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'Update Order', 'module' => 'Order', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'Update Page', 'module' => 'Page', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'Update Payment', 'module' => 'Payment', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'Update Product', 'module' => 'Product', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'Update Roles', 'module' => 'Roles', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'Update Shop', 'module' => 'Shop', 'guard_name' => 'api']);
        Permission::query()->firstOrCreate(['name' => 'Update Shop', 'module' => 'Shop', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'Update User', 'module' => 'User', 'guard_name' => 'admins']);

        Permission::query()->firstOrCreate(['name' => 'Store Admin', 'module' => 'Admin', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'Store Banners', 'module' => 'Banners', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'Store Cart', 'module' => 'Cart', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'Store Category', 'module' => 'Category', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'Store Common', 'module' => 'Common', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'Store Menu', 'module' => 'Menu', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'Store Order', 'module' => 'Order', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'Store Page', 'module' => 'Page', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'Store Payment', 'module' => 'Payment', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'Store Product', 'module' => 'Product', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'Store Roles', 'module' => 'Roles', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'Store Shop', 'module' => 'Shop', 'guard_name' => 'api']);
        Permission::query()->firstOrCreate(['name' => 'Store Shop', 'module' => 'Shop', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'Store User', 'module' => 'User', 'guard_name' => 'admins']);

        Permission::query()->firstOrCreate(['name' => 'Create Admin', 'module' => 'Admin', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'Create Banners', 'module' => 'Banners', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'Create Cart', 'module' => 'Cart', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'Create Category', 'module' => 'Category', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'Create Common', 'module' => 'Common', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'Create Menu', 'module' => 'Menu', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'Create Order', 'module' => 'Order', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'Create Page', 'module' => 'Page', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'Create Payment', 'module' => 'Payment', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'Create Product', 'module' => 'Product', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'Create Roles', 'module' => 'Roles', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'Create Shop', 'module' => 'Shop', 'guard_name' => 'api']);
        Permission::query()->firstOrCreate(['name' => 'Create Shop', 'module' => 'Shop', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'Create User', 'module' => 'User', 'guard_name' => 'admins']);

        Permission::query()->firstOrCreate(['name' => 'Delete Admin', 'module' => 'Admin', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'Delete Banners', 'module' => 'Banners', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'Delete Cart', 'module' => 'Cart', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'Delete Category', 'module' => 'Category', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'Delete Common', 'module' => 'Common', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'Delete Menu', 'module' => 'Menu', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'Delete Order', 'module' => 'Order', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'Delete Page', 'module' => 'Page', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'Delete Payment', 'module' => 'Payment', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'Delete Product', 'module' => 'Product', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'Delete Roles', 'module' => 'Roles', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'Delete Shop', 'module' => 'Shop', 'guard_name' => 'api']);
        Permission::query()->firstOrCreate(['name' => 'Delete Shop', 'module' => 'Shop', 'guard_name' => 'admins']);
        Permission::query()->firstOrCreate(['name' => 'Delete User', 'module' => 'User', 'guard_name' => 'admins']);
    }
}

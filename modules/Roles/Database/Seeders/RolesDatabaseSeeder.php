<?php

namespace Modules\Roles\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->call(PermissionSeeder::class);

        $this->assignPermissionsToRoles();
    }

    private function createRoles()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('roles')->truncate();
        Schema::enableForeignKeyConstraints();

        $superadmin = Role::query()->firstOrCreate(['name' => 'superadmin', 'guard_name' => 'admins']);
        $admin = Role::query()->firstOrCreate(['name' => 'admin', 'guard_name' => 'admins']);
        $customer = Role::query()->firstOrCreate(['name' => 'customer', 'guard_name' => 'api']);

        return [$superadmin, $admin, $customer];
    }

    private function getPermissions()
    {
        return Permission::query()->get();
    }

    private function assignPermissionsToRoles()
    {
        [$superadmin, $admin, $customer] = $this->createRoles();
        $permissions = $this->getPermissions();

        $notAllowedPermissionsToAdmin = [
            'Create Admin', 'Create Banners', 'Create Cart', 'Create Category',
            'Create Common', 'Create Menu', 'Create Order', 'Create Page',
            'Create Payment', 'Create Product', 'Create Roles', 'Create Shop', 'Create User',
            'Delete Admin', 'Delete Banners', 'Delete Cart', 'Delete Category',
            'Delete Common', 'Delete Menu', 'Delete Order', 'Delete Page',
            'Delete Payment', 'Delete Product', 'Delete Roles', 'Delete Shop',
            'Delete User', ];

        foreach ($permissions as $permission) {
            if ($permission->guard_name == 'api') {
                $permission->assignRole($customer);
            }

            if ($permission->guard_name == 'admins' && !in_array($permission->name, $notAllowedPermissionsToAdmin)) {
                $permission->assignRole($admin);
            }

            if ($permission->guard_name == 'admins') {
                $permission->assignRole($superadmin);
            }
        }
    }
}

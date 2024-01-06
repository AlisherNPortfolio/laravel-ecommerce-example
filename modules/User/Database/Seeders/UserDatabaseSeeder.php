<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Modules\User\Models\Admin;
use Modules\User\Models\User;

class UserDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $users = [
            [
                'name' => 'Superadmin',
                'username' => 'superadmin',
                'email' => 'super@mail.uz',
                'phone' => '+998909289445',
                'password' => Hash::make('Superadmin123'),
            ],
            [
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@mail.uz',
                'phone' => '+998999289445',
                'password' => Hash::make('Admin123'),
            ],
        ];

        $customer = [
            'name' => 'Customer',
            'username' => 'customer',
            'email' => 'customer@mail.uz',
            'phone' => '+998999279445',
            'password' => Hash::make('Customer123'),
        ];

        $roles = [
            ['superadmin'],
            ['admin'],
        ];

        Schema::disableForeignKeyConstraints();
        DB::table('admins')->truncate();
        DB::table('users')->truncate();
        Schema::enableForeignKeyConstraints();

        app()['cache']->forget('spatie.permission.cache');
        foreach ($users as $key => $user) {
            $userModel = Admin::query()->create($user);
            $userModel->assignRole($roles[$key]);
        }

        $customerModel = User::query()->create($customer);
        $customerModel->assignRole(['customer']);
    }
}

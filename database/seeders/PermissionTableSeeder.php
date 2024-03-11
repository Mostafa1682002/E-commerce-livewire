<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            //Categories
            ['guard_name' => "admin", 'name' => 'categories-list', 'routes' => "admin.categories.index"],
            ['guard_name' => "admin", 'name' => 'categories-create', 'routes' => "admin.categories.index,admin.categories.create,admin.categories.store"],
            ['guard_name' => "admin", 'name' => 'categories-edit', 'routes' => "admin.categories.index,admin.categories.edit,admin.categories.update"],
            ['guard_name' => "admin", 'name' => 'categories-delete', 'routes' => "admin.categories.index,admin.categories.destroy"],
            //Products
            ['guard_name' => "admin", 'name' => 'products-list', 'routes' => "admin.products.index"],
            ['guard_name' => "admin", 'name' => 'products-create', 'routes' => "admin.products.index,admin.products.create,admin.products.store"],
            ['guard_name' => "admin", 'name' => 'products-edit', 'routes' => "admin.products.index,admin.products.edit,admin.products.update"],
            ['guard_name' => "admin", 'name' => 'products-delete', 'routes' => "admin.products.index,admin.products.destroy"],
            //Orders
            ['guard_name' => "admin", 'name' => 'orders-list', 'routes' => "admin.orders.index,admin.orders.show"],
            ['guard_name' => "admin", 'name' => 'orders-delete', 'routes' => "admin.orders.index,admin.orders.destroy"],
            //Settings
            ['guard_name' => "admin", 'name' => 'setting-show', 'routes' => "admin.setting"],
            ['guard_name' => "admin", 'name' => 'setting-update', 'routes' => "admin.setting,admin.setting.update"],
            //Sliders
            ['guard_name' => "admin", 'name' => 'slider-list', 'routes' => "admin.slider.index"],
            ['guard_name' => "admin", 'name' => 'slider-create', 'routes' => "admin.slider.index,admin.slider.create,admin.slider.store"],
            ['guard_name' => "admin", 'name' => 'slider-edit', 'routes' => "admin.slider.index,admin.slider.edit,admin.slider.update"],
            ['guard_name' => "admin", 'name' => 'slider-delete', 'routes' => "admin.slider.index,admin.slider.destroy"],
            //Users
            ['guard_name' => "admin", 'name' => 'users-list', 'routes' => "admin.users.index"],
            ['guard_name' => "admin", 'name' => 'users-edit', 'routes' => "admin.users.index,admin.users.update"],
            ['guard_name' => "admin", 'name' => 'users-delete', 'routes' => "admin.users.index,admin.users.destroy"],
            //Coupones
            ['guard_name' => "admin", 'name' => 'coupones-list', 'routes' => "admin.coupones.index"],
            ['guard_name' => "admin", 'name' => 'coupones-create', 'routes' => "admin.coupones.index,admin.coupones.create,admin.coupones.store"],
            ['guard_name' => "admin", 'name' => 'coupones-edit', 'routes' => "admin.coupones.index,admin.coupones.edit,admin.coupones.update"],
            ['guard_name' => "admin", 'name' => 'coupones-delete', 'routes' => "admin.coupones.index,admin.coupones.destroy"],
            //Admins
            ['guard_name' => "admin", 'name' => 'admins-list', 'routes' => "admin.admins.index"],
            ['guard_name' => "admin", 'name' => 'admins-create', 'routes' => "admin.admins.index,admin.admins.create,admin.admins.store"],
            ['guard_name' => "admin", 'name' => 'admins-edit', 'routes' => "admin.admins.index,admin.admins.edit,admin.admins.update"],
            ['guard_name' => "admin", 'name' => 'admins-delete', 'routes' => "admin.admins.index,admin.admins.destroy"],
            //Roles
            ['guard_name' => "admin", 'name' => 'roles-list', 'routes' => "admin.roles.index"],
            ['guard_name' => "admin", 'name' => 'roles-create', 'routes' => "admin.roles.index,admin.roles.create,admin.roles.store"],
            ['guard_name' => "admin", 'name' => 'roles-edit', 'routes' => "admin.roles.index,admin.roles.edit,admin.roles.update"],
            ['guard_name' => "admin", 'name' => 'roles-delete', 'routes' => "admin.roles.index,admin.roles.destroy"],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}

<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',

            'admin-list',
            'admin-create',
            'admin-edit',
            'admin-delete',

            'product-list',
            'product-create',
            'product-edit',
            'product-delete',

            'slider-list',
            'slider-create',
            'slider-edit',
            'slider-delete',

            'category-list',
            'category-create',
            'category-edit',
            'category-delete',

            'user-list',
            'user-create',
            'user-edit',
            'user-delete',

            'location-list',
            'location-create',
            'location-edit',
            'location-delete',

            'coupon-list',
            'coupon-create',
            'coupon-edit',
            'coupon-delete',

            'delivery-list',
            'delivery-create',
            'delivery-edit',
            'delivery-delete',

            'faq-list',
            'faq-create',
            'faq-edit',
            'faq-delete',

            'property-list',
            'property-create',
            'property-edit',
            'property-delete',

            'order-list',
            'order-edit',
            'order-delete',

            'page-list',
            'page-create',
            'page-edit',
            'page-delete',

            'contact-list',
            'contact-delete',

            'subscribe-list',
            'subscribe-delete',

            'message-list',

            'option-edit',
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}

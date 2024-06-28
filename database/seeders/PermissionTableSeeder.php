<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        //Permissions
        $permissions = [
            'membership-plan-list',
            'membership-plan-create',
            'membership-plan-edit',
            'membership-plan-delete',
            'withdraw-list',
            'withdraw-create',
            'withdraw-edit',
            'withdraw-delete',
            'complaint-list',
            'complaint-create',
            'complaint-edit',
            'complaint-delete',
            'information-list',
            'information-create',
            'information-edit',
            'information-delete',
            'company-list',
            'company-create',
            'company-delete',
            'chat-list',
            'chat-create',
            'chat-delete',
            'order-create',
            'order-chat',
            'order-driver-edit',
            'order-driver-status-edit',
            'order-comment-edit',
            'order-affiliate-edit',
            'menu-catalog',
            'order-history',
            'setting-list',
            'setting-edit',
            'review-list',
            'review-create',
            'review-edit',
            'review-delete',
            'FAQs-list',
            'FAQs-create',
            'FAQs-edit',
            'FAQs-delete',
            'coupon-list',
            'coupon-create',
            'coupon-edit',
            'coupon-delete',
            'dashboard-report',
            'order-view',
            'order-booking-edit',
            'order-status-edit',
            'order-detail-edit',
            'menu-sales',
            'menu-store-config',
            'menu-user',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'service-staff-list',
            'service-staff-create',
            'service-staff-edit',
            'service-staff-delete',
            'customer-list',
            'customer-create',
            'customer-edit',
            'customer-delete',
            'driver-list',
            'driver-create',
            'driver-edit',
            'driver-delete',
            'affiliate-list',
            'affiliate-create',
            'affiliate-edit',
            'affiliate-delete',
            'manager-list',
            'manager-create',
            'manager-edit',
            'manager-delete',
            'supervisor-list',
            'supervisor-create',
            'supervisor-edit',
            'supervisor-delete',
            'assistant-supervisor-list',
            'assistant-supervisor-create',
            'assistant-supervisor-edit',
            'assistant-supervisor-delete',
            'staff-holiday-list',
            'staff-holiday-create',
            'staff-holiday-delete',
            'time-slot-list',
            'time-slot-create',
            'time-slot-edit',
            'time-slot-delete',
            'staff-zone-list',
            'staff-zone-create',
            'staff-zone-edit',
            'staff-zone-delete',
            'staff-group-list',
            'staff-group-create',
            'staff-group-edit',
            'staff-group-delete',
            'partner-list',
            'partner-create',
            'partner-edit',
            'partner-delete',
            'holiday-list',
            'service-list',
            'service-create',
            'service-edit',
            'service-delete',
            'service-category-list',
            'service-category-create',
            'service-category-edit',
            'service-category-delete',
            'cash-collection-list',
            'cash-collection-edit',
            'cash-collection-delete',
            'order-list',
            'order-download',
            'order-edit',
            'order-delete'
        ];
       
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
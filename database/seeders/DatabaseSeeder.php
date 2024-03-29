<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PermissionTableSeeder::class,
            CreateAdminUserSeeder::class,
            StaffRoleSeeder::class,
            CustomerRoleSeeder::class,
            AffiliateRoleSeeder::class,
            ServiceCategorySeeder::class,
            ServiceSeeder::class,
            ManagerRoleSeeder::class,
            SupervisorRoleSeeder::class,
            AssistantSupervisorRoleSeeder::class,
            StaffZoneSeeder::class,
            DriverRoleSeeder::class,
            SettingsTableSeeder::class
        ]);
    }
}
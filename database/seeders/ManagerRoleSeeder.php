<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class ManagerRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Manager', 
            'email' => 'manager@gmail.com',
            'password' => bcrypt('manager1234')
        ]);

        $role = Role::create(['name' => 'Manager']);

        $permissions = Permission::where('name', 'like', 'manager%')->pluck('id','id');

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
    }
}

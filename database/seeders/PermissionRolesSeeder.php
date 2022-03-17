<?php

namespace Database\Seeders;

use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;

class PermissionRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Clear chached permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // All permissions to create
        $permissions = [
            'user_management', 'employees_view', 
        ];

        $roles = [
            'admin','HR','Project_coordinator','BDE','HR_head',
        ];
        $permissions = collect($permissions)->map(function ($permission) {
            return ['name' => $permission, 'guard_name' => 'web'];
        });
        $roles = collect($roles)->map(function ($permission) {
            return ['name' => $permission, 'guard_name' => 'web'];
        });

        $createPerimssions = Permission::insert($permissions->toArray());
        $createRoles = Role::insert($roles->toArray());

        $adminUser = User::find(1);
        $adminRole = Role::find(1);
        $adminUser->assignRole($adminRole);
        $adminRole->givePermissionTo(Permission::where('name', '!=', 'only_appsminder_deals')->get());
    }
}

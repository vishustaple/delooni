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
            'new',
        ];

        $roles = [
            'admin','customer', 'service provider', 'guest'
        ];
        $permissions = collect($permissions)->map(function ($permission) {
            return ['name' => $permission, 'guard_name' => 'web'];
        });
        $roles = collect($roles)->map(function ($permission) {
            return ['name' => $permission, 'guard_name' => 'web'];
        });

        $createPerimssions = Permission::insert($permissions->toArray());
        $createRoles = Role::insert($roles->toArray());

        $adminUser = User::find(User::STATIC_ADMIN_DATABASE_ID);
        $adminRole = Role::find(User::ROLE_ADMIN);
        $adminUser->assignRole($adminRole);
        
        $customerUser = User::find(User::STATIC_CUSTOMER_DATABASE_ID);
        $customerRole = Role::find(User::ROLE_CUSTOMER);
        $customerUser->assignRole($customerRole);
        
        $serviceProviderUser = User::find(User::STATIC_SERVICEPROFIDER_DATABASE_ID);
        $serviceProviderRole = Role::find(User::ROLE_SERVICE_PROVICER);
        $serviceProviderUser->assignRole($serviceProviderRole);
        
        $adminRole->givePermissionTo(Permission::get());
    }
}

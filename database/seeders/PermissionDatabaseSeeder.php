<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'user-menu',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'role-menu',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'product-menu',
            'product-list',
            'product-create',
            'product-edit',
            'product-delete',
            'admins',
            'customers',
            'shops',
            'rollmanagement',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name'       => $permission,
                'guard_name' => 'web',
            ]);
        }
    }
}

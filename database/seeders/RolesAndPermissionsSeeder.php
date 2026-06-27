<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'view properties',
            'create properties',
            'edit properties',
            'delete properties',

            'view users',
            'create users',
            'edit users',
            'delete users',

            'view leads',
            'create leads',
            'edit leads',
            'delete leads',

            'view reports',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        $platformAdmin = Role::firstOrCreate([
            'name' => 'Platform Admin',
            'guard_name' => 'web',
        ]);

        $owner = Role::firstOrCreate([
            'name' => 'Owner',
            'guard_name' => 'web',
        ]);

        $superAdmin = Role::firstOrCreate([
            'name' => 'Super Admin',
            'guard_name' => 'web',
        ]);

        $manager = Role::firstOrCreate([
            'name' => 'Manager',
            'guard_name' => 'web',
        ]);

        $agent = Role::firstOrCreate([
            'name' => 'Agent',
            'guard_name' => 'web',
        ]);

        // Platform Admin
        $platformAdmin->syncPermissions(
            Permission::all()
        );

        // Owner
        $owner->syncPermissions(
            Permission::all()
        );

        // Super Admin
        $superAdmin->syncPermissions(
            Permission::all()
        );

        // Manager
        $manager->syncPermissions([
            'view properties',
            'create properties',
            'edit properties',

            'view users',

            'view leads',
            'create leads',
            'edit leads',

            'view reports',
        ]);

        // Agent
        $agent->syncPermissions([
            'view properties',
            'create properties',
            'edit properties',

            'view leads',
            'create leads',
            'edit leads',
        ]);
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // Define roles
        $roles = ['Admin', 'Developer', 'Customer', 'Receptionist', 'HR', 'Accountant'];

        foreach ($roles as $roleName) {
            Role::updateOrCreate(['name' => $roleName]);
        }

        // Define permissions
        $permissions = [
            'manage users', 'view projects', 'edit projects', 'delete projects',
            'view invoices', 'edit invoices', 'manage payments', 'view reports'
        ];

        foreach ($permissions as $permissionName) {
            Permission::updateOrCreate(['name' => $permissionName]);
        }

        // Assign permissions to roles
        Role::findByName('Developer')->givePermissionTo(Permission::all());
        Role::findByName('Admin')->givePermissionTo(['manage users', 'view projects', 'view invoices', 'edit invoices', 'manage payments', 'view reports']);
        Role::findByName('Customer')->givePermissionTo(['view invoices']);
        Role::findByName('Receptionist')->givePermissionTo(['view reports']);
        Role::findByName('HR')->givePermissionTo(['manage users']);
        Role::findByName('Accountant')->givePermissionTo(['manage payments', 'view reports']);
    }
}

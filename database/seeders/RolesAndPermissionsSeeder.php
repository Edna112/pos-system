<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            // User Management
            ['name' => 'View Users', 'slug' => 'view-users'],
            ['name' => 'Create Users', 'slug' => 'create-users'],
            ['name' => 'Edit Users', 'slug' => 'edit-users'],
            ['name' => 'Delete Users', 'slug' => 'delete-users'],
            
            // Role Management
            ['name' => 'View Roles', 'slug' => 'view-roles'],
            ['name' => 'Create Roles', 'slug' => 'create-roles'],
            ['name' => 'Edit Roles', 'slug' => 'edit-roles'],
            ['name' => 'Delete Roles', 'slug' => 'delete-roles'],
            
            // Product Management
            ['name' => 'View Products', 'slug' => 'view-products'],
            ['name' => 'Create Products', 'slug' => 'create-products'],
            ['name' => 'Edit Products', 'slug' => 'edit-products'],
            ['name' => 'Delete Products', 'slug' => 'delete-products'],
            
            // Sales Management
            ['name' => 'View Sales', 'slug' => 'view-sales'],
            ['name' => 'Create Sales', 'slug' => 'create-sales'],
            ['name' => 'Edit Sales', 'slug' => 'edit-sales'],
            ['name' => 'Delete Sales', 'slug' => 'delete-sales'],
            
            // Inventory Management
            ['name' => 'View Inventory', 'slug' => 'view-inventory'],
            ['name' => 'Manage Inventory', 'slug' => 'manage-inventory'],
            
            // Reports
            ['name' => 'View Reports', 'slug' => 'view-reports'],
            ['name' => 'Export Reports', 'slug' => 'export-reports'],
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission['name'],
                'guard_name' => 'web'
            ]);
        }

        // Create roles and assign permissions
        $roles = [
            'admin' => [
                'name' => 'Administrator',
                'description' => 'Full system access',
                'permissions' => [
                    'View Users', 'Create Users', 'Edit Users', 'Delete Users',
                    'View Roles', 'Create Roles', 'Edit Roles', 'Delete Roles',
                    'View Products', 'Create Products', 'Edit Products', 'Delete Products',
                    'View Sales', 'Create Sales', 'Edit Sales', 'Delete Sales',
                    'View Inventory', 'Manage Inventory',
                    'View Reports', 'Export Reports',
                ]
            ],
            'cashier' => [
                'name' => 'Cashier',
                'description' => 'Can process sales and view inventory',
                'permissions' => [
                    'View Products',
                    'View Sales',
                    'Create Sales',
                    'View Inventory'
                ]
            ],
            'stock-manager' => [
                'name' => 'Stock Manager',
                'description' => 'Can manage inventory and products',
                'permissions' => [
                    'View Products',
                    'Create Products',
                    'Edit Products',
                    'View Inventory',
                    'Manage Inventory'
                ]
            ],
            'viewer' => [
                'name' => 'Viewer',
                'description' => 'Can only view reports and inventory',
                'permissions' => [
                    'View Reports',
                    'View Inventory',
                    'View Products',
                    'View Sales'
                ]
            ]
        ];

        foreach ($roles as $slug => $roleData) {
            $role = Role::firstOrCreate([
                'name' => $roleData['name'],
                'guard_name' => 'web'
            ], [
                'description' => $roleData['description'] ?? null
            ]);

            $role->syncPermissions($roleData['permissions']);
        }
    }
} 
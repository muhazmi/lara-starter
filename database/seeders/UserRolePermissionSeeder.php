<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class UserRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create permissions
        $permissions = [
            'index admin/posts', 'create admin/posts/create', 'store admin/posts/store', 'edit admin/posts/edit', 'update admin/posts/update', 'delete admin/posts/delete', 'show admin/posts/show',
            'index admin/categories', 'create admin/categories/create', 'store admin/categories/store', 'edit admin/categories/edit', 'update admin/categories/update', 'delete admin/categories/delete', 'show admin/categories/show',
            'index admin/tags', 'create admin/tags/create', 'store admin/tags/store', 'edit admin/tags/edit', 'update admin/tags/update', 'delete admin/tags/delete', 'show admin/tags/show',
            'index admin/configuration',
            'index admin/users', 'create admin/users/create', 'store admin/users/store', 'edit admin/users/edit', 'update admin/users/update', 'delete admin/users/delete', 'show admin/users/show',
            'index admin/roles', 'create admin/roles/create', 'store admin/roles/store', 'edit admin/roles/edit', 'update admin/roles/update', 'delete admin/roles/delete', 'show admin/roles/show',
            'index admin/permissions', 'create admin/permissions/create', 'store admin/permissions/store', 'edit admin/permissions/edit', 'update admin/permissions/update', 'delete admin/permissions/delete', 'show admin/permissions/show',
            'index admin/navigations', 'create admin/navigations/create', 'store admin/navigations/store', 'edit admin/navigations/edit', 'update admin/navigations/update', 'delete admin/navigations/delete', 'show admin/navigations/show',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles
        $roles = [
            'admin' => [
                'index admin/posts', 'create admin/posts/create', 'store admin/posts/store', 'edit admin/posts/edit', 'update admin/posts/update', 'delete admin/posts/delete', 'show admin/posts/show',
                'index admin/categories', 'create admin/categories/create', 'store admin/categories/store', 'edit admin/categories/edit', 'update admin/categories/update', 'delete admin/categories/delete', 'show admin/categories/show',
                'index admin/tags', 'create admin/tags/create', 'store admin/tags/store', 'edit admin/tags/edit', 'update admin/tags/update', 'delete admin/tags/delete', 'show admin/tags/show',
                'index admin/configuration', 'index admin/users', 'create admin/users/create', 'store admin/users/store', 'edit admin/users/edit', 'update admin/users/update', 'delete admin/users/delete', 'show admin/users/show',
                'index admin/roles', 'create admin/roles/create', 'store admin/roles/store', 'edit admin/roles/edit', 'update admin/roles/update', 'delete admin/roles/delete', 'show admin/roles/show',
                'index admin/permissions', 'create admin/permissions/create', 'store admin/permissions/store', 'edit admin/permissions/edit', 'update admin/permissions/update', 'delete admin/permissions/delete', 'show admin/permissions/show',
                'index admin/navigations', 'create admin/navigations/create', 'store admin/navigations/store', 'edit admin/navigations/edit', 'update admin/navigations/update', 'delete admin/navigations/delete', 'show admin/navigations/show',
            ],
            'author'  => [
                'index admin/posts', 'create admin/posts/create', 'edit admin/posts/edit', 'delete admin/posts/delete'
            ],
        ];

        foreach ($roles as $roleName => $rolePermissions) {
            $role = Role::create(['name' => $roleName]);
            $role->givePermissionTo($rolePermissions);
        }

        // Create users
        $users = [
            [
                'name'          => 'AmperaKoding',
                'email'         => 'amperakoding@gmail.com',
                'password'      => Hash::make('amperakoding@gmail.com'),
                'profile_image' => 'amperakoding.png',
                'province_id'   => '16',
                'city_id'       => '1671',
                'district_id'   => rand(167101, 167118),
                'village_id'    => rand(1671161001, 1671161003),
            ],
            [
                'name'          => 'Muhazmi',
                'email'         => 'muhazmi@gmail.com',
                'password'      => Hash::make('muhazmi@gmail.com'),
                'profile_image' => 'muhazmi.png',
                'province_id'   => '16',
                'city_id'       => '1671',
                'district_id'   => rand(167101, 167118),
                'village_id'    => rand(1671161001, 1671161003),
            ]
        ];

        foreach ($users as $index => $userData) {
            $user = User::create($userData);

            // Assign role based on index
            $roleName = $index == 0 ? 'admin' : 'author';
            $role = Role::where('name', $roleName)->first();
            $user->assignRole($role);
        }
    }
}

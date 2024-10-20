<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            // SUPERADMIN
            'superadmin' => [
                'index admin/cms',

                'index admin/cms/articles',
                'create admin/cms/articles/create',
                'store admin/cms/articles/store',
                'edit admin/cms/articles/edit',
                'update admin/cms/articles/update',
                'delete admin/cms/articles/delete',

                'index admin/cms/tags',
                'create admin/cms/tags/create',
                'store admin/cms/tags/store',
                'edit admin/cms/tags/edit',
                'update admin/cms/tags/update',
                'delete admin/cms/tags/delete',

                'index admin/master',

                'index admin/master',
                'index admin/master/users',
                'create admin/master/users/create',
                'store admin/master/users/store',
                'edit admin/master/users/edit',
                'update admin/master/users/update',
                'delete admin/master/users/delete',

                'index admin/master/categories',
                'create admin/master/categories/create',
                'store admin/master/categories/store',
                'edit admin/master/categories/edit',
                'update admin/master/categories/update',
                'delete admin/master/categories/delete',

                'index admin/master/category_types',
                'create admin/master/category_types/create',
                'store admin/master/category_types/store',
                'edit admin/master/category_types/edit',
                'update admin/master/category_types/update',
                'delete admin/master/category_types/delete',

                'edit admin/setting/privacy-policy/edit',
                'update admin/setting/privacy-policy/update',

                'edit admin/setting/terms-and-conditions/edit',
                'update admin/setting/terms-and-conditions/update',

                'index admin/setting',

                'index admin/setting/roles',
                'create admin/setting/roles/create',
                'store admin/setting/roles/store',
                'edit admin/setting/roles/edit',
                'update admin/setting/roles/update',
                'delete admin/setting/roles/delete',

                'index admin/setting/permissions',
                'create admin/setting/permissions/create',
                'store admin/setting/permissions/store',
                'edit admin/setting/permissions/edit',
                'update admin/setting/permissions/update',
                'delete admin/setting/permissions/delete',

                'index admin/setting/menus',
                'create admin/setting/menus/create',
                'store admin/setting/menus/store',
                'edit admin/setting/menus/edit',
                'update admin/setting/menus/update',
                'delete admin/setting/menus/delete',

                'index admin/setting/sub_menus',
                'create admin/setting/sub_menus/create',
                'store admin/setting/sub_menus/store',
                'edit admin/setting/sub_menus/edit',
                'update admin/setting/sub_menus/update',
                'delete admin/setting/sub_menus/delete',

                'edit admin/setting/company/edit',
                'update admin/setting/company/update',

                'index admin/other',

                'index admin/other/logs',
                'detail admin/other/logs/detail',

                'index admin/other/backup_databases',
            ],

            'admin' => [
                'index admin/cms',

                'index admin/cms/articles',
                'create admin/cms/articles/create',
                'store admin/cms/articles/store',
                'edit admin/cms/articles/edit',
                'update admin/cms/articles/update',

                'index admin/master',
                'index admin/master/users',
                'create admin/master/users/create',
                'store admin/master/users/store',
                'edit admin/master/users/edit',
                'update admin/master/users/update',
            ],

            'admin_master'  => [],
            'admin_finance'  => [],
            'admin_cms'  => [],
        ];

        foreach ($roles as $roleName => $rolePermissions) {
            $role = Role::create(['name' => $roleName]);
            $role->givePermissionTo($rolePermissions);
        }
    }
}

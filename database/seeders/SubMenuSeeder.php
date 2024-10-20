<?php

namespace Database\Seeders;

use App\Models\SubMenu;
use Illuminate\Database\Seeder;

class SubMenuSeeder extends Seeder
{
    public function run(): void
    {
        $submenus = [
            // CMS
            [
                'menu_id'   => 1, // CMS
                'name'      => __('Article'),
                'url'       => 'admin/cms/articles',
                'icon'      => 'fa-regular fa-circle nav-icon',
                'sort'      => 1,
            ],
            [
                'menu_id'   => 1, // CMS
                'name'      => 'Tag',
                'url'       => 'admin/cms/tags',
                'icon'      => 'fa-regular fa-circle nav-icon',
                'sort'      => 2,
            ],

            // MASTER
            [
                'menu_id'   => 2, // MASTER
                'name'      => __('User'),
                'url'       => 'admin/master/users',
                'icon'      => 'fa-regular fa-circle nav-icon',
                'sort'      => 1,
            ],
            [
                'menu_id'   => 2, // MASTER
                'name'      => __('Category'),
                'url'       => 'admin/master/categories',
                'icon'      => 'fa-regular fa-circle nav-icon',
                'sort'      => 2,
            ],
            [
                'menu_id'   => 2, // MASTER
                'name'      => __('Category Type'),
                'url'       => 'admin/master/category_types',
                'icon'      => 'fa-regular fa-circle nav-icon',
                'sort'      => 3,
            ],
            
            // SETTING
            [
                'menu_id'   => 3, // SETTING
                'name'      => __('Company Information'),
                'url'       => 'admin/setting/company/edit',
                'icon'      => 'fa-regular fa-circle nav-icon',
                'sort'      => 1,
            ],
            [
                'menu_id'   => 3, // SETTING
                'name'      => __('Roles'),
                'url'       => 'admin/setting/roles',
                'icon'      => 'fa-regular fa-circle nav-icon',
                'sort'      => 2,
            ],
            [
                'menu_id'   => 3, // SETTING
                'name'      => __('Permission'),
                'url'       => 'admin/setting/permissions',
                'icon'      => 'fa-regular fa-circle nav-icon',
                'sort'      => 3,
            ],
            [
                'menu_id'   => 3, // SETTING
                'name'      => __('Menu'),
                'url'       => 'admin/setting/menus',
                'icon'      => 'fa-regular fa-circle nav-icon',
                'sort'      => 4,
            ],
            [
                'menu_id'   => 3, // SETTING
                'name'      => __('Sub Menu'),
                'url'       => 'admin/setting/sub_menus',
                'icon'      => 'fa-regular fa-circle nav-icon',
                'sort'      => 5,
            ],

            // OTHERS
            [
                'menu_id'   => 4, // OTHERS
                'name'      => __('Backup Database'),
                'url'       => 'admin/other/backup_databases',
                'icon'      => 'fa-regular fa-circle nav-icon',
                'sort'      => 2
            ],
            [
                'menu_id'   => 4, // OTHERS
                'name'      => __('Logs'),
                'url'       => 'admin/other/logs',
                'icon'      => 'fa-regular fa-circle nav-icon',
                'sort'      => 1,
            ],
        ];

        foreach ($submenus as $submenu) {
            SubMenu::create($submenu);
        }
    }
}

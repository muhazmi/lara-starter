<?php

namespace Database\Seeders;

use App\Models\Navigation;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NavigationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Navigation::create([
            'name'       => 'Post',
            'url'        => 'admin/posts',
            'main_menu'  => null,
            'icon'       => 'fa fa-newspaper',
            'sort'       => '1',
        ]);
        Navigation::create([
            'name'       => 'Category',
            'url'        => 'admin/categories',
            'main_menu'  => null,
            'icon'       => 'fa fa-tag',
            'sort'       => '2',
        ]);
        Navigation::create([
            'name'       => 'Tags',
            'url'        => 'admin/tags',
            'main_menu'  => null,
            'icon'       => 'fa fa-tags',
            'sort'       => '3',
        ]);
        $configuration = Navigation::create([
            'name'       => 'Configuration',
            'url'        => 'admin/configuration',
            'main_menu'  => null,
            'icon'       => 'fa fa-cogs',
            'sort'       => '4',
        ]);
        $configuration->subMenus()->create([
            'name'       => 'Users',
            'url'        => 'admin/configuration/users',
            'icon'       => 'far fa-circle nav-icon',
            'sort'       => '1',
        ]);
        $configuration->subMenus()->create([
            'name'       => 'Navigations',
            'url'        => 'admin/configuration/navigations',
            'icon'       => 'far fa-circle nav-icon',
            'sort'       => '2',
        ]);
        $configuration->subMenus()->create([
            'name'       => 'Permissions',
            'url'        => 'admin/configuration/permissions',
            'icon'       => 'far fa-circle nav-icon',
            'sort'       => '3',
        ]);
        $configuration->subMenus()->create([
            'name'       => 'Roles',
            'url'        => 'admin/configuration/roles',
            'icon'       => 'far fa-circle nav-icon',
            'sort'       => '4',
        ]);
    }
}

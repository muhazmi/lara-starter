<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        $menus = [
            [
                'name' => 'CMS',
                'url' => 'admin/cms',
                'icon' => 'fa fa-bullhorn',
                'sort' => 1,
            ],
            [
                'name' => 'Master',
                'url' => 'admin/master',
                'icon' => 'fa fa-key',
                'sort' => 2,
            ],
            [
                'name' => __('Setting'),
                'url' => 'admin/setting',
                'icon' => 'fa fa-cogs',
                'sort' => 3,
            ],
            [
                'name' => __('Others'),
                'url' => 'admin/other',
                'icon' => 'nav-icon fa fa-layer-group',
                'sort' => 4,
            ],
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }
}

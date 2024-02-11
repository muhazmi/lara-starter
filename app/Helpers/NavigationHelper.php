<?php

namespace App\Helpers;

use App\Models\Navigation;

class NavigationHelper
{
    public static function getMainMenu()
    {
        return Navigation::whereNull('main_menu')->get();
    }
}

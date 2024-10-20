<?php

use App\Models\Menu;
use App\Models\Company;
use Jenssegers\Agent\Facades\Agent;

function getMainMenu()
{
    return Menu::with('subMenus')->get();
}

function companyInfo()
{
    return Company::find(1);
}

function formatNumber($number, $decimals = 0)
{
    return number_format($number, $decimals, ',', '.');
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Village;

class RegionController extends Controller
{
    public function getCity(Request $request)
    {
        $city = City::where('province_code', $request->input('province_id'))->get();
        return response()->json($city);
    }

    public function getDistrict(Request $request)
    {
        $district = District::where('city_code', $request->input('city_id'))->get();
        return response()->json($district);
    }

    public function getVillage(Request $request)
    {
        $village = Village::where('district_code', $request->input('district_id'))->get();
        return response()->json($village);
    }

}

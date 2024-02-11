<?php

namespace App\Http\Controllers\Admin;

use App\Models\Navigation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class NavigationController extends Controller
{
    protected $module;

    public function __construct()
    {
        $this->module = 'Navigation';
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'page_title'    => $this->module,
            'navigations'   => Navigation::orderBy('sort')->whereNull('main_menu')->get(),
        ];

        return view('backend.navigation.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'page_title' => 'Add ' . $this->module,
        ];

        return view('backend.navigation.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|max:255',
            'url'       => 'nullable|max:255',
            'icon'      => 'required|max:255',
            'main_menu' => 'nullable|max:255',
            'sort'      => 'required',
        ]);

        // Create the Navigation model
        $navigation = Navigation::create([
            'name'      => $request->input('name'),
            'url'       => $request->input('url'),
            'icon'      => $request->input('icon'),
            'main_menu' => null,
            'sort'      => $request->input('sort'),
        ]);

        // Create associated submenus
        $submenusData = $request->input('submenu_name', []);
        $submenusUrlData = $request->input('submenu_url', []);
        $submenusIconData = $request->input('submenu_icon', []);
        $submenusSortData = $request->input('submenu_sort', []);

        foreach ($submenusData as $index => $submenuName) {
            $navigation->submenus()->create([
                'name' => $submenuName,
                'url' => $submenusUrlData[$index],
                'icon' => $submenusIconData[$index],
                'sort' => intval($submenusSortData[$index]),
            ]);
        }

        Alert::success('Success', $this->module . ' added successfully.');
        return redirect()->route('navigations.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Navigation $navigation)
    {
        $data = [
            'page_title' => 'Edit ' . $this->module,
            'navigations' => $navigation,
        ];

        return view('backend.navigation.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'      => 'required|max:255',
            'url'       => 'nullable|max:255',
            'icon'      => 'required|max:255',
            'main_menu' => 'nullable|max:255',
            'sort'      => 'required',
        ]);

        // Find the Navigation model to update
        $navigation = Navigation::findOrFail($id);

        // Update the Navigation model
        $navigation->update([
            'name'      => $request->input('name'),
            'url'       => $request->input('url'),  // Fix: Remove the 'required' validation for 'url'
            'icon'      => $request->input('icon'),
            'main_menu' => null,
            'sort'      => $request->input('sort'),
        ]);

        // Update or create associated submenus
        $navigation->submenus()->delete(); // Delete existing submenus
        $submenusData = $request->input('submenu_name', []);
        $submenusUrlData = $request->input('submenu_url', []);
        $submenusIconData = $request->input('submenu_icon', []);
        $submenusSortData = $request->input('submenu_sort', []);

        foreach ($submenusData as $index => $submenuName) {
            $navigation->submenus()->create([
                'name' => $submenuName,
                'url' => $submenusUrlData[$index],
                'icon' => $submenusIconData[$index],
                'sort' => intval($submenusSortData[$index]),
            ]);
        }

        Alert::success('Success', $this->module . ' updated successfully.');
        return redirect()->route('navigations.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Navigation $navigation)
    {
        if (!$navigation) {
            return back()->with('error', $this->module . ' not found.');
        }

        $navigation->delete();

        Alert::success('Success', $this->module . ' deleted successfully.');
        return redirect()->route('navigations.index');
    }
}

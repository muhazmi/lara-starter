<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    protected $module;

    public function __construct()
    {
        $this->module = 'Category';
        $this->middleware([
            'role:author|admin',
            'permission:index admin/categories|create admin/categories/create|store admin/categories/store|edit admin/categories/edit|update admin/categories/update|delete admin/categories/delete|show admin/categories/show'
        ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'page_title' => $this->module,
            'categories' => Category::all(),
        ];

        return view('backend.category.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'page_title' => 'Add ' . $this->module,
        ];

        return view('backend.category.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|unique:categories'
        ]);

        Category::create([
            'name'     => $request->name,
            'slug'     => Str::slug($request->name),
        ]);

        Alert::success('Success', $this->module . ' added successfully.');
        return redirect()->route('categories.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $data = [
            'page_title' => 'Edit ' . $this->module,
            'categories' => $category,
        ];

        return view('backend.category.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255|unique:categories,name,' . $id,
        ]);

        $category = Category::findOrFail($id);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        Alert::success('Success', $this->module . ' updated successfully.');
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if (!$category) {
            return back()->with('error', $this->module . ' not found.');
        }

        $category->delete();

        Alert::success('Success', $this->module . ' deleted successfully.');
        return redirect()->route('categories.index');
    }
}

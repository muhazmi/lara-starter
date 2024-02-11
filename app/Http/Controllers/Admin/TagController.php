<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class TagController extends Controller
{
    protected $module;

    public function __construct()
    {
        $this->module = 'Tag';

        $this->middleware([
            'role:admin|author',
            'permission:index admin/tags|create admin/tags/create|store admin/tags/store|edit admin/tags/edit|update admin/tags/update|delete admin/tags/delete|show admin/tags/show'
        ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'page_title' => $this->module,
            'tags' => Tag::all(),
        ];

        return view('backend.tag.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'page_title' => 'Add ' . $this->module,
        ];

        return view('backend.tag.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|unique:tags'
        ]);

        Tag::create([
            'name'     => $request->name,
            'slug'     => Str::slug($request->name),
        ]);

        Alert::success('Success', $this->module . ' added successfully.');
        return redirect()->route('tags.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        $data = [
            'page_title' => 'Edit ' . $this->module,
            'tags' => $tag,
        ];

        return view('backend.tag.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255|unique:tags,name,' . $id,
        ]);

        $tag = Tag::findOrFail($id);

        $tag->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        Alert::success('Success', $this->module . ' updated successfully.');
        return redirect()->route('tags.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        if (!$tag) {
            return back()->with('error', $this->module . ' not found.');
        }

        $tag->delete();

        Alert::success('Success', $this->module . ' deleted successfully.');
        return redirect()->route('tags.index');
    }
}

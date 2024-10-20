<?php

namespace App\Http\Controllers\Admin\Cms;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Cms\TagStoreRequest;
use App\Http\Requests\Cms\TagUpdateRequest;
use Illuminate\Routing\Controllers\HasMiddleware;

class TagController extends Controller implements HasMiddleware
{
    protected $module;

    public function __construct()
    {
        $this->module = ('Tag');
    }

    public static function middleware(): array
    {
        return [
            'role:superadmin|admin_cms',
            'permission:index admin/cms/tags|create admin/cms/tags/create|store admin/cms/tags/store|edit admin/cms/tags/edit|update admin/cms/tags/update|delete admin/cms/tags/delete'
        ];
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Tag::latest()->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('DT_RowIndex', function ($row) {
                    return $row->id;
                })
                ->addColumn('action', function ($row) {
                    $btn = '
                    <form action="' . route('tags.destroy', $row->id) . '" method="POST" class="d-inline delete-data">
                        ' . method_field('DELETE') . csrf_field() . '
                        <div class="btn-group">
                            <button type="button" data-id="' . $row->id . '" data-url="' . route('tags.edit', $row->id) . '" class="btn btn-warning edit">
                                <i class="fa fa-pencil-alt"></i>
                            </button>
                            <button type="submit" class="btn btn-danger" title="Delete">
                                <i class="fa fa-trash-can"></i>
                            </button>
                        </div>
                    </form>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $data = [
            'page_title' => $this->module,
        ];

        return view('backend.cms.tag.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TagStoreRequest $request)
    {
        $data = $request->validated();
        $tags = Tag::create($data);

        return response()->json([
            'success' => __('Data Created Successfully'),
            'data' => $tags
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $tag = Tag::find($id);

        if ($tag) {
            return response()->json([
                'tag' => $tag,
            ]);
        }

        return response()->json(['error' => __('Data not found')], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TagUpdateRequest $request, Tag $tag)
    {
        $data = $request->validated();

        $tag->update($data);

        return response()->json([
            'success' => __('Data Updated Successfully'),
            'data' => $tag
        ], 200);
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();

        return response()->json([
            'success' => __('Data Deleted Successfully'),
        ], 200);
    }
}

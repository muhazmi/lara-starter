<?php

namespace App\Http\Controllers\Admin\Master;

use App\Models\Category;
use App\Models\CategoryType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Routing\Controllers\HasMiddleware;
use App\Http\Requests\Master\CategoryStoreRequest;
use App\Http\Requests\Master\CategoryUpdateRequest;

class CategoryController extends Controller implements HasMiddleware
{
    protected $module;

    public function __construct()
    {
        $this->module = __('Category');
    }

    public static function middleware(): array
    {
        return [
            'role:superadmin|admin_master',
            'permission:index admin/master/categories|create admin/master/categories/create|store admin/master/categories/store|edit admin/master/categories/edit|update admin/master/categories/update|delete admin/master/categories/delete'
        ];
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Category::with('categoryType')->latest()->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('DT_RowIndex', function ($row) {
                    return $row->id;
                })
                ->addColumn('action', function ($row) {
                    $btn = '
                    <form action="' . route('categories.destroy', $row->id) . '" method="POST" class="d-inline delete-data">
                        ' . method_field('DELETE') . csrf_field() . '
                        <div class="btn-group">
                            <button class="btn btn-warning edit-btn" data-id="' . $row->id . '" type="button">
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
            'page_title'        => $this->module,
            'category_types'    => CategoryType::all(),
        ];

        return view('backend.master.category.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryStoreRequest $request)
    {
        $data       = $request->validated();
        $categories = Category::create($data);

        return response()->json([
            'success' => __('Data Created Successfully'),
            'data' => $categories
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $categories = Category::find($id);

        if ($categories) {
            return response()->json([
                'categories' => $categories,
            ]);
        }

        return response()->json(['error' => __('Data not found')], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $data = $request->validated();

        $category->update($data);

        return response()->json([
            'success' => __('Data Updated Successfully')
        ], 200);
    }

    public function show(Category $category)
    {
        return response()->json($category);
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json([
            'success' => __('Data Deleted Successfully'),
        ], 200);
    }
}

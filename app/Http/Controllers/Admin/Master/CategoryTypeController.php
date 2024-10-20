<?php

namespace App\Http\Controllers\Admin\Master;

use App\Models\CategoryType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Master\CategoryTypeStoreRequest;
use App\Http\Requests\Master\CategoryTypeUpdateRequest;
use Illuminate\Routing\Controllers\HasMiddleware;

class CategoryTypeController extends Controller implements HasMiddleware
{
    protected $module;

    public function __construct()
    {
        $this->module = __('Category Type');
    }

    public static function middleware(): array
    {
        return [
            'role:superadmin|admin_master',
            'permission:index admin/master/category_types|create admin/master/category_types/create|store admin/master/category_types/store|edit admin/master/category_types/edit|update admin/master/category_types/update|delete admin/master/category_types/delete'
        ];
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = CategoryType::latest()->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('DT_RowIndex', function ($row) {
                    return $row->id;
                })
                ->addColumn('action', function ($row) {
                    $btn = '
                    <form action="' . route('category_types.destroy', $row->id) . '" method="POST" class="d-inline delete-data">
                        ' . method_field('DELETE') . csrf_field() . '
                        <div class="btn-group">
                            <button type="button" data-id="' . $row->id . '" data-url="' . route('category_types.edit', $row->id) . '" class="btn btn-warning edit">
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

        return view('backend.master.category_type.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryTypeStoreRequest $request)
    {
        $data = $request->validated();
        $category_types = CategoryType::create($data);

        return response()->json([
            'success' => __('Data Created Successfully'),
            'data' => $category_types
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category_type = CategoryType::find($id);

        if ($category_type) {
            return response()->json([
                'category_type' => $category_type,
            ]);
        }

        return response()->json(['error' => __('Data not found')], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryTypeUpdateRequest $request, CategoryType $category_type)
    {
        $data = $request->validated();

        $category_type->update($data);

        return response()->json([
            'success' => __('Data Updated Successfully'),
            'data' => $category_type
        ], 200);
    }

    public function destroy(CategoryType $category_type)
    {
        $category_type->delete();

        return response()->json([
            'success' => __('Data Deleted Successfully'),
        ], 200);
    }
}

<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Models\Menu;
use App\Models\SubMenu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Setting\SubMenuStoreRequest;
use App\Http\Requests\Setting\SubMenuUpdateRequest;

class SubMenuController extends Controller
{
    protected $module;

    public function __construct()
    {
        $this->module = ('Sub Menu');
    }

    public static function middleware(): array
    {
        return [
            'role:masteradmin|superadmin|admin',
            'permission:index admin/master/sub_menus|create admin/master/sub_menus/create|store admin/master/sub_menus/store|edit admin/master/sub_menus/edit|update admin/master/sub_menus/update|delete admin/master/sub_menus/delete'
        ];
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = SubMenu::with('menu')->orderBy('name')->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '
                    <form action="' . route('sub_menus.destroy', $row->id) . '" method="POST" class="d-inline delete-data">
                        ' . method_field('DELETE') . csrf_field() . '
                        <div class="btn-group">
                            <button type="button" data-id="' . $row->id . '" data-url="' . route('sub_menus.edit', $row->id) . '" class="btn btn-warning edit">
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
            'menus'      => Menu::orderBy('name')->get(),
        ];

        return view('backend.setting.sub_menu.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubMenuStoreRequest $request)
    {
        $data = $request->validated();
        $sub_menus = SubMenu::create($data);

        return response()->json([
            'success' => __('Data Created Successfully'),
            'data' => $sub_menus
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $sub_menu = SubMenu::find($id);

        if ($sub_menu) {
            return response()->json([
                'menu' => $sub_menu,
            ]);
        }

        return response()->json(['error' => __('Data not found')], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubMenuUpdateRequest $request, SubMenu $sub_menu)
    {
        $data = $request->validated();

        $sub_menu->update($data);

        return response()->json([
            'success' => __('Data Updated Successfully'),
            'data' => $sub_menu
        ], 200);
    }

    public function destroy(SubMenu $sub_menu)
    {
        $sub_menu->delete();

        return response()->json([
            'success' => __('Data Deleted Successfully'),
        ], 200);
    }
}

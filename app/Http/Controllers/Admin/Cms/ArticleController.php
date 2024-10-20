<?php

namespace App\Http\Controllers\Admin\Cms;

use App\Models\Tag;
use App\Models\Article;

use Illuminate\Support\Str;
use App\Enums\PublishStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Cms\ArticleStoreRequest;
use App\Http\Requests\Cms\ArticleUpdateRequest;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Routing\Controllers\HasMiddleware;

class ArticleController extends Controller implements HasMiddleware
{
    protected $module;

    public function __construct()
    {
        $this->module = __('Article');
    }

    public static function middleware(): array
    {
        return [
            'role:superadmin|admin|admin_cms',
            'permission:index admin/cms/articles|create admin/cms/articles/create|store admin/cms/articles/store|edit admin/cms/articles/edit|update admin/cms/articles/update|delete admin/cms/articles/delete'
        ];
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Article::with('tags')->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('DT_RowIndex', function ($row) {
                    return $row->id;
                })
                ->addColumn('tags', function ($row) {
                    return $row->tags->map(function ($tag) {
                        return '<span class="my-1 btn btn-info">' . $tag->name . '</span>';
                    })->implode(' ');
                })
                ->addColumn('is_published', function ($row) {
                    $description = PublishStatus::getDescription($row->is_published);
                    $class = PublishStatus::getClassBootstrap($row->is_published);
                    return '<button data-id="' . $row->id . '" class="' . $class . ' update-status" >' . $description . '</button>';
                })
                ->addColumn('action', function ($row) {
                    $btn = '
                    <form action="' . route('articles.destroy', $row->id) . '" method="POST" class="d-inline delete-data">
                        ' . method_field('DELETE') . csrf_field() . '
                        <div class="btn-group">
                            <a href="' . route('front.article.show', $row->slug) . '" class="btn btn-primary" target="_blank">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a href="' . route('articles.edit', $row->id) . '" class="btn btn-warning">
                                <i class="fa fa-pencil-alt"></i>
                            </a>
                            <button type="submit" class="btn btn-danger" title="Delete">
                                <i class="fa fa-trash-can"></i>
                            </button>
                        </div>
                    </form>';
                    return $btn;
                })
                ->rawColumns(['tags', 'is_published', 'action'])
                ->make(true);
        }

        $data = [
            'page_title'    => 'Artikel',
        ];

        return view('backend.cms.article.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'page_title'    => __('Create') . ' ' . $this->module,
            'tags'          => Tag::orderBy('name')->get(),
        ];

        return view('backend.cms.article.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleStoreRequest $request)
    {
        $data = $request->validated();

        DB::beginTransaction();

        try {
            if ($request->hasFile('photo')) {
                // Store new image
                $photo          = $request->file('photo');
                $photoName      = $this->storePhoto($photo, $request->title);
                $data['photo']  = $photoName;

                // Generate and store new thumbnail
                $thumbnailName           = $this->storeThumbnail($photo, $request->title);
                $data['photo_thumbnail'] = $thumbnailName;
            }

            // Create the article
            $article = Article::create($data);

            if ($request->has('tag_id')) {
                $article->tags()->sync($request->tag_id);
            }

            DB::commit();

            alert()->success('Success', __('Data Created Successfully'));
            return redirect()->route('articles.index');
        } catch (\Exception $e) {
            DB::rollBack();
            alert()->error('Error', __('Failed to update data. Please try again.') . ' ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        $article = Article::with('tags')->find($article->id);
        $data = [
            'page_title'    => __('Edit') . ' ' . $this->module,
            'articles'      => $article,
            'tags'          => Tag::orderBy('name')->get(),
        ];

        return view('backend.cms.article.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleUpdateRequest $request, Article $article)
    {
        $data = $request->validated();

        DB::beginTransaction();

        try {
            if ($request->hasFile('photo')) {
                // Delete old image and thumbnail if they exist
                Storage::disk('images')->delete('article/' . $article->photo);
                Storage::disk('images')->delete('article/' . $article->photo_thumbnail);

                // Store new image
                $photo          = $request->file('photo');
                $photoName      = $this->storePhoto($photo, $request->title);
                $data['photo']  = $photoName;

                // Generate and store new thumbnail
                $thumbnailName           = $this->storeThumbnail($photo, $request->title);
                $data['photo_thumbnail'] = $thumbnailName;
            }

            $article->update($data);

            DB::commit();

            alert()->success('Success', __('Data Updated Successfully'));
            return redirect()->route('articles.index');
        } catch (\Exception $e) {
            DB::rollBack();
            alert()->error('Error', __('Failed to update data. Please try again.') . ' ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        try {
            // Delete the existing file before uploading the new one
            Storage::disk('images')->delete('article/' . $article->photo);
            Storage::disk('images')->delete('article/' . $article->photo_thumbnail);

            // Menghapus transaksi pengeluaran
            $article->delete();

            // Commit transaksi jika tidak ada kesalahan
            DB::commit();

            return response()->json([
                'success' => $this->module . ' ' . __('Deleted Successfully'),
                'data' => $article
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => __('An error occurred while trying to delete the category type.'),
                'message' => $e->getMessage()
            ], 500);
        }
    }

    private function storePhoto($photo, $name)
    {
        $photoName      = $this->generateFileName($photo, $name);
        $photoDirectory = storage_path('app/assets/images/article');

        // Ensure the directory exists
        if (!File::exists($photoDirectory)) {
            File::makeDirectory($photoDirectory, 0755, true);
        }

        Storage::disk('images')->put('article/' . $photoName, file_get_contents($photo));

        return $photoName;
    }

    private function storeThumbnail($photo, $name)
    {
        $thumbnailName      = $this->generateFileName($photo, $name, 'thumbnail');
        $thumbnailDirectory = storage_path('app/assets/images/article');

        // Ensure the directory exists
        if (!File::exists($thumbnailDirectory)) {
            File::makeDirectory($thumbnailDirectory, 0755, true);
        }

        $image = Image::read($photo->getRealPath());

        // Resize the image
        $image->scale(width: 500)->save($thumbnailDirectory . '/' . $thumbnailName);

        return $thumbnailName;
    }

    private function generateFileName($file, $name, $suffix = '')
    {
        $suffix = $suffix ? '-' . $suffix : '';
        return Str::slug($name) . $suffix . '-' . now()->format('YmdHis') . '.' . $file->extension();
    }

    public function set_active(Request $request, Article $product)
    {
        $data = $request->validated();

        $product->update($data);

        alert()->success('Success', $this->module . ' berhasil diaktifkan.');
        return redirect()->route('products.index');
    }

    public function set_inactive(Request $request, Article $product)
    {
        $data = $request->validated();

        $product->update($data);

        alert()->success('Success', $this->module . ' berhasil dinonaktifkan.');
        return redirect()->route('products.index');
    }

    public function updateStatus(Request $request, Article $booking)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'is_published' => 'required|integer'
        ]);

        $product = Article::findOrFail($request->product_id);
        $product->update(['is_published' => $request->is_published]);

        return response()->json(['success' => 'Status produk berhasil diganti.']);
    }
}

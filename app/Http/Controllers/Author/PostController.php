<?php

namespace App\Http\Controllers\Author;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostStoreRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PostUpdateRequest;
use RealRashid\SweetAlert\Facades\Alert;

class PostController extends Controller
{
    private $module, $categories;

    public function __construct()
    {
        $this->module = 'Post';
        $this->categories = Category::all();
    }

    public function index()
    {
        $data = [
            'page_title'    => 'My Post',
            'categories'    => $this->categories,
            'posts'         => Post::with(['category', 'tags'])
                ->where('author_id', auth()->user()->id)
                ->get(),
        ];

        return view('frontend.author.posts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'page_title' => 'New ' . $this->module,
            'categories' => Category::all(),
            'tags'       => Tag::all(),
        ];

        return view('frontend.author.posts.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostStoreRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($request->title);
        $data['author_id'] = auth()->user()->id;

        if ($request->hasFile('featured_image')) {
            $featured_image = $request->file('featured_image');
            $featured_imageName = now()->format('YmdHis') . '_.' . $featured_image->extension();
            Storage::disk('public')->put('images/posts/' . $featured_imageName, file_get_contents($featured_image));
            $data['featured_image'] = $featured_imageName;
        }

        $post = Post::create($data);

        // Assuming $request->tags is an array of tag IDs
        if ($request->has('tag_id') && is_array($request->tag_id)) {
            $post->tags()->sync($request->tag_id);
        }

        Alert::success('Success', $this->module . ' added successfully.');
        return redirect()->route('author.posts');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $posts = Post::with(['category', 'tags'])->find($post->id);

        $data = [
            'page_title'    => 'Edit Data ' . $this->module,
            'posts'         => $posts,
            'categories'    => Category::all(),
            'tags'          => Tag::all(),
        ];

        return view('frontend.author.posts.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostUpdateRequest $request, Post $post)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($request->title);

        if ($request->hasFile('featured_image')) {
            Storage::disk('public')->delete('images/posts/' . $post->featured_image);

            $featured_image = $request->file('featured_image');
            $featured_imageName = now()->format('YmdHis') . '_.' . $featured_image->extension();
            Storage::disk('public')->put('images/posts/' . $featured_imageName, file_get_contents($featured_image));
            $data['featured_image'] = $featured_imageName;
        }

        $post->update($data);

        // Assuming $request->tags is an array of tag IDs
        if ($request->has('tag_id') && is_array($request->tag_id)) {
            $post->tags()->sync($request->tag_id);
        }

        Alert::success('Success', $this->module . ' updated successfully.');
        return redirect()->route('author.posts');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if (!$post) {
            return back()->with('error', $this->module . ' not found.');
        }

        // Delete the existing image file before uploading the new one
        Storage::disk('public')->delete('images/posts/' . $post->featured_image);

        $post->delete();

        Alert::success('Success', $this->module . ' deleted successfully.');
        return redirect()->route('author.posts');
    }
}

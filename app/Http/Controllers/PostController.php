<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\Project;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class PostController extends Controller
{
    private $categories, $postsByMonthYear;

    public function __construct()
    {
        $this->categories = Category::all();
        $this->postsByMonthYear = Post::select(DB::raw('MONTH(published_at) as month, YEAR(published_at) as year'))
            ->groupBy('month', 'year')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();
    }

    public function index()
    {
        $data = [
            'page_title'            => 'All Post',
            'categories'            => $this->categories,
            'sidebar_recent_posts'  => Post::orderBy('id', 'desc')->limit(3)->get(),
            'latest_posts'          => Post::orderBy('id', 'desc')->paginate(6),
            'monthly_post_archive'  => $this->postsByMonthYear,
        ];

        return view('frontend.posts.index', $data);
    }

    public function show($slug)
    {
        $post = Post::with(['category', 'tags'])
            ->where('slug', $slug)
            ->firstOrFail();

        $data = [
            'posts'                 => $post,
            'page_title'            => $post->title,
            'categories'            => $this->categories,
            'sidebar_recent_posts'  => Post::orderBy('id', 'desc')->limit(3)->get(),
            'related_posts'         => $post->category->posts()->where('id', '!=', $post->id)->take(3)->get(),
            'monthly_post_archive'  => $this->postsByMonthYear,
        ];
        return view('frontend.posts.show', $data);
    }

    public function archive($year, $month)
    {
        $post_archive = Post::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->paginate(10);

        $data = [
            'page_title'            => 'Post Archive: ' . date('F Y', mktime(0, 0, 0, $month, 1, $year)),
            'categories'            => $this->categories,
            'post_archive'          => $post_archive,
            'sidebar_recent_posts'  => Post::orderBy('id', 'desc')->limit(3)->get(),
            'monthly_post_archive'  => $this->postsByMonthYear,
        ];

        return view('frontend.posts.archive', $data);
    }

    public function category($category)
    {
        $category = Category::where('slug', $category)->firstOrFail();

        $data = [
            'page_title'            => 'Post: Category - ' . $category->name,
            'categories'            => $this->categories,
            'post_category'         => $category->posts()->paginate(6),
            'sidebar_recent_posts'  => Post::orderBy('id', 'desc')->limit(3)->get(),
            'monthly_post_archive'  => $this->postsByMonthYear,
        ];

        return view('frontend.posts.category', $data);
    }

    public function search(Request $request)
    {
        $data = [
            'page_title'            => 'Search Result: ' . request()->keywords,
            'categories'            => $this->categories,
            'search_result'         => Post::search($request->input('keywords'))->paginate(6),
            'sidebar_recent_posts'  => Post::orderBy('id', 'desc')->limit(3)->get(),
            'latest_posts'          => Post::orderBy('id', 'desc')->paginate(6),
            'monthly_post_archive'  => $this->postsByMonthYear,
        ];

        return view('frontend.posts.search_result', $data);
    }
}

<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
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
            'page_title'    => 'My Post',
            'categories'    => $this->categories,
            'recent_posts'  => Post::paginate(3),
            'latest_posts'  => Post::paginate(6),
            'monthly_post_archive' => $this->postsByMonthYear,
        ];

        return view('frontend.posts.index', $data);
    }
}

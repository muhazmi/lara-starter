<?php

namespace App\Http\Controllers\Author;

use App\Models\Post;
use App\Models\Category;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'page_title'    => 'My Dashboard',
            'categories'    => Category::all(),
            'recent_posts'  => Post::with(['category'])
                ->where('author_id', auth()->user()->id)
                ->limit(10)
                ->orderBy('created_at','desc')
                ->get(),
        ];

        return view('frontend.author.dashboard', $data);
    }
}

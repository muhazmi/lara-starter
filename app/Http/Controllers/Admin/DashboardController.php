<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Tag;
use App\Models\Booking;
use App\Models\User;
use App\Models\Article;
use App\Models\Expenditure;
use App\Models\Product;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'module'            => 'Dashboard',
            'page_title'        => 'Dashboard',
            'popular_articles'  => Article::getPopularArticles(),
        ];

        return view('backend.dashboard.index', $data);
    }

    public function getData()
    {
        $data = [
            'total_articles'    => Article::getTotalRows(),
            'total_tags'        => Tag::getTotalRows(),
        ];

        return response()->json($data);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Article;

class HomeController extends Controller
{
    public function index()
    {
        $company    = companyInfo();

        $data = [
            'page_title'        => 'Home',
            'latest_articles'   => Article::orderBy('id', 'desc')->limit(3)->get(),
            'tags'              => Article::orderBy('id', 'desc')->limit(3)->get(),
        ];

        return view('frontend.home.index', $data);
    }
}


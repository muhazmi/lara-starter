<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $request->validate([
            'keywords' => 'required|string|max:255',
        ]);

        $keywords = $request->input('keywords');

        // Pencarian di Articles dan Products
        $articleResults = Article::search($keywords)->get();
        $productResults = Product::search($keywords)->get();

        $data = [
            'page_title'    => 'Hasil Pencarian: ' . $keywords,
            'article_results' => $articleResults,
            'product_results' => $productResults,
        ] + $this->getCommonData();

        return view('frontend.search.results', $data);
    }

    private function getCommonData()
    {
        // Implementasi dari method getCommonData, yang mengembalikan data umum untuk semua view
        return [
            'product_categories' => Category::getProducts(),
            'tags_navbar' => Tag::has('articles', '>=', 5)->orderBy('name')->get(),
        ];
    }
}

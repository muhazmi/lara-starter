<?php

namespace App\Http\Controllers;

use App\Enums\PublishStatus;
use App\Models\Tag;
use App\Models\Brand;
use App\Models\Article;
use App\Models\Category;
use App\Models\ArticleView;
use Illuminate\Http\Request;
use Jenssegers\Agent\Facades\Agent;


class ArticleController extends Controller
{
    private $module, $tags, $sidebar_recent_articles, $sidebar_popular_articles;

    public function __construct()
    {
        $this->module                   = __('Article');
        $this->tags                     = Tag::orderBy('name')->get();
        $this->sidebar_recent_articles  = Article::getRecentArticles();
        $this->sidebar_popular_articles = Article::getPopularArticles();
    }

    private function getCommonData()
    {
        return [
            'module'                    => $this->module,
            'tags'                      => $this->tags,
            'sidebar_recent_articles'   => $this->sidebar_recent_articles,
            'sidebar_popular_articles'  => $this->sidebar_popular_articles,
        ];
    }

    public function index()
    {
        $data = [
            'page_title'    => __('Article'),
            'all_articles'  => Article::getLatestArticlesPaginated(),
        ] + $this->getCommonData();

        return view('frontend.article.archive', $data);
    }

    public function show($slug)
    {
        $article = Article::with(['tags'])
            ->where('is_published', PublishStatus::PUBLISHED)
            ->where('slug', $slug)
            ->firstOrFail();

        $visitorInfo  = $this->getVisitorInfo();
        $existingView = $this->checkExistingView($article, $visitorInfo['ipAddress']);

        if (!$existingView || $existingView->article_id !== $article->id) {
            $this->recordView($article, $visitorInfo);
            $this->updateArticleViews($article);
        }

        $data = [
            'detail_article'            => $article,
            'page_title'                => $article->title,
            'related_articles'          => $article->getRelatedArticles(),
        ] + $this->getCommonData();
        return view('frontend.article.show', $data);
    }

    public function tag($tag)
    {
        $tag = Tag::where('slug', $tag)->firstOrFail();

        $data = [
            'page_title'        => $tag->name,
            'article_by_tag'    => $tag->articles()->paginate(6)
        ] + $this->getCommonData();

        return view('frontend.article.tag', $data);
    }

    public function search(Request $request)
    {
        $request->validate([
            'keywords' => 'required|string|max:255',
        ]);

        $keywords = $request->input('keywords');

        $searchResults = Article::search($keywords)->get();

        $data = [
            'module' => __('Search Results'),
            'page_title' => $keywords,
            'search_results' => $searchResults,
        ] + $this->getCommonData();

        return view('frontend.article.search_result', $data);
    }

    private function getVisitorInfo()
    {
        return [
            'browser'    => Agent::browser() . '-' . Agent::version(Agent::browser()),
            'device'     => Agent::device(),
            'platform'   => Agent::platform() . '-' . Agent::version(Agent::platform()),
            'ipAddress'  => request()->getClientIp(),
        ];
    }

    private function checkExistingView($article, $ipAddress)
    {
        return ArticleView::where('article_id', $article->id)
            ->where('ip_address', $ipAddress)
            ->first();
    }

    private function recordView($article, $visitorInfo)
    {
        ArticleView::create([
            'article_id'    => $article->id,
            'ip_address' => $visitorInfo['ipAddress'],
            'browser'    => $visitorInfo['browser'],
            'device'     => $visitorInfo['device'],
            'platform'   => $visitorInfo['platform'],
        ]);
    }

    private function updateArticleViews($article)
    {
        $article->views += 1;
        $article->save();
    }
}

<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Tag;
use Illuminate\Support\Str;
use App\Enums\PublishStatus;
use Laravel\Scout\Searchable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Attributes\SearchUsingFullText;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use Searchable, HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'keywords',
        'meta_description',
        'description',
        'photo',
        'photo_thumbnail',
        'views',
        'is_published',
        'published_at'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (Auth::check()) {
                $model->created_by = Auth::id();
                $model->updated_by = Auth::id();
            }

            // Generate slug if title is set
            if (!empty($model->title)) {
                $model->slug = Str::slug($model->title);
            }
        });

        static::updating(function ($model) {
            if (Auth::check()) {
                $model->updated_by = Auth::id();
            }

            // Regenerate slug if title is updated
            if (!empty($model->title) && $model->isDirty('title')) {
                $model->slug = Str::slug($model->title);
            }
        });
    }

    #[SearchUsingFullText(['title'])]
    public function toSearchableArray()
    {
        return [
            'is_published' => $this->is_published,
            'title' => $this->title,
        ];
    }

    public function searchableAs()
    {
        return 'articles_index'; // Nama index untuk model Article
    }

    public function getFormattedCreatedAtAttribute()
    {
        // Set locale if not already set globally
        Carbon::setLocale('id');

        return Carbon::parse($this->attributes['created_at'])->translatedFormat('l, j F Y H:i');
    }

    public function scopeSearch($query, $keyword)
    {
        return $query->where(function ($query) use ($keyword) {
            $query->where('title', 'like', '%' . $keyword . '%')
                ->orWhere('description', 'like', '%' . $keyword . '%');
        });
    }

    public static function getArticleArchive()
    {
        return static::select(DB::raw('MONTH(published_at) as month, YEAR(published_at) as year'))
            ->groupBy('month', 'year')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();
    }

    public static function getRecentArticles($limit = 5)
    {
        return static::where('is_published', PublishStatus::PUBLISHED)->orderByDesc('id')->limit($limit)->get();
    }

    public static function getPopularArticles($limit = 5)
    {
        return static::where('is_published', PublishStatus::PUBLISHED)->orderByDesc('views')->limit($limit)->get();
    }

    public function getRelatedArticles($limit = 3)
    {
        // Mengumpulkan ID dari tags yang terkait dengan artikel ini
        $tagIds = $this->tags->pluck('id');

        // Mengambil artikel terkait melalui tag dengan menggunakan join
        return Article::whereHas('tags', function ($query) use ($tagIds) {
            $query->whereIn('tags.id', $tagIds);
        })
            ->where('is_published', PublishStatus::PUBLISHED)
            ->where('id', '!=', $this->id)
            ->limit($limit)
            ->get();
    }

    public static function getLatestHomepage()
    {
        return static::where('is_published', PublishStatus::PUBLISHED)
            ->orderByDesc('created_at')
            ->limit(3)
            ->get();
    }

    public static function getLatestArticlesPaginated($perPage = 6)
    {
        return static::where('is_published', PublishStatus::PUBLISHED)
            ->with('tags') // Eager loading tags
            ->orderByDesc('created_at')
            ->paginate($perPage);
    }

    public static function getTotalRows()
    {
        return self::count();
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'article_tags');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function views()
    {
        return $this->hasMany(ArticleView::class);
    }
}

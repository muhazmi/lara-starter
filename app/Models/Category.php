<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'category_type_id',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (Auth::check()) {
                $model->created_by = Auth::id();
                $model->updated_by = Auth::id();

                // Auto-generate slug
                if (!$model->slug) {
                    $model->slug = Str::slug($model->name);
                }
            }
        });

        static::updating(function ($model) {
            if (Auth::check()) {
                $model->updated_by = Auth::id();
            }

            // Re-generate slug if name changes
            if ($model->isDirty('name')) {
                $model->slug = Str::slug($model->name);
            }
        });
    }

    public function scopeExcludeCategories($query, $excludedCategories = [])
    {
        return $query->whereNotIn('slug', $excludedCategories)->orderBy('name');
    }

    public static function getArticles()
    {
        return static::with('categoryType')
            ->whereHas('categoryType', function ($query) {
                $query->where('id', 1);
            })
            ->orderBy('name')
            ->get();
    }

    public static function getTotalRows()
    {
        return self::count();
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function categoryType()
    {
        return $this->belongsTo(CategoryType::class);
    }
}

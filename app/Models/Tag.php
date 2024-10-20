<?php

namespace App\Models;

use App\Models\Article;
use App\Models\Product;
use Illuminate\Support\Str;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = ['name', 'slug'];

    // Pesan log yang disesuaikan
    public function getDescriptionForEvent(string $eventName): string
    {
        return "Tag has been {$eventName}";
    }

    // Menambahkan method getActivitylogOptions sesuai dengan versi terbaru dari spatie/laravel-activitylog
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->useLogName('tag')
            ->setDescriptionForEvent(fn(string $eventName) => "Tag model has been {$eventName}");
    }

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

    public function articles()
    {
        return $this->belongsToMany(Article::class, 'article_tags');
    }

    public static function getTotalRows()
    {
        return self::count();
    }
}

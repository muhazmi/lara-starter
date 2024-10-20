<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoryType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'category_type_id'
    ];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($categoryType) {
            if (empty($categoryType->slug)) {
                $categoryType->slug = Str::slug($categoryType->name);
            }
        });
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}

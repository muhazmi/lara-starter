<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ArticleTag extends Model
{
    use HasFactory;

    protected $fillable = ['article_id', 'tag_id'];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}

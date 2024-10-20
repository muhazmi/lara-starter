<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ArticleView extends Model
{
    use HasFactory;

    protected $fillable = ['article_id', 'ip_address', 'browser', 'device', 'platform'];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}

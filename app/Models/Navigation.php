<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Navigation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'url', 'icon', 'main_menu', 'sort'
    ];

    public function subMenus()
    {
        return $this->hasMany(Navigation::class, 'main_menu', 'id');
    }
}

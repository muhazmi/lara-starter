<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'director_name',
        'short_description',
        'description',
        'email',
        'telephone',
        'phone',
        'address',
        'facebook_link',
        'instagram_link',
        'twitter_link',
        'gmap_link',
        'gmap_location',
        'logo',
        'logo_thumbnail',
        'favicon',
    ];
}

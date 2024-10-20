<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'logo',
        'tax',
        'smtp_protocol',
        'smtp_host',
        'smtp_username',
        'smtp_password',
        'smtp_port',
        'smtp_encryption',
        'favicon',
    ];
}

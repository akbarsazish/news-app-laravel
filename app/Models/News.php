<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $fillable = [
        'author',
        'title',
        'content',
        'description',
        'url',
        'url_to_image',
        'published_at',
    ];
}

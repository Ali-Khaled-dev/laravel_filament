<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleTranslation extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'title',
        'slug',
        'short_descreption',
        'descreption',
        'meta_keywords',
    ];


    public $timestamps = false;

    protected $casts = [
        'meta_keywords' => 'array',
    ];
}

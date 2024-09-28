<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{
    use HasFactory;

    protected $fillable  = [
        'locale',
        'name',
        'slug',
        'meta_descreption',
        'meta_keywords',
        'category_id'
    ];

    public $table = 'category_translation';

    protected $casts = [
        'id' => 'integer',
        'meta_descreption' => 'array',
        'meta_keywords' => 'array',
    ];

    public $timestamps = false;
}

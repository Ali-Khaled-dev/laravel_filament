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
    ];

    public $table = 'category_translation';

    protected $casts = [
        'id' => 'integer',
    ];

    public $timestamps = false;
}

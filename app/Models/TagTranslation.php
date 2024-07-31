<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagTranslation extends Model
{
    use HasFactory;

    public $fillable  = ['name'];

    public $table = 'tag_translation';

    public $timestamps = false;
}

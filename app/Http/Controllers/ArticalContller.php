<?php

namespace App\Http\Controllers;

use App\Models\Artical;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Livewire\WithPagination;

class ArticalContller extends Controller
{
    use WithPagination;

    public function index()
    {
        $categories = Category::all();
        $articals = Artical::all();
        $tags = Tag::all();
        return view('welcome', compact('categories', 'articals', 'tags'));
    }
}

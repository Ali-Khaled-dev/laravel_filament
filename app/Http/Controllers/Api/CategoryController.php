<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Repositry\CategoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $category;

    public function __construct(CategoryInterface $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        return $this->category->index();
    }


    public function store(CategoryRequest $request)
    {
        return $this->category->store($request);
    }


    public function show(string $id)
    {
        return $this->category->show($id);
    }


    public function update(CategoryRequest $request, string $id)
    {
        return $this->category->update($request, $id);
    }


    public function destroy(string $id)
    {
        return $this->category->destroy($id);
    }
}

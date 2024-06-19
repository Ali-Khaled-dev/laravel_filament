<?php

namespace App\Repositry;

use App\http\Resources\CategoryResource;
use App\Http\Controllers\Api\ApiResponseTrait;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryRepositry implements CategoryInterface
{
    use ApiResponseTrait;

    public function index()
    {
        $categories = CategoryResource::collection(Category::all());

        return $this->apiResponse($categories, 'succsess', 200);
    }
    public function store(Request $request)
    {
        $category = Category::create([

            'en' => ['name' => $request->en_name],
            'ar' => ['name' => $request->ar_name],

            'slug' => $request->slug,
        ]);

        return $this->apiResponse(new CategoryResource($category), __('succsess'), 200);
    }
    public function show(string $id)
    {
        $category = Category::findOrFail($id);

        if (!$category) {

            return $this->apiResponse(null, __('The Category not found'), 404);
        }

        return $this->apiResponse(new CategoryResource($category), __('succsess'), 200);
    }
    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);

        $category->en_name = $request->en_name;
        $category->ar_name = $request->ar_name;
        $category->slug = $request->slug;


        return $this->apiResponse($category, __('succsess'), 200);
    }
    public function destroy(string $id)
    {
        $post = Category::findOrFail($id);

        if (!$post) {

            return $this->apiResponse(null, __('The Category Not Found'), 404);
        }

        $post->delete();

        return $this->apiResponse(null, __('success'), 200);
    }
}

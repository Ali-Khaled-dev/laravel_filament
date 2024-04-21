<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Api\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use ApiResponseTrait;
    
    public function index()
    {
        $categories = CategoryResource::collection(Category::all());

        return $this->apiResponse($categories, 'succsess' , 200);
    }

    
    public function store(CategoryRequest $request)
    {
     
       $category = Category::create([

           'en' => ['name' => $request -> en_name],
           'ar' => ['name' => $request -> ar_name],

           'slug' => $request -> slug,
        ]);

        return $this->apiResponse(new CategoryResource($category), __('succsess') , 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::findOrFail($id);

        if(!$category)
        {
        
            return $this -> apiResponse(null, __('The Category not found') , 404);

        }

        return $this -> apiResponse(new CategoryResource($category), __('succsess') , 200);

    }

    
    public function update(CategoryRequest $request, string $id)
    {
        $category= Category::findOrFail($id);

        $category -> en_name = $request -> en_name;
        $category -> ar_name = $request -> ar_name;
        $category -> slug = $request -> slug;
       
 
         return $this->apiResponse($category, __('succsess') , 200);
    }

   
    public function destroy(string $id)
    {
        $post = Category::findOrFail($id);

        if(!$post)
        {

            return $this->apiResponse(null, __('The Category Not Found') , 404);
        
        }

        $post->delete();

            return $this->apiResponse(null, __('success') , 200);
        
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class PostController extends Controller
{

    use ApiResponseTrait;
    
    public function index()
    {

         $posts = PostResource::collection(Post::all());

         return $this->apiResponse($posts, __('succsess'), 200);
   
    }

    public function store(PostRequest $request)
    {
        try {
            $post = Post::create([

                'en' =>[
                 'title' => $request -> en_title,
                 'content' => $request -> en_content,
                ],
 
                'ar'=>[
                 'title' => $request -> ar_title,
                 'content' => $request -> ar_content ,
                ], 
                 'slug' => $request -> slug,
                 'tags' => $request['tags'],
                 'published' => 1,
                 'user_id' => $request-> user_id ,
     
              ]);
 
              return $this -> apiResponse( new PostResource($post),  __('succsess'), 200);
        
        } catch (ModelNotFoundException $e) {
            return $this -> apiResponse( $e, '', 404);
        
        }
      
    }

    public function show(string $id)
    {
        try {
            $post = Post::findOrFail($id);

            return $this->apiResponse(new PostResource($post), __('succsess' ), 200);



        } catch (ModelNotFoundException $e) {
    
            return $this->apiResponse(null, __('The Post Not Found'), 401);
        }        
    
    }

    public function update(PostRequest $request, string $id)
    {
      

            try {

                $post = Post::findOrFail($id);
            
               $post -> update([
                    'en' => [
                    'title' =>$request -> en_title,
                    'content' => $request -> en_content],
        
                    'ar' => [
                    'title' =>$request -> ar_title,
                    'content' => $request -> ar_content],
        
                    'slug' =>$request -> slug,
                    'tags' => $request['tags'],
                    
                ]);
           
                return $this->apiResponse(new PostResource($post), __('succsess' ), 200);


            } catch (ModelNotFoundException $e) 
            {
        
                return $this->apiResponse(null, __('The Post Not Found'), 404);
            
            }

           
           
    }

    public function destroy(string $id)
    {
       try{
        $post = Post::findOrFail($id);

        $post->forceDelete();

        return $this->apiResponse(null, __('success'), 200);

       }catch(ModelNotFoundException $e){
        return $this->apiResponse(null, __('The Post Not Found'), 404);
       
        }
    }

    
}

<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PostController;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;



Route::group(['prefix' => 'auth'], function () 
{
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);  
   
    Route::get('/users', function () 
    {
        $titles = DB::table('users')->pluck('name');
 
        foreach ($titles as $title) {
            echo $title;
           
        }
    });
    
});

Route::group(
    ['middleware' => [ 'auth' , 'checkLang']],function ()  {
        Route::apiResource('/categories',CategoryController::class);
        Route::apiResource('/posts',PostController::class);
         
    }
);




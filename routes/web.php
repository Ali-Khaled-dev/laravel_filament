<?php

use App\Http\Controllers\ArticalContller;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Livewire::setUpdateRoute(function ($handle) {
    return Route::post(LaravelLocalization::setLocale() . '/livewire/update', $handle)
        ->middleware([
            'localeSessionRedirect',
            'localizationRedirect',
            'localeViewPath'
        ]);
});

require __DIR__ . '/auth.php';



Route::get('/', [ArticalContller::class,'index']);

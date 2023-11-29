<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $posts = [];
    if (auth()->check()) { $posts = auth()->user()->posts()->latest()->get(); }
    return view('home', ['posts' => $posts ]);
});

Route::post('/register', [UserController::class, 'register']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/login', [UserController::class, 'login']);

// posts 

Route::post('/create-post', [PostController::class, 'createPost']);
Route::put('/edit-post/{post}', [PostController::class, 'editPost']);
Route::get('/edit-post/{post}', [PostController::class, 'editPostView']);
Route::delete('/delete-post/{post}', [PostController::class, 'deletePost']);

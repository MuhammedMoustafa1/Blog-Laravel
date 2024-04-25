<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;
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

/*Route::get('/', function () {
    return view('welcome');
});

Route::get('/posts',function(){
    $posts = [
        "id"=>1,
        "title"=>"post 1",
        "body"=>"post 1 body",
        "posted_by"=>"Ahmed"
    ];
    return view("posts" , ["posts"=>$posts]);
});

Route::get('/posts',[PostController::class, 'index']);

Route::get('/posts/create',[PostController::class, 'create']);
Route::post('/posts', [PostController::class, 'store']);

Route::get("/posts/{id}",[PostController::class, 'show']);


Route::get("/posts/{id}/edit",[PostController::class, 'edit']);

Route::PUT("/posts/{id}",[PostController::class, 'update']);

Route::delete("/posts/{id}",[PostController::class, 'destroy']);*/


// Route::get('/comments',[CommentController::class,'index'])->name('comments.index');
// Route::get('/comments/create/{postID}',[CommentController::class,'create'])->name('comments.create');
// Route::post('/comments/{postID}',[CommentController::class,'store'])->name('comments.store');
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store')->middleware('auth');


Route::resource("posts",PostController::class);





Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

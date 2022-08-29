<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostsCommentController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\PostsTagController;
use App\Http\Controllers\UserCommentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/', function () {
//     return view('home.index',[]);
// })->name('home.index');

// Route::get('contact', function () {
//     return view('home.contact');
// })->name('home.contact');

Route::get('/', [HomeController::class, 'home'])->name('home.index');
Route::get('/contact', [HomeController::class, 'contact'])->name('home.contact');
Route::get('/secret', [HomeController::class, 'secret'])
    ->name('home.secret')
    ->middleware('can:home.secret');

Route::resource('posts', PostsController::class)
//->middleware('auth')
;
//->only(['index', 'show', 'create', 'store', 'edit', 'update']);

Route::get('/posts/tag/{tag}', [PostsTagController::class, 'index'])->name('posts.tags.index');

Route::resource('posts.comments', PostsCommentController::class)->only(['index','store']);
Route::resource('users.comments',UserCommentController::class)->only(['store']);
Route::resource('users', UserController::class)->only(['show','edit','update']);

// Route::get('posts', function () use($posts) {
//     // dd(request()->all());
//     dd((int)request()->query('page',1));
//     return view('posts.index', ['posts' => $posts]);
// });

// Route::get('posts/{id}', function ($id) use($posts) {

//     abort_if(!isset($posts[$id]),404);
//     return view('posts.show', ['post' => $posts[$id]]);

// })->name('posts.show');

Route::get('recent-posts/{days_ago?}', function ($daysAgo=20) {
    return 'Post from '.$daysAgo.' days ago.';
})->name('posts.recent.index');


// Route::prefix('/fun')->name('fun.')->group(function() use($posts){

//     Route::get('/responses', function () use($posts) {
//         return response($posts, 201)
//             ->header('content-Type', 'application/json')
//             ->cookie('MY_COOKIE','gaurav pipaliya',3600);
//     })->name('responses');
    
//     Route::get('/redirect', function () {
//         return redirect('contact');
//     })->name('redirect');
    
//     Route::get('/back', function () {
//         return back();
//     })->name('back');
    
//     Route::get('/named-route', function () {
//         return redirect()->route('posts.show', ['id' => 1]);;
//     })->name('named-route');
    
//     Route::get('/away', function () {
//         return redirect()->away('https://google.com');
//     })->name('away');
    
//     Route::get('/json', function () use($posts) {
//         return response()->json($posts);;
//     })->name('json');
    
//     Route::get('/download', function () {
//         return response()->download(public_path().'/download.png', '1.png');
//     })->name('download');

// });

Route::get('mailable', function (){
    $comment = App\Models\Comment::find(1);
    return new App\Mail\CommentPostedMarkDown($comment);
});

Auth::routes();
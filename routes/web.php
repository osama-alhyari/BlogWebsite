<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

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

//Public Routes Start----------------------------------------------------------------------------
Route::get('/signup', function () {
    return view('signup');
});
Route::get('/login', function () {
    return view('login');
});
//Public Routes End------------------------------------------------------------------------------

//User Routes Start------------------------------------------------------------------------------

//User Routes End--------------------------------------------------------------------------------

//Admin Routes Start-----------------------------------------------------------------------------

//Admin Routes End-------------------------------------------------------------------------------


Route::get('/', function () {
    return view('user.posts');
});

Route::post('/post', [PostController::class, 'store'])->name('storePost');
Route::get('/post', [PostController::class, 'create'])->name('createPost');
Route::get('/post/{id}', [PostController::class, 'show'])->name('showPost');
Route::post('/register', [AuthController::class, 'registerUser'])->name('registerUser');
Route::get('/register', [AuthController::class, 'registration'])->name('registration');
Route::get('/login', [AuthController::class, 'authentication'])->name('authentication');
Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
Route::get('/', [PostController::class, 'index'])->name('getPosts');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
Route::get('/dashboard', [PostController::class, 'dashboard'])->name('dashboard');
Route::get('/home', [PostController::class, 'index'])->name('home');
Route::post('/comment', [CommentController::class, 'store'])->name('storeComment');
Route::put('/comment/update', [CommentController::class, 'update'])->name('updateComment');
Route::delete('/comment/delete', [CommentController::class, 'destroy'])->name('deleteComment');
Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('deletePost');
Route::get('/edit/{id}', [PostController::class, 'edit'])->name('editPost');
Route::patch('/post/{id}', [PostController::class, 'update'])->name('updatePost');
Route::get('/random', [PostController::class, 'random'])->name('randomPost');

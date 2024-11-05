<?php

use App\Http\Controllers\AuthController;
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

Route::post('/post', [PostController::class, 'store']);
Route::get('/post', [PostController::class, 'create']);
Route::post('/register', [AuthController::class, 'registerUser'])->name('registerUser');
Route::get('/register', [AuthController::class, 'registration'])->name('registration');
Route::get('/login', [AuthController::class, 'authentication'])->name('authentication');
Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
Route::get('/', [PostController::class, 'index'])->name('getPosts');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
Route::get('/dashboard', [PostController::class, 'dashboard'])->name('dashboard');
Route::get('/home', [PostController::class, 'home'])->name('home');

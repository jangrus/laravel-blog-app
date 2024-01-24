<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserRolesController;
use App\Models\Post;
use App\Models\UserRoles;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

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
    return view('posts.index', [
        'posts' => Post::all(),
    ]);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::resource('posts', PostController::class);
Route::middleware('auth')->resource('posts.comments', CommentController::class);

Route::post('posts/{post}/comments/{comment}/store', [CommentController::class, 'nestedComment'])
    ->middleware('auth')
    ->name('comment.comment');

Route::get('myposts', [PostController::class, 'userPosts'])
    ->middleware('auth')
    ->name('myposts');

Route::get('mycomments', [CommentController::class, 'userComments'])
    ->middleware('auth')
    ->name('mycomments');

Route::get('editroles', [ProfileController::class, 'editRoles'])
    ->middleware('auth')
    ->name('editroles');

Route::patch('edit-user-role', [UserRolesController::class, 'update'])
    ->middleware('auth')
    ->name('edit-user-role');

Route::post('likePost', [PostController::class, 'likePost'])
    ->middleware('auth')
    ->name('likePost');

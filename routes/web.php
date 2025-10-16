<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ProfileController,
    PostController,
    CommentController,
    TagController,
    PostUpvoteController,
    CommentUpvoteController,
    PostViewController,
    ReportController,
    AdminController,
    AuthorController
};

Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('/posts', [PostController::class, 'magazine'])->name('posts.magazine');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

Route::get('/authors', [AuthorController::class,'index'])->name('authors.index');
Route::get('/authors/{user}', [AuthorController::class,'show'])->name('authors.show');
Route::get('/authors/most-viewed', [AuthorController::class,'mostViewed'])->name('authors.mostViewed');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class,'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class,'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class,'destroy'])->name('profile.destroy');

    Route::get('posts/create', [PostController::class,'create'])->name('posts.create');
    Route::post('posts', [PostController::class,'store'])->name('posts.store');
    Route::get('posts/{post}/edit', [PostController::class,'edit'])->name('posts.edit');
    Route::put('posts/{post}', [PostController::class,'update'])->name('posts.update');
    Route::delete('posts/{post}', [PostController::class,'destroy'])->name('posts.destroy');

    Route::post('posts/{post}/comments', [CommentController::class,'store'])->name('comments.store');
    Route::put('comments/{comment}', [CommentController::class,'update'])->name('comments.update');
    Route::delete('comments/{comment}', [CommentController::class,'destroy'])->name('comments.destroy');

    Route::post('posts/{post}/upvote', [PostUpvoteController::class,'store'])->name('posts.upvote');
    Route::post('posts/{post}/view', [PostViewController::class,'store'])->name('posts.view');
    Route::post('posts/{post}/report', [ReportController::class,'store'])->name('posts.report');

    Route::post('comments/{comment}/upvote', [CommentUpvoteController::class,'store'])->name('comments.upvote');
    Route::post('comments/{comment}/report', [ReportController::class,'storeComment'])->name('comments.report');

    Route::resource('tags', TagController::class)->only(['index','show']);
});

Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function () {
    Route::get('/dashboard', [AdminController::class,'dashboard'])->name('admin.dashboard');

    Route::get('users', [AdminController::class,'users'])->name('admin.users');
    Route::delete('users/{user}', [AdminController::class,'deleteUser'])->name('admin.users.delete');

    Route::get('posts', [AdminController::class,'posts'])->name('admin.posts');
    Route::delete('posts/{post}', [AdminController::class,'deletePost'])->name('admin.posts.delete');

    Route::get('comments', [AdminController::class,'comments'])->name('admin.comments');
    Route::delete('comments/{comment}', [AdminController::class,'deleteComment'])->name('admin.comments.delete');

    Route::get('reports', [AdminController::class,'reports'])->name('admin.reports');
    Route::post('reports/{report}/resolve', [AdminController::class,'resolveReport'])->name('admin.reports.resolve');
    Route::post('reports/{report}/dismiss', [AdminController::class,'dismissReport'])->name('admin.reports.dismiss');
});

require __DIR__.'/auth.php';
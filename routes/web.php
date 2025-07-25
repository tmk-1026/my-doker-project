<?php

use App\Http\Controllers\HotelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\OwnerReservationController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminPostController;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsOwner;
use App\Http\Middleware\IsGeneralUser;

//  Route::get('/', function () {
   // return view('welcome');
//});
Auth::routes();


Route::get('/home', [HotelController::class, 'index'])->name('top');
Route::get('/hotels', [HotelController::class, 'index'])->name('hotels.index');
Route::get('/hotels/{hotel}', [HotelController::class, 'show'])->name('hotels.show');
Route::post('/hotels/{hotel}/bookmark', [HotelController::class, 'bookmark'])->name('bookmarks.store');
Route::get('/search', [HotelController::class, 'search'])->name('search');
Route::middleware('auth')->group(function () {

Route::get('/reports/create/{post}', [ReportController::class, 'create'])->name('reports.create');
Route::post('/reports', [ReportController::class, 'store'])->name('reports.store');


Route::resource('/posts', PostController::class);
//Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
//Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
//Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
//Route::get('/posts/{post}', [PostController::class, 'show'])->middleware('auth')->name('posts.show');
//Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
//Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
//Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
//Route::get('/reservations/{reservation}', [ReservationController::class, 'show'])->name('reservations.show');   
Route::get('/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
Route::get('/reservations/{reservation}/edit', [ReservationController::class, 'edit'])->name('reservations.edit');
Route::put('/reservations/{reservation}', [ReservationController::class, 'update'])->name('reservations.update');
Route::delete('/reservations/{reservation}', [ReservationController::class, 'destroy'])->name('reservations.destroy');
Route::patch('/reservations/{reservation}/status', [ReservationController::class, 'updateStatus'])->name('reservations.updateStatus');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/bookmarks', [BookmarkController::class, 'index'])->name('bookmarks.index');
    Route::post('/posts/{post}/bookmark', [BookmarkController::class, 'store'])->name('bookmarks.store');
    Route::delete('/posts/{post}/bookmark', [BookmarkController::class, 'destroy'])->name('bookmarks.destroy');
});

Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
// ユーザー一覧表示
Route::get('admin/users', [AdminUserController::class, 'index'])->name('admin.users.index');
// ユーザーステータス切り替え
Route::post('admin/users/{user}/toggle', [AdminUserController::class, 'toggleStatus'])->name('admin.users.toggle');
// 投稿表示・非表示切り替え
Route::post('admin/posts/{post}/toggle', [AdminPostController::class, 'toggleVisibility'])->name('admin.posts.toggle');
// 必要であれば、以下も追加してください
// Route::get('admin/posts', [AdminPostController::class, 'index'])->name('admin.posts.index');
// Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

Route::middleware(['auth', IsOwner::class])
    ->prefix('owner')
    ->name('owner.')
    ->group(function () {
        Route::get('/dashboard', [OwnerController::class, 'dashboard'])->name('dashboard');
        //Route::get('/reservations', [OwnerReservationController::class, 'index'])->name('reservations.index');
        //Route::get('/reservations/{reservation}', [OwnerReservationController::class, 'show'])->name('reservations.show');
        //Route::patch('/reservations/{reservation}/status', [OwnerReservationController::class, 'updateStatus'])->name('reservations.updateStatus');
        Route::get('/users/{user}', [OwnerController::class, 'profile'])->name('users.profile');
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::get('/mypage', [OwnerController::class, 'mypage'])->name('mypage');
        Route::get('/mypage', [OwnerController::class, 'show'])->name('mypage.show');
        Route::get('/mypage/edit', [OwnerController::class, 'edit'])->name('mypage.edit');
        Route::put('/mypage', [OwnerController::class, 'update'])->name('mypage.update');
        Route::delete('/mypage/delete', [OwnerController::class, 'destroy'])->name('mypage.destroy');

});

        Route::get('/mypage', [UserController::class, 'mypage'])->name('mypage');
        Route::get('/mypage', [UserController::class, 'show'])->name('mypage.show');
        Route::get('/mypage/edit', [UserController::class, 'edit'])->name('mypage.edit');
        Route::put('/mypage', [UserController::class, 'update'])->name('mypage.update');
        Route::delete('/mypage/delete', [UserController::class, 'destroy'])->name('mypage.destroy');
        
        Route::get('/users/{user}', [UserController::class, 'profile'])->name('users.profile');
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        
        Route::get('/reservations/create/{post}', [ReservationController::class, 'create'])->name('reservations.create');
        //Route::resource('reservations', ReservationController::class);



require __DIR__.'/auth.php';



//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

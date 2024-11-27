<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VerifyingController;
use App\Http\Controllers\GuestController;

Route::view('/', 'homepage')->name('homepage');


Route::middleware('owner')->group(function () {
    Route::delete('delete/reply/{reply}', [App\Http\Controllers\RepliesController::class, 'destroy'])->name('delete.reply');
    Route::delete('delete/comment/{comment}', [App\Http\Controllers\CommentController::class, 'destroy'])->name('delete.comment');
    Route::delete('delete/post/{post}', [App\Http\Controllers\PostController::class, 'destroy'])->name('delete.post');
    Route::delete('delete/blog/{blog}', [App\Http\Controllers\BlogsController::class, 'destroy'])->name('delete.blog');
});

Route::middleware('guest')->group(function () {
    Route::get('login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
    route::get('register', [\App\Http\Controllers\UserController::class, 'create'])->name('register');
    Route::post('login', [\App\Http\Controllers\AuthController::class, 'authenticate'])->name('login.user');
    Route::post('register/user', [\App\Http\Controllers\UserController::class, 'store'])->name('store.user');
});


Route::middleware('auth')->group(function () {
    Route::get('/verify-email/{user}', [VerifyingController::class, 'verification'])->name('verify.email');
    Route::view('/user/setup', 'user.setup')->name('user.setup');
    Route::post('user/details', [App\Http\Controllers\UserDetailController::class, 'store'])->name('store.detail');
    Route::get('/user/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::post('purchese/ticket/{ticket}/event/{event}', [\App\Http\Controllers\TicketController::class, 'purchese'])->name('purchese.ticket');
    Route::get('user/profile/{user}', [\App\Http\Controllers\UserController::class, 'show'])->name('show.user');
    Route::post('/add/friend/{user}', [\App\Http\Controllers\FirendsController::class, 'send'])->name('add.friend');
    Route::post('/friend-request/accept/{id}', [\App\Http\Controllers\FirendsController::class, 'accept'])->name('accept.friend');
    Route::post('/friend-request/reject/{id}', [\App\Http\Controllers\FirendsController::class, 'reject'])->name('reject.friend');
    Route::post('/unfriend/user/{id}', [\App\Http\Controllers\FirendsController::class, 'unfriend'])->name('unfriend.user');
    Route::get('/blogs', [\App\Http\Controllers\BlogsController::class, 'index'])->name('all.blogs');
    Route::get('logut/user', [App\Http\Controllers\UserController::class, 'logOut'])->name('logout');
    Route::post('/user/{user}/liked/comment/{comment}', [App\Http\Controllers\CommentController::class, 'likeComment'])->name('like.comment');
    Route::get('/blog/{blog}', [App\Http\Controllers\BlogsController::class, 'show'])->name('show.blog');
    Route::post('add/comment/{blog}', [\App\Http\Controllers\CommentController::class, 'store'])->name('add.comment');
    Route::get('all/events', [\App\Http\Controllers\EventController::class, 'index'])->name('all.events');
    Route::get('show/event/{event}', [App\Http\Controllers\EventController::class, 'show'])->name('show.event');
    Route::get('/show/comment/{comment}', [App\Http\Controllers\CommentController::class, 'show'])->name('show.comment');
    Route::post('add/reply/{comment}', [App\Http\Controllers\RepliesController::class, 'store'])->name('add.reply');
    Route::patch('edit/reply/{reply}', [App\Http\Controllers\RepliesController::class, 'edit'])->name('edit.reply');
    Route::get('/create/blog', [App\Http\Controllers\BlogsController::class, 'create'])->name('create.blog');
    Route::post('blog/created', [App\Http\Controllers\BlogsController::class, 'store'])->name('store.blog');
    Route::get('edit/blog/{blog}', [App\Http\Controllers\BlogsController::class, 'edit'])->name('edit.blog');
    Route::put('update/blog/{blog}', [App\Http\Controllers\BlogsController::class, 'update'])->name('update.blog');
    Route::get('/my/blogs', [App\Http\Controllers\BlogsController::class, 'userBlogs'])->name('user.blogs');
    Route::put('update/user/{user}', [App\Http\Controllers\UserController::class, 'update'])->name('update.user');
    Route::put('update/bio/for/{user}', [App\Http\Controllers\BiographyController::class, 'update'])->name('update.biography');
    Route::put('update/address/for/{user}', [App\Http\Controllers\AddressController::class, 'update'])->name('update.address');
    Route::get('all/friends/{user}', [App\Http\Controllers\UserController::class, 'showFriends'])->name('all.friends');
    Route::post('create/post/{user}', [App\Http\Controllers\PostController::class, 'store'])->name('add.recommendation');
    Route::get('/all/conferences/', [App\Http\Controllers\EventController::class, 'conferance'])->name('all.conferences');
    Route::get('/all/users', [App\Http\Controllers\UserController::class, 'index'])->name('all.users');
    Route::delete('/delete/post/{post}', [App\Http\Controllers\PostController::class, 'destroy'])->name('delete.post');
    Route::patch('/patch/post/{post}', [App\Http\Controllers\PostController::class, 'edit'])->name('edit.post');
});

Route::middleware('normalAdmin')->group(function () {
    Route::delete('delete/user/{user}', [App\Http\Controllers\superAdminController::class, 'destroyUser'])->name('destroy.user');
    Route::post('/store/event/', [App\Http\Controllers\EventController::class, 'store'])->name('store.event');
    Route::get('create/event', [App\Http\Controllers\EventController::class, 'create'])->name('create.event');
    Route::post('/edit/event/{event}', [App\Http\Controllers\EventController::class, 'edit'])->name('edit.event');
    Route::delete('delete/event/{event}', [App\Http\Controllers\EventController::class, 'destroy'])->name('destroy.event');
    Route::delete('delete/guest/{guest}', [GuestController::class, 'destroy'])->name('delete.guest');
    Route::post('add/guest/{event}', [GuestController::class, 'store'])->name('create.guest');
    Route::put('update/event/{event}', [App\Http\Controllers\EventController::class, 'update'])->name('update.event');
    Route::post('create/guest/{event}', [App\Http\Controllers\GuestController::class, 'create'])->name('store.guest');
    Route::get('admin/dashboard/', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/all/posts', [App\Http\Controllers\PostController::class, 'index'])->name('all.posts');
    Route::get('/show/post/{user}', [App\Http\Controllers\PostController::class, 'show'])->name('show.post');
    Route::get('purchesed/tickets', [App\Http\Controllers\TicketController::class, 'purchesedTickets'])->name('purchesed.tickets');
});

Route::middleware('superAdmin')->group(function () {
    Route::patch('user/update-admin/{user}', [App\Http\Controllers\superAdminController::class, 'updateAdmin'])->name('update.admin');
    Route::get('all/admins', [App\Http\Controllers\superAdminController::class, 'index'])->name('all.admins');
});



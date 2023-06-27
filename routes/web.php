<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name("dashboard");

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource("category", CategoryController::class)->middleware("isAdmin")->except("show");
    Route::resource("post", PostController::class)->except(["edit", "update", "destroy", "show"]);
    Route::get("post/{post}/edit", [PostController::class, "edit"])->can("update","post")->name("post.edit");
    Route::put("post/{post}", [PostController::class, "update"])->can("update","post")->name("post.update");
    Route::delete("post/{post}", [PostController::class, "destroy"])->can("delete","post")->name("post.destroy");


});

require __DIR__ . '/auth.php';

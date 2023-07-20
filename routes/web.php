<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
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

Route::get("/", function (){
   return redirect()->route("posts.index");
})->name("home");

Route::resource('posts', PostsController::class)->shallow();
Route::get('/posts/{id}', [App\Http\Controllers\PostsController::class, 'show'])->name("showPost");



Route::get("/contact", [\App\Http\Controllers\StaticPageController::class, "contact"])->name("contact");
Route::post("/contacted", [\App\Http\Controllers\StaticPageController::class, "create"])->name("contacted");

Route::get("/about", [\App\Http\Controllers\StaticPageController::class, "about"])->name("about");
Route::get("/author", [\App\Http\Controllers\StaticPageController::class, "author"])->name("author");

Route::get("/login", [\App\Http\Controllers\LoginController::class, "index"])->name("login");
Route::POST("/logIn", [\App\Http\Controllers\LoginController::class, "login"])->name("logIn");

Route::get("/register", [\App\Http\Controllers\RegisterController::class, "index"])->name("register");
Route::post("/registered", [\App\Http\Controllers\RegisterController::class, "create"])->name("registered");

Route::get("/contactAdmin", [\App\Http\Controllers\StaticPageController::class, "contactAdmin"])->name("contactAdmin");
Route::post("/contactedAdmin", [\App\Mail\ContactAdministratorMail::class, "sendMail"])->name("contactedAdmin");






Route::middleware(["loggedIn"])->group(function(){
    Route::get("/account", [\App\Http\Controllers\AccountController::class, "index"])->name("account");
    Route::get("/logout", [\App\Http\Controllers\LoginController::class, "logout"])->name("logout");
    Route::post("/changeProfileImg", [\App\Http\Controllers\AccountController::class, "changeProfileImg"])->name("changeProfileImg");
    Route::post("/changeAccountPassword", [\App\Http\Controllers\AccountController::class, "changeAccountPassword"])->name("changeAccountPassword");
    Route::post("/commented", [\App\Http\Controllers\CommentController::class, "store"])->name("commented");
    Route::post("/commentedDelete", [\App\Http\Controllers\CommentController::class, "destroy"])->name("commentedDelete");
    Route::post("/likedComment", [\App\Http\Controllers\LikesController::class, "store"])->name("likedComm");
    Route::post("/likedPost", [\App\Http\Controllers\LikesController::class, "storePost"])->name("likedPost");

});

Route::middleware(['loggedInAdmin'])->group(function () {
    Route::get("/adminDashboard",[\App\Http\Controllers\AdminController::class, "index"])->name("dashboard");
    Route::delete("/adminDashboardUserDelete", [\App\Http\Controllers\AdminController::class, "destroyUser"])->name("destroyUser");
    Route::get("/adminDashboard/{offset}/{search?}",[\App\Http\Controllers\AdminController::class, "ajaxUser"]);
    Route::get("/adminMessages/{offset}/{search?}",[\App\Http\Controllers\AdminController::class, "ajaxMessages"]);
    Route::get("/postsAdmin",[\App\Http\Controllers\AdminController::class, "posts"])->name("postsAdmin");
    Route::get("/userActivity",[\App\Http\Controllers\AdminController::class, "userActivity"])->name("userActivity");
    Route::resource('tags', \App\Http\Controllers\AdminTagsController::class)->shallow();
    Route::post('editTag', [\App\Http\Controllers\AdminTagsController::class, "update"]);
    Route::resource('categories', \App\Http\Controllers\AdminCategoriesController::class)->shallow();
    Route::post('editCategory', [\App\Http\Controllers\AdminCategoriesController::class, "update"]);
    Route::delete("/postDeletedAdmin/{id}", [\App\Http\Controllers\AdminController::class, "destroy"]);
});

Route::get("/error", [\App\Http\Controllers\StaticPageController::class, "error"])->name("error");



<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Blog\Frontend\CommentController;
use App\Http\Controllers\Blog\Backend\Auth\AuthController;
use App\Http\Controllers\Blog\Frontend\HomepageController;
use App\Http\Controllers\Blog\Backend\Article\ArticleController;
use App\Http\Controllers\Blog\Backend\Message\MessageController;
use App\Http\Controllers\Blog\Backend\Category\CategoryController;

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

/*
|--------------------------------------------------------------------------
| BLOG FROTEND
|--------------------------------------------------------------------------
*/
Route::get('/', [HomepageController::class,'index'])->name('homepage');
Route::get('/contact', [HomepageController::class,'contact'])->name('contact');
Route::post('/contact', [HomepageController::class,'postContact'])->name('contact.post');
Route::get('/category/{category}', [HomepageController::class,'category'])->name('category');
Route::get('/blog/{slug}', [HomepageController::class,'single'])->name('single');
//Comment Part
Route::post('/article/{id}/comment' ,[CommentController::class,'makeComment'])->name('make.comment');
Route::get('/comment/{id}/delete' ,[CommentController::class,'deleteComment'])->name('delete.comment');
/*
/--------------------------------------------------------------------------
*/


/*
|--------------------------------------------------------------------------
| BLOG BACKEND
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function(){
    Route::get('/',function(){return view('blog.admin.home');})->middleware('isAdmin')->name('dashboard');
    Route::get('/login',[AuthController::class,'index'])->name('login')->middleware('isLogin');
    Route::post('/login',[AuthController::class,'login'])->name('login.post')->middleware('isLogin');
    Route::get('/logout',[AuthController::class,'logout'])->name('logout');

    //Article Part
    Route::get('/articles/trash',[ArticleController::class,'trashCan'])->name('soft.deleted.articles');
    Route::get('/articles/recover/{id}',[ArticleController::class,'recover'])->name('soft.recover.articles');
    Route::get('/articles/delete/{id}',[ArticleController::class,'softDelete'])->name('soft.delete');
    Route::get('/articles/{id}/delete',[ArticleController::class,'hardDelete'])->name('hard.delete');
    Route::resource('articles', ArticleController::class);


    //Category Part
    Route::get('/categories/{id}/delete',[CategoryController::class,'delete'])->name('category.delete');
    Route::resource('categories', CategoryController::class);

    //Message Part
    Route::get('/messages',[MessageController::class,'index'])->name('message');
    Route::get('/message/{id}/delete',[MessageController::class,'messageDelete'])->name('message.delete');
    Route::get('/message/{id}/read',[MessageController::class,'messageRead'])->name('message.read');
});
/*
/--------------------------------------------------------------------------
*/
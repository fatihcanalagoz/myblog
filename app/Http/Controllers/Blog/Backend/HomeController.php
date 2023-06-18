<?php

namespace App\Http\Controllers\Blog\Backend;

use App\Models\Blog\Article;
use App\Models\Blog\Comment;
use Illuminate\Http\Request;
use App\Models\Blog\Category;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index () {
        $models['articles'] = Article::count();
        $models['categories'] = Category::all();
        $models['comments'] = Comment::all();
        return view('blog.admin.home',$models);
    }
}

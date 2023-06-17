<?php

namespace App\Http\Controllers\Blog\Frontend;

use App\Models\Blog\Article;
use App\Models\Blog\Contact;
use Illuminate\Http\Request;
use App\Models\Blog\Category;
use App\Http\Controllers\Controller;

class HomepageController extends Controller
{
    public function index(){
        $models['categories'] = Category::inRandomOrder()->get();
        $models['articles'] = Article::orderByDesc('created_at')->paginate(5);
        return view('blog.frontend.home', $models );
    }

    public function single($slug){
        $article =  Article::whereSlug($slug)->first() ?? abort(404);
        $article->increment('hit');
        $models['article'] = $article;
        $models['categories'] = Category::inRandomOrder()->get();
        
        return view('blog.frontend.post',$models);
    }

    public function category($slug){
        $category = Category::whereSlug($slug)->first() ?? abort(404);
        $models['category'] = $category;
        $models['articles'] = Article::where('category_id',$category->id)->orderByDesc('created_at')->paginate(5);
        $models['categories'] = Category::inRandomOrder()->get();
        return view('blog.frontend.category',$models);
    }
    public function contact(){
        return view('blog.frontend.contact');
    }
    public function postContact(Request $request){

        $validate = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required'
        ]);
       
        $models = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message
        ]);
        toastr()->success('Mesajınız Gönderildi.','Başarılı');
        return redirect()->route('contact');
    }
}

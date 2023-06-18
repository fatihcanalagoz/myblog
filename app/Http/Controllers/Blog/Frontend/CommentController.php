<?php

namespace App\Http\Controllers\Blog\Frontend;

use Illuminate\Support\Str;
use App\Models\Blog\Article;
use App\Models\Blog\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function index ($id) {
        $comments = Comment::orderBy('created_at','DESC')->with('getComment')->get();
        $article = Article::all();
       
        return view('blog.frontend.widgets.CommentWidget',compact('comments','article'));
    }

    public function makeComment(Request $request,$id){
        $articles = Article::whereId($id)->first    () ?? abort('404');
        $request->validate([
            'name' => 'required|string|max:20|min:3',
            'comment' => 'required|string|max:200|min:3',

        ]);
        if(Str::lower($request->name) == 'admin' ||Str::lower($request->name) == 'fatih can alagöz' ||
         Str::lower($request->name) == 'fatihcan alagöz'|| Str::lower($request->name) == 'fatihcanalagöz'||
         Str::lower($request->name) == 'fatih can alagoz' ||Str::lower($request->name) == 'fatih canalagoz' || Str::lower($request->name) == 'fatihcanalagoz'){
            return  redirect()->back()->withErrors('Bu isimin kullanılması yasaktır.');
        }
        Comment::create([
            'name' => $request->name,
            'comment' => $request->comment,
            'article_id' => $articles->id
        ]);

        return redirect()->back();
    
    }

    public function deleteComment($id){
        $comments = Comment::whereId($id)->first() ?? abort('404');
        $comments->delete();

        toastr()->success('Yorum silindi','Başarılı');
        return redirect()->back();
    }
}

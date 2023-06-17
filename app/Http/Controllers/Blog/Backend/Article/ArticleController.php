<?php

namespace App\Http\Controllers\Blog\Backend\Article;

use Illuminate\Support\Str;
use App\Models\Blog\Article;
use Illuminate\Http\Request;
use App\Models\Blog\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $models = Article::orderBy('created_at','DESC')->get();
       
        return view('blog.admin.articles.index',compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all();
      
        return view('blog.admin.articles.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'title' => 'required|string',
            'category' => 'required|string',
            'content' => 'required|string',
            'image' => 'required|mimes:jpg,png,jpeg|max:2048',
        ]);
        $model = new Article();
       
       if( $model->whereTitle($request->title)  ){
           
        return redirect()->back()->withErrors('Bu isimde blog yazısı mevcut.');
       }
        $model->title=$request->title;
        $model->category_id=$request->category;
        $model->content=$request->content;
        $model->status=$request->status;
        $model->slug=Str::slug($request->title);
      if($request->hasFile('image')){
        $imageName = Str::slug($request->title).'.'.$request->image->getClientOriginalExtension();
        $request->image->move(public_path('blog/assets/img'),$imageName);
        $imagePath = '/blog/assets/img/'.$imageName;
        $model->image=$imagePath;
      }
     
           $model->save();
           toastr()->success('Makale başarıyla oluşturuldu!', 'Başarılı');
        return redirect()->route('admin.articles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $articles = Article::findOrFail($id);
        $category = Category::all();
        return view('blog.admin.articles.update',compact('articles','category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = $request->validate([
            'title' => 'required|string',
            'category' => 'required|string',
            'content' => 'required|string',
            'image' => 'image|mimes:jpg,png,jpeg|max:2048',
        ]);
        $model =  Article::findOrFail($id);
        $model->title=$request->title;
        $model->category_id=$request->category;
        $model->content=$request->content;
        $model->status = $request->status;
        $model->slug=Str::slug($request->title);
      if($request->hasFile('image')){
        $imageName = Str::slug($request->title).'.'.$request->image->getClientOriginalExtension();
        $request->image->move(public_path('blog/assets/img'),$imageName);
        $imagePath = '/blog/assets/img/'.$imageName;
        $model->image=$imagePath;
      }
     
           $model->save();
           toastr()->success('Makale başarıyla Güncellendi!', 'Başarılı');
        return redirect()->route('admin.articles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function softDelete(Request $request,string $id)
    {
        Article::findOrFail($id)->delete();
        toastr()->success('Makale başarıyla kaldırıldı','başarılı');
        return redirect()->route('admin.articles.index');
    }
    public function trashCan(){
        $models = Article::onlyTrashed()->orderBy('created_at','desc')->get();
        return view('blog.admin.articles.trash',compact('models'));
    }

    public function recover($id){
        Article::onlyTrashed()->findOrFail($id)->restore();
        toastr()->success('Başarılı',' Makale başarıyla kurtarıldı.');
        return redirect()->route('admin.articles.index');
    }
    public function hardDelete(string $id)
    {
        $article = Article::onlyTrashed()->findOrFail($id);
 
        if(!File::exists($article->image)){
             File::delete(public_path($article->image));
        }
        $article->forceDelete();
        toastr()->success('Başarılı','Makale başarıyla silindi.');
        return redirect()->route('admin.soft.deleted.articles');
    }
}

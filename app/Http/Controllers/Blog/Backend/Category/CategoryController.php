<?php

namespace App\Http\Controllers\Blog\Backend\Category;

use Illuminate\Support\Str;
use App\Models\Blog\Article;
use Illuminate\Http\Request;
use App\Models\Blog\Category;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    //SHOW CATEGORY
   public function index (){
    $categories = Category::orderBy('created_at' ,'DESC')->get();
    return view('blog.admin.categories.index',compact('categories'));
   }


//CREATE CATEGORY
   public function store(Request $request){
    $categoryName = Category::whereName($request->category)->first();

    if($categoryName){
        toastr()->error('Bu isimde kategori zaten var!', 'Hata!, ');
        return redirect()->back();
    }
    Category::create([
        'name' => Str::studly($request->category),
        'slug' => Str::slug($request->category),
    ]);
    toastr()->success('Kategori başarıyla oluşturuldu!', 'Başarılı');
    return redirect()->route('admin.categories.index');
   }


   
   //DELETE CATEGORY
   public function delete($id){
    $category = Category::findOrFail($id) ?? abort('404');
    if($category->id == 1){
        toastr()->warning('Bu kategori silinemez!', 'Hata!, ');
        return redirect()->back();
    }
    if($category->articleCount() > 0){
        Article::whereCategoryId($category->id)->update(['category_id' => 1]);
    }
    $category->delete();
    toastr()->success('Kategori başarıyla Silindi!', 'Başarılı');
    return redirect()->route('admin.categories.index');
   }

   public function update(Request $request,$id){
    $category = Category::findOrFail($id);
    $category->name = Str::studly($request->categoryName);
    $category->save();
    toastr()->success('Kategori güncellendi!', 'Başarılı');
    return redirect()->route('admin.categories.index');
   }
}


//TODO asdasdas
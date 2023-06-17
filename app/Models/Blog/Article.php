<?php

namespace App\Models\Blog;

use App\Models\Blog\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;
    use SoftDeletes;
    public function getCategory(){
        return $this->hasOne(Category::class,'id','category_id');
    }
}

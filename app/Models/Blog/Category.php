<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name','slug'];
    public function articleCount(){
        return $this->hasMany(Article::class,'category_id','id')->count();
    }
}

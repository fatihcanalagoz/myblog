<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['Eglence','Spor','Psikoloji','Edebiyat','Yazilim','Teknoloji'];
        foreach($categories as $category){

            DB::table('categories')->insert([
                'name' => $category,
                'slug' => Str::slug($category)
            ]);
        }
    }
}

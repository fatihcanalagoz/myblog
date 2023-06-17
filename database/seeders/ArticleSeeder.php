<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
 

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
 

      for ($i=0; $i < 5; $i++) { 
        DB::table('articles')->insert([
            'category_id' => rand(1,5),
            'title' => fake()->sentence(rand(3,7)),
            'image' => fake()->imageURL(800,400,'cats',true,'Faker'),
            'content' => fake()->paragraph(5),
            'slug' => Str::slug(fake()->sentence(rand(3,7))),
            'created_at' => fake()->dateTime('now'),
            'updated_at' => now()
            
        ]);
      }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Article::create([
            'title' => 'php',
            'body' => 'PHP: Hypertext Preprocessor is a widely-used open source general-purpose scripting language that is especially suited for web development and can be embedded into HTML.',
            'user_id' => 1,
            
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = Tag::factory(10)->create();
        $posts = Post::all();
        foreach($posts as $post){
            $tagPool = $tags->shuffle()->take(rand(0, $tags->count()));
            foreach($tagPool as $tag){
                $post->tags()->attach($tag);
            }
        }
    }
}

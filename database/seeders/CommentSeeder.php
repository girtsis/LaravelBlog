<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $posts = Post::all();
//        $comments = Comment::factory(1000)->make();
//        foreach ($comments as $comment){
//            $comment->user_id = $users->random()->id;
//            $comment->post_id = $posts->random()->id;
//            $comment->save();
//        }
        foreach($posts as $post){
            $comments = Comment::factory(rand(0,20))->make();
            foreach ($comments as $comment){
                $comment->user_id = $users->random()->id;
                $comment->post_id = $post->id;
                $comment->save();
            }
        }
    }
}

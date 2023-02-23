<?php

namespace Database\Seeders;

use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LikeSeeder extends Seeder
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

        foreach($posts as $post){
            $likes = Like::factory(rand(0,$users->count()))->make();
            $userPool = $users->shuffle()->take($likes->count());
            foreach ($likes as $like){
                $like->user_id = $userPool->pop()->id;
                $like->post_id = $post->id;
                $like->save();
            }
        }
    }
}

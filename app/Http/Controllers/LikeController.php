<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Http\Requests\StoreLikeRequest;
use App\Http\Requests\UpdateLikeRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
   public function like(Post $post){
       $like = Auth::user()->likes()->where('post_id', $post->id)->first();
       if(!$like){
           $like = new Like();
           $like->user()->associate(Auth::user());
           $like->post()->associate($post);
           $like->save();
       } else {
           $like->delete();
       }
       return redirect()->back();
   }
}

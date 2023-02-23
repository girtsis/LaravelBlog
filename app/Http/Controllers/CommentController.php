<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CommentController extends Controller
{
    public function comment(UpdateCommentRequest $request, Post $post){
        $comment = new Comment();
        $comment->body = $request->input('body');
        $comment->user()->associate(Auth::user());
        $comment->post()->associate($post);
        $comment->save();
        return redirect()->back();
    }

    public function delete(Post $post, Comment $comment){
        if(Auth::user() != $comment->user){
            throw new NotFoundHttpException();
        }
        $comment->delete();
        return redirect()->back();
    }

    public function edit(UpdateCommentRequest $request, Post $post, Comment $comment){
        if(Auth::user() != $comment->user){
            throw new NotFoundHttpException();
        }
        $comment->body = $request->input('body');
        $comment->save();
        return redirect()->back();
    }
}

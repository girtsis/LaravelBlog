<?php

namespace App\Http\Controllers;

use App\Jobs\ImageUpload;
use App\Models\Image;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $posts = Auth::user()->posts()->latest()->paginate();
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StorePostRequest $request)
    {
//        $post = new Post();
//        $post->title = $request->input('title');
//        $post->body = $request->input('body');
        $post = new Post($request->validated());
        $post->user()->associate(Auth::user());
        $post->save();
        if($request->has('images')) {
            foreach ($request->validated('images') as $file) {
                $path = $file->store('public');
                ImageUpload::dispatch($post->id, $path);
            }
        }
        return redirect()->route('posts.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        if(Auth::user() != $post->user){
            throw new NotFoundHttpException();
        }
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if(Auth::user() != $post->user){
            throw new NotFoundHttpException();
        }
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
//        $post->title = $request->validated('title');
//        $post->body = $request->validated('body');
        $post->fill($request->validated());
        $post->save();
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if(Auth::user() != $post->user){
            throw new NotFoundHttpException();
        }
        $post->delete();
        return redirect()->route('posts.index');
    }
}

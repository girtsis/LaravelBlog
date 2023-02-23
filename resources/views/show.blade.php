@extends('layouts.app')
@section('content')
    @include('partials.post-card')
    <h3 class="m-4">Comments</h3>
    <div class="card mt-2">
        <div class="card-body">
            <form action="{{route('post.comment', ['post'=>$post])}}" method="POST">
                @csrf
                <textarea id="body" class="form-control mb-2" name="body" rows="3" placeholder="Add comment here..."></textarea>
                <button class="btn btn-primary" type="submit">Post</button>
            </form>
        </div>
    </div>
    @foreach($post->comments()->latest()->get() as $comment)
        <div class="card mt-2" x-data="{ open: false }">
            <div class="card-body">
                <p x-show="!open" class="card-text">{{$comment->body}}</p>
                @if($comment->user == Auth::user())
                    <button x-show="!open" x-on:click="open = !open">Edit</button>
                    <form x-show="!open" action="{{route('post.comment.delete', ['post'=>$post, 'comment'=>$comment])}}" method="GET">
                        @csrf
                        <button class="btn btn-primary" type="submit">Delete</button>
                    </form>
                    <form x-show="open" action="{{route('post.comment.edit', ['post'=>$post, 'comment'=>$comment])}}" method="POST">
                        @csrf
                        <textarea id="body" class="form-control mb-2" name="body" rows="3" >{{$comment->body}}</textarea>
                        <button class="btn btn-primary" type="submit">Save</button>
                    </form>
                @endif
            </div>
            <div class="card-footer">
                {{$comment->user->name}}<br>
                {{$comment->created_at->diffForHumans()}}
            </div>
        </div>
    @endforeach
@endsection

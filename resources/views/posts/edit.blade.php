@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{route('posts.update', ['post' => $post])}}" method="POST">
            @method('PUT')
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input
                    type="text"
                    class="form-control @error('title') is-invalid @enderror"
                    id="title"
                    placeholder="Title"
                    name="title"
                    value="{{old('title') ?? $post->title}}"
                >
                @error('title')
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="body" class="form-label">Content</label>
                <textarea
                    class="form-control @error('body') is-invalid @enderror"
                    id="body"
                    rows="12"
                    name="body">{{old('body') ?? $post->body}}</textarea>
                @error('body')
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <div class="mb-3">
                <input type="submit" class="btn btn-primary" value="Update">
            </div>
        </form>
    </div>
@endsection

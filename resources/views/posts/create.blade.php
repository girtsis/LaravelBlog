@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{route('posts.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input
                    type="text"
                    class="form-control @error('title') is-invalid @enderror"
                    id="title"
                    placeholder="Title"
                    name="title" value="{{old('title')}}" >
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
                    name="body">{{old('body')}}</textarea>
                @error('body')
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="images" class="form-label">Images</label>
                <input multiple type="file" id="images" name="images[]" class="form-control" accept="image/*">
                @error('images')
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <div class="mb-3">
                <input type="submit" class="btn btn-primary" value="Add post">
            </div>
        </form>
    </div>
@endsection

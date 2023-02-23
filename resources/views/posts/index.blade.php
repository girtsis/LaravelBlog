@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{route('posts.create')}}" class="btn btn-primary">Add Post</a>
       {{$posts->links()}}
        <table class="table table-striped table-hover">
            <thead>
                <th>ID</th>
                <th>Title</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Actions</th>
            </thead>

            <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td>{{$post->id}}</td>
                        <td>{{$post->title}}</td>
                        <td>{{$post->created_at}}</td>
                        <td>{{$post->updated_at}}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{route('posts.show',['post'=>$post])}}" class="btn btn-info">View</a>
                                <a href="{{route('posts.edit',['post'=>$post])}}" class="btn btn-warning">Edit</a>
                                <button form="post-delete-form-{{$post->id}}" class="btn btn-danger">Delete</button>
                            </div>
                            <form id="post-delete-form-{{$post->id}}" action="{{route('posts.destroy', ['post'=>$post])}}" method="POST">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>

            <tfoot>
                <th>ID</th>
                <th>Title</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Actions</th>
            </tfoot>
        </table>
        {{$posts->links()}}
    </div>
@endsection

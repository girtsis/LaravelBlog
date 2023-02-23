@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table table-striped">
            <tbody>
                <tr>
                    <th>Id</th>
                    <td>{{$post->id}}</td>
                </tr>
                <tr>
                    <th>Title</th>
                    <td>{{$post->title}}</td>
                </tr>
                <tr>
                    <th>Content</th>
                    <td>{{$post->body}}</td>
                </tr>
                <tr>
                    <th>Created at</th>
                    <td>{{$post->created_at}}</td>
                </tr>
                <tr>
                    <th>Updated at</th>
                    <td>{{$post->updated_at}}</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection

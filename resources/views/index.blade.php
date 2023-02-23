@extends('layouts.app')
@section('content')
    {{$posts->links()}}
    <div class="row">
        @foreach($posts as $post)
            <div class="col-3 mt-2">
                @include('partials.post-card')
            </div>
        @endforeach
    </div>
@endsection

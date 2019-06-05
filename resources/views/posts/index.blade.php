@extends('layouts.app')

@section('content')

    <h1> Posts </h1>

    @if ( count($posts) > 0 )

        @foreach ($posts as $post)
            
            <div class = "card card-body bg-light">

                <div class = "row">

                    <div class = "col-md-2 col-sm-2">

                        <img src = "/storage/cover_images/{{ $post->cover_image }}" style = "width:100%">

                    </div>

                    <div class = "col-md-4 col-sm-4">

                        <h3> <a href = "/posts/{{$post->id}}"> {{ $post->title }} </a> </h3>
                        <small> Written by {{ $post->user->name }} on {{ $post->created_at }} </small>

                    </div>

                </div>
                
            </div>

        @endforeach

        <br>

        {{ $posts->links() }}
        
    @else

        <p> No Posts Found 😓 </p>
        
    @endif
    
@endsection
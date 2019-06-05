@extends('layouts.app')

@section('content')

    <a href = "/posts" class = "btn btn-outline-secondary btn-sm"> Go Back </a>

    <br><br>

    <h1> {{ $post->title }} </h1>


    <div class = "row">

            <div class = "col-md-4 col-sm-4">

                <img src = "/storage/cover_images/{{ $post->cover_image }}" style = "width:100%">

            </div>

            <div class = "col-md-8 col-sm-8">
        
                {!! $post->body !!}
        
            </div>

    </div>

    <hr>

    <small> Written by {{ $post->user->name }} on {{ $post->created_at }}  </small>

    <hr>

    @if (!Auth::guest())

        @if (Auth::user()->id == $post->user_id)

            <a href = "/posts/{{ $post->id }}/edit" class = "btn btn-outline-dark"> Edit </a>


            <!-- Delete Button -->
            {!! Form::open( [ 'action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'float-right' ] ) !!}
                
                {{ Form::hidden('_method', 'DELETE') }}
                {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                
            {!! Form::close() !!}

        @endif

    @endif

@endsection
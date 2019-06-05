@extends ('layouts.app')

@section ('content')
    <h1> {{$title}} </h1>
    <p> These are my skills... </p>

    @if (count ($services) > 0)

        <ul class = "list-group">

            @foreach ($services as $service)
                <li class = "list-group-item"> {{$service}} </li>  
            @endforeach
            
        </ul>

    @endif

@endsection
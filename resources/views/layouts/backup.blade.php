//OLD APP LAYOUT
<!DOCTYPE html>
<?xml version="1.0" encoding="UTF-8"?>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title> {{ config('app.name', 'BLOG-APP') }} </title>

        <link rel = "stylesheet" href = "{{ asset('css/app.css') }}">

    </head>

    <body>

        @include('inc.navbar')

        <br>

        <div class = "container">

            @include('inc.messages')

            @yield('content')

        </div>

        <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
        <script>
            CKEDITOR.replace( 'article-ckeditor' );
        </script>
       
    </body>
    
</html>


//OLD NAVBAR
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class = "container"> 
        <a class="navbar-brand" href="/"> {{ config('app.name', 'BLOG-APP') }} </a>
    
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">

            <span class="navbar-toggler-icon"></span>

        </button>
    
        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        
            <ul class="navbar-nav mr-auto">
                
                <li>  <a class = "nav-link" href = "/"> Home <span class = "sr-only"> (current) </span>  </a>  </li>
                <li class = "nav-item">  <a class = "nav-link" href = "/about"> About </a>  </li>
                <li class = "nav-item">  <a class = "nav-link" href = "/services"> Services </a>  </li>
                <li class = "nav-item">  <a class = "nav-link" href = "/posts"> Blog </a>  </li>
                <li class = "nav-item">  <a class = "nav-link disabled" href = "#" tabindex = "-1" aria-disabled = "true"> Disabled </a>  </li>
                            
                <li class="nav-item dropdown">
            
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
            
                    <div class="dropdown-menu" aria-labelledby="dropdown01">
            
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
            
                    </div>
            
                </li>
        
            </ul>

            <ul class = "nav navbar-nav navbar-right">

                <li class = "nav-item">  <a class = "nav-link" href = "/posts/create"> Create Post </a>  </li>

            </ul>

            <form class="form-inline my-2 my-lg-0">
            
                <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
        
            </form>
        
        </div>

    </div>

</nav>    
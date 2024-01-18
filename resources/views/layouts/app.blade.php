<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title ?? 'Task Manager' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{route('auth.index')}}">
                    Project Manager
                </a>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav mr-auto">

                    </ul>
                    <ul class="navbar-nav ml-auto">
                        @if(session('user'))
                        <li class="nav-item"><a class="nav nav-link" href="{{route('auth.logout')}}">Logout</a></li>
                        @else
                        <li class="nav-item"><a class="nav-link" href="{{route('auth.registerForm')}}">Register</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{route('auth.loginForm')}}">Login</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>

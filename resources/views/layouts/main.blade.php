<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel.local : : @yield('title')</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
            crossorigin="anonymous"></script>

</head>
<body class="container bg-dark bg-gradient text-secondary min-vh-100">
@if (Route::has('login'))
    <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
        @auth
            <a href="{{ url('/home') }}" class="text-sm text-gray-700 underline">Home</a>
        @else
            <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Login</a>

            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
            @endif
        @endauth
    </div>
@endif

<header class="row shadow p-3">
    <h1 class="col-5">LOGO</h1>
    <div class="col-7 navbar">
        <ul class="nav w-100 justify-content-between">
            @foreach ($menu as $item)
                <div class="dropdown">
                    <li class="nav-item btn-group">
                        <a class="nav-link btn btn-secondary
                            {{ \Illuminate\Support\Facades\Request::is(($item['path'] !== '/' ? substr($item['path'], 1) : $item['path'])) ? 'active bg-gradient bg-primary' : '' }}"
                            href="{{ $item['path'] }}">{{ $item['name'] }}</a>
                        @isset($item['child'])
                            <button class="btn btn-secondary dropdown-toggle dropdown-toggle-split" type="button"
                                    id="dropdownMenuButton"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                            </button>
                            <ul class="bg-secondary dropdown-menu dropdown-menu-end">
                                @foreach ($item['child'] as $subItem)
                                    <li class="dropdown-item bg-secondary">
                                        <a class="nav-link btn btn-secondary {{ \Illuminate\Support\Facades\Request::is(substr($subItem['path'], 1)) ? 'active bg-gradient bg-primary' : '' }}" href="{{ $subItem['path'] }}">{{ $subItem['name'] }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        @endisset
                    </li>
                </div>
            @endforeach
        </ul>
    </div>
</header>
<div class="row">
    <main class="p-3">
        @yield('content')
    </main>
</div>
<footer class="fixed-bottom row-fluid row shadow p-3 bg-gradient">
    <div class="navbar-inner">
        <div class="container">
            <p class="text-center">Пилюгин Евгений 2020 &copy;</p>
        </div>
    </div>
</footer>
</body>
</html>

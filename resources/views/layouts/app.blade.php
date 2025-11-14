<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="d-flex">

        {{-- Sidebar --}}
        <div class="bg-dark text-white p-3" style="width: 250px; min-height: 100vh;">
            <h4 class="text-center">{{ config('app.name') }}</h4>
            <hr class="bg-secondary">

            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link text-white {{ request()->is('dashboard') ? 'fw-bold' : '' }}">Dashboard</a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('tasks.index') }}" class="nav-link text-white {{ request()->is('tasks*') ? 'fw-bold' : '' }}">Tasks</a>
                </li>

                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-danger w-100 mt-3">Logout</button>
                    </form>
                </li>
            </ul>
        </div>

        {{-- Content area --}}
        <div class="flex-grow-1 p-4">
            @yield('content')
        </div>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://cdn.tailwindcss.com"></script>
        <title>SIMJ</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                    <a class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline" href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>                    
                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                    <a class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline" href="{{ route('admin') }}" >
                        Panel Administración
                    </a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div class="flex pt-8 sm:justify-start sm:pt-0">
                    <div class="p-6 rounded-lg shadow-lg">
                        <h1 class="text-4xl font-bold p-6">Prueba técnica | SiMJ</h1>
                        <h3 class="text-zinc-500">Credenciales del usuario con rol administrador :</h3>
                        <ul>
                            <li>
                                <strong>Email</strong>: admin@admin.com
                            </li>
                            <li>
                               <strong>Contraseña</strong>: admin123
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
        </div>
    </body>
</html>

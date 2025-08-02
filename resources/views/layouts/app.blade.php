<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>コスメ管理アプリ(MVP)</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('16355_paint.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-text min-h-screen flex flex-col">

    <header class="bg-secondary/80 shadow-md">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-primary">
                <a href="{{ route('cosmetics.index') }}" class="flex items-center">
                    <img src="{{ asset('16355_paint.png') }}" alt="コスメ管理アイコン" class="h-6 w-6 mr-2 flex-shrink-0">
                    コスメ管理
                </a>
            </h1>
            <nav>
                <ul class="flex space-x-4">
                    <li>
                        <a href="{{ route('cosmetics.index') }}"
                            class="px-3 py-2 rounded-lg transition text-text text-opacity-80
                      {{ request()->routeIs('cosmetics.index')
                         ? 'bg-primary/50 font-semibold text-white'
                         : 'hover:bg-secondary' }}">
                            一覧
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('cosmetics.create') }}"
                            class="px-3 py-2 rounded-lg transition text-text text-opacity-80
                      {{ request()->routeIs('cosmetics.create')
                         ? 'bg-primary/50 font-semibold text-white'
                         : 'hover:bg-secondary' }}">
                            登録
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="container mx-auto px-6 py-10 flex-1">
        @yield('content')
    </main>

</body>

</html>
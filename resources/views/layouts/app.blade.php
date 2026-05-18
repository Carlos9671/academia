<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GymStreak</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-900">

    <nav class="bg-white shadow mb-6">
        <div class="max-w-5x1 mx-auto px-4 py-4 flex justify-between items-center">
            <a href="/" class="text-xl font-bold text-orange-500">GymStreak</a>
            <div class="flex gap-4">
                <a href="{{ route('gyms.index') }}" class="text-sm text-gray-600 hover:text-orange-500">Academia</a>
                <a href="{{ route('members.index') }}" class="text-sm text-gray-600 hover:text-orange-500">Alunos</a>
            </div>
        </div>
    </nav>

    <main class="max-w-5x1 mx-auto px-4">

        @if(session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-green-100 text-green-800 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    
    </main>
</body>
</html>   
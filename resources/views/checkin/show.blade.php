<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check-in</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-900 min-h-screen flex items-center justify-center px-4">

    <div class="w-full max-w-sm">

        @if(session('success'))
            <div class="bg-green-500 bg-opacity-20 text-green-400 text-sm px-4 py-3 rounded-lg mb-4 text-center">
                {{ e(session('success')) }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-500 bg-opacity-20 text-red-400 text-sm px-4 py-3 rounded-lg mb-4 text-center">
                {{ e(session('error')) }}
            </div>
        @endif

        <div class="bg-gray-800 rounded-2xl p-8 text-center">

            <div class="text-5xl mb-4">🏋️</div>
            <h1 class="text-white font-bold text-xl mb-1">{{ $gym->name }}</h1>
            <p class="text-gray-400 text-sm mb-8">Confirme sua presença hoje</p>

            @auth
                <p class="text-gray-300 text-sm mb-6">Olá, <span class="text-orange-500 font-bold">{{ Auth::user()->name }}</span></p>

                <form action="{{ route('checkin.store', $gym->token) }}" method="POST">
                    @csrf
                    <input type="hidden" name="member_id" value="{{ Auth::user()->id }}">
                    <button type="submit"
                        class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-4 rounded-xl text-lg transition">
                        ✅ Confirmar Check-in
                    </button>
                </form>
            @else
                <p class="text-gray-400 text-sm mb-4">Você precisa estar logado para fazer check-in.</p>
                <a href="{{ route('login') }}"
                    class="w-full block bg-orange-500 hover:bg-orange-600 text-white font-bold py-4 rounded-xl text-lg transition">
                    Fazer Login
                </a>
            @endauth

        </div>

        @auth
        <div class="text-center mt-4">
            <a href="{{ route('app.home') }}" class="text-gray-500 text-sm hover:text-gray-300">Voltar para o app</a>
        </div>
        @endauth

    </div>

</body>
</html>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GymStreak</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-900 min-h-screen flex items-center justify-center px-4">

    <div class="w-full max-w-sm">

        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-orange-500">🔥 GymStreak</h1>
            <p class="text-gray-400 mt-2 text-sm">Mantenha sua ofensiva viva</p>
        </div>

        <div class="bg-gray-800 rounded-2xl p-6 shadow-xl">

            @if($errors->any())
                <div class="bg-red-500 bg-opacity-20 text-red-400 text-sm px-4 py-3 rounded-lg mb-4">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-300 mb-1">WhatsApp</label>
                    <input type="text" name="phone" value="{{ old('phone') }}"
                        placeholder="5527999999999"
                        class="w-full bg-gray-700 text-white border border-gray-600 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-orange-500">
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-300 mb-1">Senha</label>
                    <input type="password" name="password"
                        placeholder="••••••••"
                        class="w-full bg-gray-700 text-white border border-gray-600 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-orange-500">
                </div>

                <button type="submit"
                    class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 rounded-lg transition">
                    Entrar
                </button>

            </form>
        </div>
    </div>

</body>
</html>
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
            <h1 class="text-2xl font-bold text-white">Trocar Senha</h1>
            <p class="text-gray-400 text-sm mt-1">Defina uma senha pessoal</p>
        </div>

        <div class="bg-gray-800 rounded-2xl p-6 shadow-xl">

            @if($errors->any())
                <div class="bg-red-500 bg-opacity-20 text-red-400 text-sm px-4 py-3 rounded-lg mb-4">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('senha.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-300 mb-1">Senha Atual</label>
                    <input type="password" name="senha_atual"
                        placeholder="••••••••"
                        class="w-full bg-gray-700 text-white border border-gray-600 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-orange-500">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-300 mb-1">Nova Senha</label>
                    <input type="password" name="nova_senha"
                        placeholder="••••••••"
                        class="w-full bg-gray-700 text-white border border-gray-600 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-orange-500">
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-300 mb-1">Confirmar Nova Senha</label>
                    <input type="password" name="nova_senha_confirmation"
                        placeholder="••••••••"
                        class="w-full bg-gray-700 text-white border border-gray-600 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-orange-500">
                </div>

                <button type="submit"
                    class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 rounded-lg transition">
                    Salvar
                </button>

            </form>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('app.home') }}" class="text-gray-500 text-sm hover:text-gray-300">Voltar</a>
        </div>

    </div>

</body>
</html>
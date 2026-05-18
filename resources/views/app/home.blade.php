<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GymStreak</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-900 min-h-screen px-4 py-8">

    <div class="max-w-sm mx-auto">

        <div class="flex justify-between items-center mb-8">
            <div>
                <p class="text-gray-400 text-sm">Olá,</p>
                <h1 class="text-white font-bold text-xl">{{ Auth::user()->name }}</h1>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="text-gray-500 text-sm hover:text-gray-300">Sair</button>
            </form>
        </div>

        <!-- Ofensiva -->
        <div class="bg-gray-800 rounded-2xl p-6 text-center mb-6">
            <div class="text-7xl mb-2">🔥</div>
            <div class="text-6xl font-bold text-white mb-1">{{ Auth::user()->streak_current }}</div>
            <p class="text-gray-400 text-sm">dias de ofensiva</p>

            @if(Auth::user()->streak_current >= 7)
                <div class="mt-4 bg-orange-500 bg-opacity-20 text-orange-400 text-sm px-4 py-2 rounded-lg">
                    🏆 Incrível! Você está em chamas!
                </div>
            @elseif(Auth::user()->streak_current >= 3)
                <div class="mt-4 bg-yellow-500 bg-opacity-20 text-yellow-400 text-sm px-4 py-2 rounded-lg">
                    💪 Continue assim, você está indo bem!
                </div>
            @else
                <div class="mt-4 bg-gray-700 text-gray-400 text-sm px-4 py-2 rounded-lg">
                    🚀 Vamos começar sua ofensiva!
                </div>
            @endif
        </div>

        <!-- Recorde -->
        <div class="bg-gray-800 rounded-2xl p-4 mb-6 flex justify-between items-center">
            <div>
                <p class="text-gray-400 text-xs">Seu recorde</p>
                <p class="text-white font-bold text-lg">{{ Auth::user()->streak_longest }} dias 🏅</p>
            </div>
            <div>
                <p class="text-gray-400 text-xs">Academia</p>
                <p class="text-white font-bold text-lg">{{ Auth::user()->gym->name }}</p>
            </div>
        </div>

        <!-- Dias de treino -->
        <div class="bg-gray-800 rounded-2xl p-4 mb-6">
            <p class="text-gray-400 text-xs mb-3">Seus dias de treino</p>
            <div class="flex justify-between">
                @foreach(['0' => 'D', '1' => 'S', '2' => 'T', '3' => 'Q', '4' => 'Q', '5' => 'S', '6' => 'S'] as $value => $label)
                    <div class="flex flex-col items-center gap-1">
                        <span class="text-xs text-gray-500">{{ $label }}</span>
                        <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold
                            {{ in_array($value, Auth::user()->training_days ?? []) ? 'bg-orange-500 text-white' : 'bg-gray-700 text-gray-500' }}">
                            {{ in_array($value, Auth::user()->training_days ?? []) ? '✓' : '' }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Ultimo checkin -->
        <div class="bg-gray-800 rounded-2xl p-4 text-center">
            <p class="text-gray-400 text-xs mb-1">Último check-in</p>
            @if(Auth::user()->last_checkin_at)
                <p class="text-white font-medium">{{ Auth::user()->last_checkin_at->diffForHumans() }}</p>
            @else
                <p class="text-gray-500 text-sm">Nenhum check-in ainda</p>
            @endif
        </div>

    </div>

</body>
</html>
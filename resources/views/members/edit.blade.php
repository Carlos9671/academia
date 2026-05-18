@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Editar Aluno</h1>
        <a href="{{ route('members.index') }}" class="text-sm text-gray-500 hover:underline">Voltar</a>
    </div>

    <div class="bg-white rounded shadow p-6">
        <form action="{{ route('members.update', $member) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Academia</label>
                <select name="gym_id" class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-orange-400">
                    <option value="">Selecione a academia</option>
                    @foreach($gyms as $gym)
                        <option value="{{ $gym->id }}" {{ old('gym_id', $member->gym_id) == $gym->id ? 'selected' : '' }}>
                            {{ $gym->name }}
                        </option>
                    @endforeach
                </select>
                @error('gym_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Nome do Aluno</label>
                <input type="text" name="name" value="{{ old('name', $member->name) }}"
                    class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-orange-400">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">WhatsApp</label>
                <input type="text" name="phone" value="{{ old('phone', $member->phone) }}"
                    placeholder="5527999999999"
                    class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-orange-400">
                @error('phone')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Dias de Treino</label>
                <div class="flex flex-wrap gap-3">
                    @foreach(['0' => 'Dom', '1' => 'Seg', '2' => 'Ter', '3' => 'Qua', '4' => 'Qui', '5' => 'Sex', '6' => 'Sáb'] as $value => $label)
                        <label class="flex items-center gap-1 text-sm cursor-pointer">
                            <input type="checkbox" name="training_days[]" value="{{ $value }}"
                                {{ in_array($value, old('training_days', $member->training_days ?? [])) ? 'checked' : '' }}
                                class="accent-orange-500">
                            {{ $label }}
                        </label>
                    @endforeach
                </div>
                @error('training_days')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium mb-1">Status</label>
                <select name="active" class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-orange-400">
                    <option value="1" {{ old('active', $member->active) == 1 ? 'selected' : '' }}>Ativo</option>
                    <option value="0" {{ old('active', $member->active) == 0 ? 'selected' : '' }}>Inativo</option>
                </select>
            </div>

            <button type="submit" class="bg-orange-500 text-white px-6 py-2 rounded hover:bg-orange-600">
                Salvar
            </button>
        </form>
    </div>
@endsection
@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Editar Academia</h1>
        <a href="{{ route('gyms.index') }}" class="text-sm text-gray-500 hover:underline">Voltar</a>
    </div>

    <div class="bg-white rounded shadow p-6">
        <form action="{{ route('gyms.update', $gym) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Nome da Academia</label>
                <input type="text" name="name" value="{{ old('name', $gym->name) }}"
                    class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-orange-400">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Nome do Dono</label>
                <input type="text" name="owner_name" value="{{ old('owner_name', $gym->owner_name) }}"
                    class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-orange-400">
                @error('owner_name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium mb-1">Telefone</label>
                <input type="text" name="phone" value="{{ old('phone', $gym->phone) }}"
                    class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-orange-400">
                @error('phone')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="bg-orange-500 text-white px-6 py-2 rounded hover:bg-orange-600">
                Salvar
            </button>
        </form>
    </div>
@endsection
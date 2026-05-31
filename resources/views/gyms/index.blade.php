@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Academias</h1>
        <a href="{{ route('gyms.create') }}" class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600">
            Nova Academia
        </a>
    </div>

    @if($gyms->isEmpty())
        <p class="text-gray-500">Nenhuma academia cadastrada ainda.</p>
    @else
        <div class="bg-white rounded shadow overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-600">
                    <tr>
                        <th class="text-left px-4 py-3">Nome</th>
                        <th class="text-left px-4 py-3">Dono</th>
                        <th class="text-left px-4 py-3">Telefone</th>
                        <th class="text-left px-4 py-3">Status</th>
                        <th class="text-left px-4 py-3">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($gyms as $gym)
                        <tr>
                            <td class="px-4 py-3 font-medium">{{ $gym->name }}</td>
                            <td class="px-4 py-3">{{ $gym->owner_name }}</td>
                            <td class="px-4 py-3">{{ $gym->telefone_mascarado }}</td>
                            <td class="px-4 py-3">
                                @if($gym->active)
                                    <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs">Ativa</span>
                                @else
                                    <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs">Inativa</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 flex gap-2">
                                <a href="{{ route('gyms.show', $gym) }}" class="text-blue-500 hover:underline">Ver</a>
                                <a href="{{ route('gyms.edit', $gym) }}" class="text-yellow-500 hover:underline">Editar</a>
                                <form action="{{ route('gyms.destroy', $gym) }}" method="POST" onsubmit="return confirm('Tem certeza?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline">Remover</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
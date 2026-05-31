@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Alunos</h1>
        <a href="{{ route('members.create') }}" class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600">
            Novo Aluno
        </a>
    </div>

    @if($members->isEmpty())
        <p class="text-gray-500">Nenhum aluno cadastrado ainda.</p>
    @else
        <div class="bg-white rounded shadow overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-600">
                    <tr>
                        <th class="text-left px-4 py-3">Nome</th>
                        <th class="text-left px-4 py-3">Academia</th>
                        <th class="text-left px-4 py-3">WhatsApp</th>
                        <th class="text-left px-4 py-3">Ofensiva</th>
                        <th class="text-left px-4 py-3">Status</th>
                        <th class="text-left px-4 py-3">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($members as $member)
                        <tr>
                            <td class="px-4 py-3 font-medium">{{ $member->name }}</td>
                            <td class="px-4 py-3">{{ $member->gym->name }}</td>
                            <td class="px-4 py-3">{{ $member->telefone_mascarado }}</td>
                            <td class="px-4 py-3">
                                <span class="text-orange-500 font-bold">🔥 {{ $member->streak_current }} dias</span>
                            </td>
                            <td class="px-4 py-3">
                                @if($member->active)
                                    <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs">Ativo</span>
                                @else
                                    <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs">Inativo</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 flex gap-2">
                                <a href="{{ route('members.edit', $member) }}" class="text-yellow-500 hover:underline">Editar</a>
                                <form action="{{ route('members.destroy', $member) }}" method="POST" onsubmit="return confirm('Tem certeza?')">
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
@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">{{ $gym->name }}</h1>
        <div class="flex gap-2">
            <a href="{{ route('gyms.edit', $gym) }}" class="bg-yellow-400 text-white px-4 py-2 rounded hover:bg-yellow-500 text-sm">Editar</a>
            <a href="{{ route('gyms.index') }}" class="text-sm text-gray-500 hover:underline mt-2">Voltar</a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-white rounded shadow p-6">
            <h2 class="text-sm font-medium text-gray-500 mb-4">Informações</h2>
            <p class="text-sm mb-2"><span class="font-medium">Dono:</span> {{ $gym->owner_name }}</p>
            <p class="text-sm mb-2"><span class="font-medium">Telefone:</span> {{ $gym->phone }}</p>
            <p class="text-sm mb-2">
                <span class="font-medium">Status:</span>
                @if($gym->active)
                    <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs">Ativa</span>
                @else
                    <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs">Inativa</span>
                @endif
            </p>
        </div>

        <div class="bg-white rounded shadow p-6">
            <h2 class="text-sm font-medium text-gray-500 mb-4">QR Code de Check-in</h2>
            <p class="text-xs text-gray-500 mb-3">Imprima e cole na entrada da academia.</p>
            <div class="bg-gray-50 border rounded p-4 text-center">
                {!! QrCode::size(180)->generate(route('checkin.show', $gym->token)) !!}
                <p class="text-xs text-gray-400 break-all">{{ route('checkin.show', $gym->token) }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded shadow overflow-hidden">
        <div class="flex justify-between items-center px-4 py-3 border-b">
            <h2 class="font-medium">Alunos</h2>
            <a href="{{ route('members.create') }}" class="bg-orange-500 text-white px-3 py-1 rounded text-sm hover:bg-orange-600">Novo Aluno</a>
        </div>
        @if($gym->members->isEmpty())
            <p class="text-gray-500 text-sm p-4">Nenhum aluno cadastrado ainda.</p>
        @else
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-600">
                    <tr>
                        <th class="text-left px-4 py-3">Nome</th>
                        <th class="text-left px-4 py-3">Telefone</th>
                        <th class="text-left px-4 py-3">Ofensiva</th>
                        <th class="text-left px-4 py-3">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($gym->members as $member)
                        <tr>
                            <td class="px-4 py-3 font-medium">{{ $member->name }}</td>
                            <td class="px-4 py-3">{{ $member->phone }}</td>
                            <td class="px-4 py-3">
                                <span class="text-orange-500 font-bold">🔥 {{ $member->streak_current }} dias</span>
                            </td>
                            <td class="px-4 py-3 flex gap-2">
                                <a href="{{ route('members.show', $member) }}" class="text-blue-500 hover:underline">Ver</a>
                                <a href="{{ route('members.edit', $member) }}" class="text-yellow-500 hover:underline">Editar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
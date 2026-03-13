@extends('layouts.main')

@section('title', 'Usuários')

@section('content')

<div class="container">

    <h1>Gerenciamento de Usuários</h1>

    <a href="/users/create" class="btn btn-primary mb-3">Novo Usuário</a>

    {{-- Desktop: tabela --}}
    <div class="d-none d-md-block">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Admin</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->is_admin ? 'Sim' : 'Não' }}</td>
                    <td>
                        <a href="/users/edit/{{ $user->id }}" class="btn btn-sm btn-info">Editar</a>
                        <form action="/users/{{ $user->id }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Tem certeza que deseja excluir este usuário?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Mobile: cards --}}
    <div class="d-block d-md-none">
        @foreach($users as $user)
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">{{ $user->name }}</h5>
                <p class="card-text"><strong>Email:</strong> {{ $user->email }}</p>
                <p class="card-text"><strong>Admin:</strong> {{ $user->is_admin ? 'Sim' : 'Não' }}</p>
                <div class="d-flex justify-content-start">
                    <a href="/users/edit/{{ $user->id }}" class="btn btn-sm btn-info me-2">Editar</a>
                    <form action="/users/{{ $user->id }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este usuário?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>

@endsection

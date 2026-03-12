@extends('layouts.main')

@section('title', 'Usuários')

@section('content')

    <div class="container">

        <h1>Gerenciamento de Usuários</h1>

        <a href="/users/create" class="btn btn-primary mb-3">Novo Usuário</a>

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

@endsection

@extends('layouts.main')

@section('title', 'Criar Usuário')

@section('content')

<div class="container mt-4">

    <h1>Criar Novo Usuário</h1>

    <a href="/users" class="btn btn-secondary mb-3">Voltar</a>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/users" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" name="name" id="name" class="form-control" required value="{{ old('name') }}">
        </div>

        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" class="form-control" required value="{{ old('email') }}">
        </div>

        <div class="form-group">
            <label for="password">Senha</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="is_admin" id="is_admin" class="form-check-input">
            <label for="is_admin" class="form-check-label">Administrador</label>
        </div>

        <button type="submit" class="btn btn-primary">Criar Usuário</button>
    </form>

</div>

@endsection

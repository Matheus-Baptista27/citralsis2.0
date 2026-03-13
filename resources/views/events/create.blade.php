@extends ('layouts.main')

@section('title', 'CITRAL SIS 2.0')

@section('content')

<div id="event-create-container" class="col-md-6 offset-md-3">
    <h1>Criar Atividade</h1>

    <form action="/events" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="instructor-info mb-3">
            <span class="label">Olá, Instrutor:</span>
            <span class="name">{{ auth()->user()->name }}</span>
        </div>

        <div class="form-group mb-3">
            <label for="status">Status:</label>
            <input type="text" class="form-control" id="status" name="status" placeholder="Status da Atividade">
        </div>

        <div class="form-group mb-3">
            <label for="date">Data:</label>
            <input type="date" class="form-control" id="date" name="date" required>
        </div>

        <div class="form-group mb-3">
            <label for="driver">Motorista:</label>
            <input type="text" class="form-control" id="driver" name="driver" placeholder="Motorista">
        </div>

        <div class="form-group mb-3">
            <label for="car">Carro:</label>
            <input type="text" class="form-control" id="car" name="car" placeholder="Prefixo Carro">
        </div>

        <div class="form-group mb-3">
            <label for="line">Linha:</label>
            <input type="text" class="form-control" id="line" name="line" placeholder="Linha">
        </div>

        <div class="form-group mb-3">
            <label for="start_time">Início Percurso:</label>
            <input type="time" class="form-control" id="start_time" name="start_time">
        </div>

        <div class="form-group mb-3">
            <label for="description">Observações:</label>
            <textarea name="description" id="description" class="form-control" placeholder="Observações"></textarea>
        </div>

        <button type="submit" class="btn btn-success">
            Salvar Atividade
        </button>
    </form>
</div>

@endsection

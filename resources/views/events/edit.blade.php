@extends ('layouts.main')

@section('title', 'Editando: ' . $event->title)

@section('content')

<div id="event-create-container" class="col-md-6 offset-md-3">
    <h1>Editando: {{ $event->title }}</h1>

    <form action="/events/update/{{ $event->id }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')


        <div class="instructor-info mb-3">
            <span class="label">Instrutor:</span>
            <span class="name">{{ auth()->user()->name }}</span>
        </div>
        
        <div class="form-group mb-3">
            <label for="status">Status:</label>
            <input type="text" class="form-control" id="status" name="status" placeholder="Status da Atividade" value="{{ $event->status }}" >
        </div>

        <div class="form-group mb-3">
            <label for="date">Data:</label>
            <input type="date" class="form-control" id="date" name="date" value="{{ \Carbon\Carbon::parse($event->date)->format('Y-m-d') }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="driver">Motorista:</label>
            <input type="text" class="form-control" id="driver" name="driver" placeholder="Motorista" value="{{ $event->driver }}">
        </div>

        <div class="form-group mb-3">
            <label for="car">Carro:</label>
            <input type="text" class="form-control" id="car" name="car" placeholder="Prefixo Carro" value="{{ $event->car }}">
        </div>

        <div class="form-group mb-3">
            <label for="line">Linha:</label>
            <input type="text" class="form-control" id="line" name="line" placeholder="Linha" value="{{ $event->line }}">
        </div>

        <div class="form-group mb-3">
            <label for="start_time">Início Percurso:</label>
            <input type="time" class="form-control" id="start_time" name="start_time" value="{{ $event->start_time }}">
        </div>

        <div class="form-group mb-3">
            <label for="end_time">Fim Percurso:</label>
            <input type="time" class="form-control" id="end_time" name="end_time" value="{{ $event->end_time }}">
        </div>

        <div class="form-group mb-3">
            <label for="description">Observações:</label>
            <textarea name="description" id="description" class="form-control" placeholder="Observações" >{{ $event->description }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">
            Atualizar atividade
        </button>
    </form>
</div>

@endsection

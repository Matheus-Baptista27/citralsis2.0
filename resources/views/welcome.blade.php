@extends ('layouts.main')

@section('title', 'CITRAL SIS 2.0')

@section('content')

<div id="search-container" class="col-md-12">
    <h1>Consulte um Instrutor</h1>
    <form action="/" method="GET">
    <input type="text" id="search" name="search" class="form-control" placeholder="N° Funcionário ...">
</div>

<div id="events-container" class="col-md-12">

    @if($search)
    <h2>Buscando por: {{ $search }}</h2>
    @else
    <h2>Atividades</h2>
    <p class="subtitle">Veja as atividades</p>
    @endif

    <div id="cards-container" class="row">
        @foreach($events as $event)

        <div class="card col-md-3 mb-4">
            <div class="card-body">

                <p class="card-date">
                    {{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }}
                </p>

                <h5 class="card-title">
                    {{ $event->status }}
                </h5>

                <p class="card-text">
                    Instrutor: {{ $event->user->name }} <br>
                    Motorista: {{ $event->driver }} <br>
                    Carro: {{ $event->car }} <br>
                    Linha: {{ $event->line }} <br>
                    Observação: {{ $event->description }}
                </p>

                <a href="/events/{{ $event->id }}" class="btn btn-primary">Saber mais</a>

            </div>
        </div>

        @endforeach
        @if(count($events) == 0 && $search)
            <p>Não foi possível encontrar nenhum evento com {{ $search }}! <a href="/">Ver todos!</a></p>
        @elseif(count($events) ==0)
            <p>Não há eventos disponíveis</p>
        @endif

</div>

@endsection

@extends ('layouts.main')

@section('title', 'CITRAL SIS 2.0')

@section('content')

<div id="search-container" class="col-md-12">
    <h1>Consulte um Instrutor</h1>

    <form action="/" method="GET">

        <!-- Campo de busca -->
        <div class="mb-2">
            <input
                type="text"
                id="search"
                name="search"
                class="form-control"
                placeholder="N° Funcionário ..."
                value="{{ $search }}"
            >
        </div>

        <!-- DATAS -->
        <div class="row mb-3 justify-content-center">

        <div class="col-md-4 text-center">
            <label class="form-label"><strong>Data Início</strong></label>
            <input type="date"
                name="date_start"
                class="form-control"
                value="{{ request('date_start') }}">
        </div>

        <div class="col-md-4 text-center">
            <label class="form-label"><strong>Data Fim</strong></label>
            <input type="date"
                name="date_end"
                class="form-control"
                value="{{ request('date_end') }}">
        </div>
    </div>



        <!-- Botões -->
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary flex-fill">
                Buscar
            </button>

            <a href="/" class="btn btn-secondary flex-fill">
                Limpar
            </a>
        </div>

    </form>
</div>

<!-- -->
<div class="print-header">

    <div class="report-header">

        <div class="logo">
            <img src="/img/logoSemFundo.png" width="160">
        </div>

        <div class="report-info">

            <h2>CITRAL SIS 2.0</h2>

            <h4>Relatório de Atividades</h4>

            <p>
                Usuário: {{ auth()->user()->name }}
            </p>

            <p>
                Data da impressão: {{ date('d/m/Y H:i') }}
            </p>

            <p>
                Total de atividades: {{ $events->count() }}
            </p>

        </div>

    </div>

    <hr>

</div>

<div id="events-container" class="col-md-12">

    @if($search)
    <h2>Buscando por: {{ $search }}</h2>
    @else
    <h2>Atividades</h2>
    <p class="subtitle">Veja as atividades</p>
    @endif

    <div class="mb-3">
        <button onclick="window.print()" class="btn btn-success">
            Imprimir
        </button>
    </div>

    <div id="cards-container" class="row">
        @foreach($events as $event)

    <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
        <div class="card h-100">
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
                    Percurso: {{ $event->start_time_formatted }} <br>
                    Observação: {{ $event->description }}
                </p>

                <a href="/events/{{ $event->id }}" class="btn btn-primary">Saber mais</a>

            </div>
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

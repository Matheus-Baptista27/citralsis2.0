@extends ('layouts.main')

@section('title', 'Dashboard')

@section('content')

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

<div class="col-md-10 offset-md-1 dashboard-title-container d-flex justify-content-between align-items-center">

   <h1 class="mb-0">Minhas Atividades</h1>

   <button onclick="window.print()" class="btn btn-secondary">
        🖨️ Imprimir
   </button>

</div>

    @if(auth()->user()->is_admin)
        <div class="col-md-10 offset-md-1">
            <div class="alert alert-warning text-center text-nowrap mt-2">
                Você está logado como Administrador.
            </div>
        </div>
    @endif




<div class="col-md-10 offset-md-1 dashboard-events-container">

    @if(count($events) > 0)

        {{-- MOBILE - CARDS --}}
        <div class="d-md-none">
            @foreach($events as $event)
                <div class="card mb-3 shadow-sm">
                    <div class="card-body">

                        <h5 class="card-title">{{ $event->status }}</h5>

                        <p class="mb-1"><strong>Motorista:</strong> {{ $event->driver }}</p>
                        <p class="mb-1"><strong>Data:</strong> {{ $event->date }}</p>
                        <p class="mb-1"><strong>Carro:</strong> {{ $event->car }}</p>
                        <p class="mb-1"><strong>Linha:</strong> {{ $event->line }}</p>
                        <p class="mb-1"><strong>Percurso:</strong> {{ $event->start_time }}</p>
                        <p class="mb-2"><strong>Instrutor:</strong> {{ $event->user->name }}</p>

                        @if(auth()->id() == $event->user_id || auth()->user()->is_admin)
                            <div class="d-flex">
                                <a href="/events/edit/{{ $event->id }}"
                                class="btn btn-sm btn-info mr-2">
                                    Editar
                                </a>

                                <form action="/events/{{ $event->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        Deletar
                                    </button>
                                </form>
                            </div>
                        @endif

                    </div>
                </div>
            @endforeach
        </div>


        {{-- DESKTOP - TABELA --}}
        <div class="d-none d-md-block">
            <table class="table table-striped table-hover align-middle w-100">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Status</th>
                        <th>Motorista</th>
                        <th>Data</th>
                        <th>Carro</th>
                        <th>Linha</th>
                        <th>Percurso</th>
                        <th>Instrutor</th>
                        <th class="no-print">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $event)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><a href="/events/{{ $event->id }}">{{ $event->status }}</a></td>
                        <td>{{ $event->driver }}</td>
                        <td>{{ $event->date }}</td>
                        <td>{{ $event->car }}</td>
                        <td>{{ $event->line }}</td>
                        <td>{{ $event->start_time }}</td>
                        <td>{{ $event->user->name }}</td>

                        @if(auth()->id() == $event->user_id || auth()->user()->is_admin)
                        <td class="no-print">
                            <div class="d-flex">
                                <a href="/events/edit/{{ $event->id }}" class="btn btn-sm btn-info mr-2 flex-fill">
                                    Editar
                                </a>

                                <form action="/events/{{ $event->id }}" method="POST" class="flex-fill">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger w-100">
                                        Deletar
                                    </button>
                                </form>
                            </div>
                        </td>
                        @endif
                    </tr>

                    @endforeach

                </tbody>
            </table>
        </div>

    @else
        <p>Você ainda não tem atividades,
            <a href="/events/create">Criar Atividade</a>
        </p>
    @endif

</div>

@endsection

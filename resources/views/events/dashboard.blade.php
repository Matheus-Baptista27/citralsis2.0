@extends ('layouts.main')

@section('title', 'Dashboard')

@section('content')

    <div class="col-md-10 offset-md-1 dashboard-title-container d-flex justify-content-between align-items-center">
        <h1 class="mb-0">Minhas Atividades</h1>
    </div>

    @if (auth()->user()->is_admin)
        <div class="col-md-10 offset-md-1">
            <div class="alert alert-warning text-center text-nowrap mt-2">
                Você está logado como Administrador.
            </div>
        </div>
    @endif


    {{-- FILTROS --}}
    <div class="col-md-10 offset-md-1">

        <div class="card mb-4 shadow-sm">
            <div class="card-body">

                <form method="GET" action="/dashboard">

                    <div class="row">

                        <div class="col-md-4 mb-2">
                            <input type="text" name="search" class="form-control" placeholder="Buscar motorista..."
                                value="{{ request('search') }}">
                        </div>

                        <div class="col-md-3 mb-2">
                            <select name="status" class="form-control">

                                <option value="">Todos status</option>

                                <option value="Treinamento" {{ request('status') == 'Treinamento' ? 'selected' : '' }}>
                                    Treinamento
                                </option>

                                <option value="Avaliação" {{ request('status') == 'Avaliação' ? 'selected' : '' }}>
                                    Avaliação
                                </option>

                                <option value="Reciclagem" {{ request('status') == 'Reciclagem' ? 'selected' : '' }}>
                                    Reciclagem
                                </option>

                            </select>
                        </div>

                        <div class="col-md-3 mb-2">
                            <select name="period" class="form-control">

                                <option value="">Todo período</option>

                                <option value="today" {{ request('period') == 'today' ? 'selected' : '' }}>
                                    Hoje
                                </option>

                                <option value="week" {{ request('period') == 'week' ? 'selected' : '' }}>
                                    Esta semana
                                </option>

                                <option value="month" {{ request('period') == 'month' ? 'selected' : '' }}>
                                    Este mês
                                </option>

                            </select>
                        </div>

                        <div class="col-md-2 mb-2">
                            <button class="btn btn-outline-primary w-100">
                                Filtrar
                            </button>
                        </div>

                    </div>

                </form>

            </div>
        </div>

    </div>



    <div class="col-md-10 offset-md-1 dashboard-events-container">

        @if (count($events) > 0)


            {{-- MOBILE - CARDS --}}
            <div class="d-md-none">

                @foreach ($events as $event)
                    <div class="card mb-3 shadow-sm">

                        <div class="card-body">

                            <h5 class="card-title">{{ $event->status }}</h5>

                            <p class="mb-1"><strong>Motorista:</strong> {{ $event->driver }}</p>
                            <p class="mb-1"><strong>Data:</strong> {{ $event->date_formatted }}</p>
                            <p class="mb-1"><strong>Carro:</strong> {{ $event->car }}</p>
                            <p class="mb-1"><strong>Linha:</strong> {{ $event->line }}</p>
                            <p class="mb-1"><strong>Percurso:</strong> {{ $event->start_time_formatted }}</p>
                            <p class="mb-2"><strong>Instrutor:</strong> {{ $event->user->name }}</p>
                            <p class="mb-2"><strong>Observações:</strong> {{ $event->description }}</p>

                            @if (auth()->id() == $event->user_id || auth()->user()->is_admin)
                                <div class="d-flex">

                                    <a href="/events/edit/{{ $event->id }}" class="btn btn-sm btn-info mr-2">
                                        Editar
                                    </a>

                                    <form action="/events/{{ $event->id }}" method="POST" class="flex-fill"
                                        onsubmit="return confirm('Tem certeza que deseja deletar esta atividade?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-sm btn-danger w-100">
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

                            <th style="min-width:180px">Status</th>
                            <th>Motorista</th>
                            <th>Data</th>
                            <th>Carro</th>
                            <th>Linha</th>
                            <th>Percurso</th>
                            <th>Instrutor</th>
                            <th>Observações</th>
                            <th class="no-print">Ações</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach ($events as $event)
                            <tr>

                                <td>
                                    <a href="/events/{{ $event->id }}">
                                        {{ $event->status }}
                                    </a>
                                </td>

                                <td>{{ $event->driver }}</td>

                                <td>{{ $event->date_formatted }}</td>

                                <td>{{ $event->car }}</td>

                                <td>{{ $event->line }}</td>

                                <td>{{ $event->start_time_formatted }}</td>

                                <td>{{ $event->user->name }}</td>

                                <td class="obs-cell">
                                    {{ Str::limit($event->description, 40) }}
                                </td>


                                @if (auth()->id() == $event->user_id || auth()->user()->is_admin)
                                    <td class="no-print">

                                        <div class="d-flex">

                                            <a href="/events/edit/{{ $event->id }}"
                                                class="btn btn-sm btn-info mr-2 flex-fill">
                                                Editar
                                            </a>
                                            <form action="/events/{{ $event->id }}" method="POST" class="flex-fill"
                                                onsubmit="return confirm('Tem certeza que deseja deletar esta atividade?')">

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
            <p>
                Você ainda não tem atividades,
                <a href="/events/create">Criar Atividade</a>
            </p>

        @endif

    </div>


    {{-- PAGINAÇÃO --}}
    <div class="col-md-10 offset-md-1 mt-3">
        {{ $events->appends(request()->query())->links() }}
    </div>

@endsection

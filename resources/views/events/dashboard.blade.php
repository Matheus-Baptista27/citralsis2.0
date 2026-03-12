@extends ('layouts.main')

@section('title', 'Dashboard')

@section('content')



<div class="col-md-10 offset-md-1 dashboard-title-container d-flex justify-content-between align-items-center">

   <h1 class="mb-0">Minhas Atividades</h1>

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
                        <p class="mb-1"><strong>Data:</strong> {{ $event->date_formatted }}</p>
                        <p class="mb-1"><strong>Carro:</strong> {{ $event->car }}</p>
                        <p class="mb-1"><strong>Linha:</strong> {{ $event->line }}</p>
                        <p class="mb-1"><strong>Percurso:</strong> {{ $event->start_time_formatted }}</p>
                        <p class="mb-2"><strong>Instrutor:</strong> {{ $event->user->name }}</p>
                        <p class="mb-2"><strong>Observações</strong> {{ $event->description }}</p>


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

                        <th>Status</th>
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
                    @foreach($events as $event)
                    <tr>

                        <td><a href="/events/{{ $event->id }}">{{ $event->status }}</a></td>
                        <td>{{ $event->driver }}</td>
                        <td>{{ $event->date_formatted }}</td>
                        <td>{{ $event->car }}</td>
                        <td>{{ $event->line }}</td>
                        <td>{{ $event->start_time_formatted }}</td>
                        <td>{{ $event->user->name }}</td>
                        <td class="obs-cell">
                            {{ Str::limit($event->description, 40) }}
                        </td>


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

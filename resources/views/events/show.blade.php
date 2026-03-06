@extends ('layouts.main')

@section('title', $event->title)

@section('content')

    <div class="col-md-10-offset-md-1">
        <div class="row">

            <div id="info-container" class="col-md-12">
                <h1>{{ $event->title }}</h1>
                <p class="event-status"><ion-icon name="school-outline"></ion-icon>{{$event->status}}</p>
                <p class="event-driver"><ion-icon name="person-outline"></ion-icon> Motorista: {{$event->driver}}</p>
                <p class="event-date"><ion-icon name="calendar-outline"></ion-icon> Data: {{$event->date}}</p>
                <p class="events-car"><ion-icon name="bus-outline"></ion-icon> Carro: {{$event->car}}</p>
                <p class="events-line"><ion-icon name="shuffle-outline"></ion-icon>Linha: {{$event->line}}</p>
                <p class="events-alarm"><ion-icon name="alarm-outline"></ion-icon>Percurso: {{$event->start_time}} - {{$event->end_time}}</p>
                <p class="events-instructor"><ion-icon name="star-outline"></ion-icon>Instrutor: {{ $event->user->name }}</p>
            @auth

                <a href="{{ route('dashboard') }}" class="btn btn-primary">
                    Listar minhas atividades
                </a>

             @endauth

            </div>
            <div class="col-md-12" id="description-container">
                <h3>Sobre a atividade</h3>
                <p class="event-description">{{ $event->description }}</p>
            </div>
        </div>
    </div>


@endsection

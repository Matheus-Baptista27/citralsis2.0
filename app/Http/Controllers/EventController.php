<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Event;
use App\Models\User;

class EventController extends Controller
{

    public function index()
    {
        $search = request('search');
        $dateStart = request('date_start');
        $dateEnd = request('date_end');

        $query = Event::with('user');

        // Se NÃO for admin, limitar aos próprios eventos
        if (!auth()->user()->is_admin) {
            $query->where('user_id', auth()->id());
        }

        // Se houver busca
       if ($search) {

    $query->where(function ($q) use ($search) {

        // Se for número → buscar por número de funcionário
        if (is_numeric($search)) {

            $q->where('driver', 'like', '%' . $search . '%');

        } else {

            // Se for texto → buscar por nome (case insensitive)
            $q->whereRaw('LOWER(driver) LIKE ?', ['%' . strtolower($search) . '%'])
              ->orWhereHas('user', function ($subQuery) use ($search) {
                  $subQuery->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($search) . '%']);
              });
            }

        });

    }

        // Filtro data início
        if ($dateStart) {
            $query->whereDate('date', '>=', $dateStart);
        }

        // Filtro data fim
        if ($dateEnd) {
            $query->whereDate('date', '<=', $dateEnd);
        }

        $events = $query->orderBy('date', 'desc')->get();

        return view('welcome', [
            'events' => $events,
            'search' => $search
        ]);
    }
    // ==========================
    // ==========================
    // Redireciona usuários pós-login
    // ==========================
    protected function authenticated($request, $user)
    {
        return redirect('/'); // força ir direto pro welcome.blade.php
    }

    public function create() {
        return view('events.create');
    }

    public function store(Request $request) {

        $event = new Event;

        $event->status = $request->status;
        $event->date = $request->date;
        $event->driver = $request->driver;
        $event->car = $request->car;
        $event->line = $request->line;
        $event->start_time = $request->start_time;
        $event->end_time = $request->end_time;
        $event->description = $request->description;

        $event->user_id = auth()->id();

        $event->save();

        return redirect('/')->with('msg', 'Evento criado com sucesso!');

    }

public function show($id)
{
    $event = Event::findOrFail($id);

    $eventOwner = User::where('id', $event->user_id)->first();

    $userEvents = [];

    if(auth()->check()) {
        $userEvents = auth()->user()->events;
    }

    return view('events.show', [
        'event' => $event,
        'eventOwner' => $eventOwner,
        'userEvents' => $userEvents
    ]);
}

public function dashboard()
{
    if (auth()->user()->is_admin) {

        // Admin vê todas
        $events = Event::with('user')->get();

    } else {

        // Usuário normal vê só as próprias
        $events = Event::where('user_id', auth()->id())->get();
    }

    return view('events.dashboard', ['events' => $events]);
}

    public function destroy($id)
    {
        $event = Event::findOrFail($id);

        if (auth()->id() != $event->user_id && !auth()->user()->is_admin) {
            abort(403);
        }

        $event->delete();

        return redirect('/dashboard')->with('msg', 'Evento excluído com sucesso!');
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);

        if (auth()->id() != $event->user_id && !auth()->user()->is_admin) {
            abort(403);
        }

        return view('events.edit', ['event' => $event]);
    }

    public function update(Request $request)
{
    $event = Event::findOrFail($request->id);

        if ($event->user_id !== auth()->id() && !auth()->user()->is_admin) {
            abort(403);
        }

    $data = [
        'status' => $request->status,
        'date' => $request->date,
        'driver' => $request->driver,
        'car' => $request->car,
        'line' => $request->line,
        'start_time' => $request->start_time,
        'end_time' => $request->end_time,
        'description' => $request->description,
    ];

    $event->update($data);

    return redirect('/dashboard')
        ->with('msg', 'Atividade editada com sucesso!');
}

public function admin()
{
    if (!auth()->user()->is_admin) {
        abort(403);
    }

    $events = Event::with('user')->get();

    return view('admin.dashboard', ['events' => $events]);
}


}



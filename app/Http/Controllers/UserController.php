<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
    {
        if(!auth()->user()->is_admin){
            abort(403);
        }

        $users = User::all();

        return view('users.index', ['users' => $users]);
    }

    public function create()
    {
        if(!auth()->user()->is_admin){
            abort(403);
        }

        return view('users.create');
    }

    public function store(Request $request)
    {

        $user = new User;

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->is_admin = $request->has('is_admin');

        $user->save();

        return redirect('/users')->with('msg', 'Usuário criado com sucesso!');
    }

    public function edit($id)
    {
        if(!auth()->user()->is_admin){
            abort(403);
        }

        $user = User::findOrFail($id);

        return view('users.edit', ['user' => $user]);
    }

    public function update(Request $request, $id)
    {

        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->email = $request->email;

        if($request->password){
            $user->password = Hash::make($request->password);
        }

        $user->is_admin = $request->has('is_admin');

        $user->save();

        return redirect('/users')->with('msg', 'Usuário atualizado!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if (!auth()->user()->is_admin) {
            abort(403);
        }

        if ($user->id === auth()->id()) {
            return redirect('/users')->with('msg', 'Você não pode excluir a si mesmo!');
        }

        $user->delete();

        return redirect('/users')->with('msg', 'Usuário excluído com sucesso!');
    }

}

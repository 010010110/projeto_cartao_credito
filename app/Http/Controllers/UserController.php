<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function getUser()
    {
        $user = Auth::user();
        $user = User::with('pessoa')->find($user['id']);
        return response()->json($user);
    }

    public function getClientes()
    {
        $users = User::with('pessoa')
            ->where('tipo', '=', 'C')->get();
        return response()->json($users);
    }

    public function getFuncionarios()
    {
        $funcionarios = User::query()
            ->where('tipo', '=', 'F')->get();
        return response()->json($funcionarios);
    }

    public function update(Request $request)
    {
        $request->validate([
            'user_id' => ['required', 'exists:user,id'],
            'status' => ['required', 'in:A,R,I']
        ]);

        $user = User::query()->find($request['user_id']);

        $user->update([
            'status' => $request['status']
        ]);

        return response('', 204);
    }

}

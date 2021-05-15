<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use App\Models\Pessoa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        $request->validate([
            'cep' => ['required', 'digits:8'],
            'numero' => ['required', 'digits_between:1,5'],
            'nome' => ['required', 'string', 'max:50'],
            'documento' => ['required', 'digits_between:11,14'],
            'telefone' => ['required', 'digits_between:10,11'],
            'tipo' => ['required', 'in:F,J'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:user'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'renda_mensal' => ['required', 'numeric', 'min:800']
        ]);

        $renda_mensal = floatval($request['renda_mensal']);

        $endereco = Endereco::create([
            'cep' => $request['cep'],
            'numero' => $request['numero']
        ]);

        $pessoa = Pessoa::create([
            'nome' => $request['nome'],
            'documento' => $request['documento'],
            'telefone' => $request['telefone'],
            'tipo' => $request['tipo'],
            'endereco_id' => $endereco['id']
        ]);

        $user = User::create([
            'tipo' => 'C',
            'status' => 'I',
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'renda_mensal' => $renda_mensal,
            'limite' => $renda_mensal * 0.3,
            'pessoa_id' => $pessoa['id']
        ]);

        $token = Auth::login($user);

        return $this->respondWithToken($token);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string']
        ]);

        $credentials = request(['email', 'password']);

        if (!$token = Auth::attempt($credentials)) {
            return response()->json(['error' => 'Usuário ou senha inválidos'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function logout()
    {
        Auth::logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    protected function respondWithToken($token)
    {
        $ttl = Auth::factory()->getTTL();

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $ttl * 60
        ]);
    }

}

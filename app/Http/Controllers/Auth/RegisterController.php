<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Endereco;
use App\Models\Pessoa;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality withonut requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        return redirect('/');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
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
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $renda_mensal = floatval($data['renda_mensal']);

        $endereco = Endereco::create([
            'cep' => $data['cep'],
            'numero' => $data['numero']
        ]);

        $pessoa = Pessoa::create([
            'nome' => $data['nome'],
            'documento' => $data['documento'],
            'telefone' => $data['telefone'],
            'tipo' => $data['tipo'],
            'endereco_id' => $endereco['id']
        ]);

        return User::create([
            'tipo' => 'C',
            'status' => 'I',
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'renda_mensal' => $renda_mensal,
            'limite' => $renda_mensal * 0.3,
            'pessoa_id' => $pessoa['id']
        ]);
    }
}

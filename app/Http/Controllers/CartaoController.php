<?php

namespace App\Http\Controllers;

use App\Models\Bandeira;
use App\Models\Cartao;
use App\Models\Endereco;
use App\Models\Pessoa;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

function cvv()
{
    $cvv = mt_rand(0, 999);
    $cvv = str_pad($cvv, 3, '0', STR_PAD_LEFT);

    return $cvv;
}

function card()
{
    $card = '';

    for ($i = 0; $i < 4; $i++) {
        $num = mt_rand(0, 9999);
        $num = str_pad($num, 4, '0', STR_PAD_LEFT);

        $card = $card . $num;
    }

    return $card;
}

class CartaoController extends Controller
{

    public function getCartoes()
    {
        $user = Auth::user();
        $user = User::query()->find($user['id']);
        return response()->json($user['cartoes']);
    }

    public function getPendentes()
    {
        $cartoes = Cartao::with('bandeira')->with('pessoa')
            ->orderByRaw("FIELD(status, 'P', 'B', 'A', 'R', 'C')")->get();
        return response()->json($cartoes);
    }

    public function getBandeiras()
    {
        return response()->json(Bandeira::all());
    }

    public function criar(Request $request)
    {
        $request->validate([
            'tipo' => ['required', 'in:C,D'],
            'senha' => ['required', 'digits:4'],
            'categoria' => ['required', 'in:N,I'],
            'bandeira' => ['required', 'exists:bandeira,id'],
            'pessoa' => ['nullable'],
            'pessoa.nome' => ['required_with:pessoa', 'string', 'max:50'],
            'pessoa.documento' => ['required_with:pessoa', 'digits_between:11,14'],
            'pessoa.telefone' => ['required_with:pessoa', 'digits_between:10,11'],
            'pessoa.tipo' => ['required_with:pessoa', 'in:F,J'],
            'pessoa.endereco.cep' => ['required_with:pessoa', 'digits:8'],
            'pessoa.endereco.numero' => ['required_with:pessoa', 'digits_between:1,5']
        ]);

        $user = Auth::user();
        $pessoa_id = $user['pessoa_id'];

        if ($request->has('pessoa')) {
            $endereco = new Endereco();
            $endereco->fill([
                'cep' => $request['pessoa']['endereco']['cep'],
                'numero' => $request['pessoa']['endereco']['numero']
            ]);

            $endereco->save();

            $pessoa = new Pessoa();
            $pessoa->fill([
                'nome' => $request['pessoa']['nome'],
                'documento' => $request['pessoa']['documento'],
                'telefone' => $request['pessoa']['telefone'],
                'tipo' => $request['pessoa']['tipo'],
                'endereco_id' => $endereco['id']
            ]);

            $pessoa->save();
            $pessoa_id = $pessoa['id'];
        }

        $cartao = new Cartao();
        $cartao->fill([
            'tipo' => $request['tipo'],
            'status' => 'P',
            'senha' => $request['senha'],
            'categoria' => $request['categoria'],
            'user_id' => $user['id'],
            'pessoa_id' => $pessoa_id,
            'bandeira_id' => $request['bandeira']
        ]);

        $cartao->save();
        return response()->json($cartao);
    }

    public function update(Request $request)
    {
        $request->validate([
            'cartao_id' => ['required', 'exists:cartao,id'],
            'status' => ['required', 'in:A,R,B,C,P']
        ]);

        $cartao = Cartao::query()->where('id', '=', $request['cartao_id'])->first();

        if ($request['status'] === 'A' && $cartao['status'] === 'P') {
            $cvv = cvv();
            $numero = card();

            $cartao->update([
                'cvv' => $cvv,
                'numero' => $numero,
                'data_emissao' => Carbon::now()->toDate(),
                'validade' => Carbon::now()->addYears(6)->toDate()
            ]);
        }

        $cartao->update([
            'status' => $request['status']
        ]);
    }

}

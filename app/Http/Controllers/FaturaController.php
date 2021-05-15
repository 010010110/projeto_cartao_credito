<?php

namespace App\Http\Controllers;

use App\Models\Fatura;
use App\Models\Item;
use App\Models\Pagamento;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FaturaController extends Controller
{

    public function getFaturas()
    {
        $user = Auth::user();
        $faturas = Fatura::with('item')
            ->where('user_id', '=', $user['id'])->get();
        return response()->json($faturas);
    }

    public function simular(Request $request)
    {
        $request->validate([
            'fatura_id' => ['required', 'exists:fatura,id'],
            'valor' => ['required', 'numeric', 'min:1'],
            'descricao' => ['required', 'string', 'max:255'],
            'parcelas' => ['required', 'integer', 'min:1']
        ]);

        $user = Auth::user();
        $user = User::query()->find($user['id']);

        $fatura = Fatura::with('item')->find($request['fatura_id']);
        $valor = array_reduce($fatura['item']->toArray(), function ($a, $b) {
            return $a + (floatval($b['valor']) / floatval($b['parcelas']));
        });

        $valor_parcela = floatval($request['valor']) / floatval($request['parcelas']);

        if (($valor + $valor_parcela) > floatval($user['limite'])) {
            return response()->json(['error' => 'Valor do item ultrapassa o limite atual'], 400);
        }

        $item = new Item();
        $item->fill([
            'valor' => $request['valor'],
            'descricao' => $request['descricao'],
            'parcelas' => $request['parcelas']
        ]);

        $item->save();

        DB::insert('INSERT INTO fatura_has_item(fatura_id, item_id, parcela, created_at) VALUES(?, ?, 1, ?)',
            [$request['fatura_id'], $item['id'], Carbon::now()]);
    }

    public function pagar(Request $request)
    {
        $request->validate([
            'fatura_id' => ['required', 'exists:fatura,id'],
            'valor' => ['required', 'numeric', 'min:1']
        ]);

        $fatura = Fatura::with('item')->find($request['fatura_id']);
        $valor = array_reduce($fatura['item']->toArray(), function ($a, $b) {
            return $a + (floatval($b['valor']) / floatval($b['parcelas']));
        });

        $valor_a_pagar = floatval($request['valor']);

        if ($valor_a_pagar !== floatval($valor)) {
            return response()->json(['error' => 'Valor a pagar inválido'], 400);
        }

        $pagamento = new Pagamento();
        $pagamento->fill([
            'valor' => $valor_a_pagar,
            'fatura_id' => $fatura['id']
        ]);

        $pagamento->save();

        $fatura->update(['status' => 'P']);
        return response('', 204);
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Produto;
use App\Cupom;
use App\FormaPagamento;
use App\Checkout;
use App\CheckoutIten;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produtos = Produto::all();        
        $formaPagamentos = FormaPagamento::all()->pluck('descricao', 'id')->toArray();
        
        return view('produtos.index', compact('produtos', 'formaPagamentos'));        
    }

    /**
     * Checkout a newly created resource in checkout.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'forma_pagamentos_id' => 'required',
            'cliente' => 'required',
            'email' => 'required|email',
        ]);

        $valor = 0;
        $itens = $request->except('_token', 'forma_pagamentos_id', 'cupom', 'cliente', 'email');

        if (count($itens) == 0) 
            return redirect('/produtos')->with('danger', 'Adicione produtos ao seu carrinho para concluir a compra!');         
        
        foreach ($itens as $key => $value) {
            $valor = $valor + explode('|', $value)[2];   
        }

        $cupon = DB::table('cupoms')->where('codigo', $request->input('cupom'))->first();
        $cupom_id = null;
        $valor_desconto = 0;

        if ($cupon) {
            $cupom_id = $cupon->id;
            $valor_desconto = ($valor/100)*$cupon->desconto;
            $valor = $valor - $valor_desconto;
        } 

        $checkout = array(
            'cliente' => $request->input('cliente'), 
            'email' => $request->input('email'), 
            'cupom_id' => $cupom_id, 
            'forma_pagamento_id' => $request->input('forma_pagamentos_id'),
            'valor_desconto' => $valor_desconto,
            'total' => $valor
        );

        $checkout_result = Checkout::create($checkout);

        foreach ($itens as $key => $value) {
            
            $checkout_iten = array(
                'descricao' => 'Compra Online no #' . $checkout_result->id, 
                'checkout_id' => $checkout_result->id, 
                'produto_id' => explode('|', $value)[0],
            );

            CheckoutIten::create($checkout_iten);
        }

        $purchase = DB::table('checkouts')
        ->leftJoin('checkout_itens', 'checkouts.id', '=', 'checkout_itens.checkout_id')
        ->leftJoin('produtos', 'checkout_itens.produto_id', '=', 'produtos.id')
        ->leftJoin('forma_pagamentos', 'checkouts.forma_pagamento_id', '=', 'forma_pagamentos.id')
        ->leftJoin('cupoms', 'checkouts.cupom_id', '=', 'cupoms.id')
        ->select('checkouts.*', 
        'forma_pagamentos.id as fp_id',
        'forma_pagamentos.descricao as fp_descricao',
        'cupoms.id as c_id',
        'cupoms.descricao as c_descricao',
        'cupoms.codigo as c_codigo',
        'cupoms.desconto as c_desconto',
        'checkout_itens.id as ci_id',
        'checkout_itens.descricao as ci_descricao',
        'produtos.id as p_id',
        'produtos.descricao as p_descricao',
        'produtos.valor as p_valor')
        ->where('checkouts.id', $checkout_result->id)
        ->orderBy('checkouts.id', 'asc')
        ->get()
        ->toArray();

        $data = new \stdClass();
        $data->name = $purchase[0]->cliente;
        $data->email = $purchase[0]->email;
        $data->subject = 'Obrigado! Purchase realizado com sucesso! - ' . $purchase[0]->ci_descricao;
        $data->purchase = $purchase;

        try {
            \Illuminate\Support\Facades\Mail::send(new \App\Mail\CheckoutMail($data));
        } catch (Exception $e) {
            
        } finally {
            return view('produtos.purchase', compact('purchase'))
            ->with('success', 'Purchase realizado com sucesso!');
        }        
    }
}
@extends('produtos.layout')

@section('title',__('Carrinho de Compras (Laravel)'))

@push('css')
<style>
    /* Personalizar layout*/
</style>
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between w-100">
                        <span>@lang('CARRINHO DE COMPRAS')</span>                        
                    </div>
                </div>
                <div class="card-body">
                    @if (session('danger'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('danger') }}
                    </div>
                    @endif
                </div>

                <div class="card-body">
                    {!! Form::open(['action' =>'ProdutoController@store', 'method' => 'POST'])!!}

                    <div class="form-group">
                        <div class="row">
                            @foreach($produtos as $produto)
                                <div class="col-md-3">
                                    <div class="custom-control custom-checkbox image-checkbox">
                                        <input name="ck-{{$produto->id}}" type="checkbox" class="custom-control-input" id="ck-{{$produto->id}}" value="{{$produto->id}}|{{$produto->descricao}}|{{$produto->valor}}">
                                        <label class="custom-control-label" for="ck-{{$produto->id}}">
                                            <img src="https://acneg.com.br/wp-content/uploads/icone.11_red.png" alt="#" class="img-fluid">
                                            <h5 class="card-title">{{$produto->descricao}}</h5>
                                            <h6 class="card-text">{{'R$ '.number_format($produto->valor, 2, ',', '.')}}</h6>
                                            <span  class="btn btn-primary">Adicionar ao Carrinho</span>
                                        </label>                                        
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>                

                    <div class="card-header">
                        <div class="d-flex justify-content-between w-100">
                            <span>@lang('ITENS NO MEU CARRINHO')</span>                            
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row">
                                <table class="table table-bordered">
                                    <tbody id="itens_no_meu_carrinho">
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <h1>Subtotal <span class="badge badge-success" id="subtotal">R$ 0,00</span></h1>
                            </div>
                            <div class="row">
                                <h5>Desconto <span class="badge badge-secondary" id="desconto">R$ 0,00</span></h5>                           
                            </div>
                        </div>
                    </div>

                    <div class="card-header">
                        <div class="d-flex justify-content-between w-100">
                            <span>@lang('DADOS DE PAGAMENTO')</span>                            
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div>
                               <div class="form-group">
                                    {{ Form::label('forma_pagamentos_id', 'Formas de Pagamento:')}}
                                    {!! Form::select('forma_pagamentos_id', $formaPagamentos, null, ['class' => 'form-control']) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label(__('Cupom:')) !!}
                                    {!! Form::text("cupom", null ,["class"=>"form-control"]) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label(__('Nome:')) !!}
                                    {!! Form::text("cliente", null ,["id" => "cliente", "class"=>"form-control mmss","required"=>"required"]) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label(__('Email:')) !!}
                                    {!! Form::email("email", null ,["id" => "email", "class"=>"form-control mmss","required"=>"required"]) !!}
                                </div>

                                <div class="well well-sm clearfix">
                                    <button class="btn btn-success btn-block btn-lg " title="@lang('Salvar')"
                                        type="submit">@lang('CHECKOUT')</button>
                                </div>
                            </div>
                        </div>
                    </div>                   

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    $( document ).ready(function() {
        
        var itens_arr = [];
        var subtotal = 0;
        $('[id^=ck-]').click(function() {
            var item = this.value; 
            
            if(itens_arr.indexOf(item) !== -1){
                itens_arr.splice(itens_arr.indexOf(item), 1);
                subtotal = subtotal - parseFloat(item.split ("|")[2]);
            } else{
                itens_arr.push(item);
                subtotal = subtotal + parseFloat(item.split ("|")[2]);
            }
            
            $("#itens_no_meu_carrinho").html('');
               
            if (itens_arr.length > 0) {
                itens_arr.forEach(function(value) {
                    arr = value.split ("|");                    
                    html = '<tr><td>' + arr[0] + '</td>'
                    + '<td>' + arr[1] + '</td>' 
                    + '<td>' + Intl.NumberFormat('pt-br', {style: 'currency', currency: 'BRL'}).format(arr[2]) + '</td></tr>';
                    $("#itens_no_meu_carrinho").append(html);
                });
            }
            
            $("#subtotal").html(Intl.NumberFormat('pt-br', {style: 'currency', currency: 'BRL'}).format(subtotal));
        });

    });
</script>
@endpush
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
                        <span>@lang('Obrigado! Purchase realizado com sucesso!')</span>                        
                    </div>
                </div>
                <div class="card-body">
                    @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif

                    <div class="row">
                        <div class="card" style="width: 100%;">
                            <div class="card-body">
                                <h4 class="card-title">{{$purchase[0]->ci_descricao}}</h4>
                                <h5 class="card-subtitle mb-2 text-muted">Forma de Pagamento: {{$purchase[0]->fp_descricao}}</h5>
                                <p class="card-text">Nome: {{$purchase[0]->cliente}}</p>

                                @if ($purchase[0]->c_codigo)
                                <p class="card-text">{{$purchase[0]->c_descricao}}</p>
                                <p class="card-text">Código: {{$purchase[0]->c_codigo}}</p>
                                <p class="card-text">Desconto: {{$purchase[0]->c_desconto}}%</p>                               
                                @endif

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <td>ID</td>
                                    <td>@lang('Item')</td>
                                    <td>@lang('Preço')</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($purchase as $case)
                                <tr>
                                    <td>{{$case->p_id}}</td>
                                    <td>{{$case->p_descricao}}</td>
                                    <td>{{'R$ '.number_format($case->p_valor, 2, ',', '.')}}</td>                                                                
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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
                                <h1>Valor Total <span class="badge badge-success" id="subtotal">{{'R$ '.number_format($purchase[0]->total, 2, ',', '.')}}</span></h1>
                            </div>
                            <div class="row">
                                <h5>Valor do Desconto <span class="badge badge-secondary" id="desconto">{{'R$ '.number_format($purchase[0]->valor_desconto, 2, ',', '.')}}</span></h5>                           
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="card-body">
                <div class="form-group">
                    <div class="well well-sm clearfix">
                        <a href="{{ url('produtos') }}" class="btn btn-danger btn-block btn-lg">
                            @lang('Voltar para a Loja')
                        </a>
                    </div>
                </div>
            </div>

        </div>            
    </div>
</div>
@endsection

@push('js')
<script>
    // Script personalizado
</script>
@endpush
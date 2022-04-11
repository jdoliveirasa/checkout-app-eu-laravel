<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between w-100">
            <span>Obrigado! Purchase realizado com sucesso!</span>                        
        </div>
    </div>
    <div class="card-body">
        
        <div class="row">
            <div class="card" style="width: 100%;">
                <div class="card-body">
                    <h4 class="card-title">{{$data->purchase[0]->ci_descricao}}</h4>
                    <h5 class="card-subtitle mb-2 text-muted">Forma de Pagamento: {{$data->purchase[0]->fp_descricao}}</h5>
                    <p class="card-text">Nome: {{$data->purchase[0]->cliente}}</p>

                    @if ($data->purchase[0]->c_codigo)
                    <p class="card-text">{{$data->purchase[0]->c_descricao}}</p>
                    <p class="card-text">Código: {{$data->purchase[0]->c_codigo}}</p>
                    <p class="card-text">Desconto: {{$data->purchase[0]->c_desconto}}%</p>                               
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
                    @foreach($data->purchase as $case)
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
                    <h1>Valor Total <span class="badge badge-success" id="subtotal">{{'R$ '.number_format($data->purchase[0]->total, 2, ',', '.')}}</span></h1>
                </div>
                <div class="row">
                    <h5>Valor do Desconto <span class="badge badge-secondary" id="desconto">{{'R$ '.number_format($data->purchase[0]->valor_desconto, 2, ',', '.')}}</span></h5>                           
                </div>
            </div>
        </div>

    </div>
</div>
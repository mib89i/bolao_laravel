@extends ('layouts.master')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h6>CRIAR UMA TEMPORADA</h6>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">


        <div class="panel panel-default">
            <div class="panel-body">
                <h6>Configurações</h6>
                <hr />
                <form method="POST" action="/temporadas/criar">

                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="title">Nome da Temporada</label>
                        <input type="text" class="form-control" id="name" name="nome">
                    </div>
                    
                    <label>Tipo de Temporada</label>
                    
                    <div class="btn-group btn-block" data-toggle="buttons">
                        <label class="btn btn-warning active" title="Todos os jogadores poderam ver e solicitar convite para participar desta temporada">
                            <input type="radio" name="opcoes_publica" id="opcao_1" autocomplete="off" checked value="publica"><i class="fa fa-unlock" aria-hidden="true"></i> Pública
                        </label>
                        
                        <label class="btn btn-warning" title="Apenas jogadores convidados poderão participar desta temporada">
                            <input type="radio" name="opcoes_publica" id="opcao_2" autocomplete="off" value="nao_publica"><i class="fa fa-lock" aria-hidden="true"></i> Privada
                        </label>
                    </div>
                    
                    <hr />
                    
                    <div class="form-group">
                        <button class="btn btn-primary">Criar Temporada</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
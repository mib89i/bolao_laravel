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
                <h6>Configurações da Temporada</h6>
                <hr />
                <form method="POST" action="/temporadas/criar">

                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="title">Nome do Campeonato</label>
                        <input type="text" class="form-control" id="name" name="nome">
                    </div>
                    
                    <div class="form-group">
                        <label for="title">Quantidade de Rodadas</label>
                        <input type="text" class="form-control" id="rounds" name="rodadas">
                    </div>
                    
                    <button class="btn btn-default">Criar Temporada</button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
@extends ('layouts.master')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h6>EDITAR UMA TEMPORADA</h6>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        

        <div class="panel panel-default">
            <div class="panel-body">
                <h6>Configurações da Temporada</h6>
                <hr />
                <form method="POST" action="/temporadas/{{ $temporada->id }}/editar">

                    {{ csrf_field() }}

                    {{ method_field('PATCH') }}
                    
                    <div class="form-group">
                        <label for="nome">Nome do Campeonato</label>
                        <input type="text" class="form-control" id="nome" name="nome" value="{{ $temporada->nome }}">
                    </div>
                    
                    <div class="form-group">
                        <label for="rodadas">Quantidade de Rodadas</label>
                        <input type="text" class="form-control" id="rodadas" name="rodadas" value="{{ $temporada->rodadas }}">
                    </div>
                    
                    <button class="btn btn-default">Atualizar Temporada</button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
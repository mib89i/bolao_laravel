@extends ('layouts.master')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h3><b>CRIAR RODADA DE JOGOS</b></h3>
    </div>
</div>



<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-9 col-md-11 text-center">
                        <h3>{{ $temporada->nome }}</h3>

                        <h6 style="color: black">Presidente: <b>{{ $temporada->usuario->nome }}</b></h6>
                    </div>

                    <div class="col-xs-3 col-md-1">
                        @if (Auth::user()->id === $temporada->usuario_id)
                        <a href="/temporadas/{{ $temporada->id }}/editar" style="text-decoration: none">
                            <div class="panel-body text-center vertical-align">
                                <i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i>
                            </div>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-body">
        <?php
        if ($ultima_rodada === NULL) {
            $nome_rodada = 'Rodada 1';
            $numero_rodada = 1;
        } else {
            $nome_rodada = 'Rodada ' . ($ultima_rodada->numero + 1);
            $numero_rodada = ($ultima_rodada->numero + 1);
        }
        ?>
        <form method="POST" action="/rodada/criar/t/{{ $temporada->id }}">

            {{ csrf_field() }}

            <div class="form-group">
                <label>Nome</label>
                <input type="text" class="form-control" name="nome" autocomplete="off" value="{{ $nome_rodada }}">
                <input type="hidden" name="numero" value="{{ $numero_rodada }}">
            </div>


            <hr />

            <div class="form-group">
                <button class="btn btn-primary open_loading">CRIAR</button>
            </div>
        </form>
    </div>
</div>
@endsection
@extends ('layouts.master')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h3><b>NOVA RODADA DE JOGOS</b></h3>
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
        <form method="POST" action="/rodada/criar">

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
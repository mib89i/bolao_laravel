@extends ('layouts.master')

@section('content')

<div class="panel panel-default">
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h3><b>{{ $rodada->nome }}</b></h3>
                <h4>{{ $rodada->temporada->nome }}</h4>
            </div>
        </div>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-body">
        <div class="row">
            <div class="col-xs-4 col-lg-2">
                <img src='{{ $usuario->avatar }}' class="img-responsive img-rounded">
            </div>

            <div class="col-xs-8 col-lg-10">
                <h4><b><a href="/perfil/{{ $usuario->id }}/{{ str_slug($usuario->nome, '-') }}">{{ $usuario->nome }}</a></b></h4>
                <h3>{{ $pontos_rodada->pontos }} pts</h3>
            </div>
        </div>
    </div>
</div>

@endsection
@extends ('layouts.master')

@section('content')

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

@foreach($temporada->rodada as $rodada)

<div class="panel panel-default no-padding">
    <div class="row">
        <div class="col-xs-9 col-md-11">
            <a href="/rodada/{{ $rodada->id }}" style="text-decoration: none">
                <div class="panel-body">
                    <div class="vertical-align" style="color: green">
                        <i class="fa fa-futbol-o" aria-hidden="true" style="margin-right: 15px"></i>
                        <h4><b>{{ $rodada->nome }}</b></h4>
                    </div>
                </div>
            </a>
        </div>


        <div class="col-xs-3 col-md-1">
            @if (Auth::user()->id === $rodada->usuario->id)
            <a href="/rodada/{{ $rodada->id }}/editar/t/{{ $rodada->temporada->id }}" style="text-decoration: none">
                <div class="panel-body text-center  vertical-align">
                    <i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i>
                </div>
            </a>
            @endif
        </div>

    </div>
</div>

@endforeach

@if(!$temporada->rodada_nao_publicada->isEmpty())
<hr />
<div class="row">
    <div class="col-xs-12">
        <h4><b>ATENÇÃO PARA RODADAS NÃO PUBLICADAS</b></h4>
    </div>
</div>

@foreach($temporada->rodada_nao_publicada as $rodada)

<div class="panel panel-default no-padding">
    <div class="row">
        <div class="col-xs-9 col-md-11">
            <a href="/rodada/{{ $rodada->id }}" style="text-decoration: none">
                <div class="panel-body">
                    <div class="vertical-align" style="color: red">
                        <i class="fa fa-futbol-o" aria-hidden="true" style="margin-right: 15px"></i>
                        <h4><b>{{ $rodada->nome }}</b></h4>
                    </div>
                </div>
            </a>
        </div>


        <div class="col-xs-3 col-md-1">
            @if (Auth::user()->id === $rodada->usuario->id)
            <a href="/rodada/{{ $rodada->id }}/editar/t/{{ $rodada->temporada->id }}" style="text-decoration: none">
                <div class="panel-body text-center  vertical-align">
                    <i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i>
                </div>
            </a>
            @endif
        </div>

    </div>
</div>
@endforeach

@endif

@endsection
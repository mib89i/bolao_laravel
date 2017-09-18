@extends ('layouts.master')

@section('content')

@if (!Auth::check())
<div class="row" style="text-align: center; margin: 0 auto">
    <div class="col-lg-12">

        <a href="login/facebook" class="btn btn-primary btn-lg">
            <div class="vertical-align">
                <i class="fa fa-facebook-square fa-2x" aria-hidden="true" style="margin-right: 15px"></i> Entrar com Facebook
            </div>
        </a>

    </div>
</div>

@else

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default no-padding">
            <a href="/temporadas" style="text-decoration: none; color: black">
                <div class="panel-body vertical-align">
                    <i class="fa fa-search" aria-hidden="true" style="margin-right: 15px"></i>
                    <h5><b>ENCONTRAR UMA TEMPORADA</b></h5>
                </div>
            </a>
        </div>
    </div>
</div>

@if (!$temporada_usuarios->isEmpty())

<div class="row">
    <div class="col-xs-9 col-sm-10 col-md-11">
        <h6>TEMPORADAS EM ANDAMENTO</h6>
    </div>

    <div class="col-xs-3 col-sm-2 col-md-1">
        <h6>EDITAR</h6>
    </div>
</div>

@foreach($temporada_usuarios as $temporada_usuario)
<div class="row">

    <div class="col-lg-12">
        <div class="panel panel-default no-padding">
            <div class="row">
                <div class="col-xs-9 col-md-11">
                    <a href="/temporadas/{{ $temporada_usuario->temporada->id }}" style="text-decoration: none">
                        <div class="panel-body">
                            <div class="vertical-align">
                                <h3><b>{{ $temporada_usuario->temporada->nome }}</b></h3>
                            </div>

                            <div class="vertical-align">
                                <h6 style="color: black">Presidente: <b>{{ $temporada_usuario->temporada->usuario->nome }} </b></h6>
                            </div>
                        </div>
                    </a>
                </div>


                <div class="col-xs-3 col-md-1">
                    @if (Auth::user()->id === $temporada_usuario->temporada->usuario_id)
                    <a href="/temporadas/{{ $temporada_usuario->temporada->id }}/editar" style="text-decoration: none">
                        <div class="panel-body text-center  vertical-align">
                            <i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i>
                        </div>
                    </a>
                    @endif
                </div>

            </div>

        </div>
    </div>

    @if (count($temporada_usuario->temporada->rodada) >= 1)
    
    <div class="col-lg-12">
        <div class="panel panel-default no-padding">
            <div class="panel-body">
                <a href="/temporadas/{{ $temporada_usuario->temporada->id }}/lista_rodadas">VER OUTRAS RODADAS</a>
            </div>
        </div>
    </div>
    
    @endif
    
    @foreach($temporada_usuario->temporada->rodada_aberta as $rodada)

    <div class="col-lg-12">
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
    </div>
    @endforeach
</div>
    <hr />
@endforeach

@endif

<div class="row">
    <div class="col-lg-12">
        <hr />
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <a href="/temporadas/criar" style="text-decoration: none; color: black">
                <div class="panel-body vertical-align">
                    <span class="fa fa-plus-square-o fa-4x fa-fw" aria-hidden="true"></span>
                    <h5><b>CRIAR TEMPORADA</b></h5>
                </div>
            </a>    
        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <a href="/temporadas/criar" style="text-decoration: none; color: black">
                <div class="panel-body vertical-align">
                    <span class="fa fa-plus-square-o fa-4x fa-fw" aria-hidden="true"></span>
                    <h5><b>CRIAR COPA</b></h5>
                </div>
            </a>    
        </div>
    </div>
</div>


@endif

@endsection
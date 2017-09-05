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

<h3><b>MEUS JOGOS</b></h3>

@if (!$temporada_usuarios->isEmpty())

<div class="row">
    <div class="col-xs-9 col-sm-10 col-md-11">
        <h6>TEMPORADAS EM ANDAMENTO</h6>
    </div>
    
    <div class="col-xs-3 col-sm-2 col-md-1">
        <h6>EDITAR</h6>
    </div>
</div>

<div class="row">
    @foreach($temporada_usuarios as $temporada_usuario)

    <div class="col-lg-12">
        <div class="panel panel-default no-padding">
            <div class="row">
                <div class="col-xs-9 col-md-11">
                    <a href="/temporadas/{{ $temporada_usuario->temporada->id }}" style="text-decoration: none">
                        <div class="panel-body">
                            <div class="vertical-align">
                                @if($temporada_usuario->temporada->publica === TRUE)
                                <i class="fa fa-unlock fa-2x" aria-hidden="true" style="color: black; margin-right: 10px"></i>
                                @else
                                <i class="fa fa-lock fa-2x" aria-hidden="true" style="color: red; margin-right: 10px"></i>
                                @endif
                                <i class="fa fa-list" aria-hidden="true" style="margin-right: 15px"></i>
                                <h4><b>{{ $temporada_usuario->temporada->nome }}</b></h4>
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

    @endforeach
</div>

@endif


@if (!$lista_rodada->isEmpty())
<h3><b>RODADA EM ANDAMENTO</b></h3>

<div class="row">
    @foreach($lista_rodada as $rodada)

    <div class="col-lg-12">
        <div class="panel panel-default no-padding">
            <div class="row">
                <div class="col-xs-9 col-md-11">
                    <a href="/rodada/{{ $rodada->id }}/palpites" style="text-decoration: none">
                        <div class="panel-body">
                            <div class="vertical-align">
                                <i class="fa fa-futbol-o" aria-hidden="true" style="margin-right: 15px"></i>
                                <h4><b>{{ $rodada->nome }}</b></h4>
                            </div>

                            <div class="vertical-align">
                                <h5 style="color: black">Temporada: <b>{{ $rodada->temporada->nome }}</b></h5>
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
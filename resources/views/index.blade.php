@extends ('layouts.master')

@section('content')

@if (!Auth::check())

<div class="row" style="text-align: center; margin: 0 auto">
    <div class="col-md-2 col-md-offset-5">
        <div class="panel panel-default">
            <div class="panel-body">
                <img src='https://s3-sa-east-1.amazonaws.com/bolaolaravel/logobolao.png' class="img-responsive img-rounded">
                <h2 style="font-family: 'Annie Use Your Telescope'"><b>BOLÃO BOCANEIROS</b></h2>
            </div>
        </div>
    </div>
    <!--
    <div class="col-lg-12">
        <img src='https://s3-sa-east-1.amazonaws.com/bolaolaravel/logobolao.png' class="img-responsive img-rounded hidden-sm hidden-md hidden-lg">
        
        <img src='https://s3-sa-east-1.amazonaws.com/bolaolaravel/logobolao.png' class="img-responsive img-rounded hidden-xs" style="margin: 0 auto; width: 250px">
    </div>
    -->
    <div class="col-lg-12" style="margin-top: 10px">
        <a href="login/facebook" class="btn btn-primary btn-lg btn-block hidden-sm hidden-md hidden-lg" onclick="openLoading()">
            <div class="vertical-align">
                <i class="fa fa-facebook-square fa-2x" aria-hidden="true" style="margin-right: 15px"></i> Entrar com Facebook
            </div>
        </a>

        <a href="login/facebook" class="btn btn-primary btn-lg hidden-xs" onclick="openLoading()">
            <div class="vertical-align">
                <i class="fa fa-facebook-square fa-2x" aria-hidden="true" style="margin-right: 15px"></i> Entrar com Facebook
            </div>
        </a>
    </div>
</div>

@else

<!-- 
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default no-padding">
            <a href="/temporadas" style="text-decoration: none; color: black" class="open_loading">
                <div class="panel-body vertical-align">
                    <i class="fa fa-search" aria-hidden="true" style="margin-right: 15px"></i>
                    <h5><b>ENCONTRAR UMA TEMPORADA</b></h5>
                </div>
            </a>
        </div>
    </div>
</div>
-->

@if (Session::get('temporada_ativa') != NULL)

<div class="row">
    <div class="col-lg-12">
        <h3><b>TEMPORADA ATUAL</b></h3>
    </div>
</div>

<div class="row">

    <div class="col-lg-12">
        <div class="panel panel-default no-padding">
            <div class="row">
                <div class="col-xs-9 col-md-11">
                    <a href="/temporadas/{{ Session::get('temporada_ativa')->id }}" style="text-decoration: none" class="open_loading">
                        <div class="panel-body">
                            <div class="vertical-align">
                                <h3><b>{{ Session::get('temporada_ativa')->nome }}</b></h3>
                            </div>

                            <div class="vertical-align">
                                <h6 style="color: black">Presidente: <b>{{ Session::get('temporada_ativa')->usuario->nome }} </b></h6>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xs-3 col-md-1">
                    @if (Auth::user()->id === Session::get('temporada_ativa')->usuario_id)
                    <a href="/temporadas/{{ Session::get('temporada_ativa')->id }}/editar" style="text-decoration: none">
                        <div class="panel-body text-center  vertical-align">
                            <i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i>
                        </div>
                    </a>
                    @endif
                </div>

            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <a href="/rodada" class="open_loading" style="text-decoration: none">
            <div class="panel panel-default no-padding">
                <div class="panel-body">
                    VER TODAS RODADAS
                </div>
            </div>
        </a>
    </div>
    
    @if(!Session::get('temporada_ativa')->rodada_aberta->isEmpty())
    <div class="col-lg-12">
        <h3><b>RODADA ATUAL</b></h3>
    </div>
    @endif
    
    @foreach(Session::get('temporada_ativa')->rodada_aberta as $rodada)

    <div class="col-lg-12">
        <div class="panel panel-default no-padding">
            <div class="row">
                <div class="col-xs-9 col-md-11">
                    <a href="/rodada/{{ $rodada->id }}/ver" class="open_loading" style="text-decoration: none">
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
                    <a href="/rodada/{{ $rodada->id }}/editar" style="text-decoration: none">
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

@endif

<div class="row">
    <div class="col-lg-12">
        <hr />
    </div>
</div>

@if (Auth::user()->admin && Session::get('temporada_ativa') == NULL)
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

@if ($rodada_finalizada != null)
<div class="modal fade" tabindex="-1" role="dialog" id="modal_rodada_finalizada" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h1 class="bg-success text-center" style="padding: 10px"><b>PARABÉNS !!!<b/></h1>
                <div class="row text-center">
                    <div class="col-lg-12">
                        <h3><b>{{ $rodada_finalizada->rodada->nome }}</b></h3>
                        <h4>{{ $rodada_finalizada->rodada->temporada->nome }}</h4>
                    </div>
                </div>
                
                <hr />
                
                <div class="row vertical-align">
                    <div class="col-xs-4 col-lg-2">
                        <img src='{{ $rodada_finalizada->usuario->avatar }}' class="img-responsive img-rounded" />
                    </div>

                    <div class="col-xs-8 col-lg-10">
                        <h3><a href="/perfil/{{ $rodada_finalizada->usuario->id }}/{{ str_slug($rodada_finalizada->usuario->nome, '-') }}">{{ $rodada_finalizada->usuario->nome }}</a></h3>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="bg-success text-center" style="padding: 10px"><b>{{ $rodada_finalizada->descricao }} pts<b/></h3>
                    </div>
                </div>
                    
                
                <div class="row">
                @if ($lista_melhores != null)
                    <div class="col-lg-12">
                        <h5>5 MELHORES</h5>
                    </div>
                    
                    @foreach($lista_melhores as $melhores)
                    <div class="col-lg-12">

                                <div class="row">

                                    <div class="col-lg-2">
                                        <img src='{{ $melhores->avatar }}' class="img-responsive img-circle">
                                    </div>

                                    <div class="col-lg-9">
                                        <h4><b><a href="/perfil/{{ $melhores->id }}/{{ str_slug($melhores->nome, '-') }}">{{ $melhores->nome }}</a></b></h4>
                                        <h3>{{ $melhores->pontos }} pts</h3>
                                    </div>

                                    <div class="col-lg-1 text-right">
                                        <h3><b>{{ $melhores->rank }}°</b></h3>
                                    </div>

                                </div>
                        <hr />
                    </div>
                    @endforeach
                @endif
                </div>
            </div>

            <div class="modal-footer">
                <a href="/visualiza_rodada/{{ $rodada_finalizada->id }}" class="btn btn-danger btn-block btn-lg"><i class="fa fa-thumbs-up" aria-hidden="true"></i> OK</a>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@section('script-add')
<script type="text/javascript">
    $(document).ready(function () {
        
        $('#modal_rodada_finalizada').modal('show');
        
    });
</script>
@endsection

@endif

@endif
<div
  class="fb-like"
  data-share="true"
  data-width="450"
  data-show-faces="true">
</div>
@endsection
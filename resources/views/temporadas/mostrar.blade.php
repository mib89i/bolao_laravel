@extends ('layouts.master')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row vertical-align">
                    <div class="col-xs-8 col-md-10">
                        <h3>{{ $temporada->nome }}</h3>
                    </div>

                    <div class="col-xs-4 col-md-2">
                        @if( Auth::user()->id !== $temporada->usuario_id )

                        @if ($temporada_usuario === NULL)
                        <a href="/temporadas/{{$temporada->id}}/request" class="btn btn-danger btn-block btn-lg"><b>PARTICIPAR</b></a>
                        @elseif ($temporada_usuario->aceito)
                        <a class="btn btn-default btn-block btn-lg" data-toggle="modal" data-target="#modal_sair"><b>SAIR</b></a>

                        <!-- Modal -->
                        <div class="modal fade" id="modal_sair" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Sair da Temporada</h4>
                                    </div>
                                    <div class="modal-body">
                                        <h4><b>Tem certeza que deseja deixar essa temporada?</b></h4>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="/temporadas/{{ $temporada_usuario->id }}/denied"  type="button" class="btn btn-danger">Sair dessa temporada</a>
                                        <button class="btn btn-default" data-dismiss="modal">Fechar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                        <a href="#" class="btn btn-default btn-block btn-lg disabled" disabled><b>AGUARDE ...</b></a>
                        @endif

                        @endif
                    </div>
                </div>
                <hr />
                <div class="row">

                    @if (Auth::user()->id === $temporada->user_id)
                    <div class="col-md-2 col-xs-6">
                        <a href="/games/s/{{ $temporada->id }}/create" class="btn btn-primary btn-block">
                            <i class="fa fa-futbol-o" aria-hidden="true" style="margin-right: 10px"></i><b>CRIAR BOLÃO</b>
                        </a>
                    </div>
                    @endif

                    <div class="col-md-2 col-xs-6">
                        <a href="#" class="btn btn-primary btn-block">
                            <i class="fa fa-bars" aria-hidden="true" style="margin-right: 10px"></i><b>PALPITES</b>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if (true === false)
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="text-center">
                    <h3><b>Nova Rodada Disponível</b></h3>
                    <a href="#" class="btn btn-default btn-lg"><b>VER RODADA</b></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<h3><b>RANKING</b></h3>

<div class="row">
    @if (isset($my_rank))
    <div class="col-lg-12">
        <div class="panel panel-default no-padding" style="border-color: gray; border-width: 4px">
            <div class="panel-body">

                <div class="row">

                    <div class="col-xs-3 col-md-1">
                        <img src='{{ $my_rank->avatar }}' class="img-responsive img-circle">
                    </div>

                    <div class="col-xs-6 col-md-9">
                        <h4><b><a href="#">{{ $my_rank->nome }}</a></b></h4>
                        <h3>870 pts</h3>
                    </div>

                    <div class="col-xs-3 col-md-2 text-right">
                        <h3><i class="fa fa-arrow-up" aria-hidden="true" style="color: #5ce936"></i><b>{{ $my_rank->rank }}°</b></h3>
                    </div>
                    
                </div>

            </div>
        </div>
        <hr />
    </div>
    @endif
    
    @foreach($ranking as $rank)
    <div class="col-lg-12">
        <div class="panel panel-default no-padding">
            <div class="panel-body">

                <div class="row">

                    <div class="col-xs-3 col-md-1">
                        <img src='{{ $rank->avatar }}' class="img-responsive img-circle">
                    </div>

                    <div class="col-xs-6 col-md-9">
                        <h4><b><a href="#">{{ $rank->nome }}</a></b></h4>
                        <h3>870 pts</h3>
                    </div>

                    <div class="col-xs-3 col-md-2 text-right">
                        <h3><i class="fa fa-arrow-down" aria-hidden="true" style="color: red"></i><b>{{ $rank->rank }}°</b></h3>
                    </div>
                    
                </div>

            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection
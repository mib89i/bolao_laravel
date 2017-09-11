@extends ('layouts.master')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h3>{{ $rodada->temporada->nome }}</h3>

                        <h6 style="color: black">Presidente: <b>{{ $rodada->usuario->nome }}</b></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-9 col-md-11 text-center">
                        <h4><b>{{ $rodada->nome }}</b></h4>
                    </div>

                    <div class="col-xs-3 col-md-1">
                        @if (Auth::user()->id === $rodada->usuario_id)
                        <a href="/rodada/{{ $rodada->id }}/editar/t/{{ $rodada->temporada_id }}" style="text-decoration: none">
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
@if(!$rodada->jogo->isEmpty())

@foreach($rodada->jogo AS $jogo)
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h4><b>{{ $jogo->local }}</b> - {{ date('d/m/Y', strtotime($jogo->data_jogo)) }} - {{ $jogo->hora_jogo }} {{ ($jogo->importancia != NULL ? 'x'.$jogo->importancia : '') }}</h4>

                        <div class="row vertical-align">
                            <div class="col-xs-5">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-6 col-sm-2">
                                            <img src='http://a.espncdn.com/combiner/i?img=/i/teamlogos/soccer/500/default-team-logo-500.png&h=42&w=42' class="img-rounded"/>
                                        </div>

                                        <div class="col-xs-6 col-sm-10">
                                            <div class="hidden-xs">
                                                <h4><label>{{ $jogo->time1->nome }}</label></h4>
                                            </div>
                                            <div class="hidden-sm hidden-md hidden-lg">
                                                <h4><label>{{ $jogo->time1->sigla }}</label></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-2 text-center">
                                <label style="font-weight: bold">X</label>
                            </div>

                            <div class="col-xs-5">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-6 col-sm-10 text-right">
                                            <div class="hidden-xs">
                                                <h4><label>{{ $jogo->time2->nome }}</label></h4>
                                            </div>
                                            <div class="hidden-sm hidden-md hidden-lg">
                                                <h4><label>{{ $jogo->time2->sigla }}</label></h4>
                                            </div>
                                        </div>

                                        <div class="col-xs-6 col-sm-2">
                                            <img src='http://a.espncdn.com/combiner/i?img=/i/teamlogos/soccer/500/default-team-logo-500.png&h=42&w=42' class="img-rounded"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-6">
                                <input class="form-control text-center" name="placar_time1" value="{{ $jogo->placar_time1 }}"/>
                            </div>
                            <div class="col-xs-6">
                                <input class="form-control text-center" name="placar_time2" value="{{ $jogo->placar_time2 }}"/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <label style="font-size: 7pt">PLACAR</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
<div class="row">
    <div class="col-lg-12">
        <a href="#" class="btn btn-success hidden-xs">GRAVAR PALPITES</a>    
        <a href="#" class="btn btn-success hidden-sm hidden-md hidden-lg btn-block">GRAVAR PALPITES</a>    
    </div>
</div>
@endif


@endsection
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
                    @if (Auth::user()->id === $rodada->usuario_id)
                    <div class="col-xs-9 col-md-11 text-center">
                        <h4><b>{{ $rodada->nome }}</b></h4>
                    </div>

                    <div class="col-xs-3 col-md-1">
                        <a href="/rodada/{{ $rodada->id }}/editar/t/{{ $rodada->temporada_id }}" style="text-decoration: none">
                            <div class="panel-body text-center vertical-align">
                                <i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i>
                            </div>
                        </a>
                    </div>
                    @else
                    <div class="col-lg-12 text-center">
                        <h4><b>{{ $rodada->nome }}</b></h4>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@if(!$rodada->jogo->isEmpty())
<form method="POST" action="/rodada/{{ $rodada->id }}/palpite">

    {{ csrf_field() }}

    @foreach($rodada->jogo AS $jogo)
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-12">
                    <h4><b>{{ $jogo->local }}</b> - {{ date('d/m/Y', strtotime($jogo->data_jogo)) }} - {{ $jogo->hora_jogo }} hrs <b>{{ ($jogo->importancia != 1 ? 'x'.$jogo->importancia : '') }}</b></h4>

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

                    <input class="hidden" name="lista_jogos[{{ $jogo->id }}][id]" value="{{ $jogo->id }}"/>
                    <input class="hidden" name="lista_jogos[{{ $jogo->id }}][data_jogo]" value="{{ $jogo->data_jogo }}"/>
                    <input class="hidden" name="lista_jogos[{{ $jogo->id }}][hora_jogo]" value="{{ $jogo->hora_jogo }}"/>

                    <?php
                    $data_hoje = date('Y-m-d'); // DATA DE HOJE
                    $hora_hoje = date('H:i'); // HORA DE HOJE
                    $editavel = TRUE;

                    if (strtotime($data_hoje) > strtotime($jogo->data_jogo)) {
                        // JOGO JÁ PASSOU
                        $editavel = FALSE;
                    } else if (strtotime($data_hoje) == strtotime($jogo->data_jogo)) {
                        // VERIFICAR O HORÁRIO
                        if (strtotime($hora_hoje) > strtotime($jogo->hora_jogo)) {
                            // HORA DO JOGO PASSOU
                            $editavel = FALSE;
                        }
                    }
                    ?>

                    @if($editavel)
                        @if($jogo->palpite == NULL)
                        <div class="row">
                            <div class="col-xs-6">
                                <input class="form-control text-center" name="lista_jogos[{{ $jogo->id }}][placar_time1]" value="{{ $jogo->placar_time1 }}"/>
                            </div>
                            <div class="col-xs-6">
                                <input class="form-control text-center" name="lista_jogos[{{ $jogo->id }}][placar_time2]" value="{{ $jogo->placar_time2 }}"/>
                            </div>
                        </div>
                        @else
                        <div class="row">
                            <div class="col-xs-6">
                                <input class="form-control text-center" name="lista_jogos[{{ $jogo->id }}][placar_time1]" value="{{ $jogo->palpite->placar_time1 }}" />
                            </div>
                            <div class="col-xs-6">
                                <input class="form-control text-center" name="lista_jogos[{{ $jogo->id }}][placar_time2]" value="{{ $jogo->palpite->placar_time2 }}" />
                            </div>
                        </div>
                        @endif
                    @else
                        @if($jogo->palpite == NULL)
                        <div class="row">
                            <div class="col-xs-6">
                                <input class="form-control text-center" name="lista_jogos[{{ $jogo->id }}][placar_time1]" disabled="disabled"/>
                            </div>
                            <div class="col-xs-6">
                                <input class="form-control text-center" name="lista_jogos[{{ $jogo->id }}][placar_time2]" disabled="disabled"/>
                            </div>
                        </div>
                        @else
                        <div class="row">
                            <div class="col-xs-6">
                                <input class="form-control text-center" name="lista_jogos[{{ $jogo->id }}][placar_time1]" value="{{ $jogo->palpite->placar_time1 }}" disabled="disabled"/>
                            </div>
                            <div class="col-xs-6">
                                <input class="form-control text-center" name="lista_jogos[{{ $jogo->id }}][placar_time2]" value="{{ $jogo->palpite->placar_time2 }}" disabled="disabled"/>
                            </div>
                        </div>
                        @endif
                    @endif
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <label style="font-size: 7pt">PLACAR</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        @if($editavel == FALSE && $jogo->hora_jogo_final == NULL)
        <div class="panel-body" style="background: #0fefb7">
            <div class="row">
                <div class="col-lg-12">
                    <b>JOGO EM ANDAMENTO</b>
                </div>
            </div>
        </div>
        <div class="panel-body no-padding text-center">
            <div class="row">
                <div class="col-lg-12">
                    <?php 
                        $plac_1 = ($jogo->placar_time1) != null ?  $jogo->placar_time1 : 0;
                        $plac_2 = ($jogo->placar_time2) != null ?  $jogo->placar_time2 : 0;
                    ?>
                    <h6>{{ $jogo->time1->nome }} {{ $plac_1 }} x {{ $plac_2 }} {{ $jogo->time2->nome }}</h6>
                </div>
            </div>
        </div>
        @elseif ($editavel == FALSE && $jogo->hora_jogo_final != NULL)
        <div class="panel-body" style="background: #ff9e9e">
            <div class="row">
                <div class="col-lg-12">
                    <b>JOGO FINALIZADO</b>
                </div>
            </div>
        </div>
        <div class="panel-body no-padding text-center">
            <div class="row">
                <div class="col-lg-12">
                    <?php 
                        $plac_1 = ($jogo->placar_time1) != null ?  $jogo->placar_time1 : 0;
                        $plac_2 = ($jogo->placar_time2) != null ?  $jogo->placar_time2 : 0;
                    ?>
                    <h6>{{ $jogo->time1->nome }} {{ $plac_1 }} x {{ $plac_2 }} {{ $jogo->time2->nome }}</h6>
                </div>
            </div>
        </div>
        @endif
    </div>
    
    @endforeach

    <div class="row">
        <div class="col-lg-12">
            <button type="submit" class="btn btn-success hidden-xs">GRAVAR PALPITES</button>    
            <button type="submit" class="btn btn-success hidden-sm hidden-md hidden-lg btn-block">GRAVAR PALPITES</button>    
        </div>
    </div>

</form>

@endif


@endsection
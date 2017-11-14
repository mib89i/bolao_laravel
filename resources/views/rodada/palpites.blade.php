@extends ('layouts.master')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h3><b>PALPITES</b></h3>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-body">
        <div class="row">
            <div class="col-xs-4 col-lg-1">
                <img src='{{ $usuario->avatar }}' class="img-responsive img-rounded">
            </div>

            <div class="col-xs-8 col-lg-11">
                <h4><b><a href="/perfil/{{ $usuario->id }}/{{ str_slug($usuario->nome, '-') }}">{{ $usuario->nome }}</a></b></h4>
                <h3>{{ $pontos_rodada->pontos }} pts</h3>
            </div>
        </div>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h3><b>{{ $rodada->nome }}</b></h3>
            </div>
        </div>
    </div>
</div>

@foreach($rodada->jogo AS $jogo)
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row text-center">
                <div class="col-lg-12">
                    <h4><b>{{ $jogo->local }}</b> - {{ date('d/m/Y', strtotime($jogo->data_jogo)) }} - {{ $jogo->hora_jogo }} hrs <b>{{ ($jogo->importancia != 1 ? 'x'.$jogo->importancia : '') }}</b></h4>
                    <?php 
                        $palpite_usuario = $jogo->palpite_usuario($usuario)->first();
                    ?>           
                    
                    <div class="row">
                        <div class="col-lg-5 col-sm-4 col-xs-3 text-right">
                            <h3 class="hidden-xs" style="display: inline">{{ $jogo->time1->nome }}</h3>
                            <h3 class="hidden-sm hidden-md hidden-lg" style="display: inline">{{ $jogo->time1->sigla }}</h3>
                        </div>
                        
                        <div class="col-lg-2 col-sm-4 col-xs-6">
                            <img src='{{ $jogo->time1->logo }}' style="width: 40px; margin-right: 10px"/>
                            @if($palpite_usuario != NULL)
                            <h3 style="display: inline"><b>{{ $palpite_usuario->placar_time1 }}</b></h3>
                            @endif
                            X
                            @if($palpite_usuario != NULL)
                            <h3 style="display: inline"><b>{{ $palpite_usuario->placar_time2 }}</b></h3>
                            @endif
                            <img src='{{ $jogo->time2->logo }}' style="width: 40px; margin-left: 10px"/>
                        </div>
                        
                        <div class="col-lg-5 col-sm-4 col-xs-3 text-left">
                            <h3 class="hidden-xs" style="display: inline">{{ $jogo->time2->nome }}</h3>
                            <h3 class="hidden-sm hidden-md hidden-lg" style="display: inline">{{ $jogo->time2->sigla }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <hr />
                    <div class="panel-body text-center" style="padding-top: 0px; padding-bottom: 0px">
                        
                        <h4>PLACAR FINAL DO JOGO</h4>
                        <?php
                        $plac_1 = ($jogo->placar_time1) != null ? $jogo->placar_time1 : 0;
                        $plac_2 = ($jogo->placar_time2) != null ? $jogo->placar_time2 : 0;
                        ?>
                        <h6>{{ $jogo->time1->nome }} {{ $plac_1 }} x {{ $plac_2 }} {{ $jogo->time2->nome }}</h6>
                        
                    </div>

                </div>
            </div>
        </div>
        <div class="panel-body bg-primary no-padding text-center">
            @if($palpite_usuario == NULL)
            <h4>0 pts</h4>
            @else
            <h4>{{ $palpite_usuario->pontos_palpite()->pontos }} pts</h4>
            @endif
        </div>
    </div>


    @endforeach
@endsection
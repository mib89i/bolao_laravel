<?php 
$tipo_time = $time_selecionado;
?>

<div class="row">
    @foreach($lista_time as $time)
    <div class="col-lg-12">
        <div class="row vertical-align">
            <div class="col-xs-2 col-md-1">
                <img src='http://a.espncdn.com/combiner/i?img=/i/teamlogos/soccer/500/default-team-logo-500.png&h=42&w=42' class="img-rounded" style="width: 40px"/>
            </div>
            
            <div class="col-xs-7 col-md-9">
                <h4>{{ $time->nome }}</h4>
            </div>
            
            <div class="col-xs-3 col-md-2">
                <a href="/times/{{ $time->id }}/selecionar/{{ $tipo_time }}" onclick="atualiza_time_selecionado()" class="btn btn-success btn-sm btn-block"><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a>
            </div>
        </div>
        <hr />
    </div>
    @endforeach
</div>

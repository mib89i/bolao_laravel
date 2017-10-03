<?php 
$tipo_time = $time_selecionado;
?>
    @foreach($lista_time as $time)
    <div class="panel panel-default">
        <div class="panel-body">
            <a href="#" onclick="atualiza_time_selecionado('{{URL::to('times/'.$time->id.'/selecionar/'.$tipo_time)}}')" style="text-decoration: none; color: black">
                <div class="row vertical-align">
                    <div class="col-xs-3 col-sm-2">
                        <img src='{{ $time->logo }}' class="img-responsive"/>
                    </div>

                    <div class="col-xs-9 col-sm-10">
                        <h3>{{ $time->nome }}</h3>
                    </div>
                </div>
            </a>
        </div>
    </div>
    @endforeach

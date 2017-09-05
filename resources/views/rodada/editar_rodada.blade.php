@extends ('layouts.master')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h3><b>EDITAR RODADA DE JOGOS</b></h3>
    </div>
</div>

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

<div class="panel panel-default">
    <div class="panel-body">
        <form method="POST" action="/rodada/{{ $rodada->id }}/editar/t/{{ $temporada->id }}">

            {{ csrf_field() }}

            <div class="form-group">
                <label>Nome</label>
                <input type="text" class="form-control" name="nome" autocomplete="off" value="{{ $rodada->nome }}">
                <input type="hidden" name="numero" value="{{ $rodada->numero }}">
            </div>

            <hr />

            <div class="form-group">
                <button class="btn btn-primary">ALTERAR</button>
            </div>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <h5><b>LISTA DE JOGOS</b></h5>
    </div>
</div>

<form action="/rodada/{{ $rodada->id }}/editar/t/{{ $temporada->id }}/adicionar_jogo" method="POST">

    {{ csrf_field() }}

    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="input_local_partida">Local da Partida</label>
                        <input id="input_local_partida" name="local" class="form-control" placeholder="LOCAL DA PARTIDA"/>
                    </div>
                </div>

                <div class="col-xs-12">
                    <div class="row">
                        <div class="col-xs-5">
                            <div class="form-group">
                                <label for="input_data_partida">Data</label>
                                <input id="input_data_partida" name="data_jogo" class="form-control mask_data text-center" placeholder="01/01/2000" />
                            </div>
                        </div>

                        <div class="col-xs-4">
                            <div class="form-group">
                                <label for="input_hora_partida">Hora</label>
                                <input id="input_hora_partida" name="hora_jogo" class="form-control mask_hora text-center" placeholder="HORA DO JOGO"/>
                            </div>
                        </div>

                        <div class="col-xs-3">
                            <div class="form-group">
                                <label for="input_importancia">Vezes</label>
                                <input id="input_importancia" name="importancia" class="form-control text-center" placeholder="IMPORTÂNCIA"/>
                            </div>
                        </div>

                        <div id="panel_dia_semana" class="col-xs-12">
                            <label>Dia</label><br />
                            <h4>Segunda-Feira</h4>
                        </div>
                    </div>
                </div>

                <div id="panel_time" class="col-xs-12">
                    <hr />
                    <div class="row vertical-align">
                        <div class="col-xs-5">
                            <div class="form-group">
                                <label for="input_time1">Time 1</label><br />
                                @if(!Session::has('time1_selecionado'))
                                <a href="#" class="btn btn-success btn-block" data-toggle="modal" data-target="#modal_pesquisa_time">CASA</a>
                                @else
                                <div class="row">
                                    <div class="col-xs-2 col-md-2">
                                        <img src='http://a.espncdn.com/combiner/i?img=/i/teamlogos/soccer/500/default-team-logo-500.png&h=42&w=42' class="img-rounded"/>
                                    </div>
                                    
                                    <div class="col-xs-10 col-md-10">
                                        <h4><label data-toggle="modal" data-target="#modal_pesquisa_time">{{ Session::get('time1_selecionado')->nome }}</label></h4>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-xs-2 text-center">
                            <label style="font-weight: bold">X</label>
                        </div>

                        <div class="col-xs-5">
                            <div class="form-group">
                                <label for="input_time2">Time 2</label>
                                @if(!Session::has('time2_selecionado'))
                                <a href="#" class="btn btn-success btn-block" data-toggle="modal" data-target="#modal_pesquisa_time2">VISITANTE</a>
                                @else
                                <div class="row">
                                    <div class="col-lg-10 text-right">
                                        <h4><label data-toggle="modal" data-target="#modal_pesquisa_time2">{{ Session::get('time2_selecionado')->nome }}</label></h4>
                                    </div>
                                    
                                    <div class="col-lg-2">
                                        <img src='http://a.espncdn.com/combiner/i?img=/i/teamlogos/soccer/500/default-team-logo-500.png&h=42&w=42' class="img-rounded"/>
                                    </div>
                                </div>
                                @endif                                
                            </div>
                        </div>
                    </div>

                    <hr />

                    <div class="form-group">
                        <button class="btn btn-primary">ADICIONAR ESTE JOGO</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>


<div class="modal fade" tabindex="-1" role="dialog" id="modal_pesquisa_time">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">PESQUISAR UM TIME</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-8 col-md-8">
                        <div class="form-group">
                            <input id="input_pesquisa_time" type="text" class="form-control" name="pesquisa_time" placeholder="NOME DO TIME">
                        </div>
                    </div>

                    <div class="col-xs-4 col-md-4">
                        <div class="hidden-xs">
                            <button id="btn_pesquisa_time" type="button" class="btn btn-primary btn-block"><i class="fa fa-search" aria-hidden="true"></i> PESQUISAR</button>
                        </div>
                        <div class="hidden-sm hidden-md hidden-lg">
                            <button id="btn_pesquisa_time" type="button" class="btn btn-primary btn-block"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </div>

                <div id="ajax_load_time"></div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">FECHAR</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="modal_pesquisa_time2">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">PESQUISAR UM TIME</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-8 col-md-8">
                        <div class="form-group">
                            <input id="input_pesquisa_time2" type="text" class="form-control" name="pesquisa_time2" placeholder="NOME DO TIME">
                        </div>
                    </div>

                    <div class="col-xs-4 col-md-4">
                        <div class="hidden-xs">
                            <button id="btn_pesquisa_time2" type="button" class="btn btn-primary btn-block"><i class="fa fa-search" aria-hidden="true"></i> PESQUISAR</button>
                        </div>
                        <div class="hidden-sm hidden-md hidden-lg">
                            <button id="btn_pesquisa_time2" type="button" class="btn btn-primary btn-block"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </div>

                <div id="ajax_load_time2"></div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">FECHAR</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@section('script-add')
<script type="text/javascript">
    function pesquisa_time() {
        $.ajax({
            type: "GET",
            url: '{{URL::to("times/ajax/get_lista_time")}}',
            data: {nome_time: $('#input_pesquisa_time').val()}
        }).done(function (data) {
        }).fail(function (data) {
            
        }).always(function (data) {
            $('#ajax_load_time').html(data);
        });
    }
    
    $(document).ready(function () {
        $('#input_pesquisa_time').keyup(function (e) {
            e.preventDefault();
            pesquisa_time();
        });
    });
    
    function pesquisa_time2() {
        $.ajax({
            type: "GET",
            url: '{{URL::to("times/ajax/get_lista_time2")}}',
            data: {nome_time: $('#input_pesquisa_time2').val()}
        }).done(function (data) {
        }).fail(function (data) {
            
        }).always(function (data) {
            $('#ajax_load_time2').html(data);
        });
    }



    $(document).ready(function () {
        $('#input_pesquisa_time2').keyup(function (e) {
            e.preventDefault();
            pesquisa_time2();
        });
    });
</script>
@endsection

@endsection

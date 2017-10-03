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

@if(!$rodada->publicada)
<div class="panel panel-primary no-padding">
    <div class="panel-body bg-primary">
        <h5><b>RODADA NÃO ESTÁ VISÍVEL PARA OS JOGADORES</b></h5>
    </div>
</div>
@endif

<div class="panel panel-default">
    <div class="panel-body">
        <form method="POST" action="/rodada/{{ $rodada->id }}/editar/t/{{ $temporada->id }}">

            {{ csrf_field() }}

            {{ method_field('PATCH') }}

            <div class="form-group">
                <label>Nome</label>
                <input type="text" class="form-control" name="nome" autocomplete="off" value="{{ $rodada->nome }}">
                <input type="hidden" name="numero" value="{{ $rodada->numero }}">
            </div>

            @if(!$rodada->concluida)
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="publicada" {{ $rodada->publicada ? 'checked' : ''}}> PUBLICAR ESTA RODADA
                    </label>
                </div>
            
                <hr />
                
                
                <div class="form-group">
                    <button class="btn btn-primary open_loading">ALTERAR</button>
                    <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#modal_excluir_rodada">EXCLUIR</a>
                </div>
            @endif
        </form>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="modal_excluir_rodada">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">EXCLUIR RODADA</h4>
            </div>

            <div class="modal-body">
                <p><b><h4 style="color: red">Deseja realmente excluir esta rodada?</h4></b></p>
                <p><h3>{{ $rodada->nome }}</h3></p>
            </div>

            <div class="modal-footer">

                <form method="POST" action="/rodada/{{ $rodada->id }}/excluir" class="hidden" id="excluir_rodada_form">

                    {{ csrf_field() }}

                    {{ method_field('DELETE') }}

                </form>
                
                <button type="button" class="btn btn-default" data-dismiss="modal">CANCELAR</button>
                <button type="submit" class="btn btn-danger open_loading" form="excluir_rodada_form">EXCLUIR RODADA</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@if($rodada->concluida)
<div class="panel panel-default">
    <div class="panel-body" style="background: #009966; color: white">
        <h4><b>RODADA CONCLUÍDA</b></h4>
    </div>
</div>
@endif

@if(!$rodada->concluida)
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
                        <!--
                        <div id="panel_dia_semana" class="col-xs-12">
                            <label>Dia</label><br />
                            <h4>Segunda-Feira</h4>
                        </div>
                        -->
                    </div>
                </div>

                <div id="panel_time" class="col-xs-12">
                    <hr />

                    <div id="ajax_time_selecionado_rodada">
                        @include('times.ajax.time_selecionado_rodada')
                    </div>

                    <hr />

                    <div class="form-group">
                        <button class="btn btn-primary open_loading">ADICIONAR ESTE JOGO</button>
                        <a href="/rodada/{{ $rodada->id }}/limpar_sessao" class="btn btn-default">LIMPAR</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endif

@if(!$lista_jogos->isEmpty())
<form method="POST" action="/rodada/{{ $rodada->id }}/editar/jogo/1">
    
    {{ csrf_field() }}
    {{ method_field('PATCH') }}
    
    @foreach($lista_jogos AS $jogo)

    <?php
    $editavel = $jogo->hora_jogo_final == NULL ? TRUE : FALSE;
    ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-9 col-md-11">
                            <h4><b>{{ $jogo->local }}</b> - {{ date('d/m/Y', strtotime($jogo->data_jogo)) }} - {{ $jogo->hora_jogo }} {{ ($jogo->importancia != 1 ? 'x'.$jogo->importancia : '') }}</h4>

                            <div class="row vertical-align">
                                <div class="col-xs-5">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-6 col-sm-2">
                                                <img src='{{ $jogo->time1->logo }}' class="img-responsive"/>
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
                                                <img src='{{ $jogo->time2->logo }}' class="img-responsive"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <input class="hidden" name="lista_jogos[{{ $jogo->id }}][id]" value="{{ $jogo->id }}"/>

                            @if($editavel)
                            <div class="row">
                                <div class="col-xs-6">
                                    <input class="form-control text-center" name="lista_jogos[{{ $jogo->id }}][placar_time1]" value="{{ $jogo->placar_time1 }}"/>
                                </div>
                                <div class="col-xs-6">
                                    <input class="form-control text-center" name="lista_jogos[{{ $jogo->id }}][placar_time2]" value="{{ $jogo->placar_time2 }}"/>
                                </div>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="lista_jogos[{{ $jogo->id }}][finalizar_jogo]"> FINALIZAR ESTE JOGO
                                </label>
                            </div>
                            @else
                            <div class="row">
                                <div class="col-xs-6">
                                    <input class="form-control text-center" name="lista_jogos[{{ $jogo->id }}][placar_time1]" value="{{ $jogo->placar_time1 }}" disabled="disabled"/>
                                </div>
                                <div class="col-xs-6">
                                    <input class="form-control text-center" name="lista_jogos[{{ $jogo->id }}][placar_time2]" value="{{ $jogo->placar_time2 }}" disabled="disabled"/>
                                </div>
                            </div>
                            @endif

                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <label style="font-size: 7pt">PLACAR</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-3 col-md-1">
                            @if (Auth::user()->id === $rodada->usuario_id)

                            <div class="btn-group">
                                <button class="btn btn-default btn-md dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-cog" aria-hidden="true"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <a href="#" data-toggle="modal" data-target="#modal_excluir_jogo{{ $jogo->id }}" class="btn btn-link" style="font-weight: bold; color: red"><i class="fa fa-trash fa-2x" aria-hidden="true" style="color: red"></i> EXCLUIR JOGO</a>
                                </ul>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @if ($editavel == FALSE)
                <div class="panel-body" style="background: #ff9e9e">
                    <div class="row">
                        <div class="col-lg-12">
                            <h6><b>JOGO FINALIZADO</b></h6>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    @endforeach
    
    <div class="row">
        <div class="col-lg-12">
            @if(!$rodada->concluida)
            <button type="submit"  class="btn btn-success hidden-xs">GRAVAR ALTERAÇÕES</button>    
            <button type="submit"  class="btn btn-success hidden-sm hidden-md hidden-lg btn-block">GRAVAR ALTERAÇÕES</button>

            <a href="/rodada/{{ $rodada->id }}/terminar" class="btn btn-danger hidden-xs open_loading">TERMINAR RODADA</a>    
            <a href="/rodada/{{ $rodada->id }}/terminar" class="btn btn-danger hidden-sm hidden-md hidden-lg btn-block open_loading">TERMINAR RODADA</a>
            @endif
        </div>
    </div>
</form>

@foreach($lista_jogos AS $jogo)
<div class="modal fade" tabindex="-1" role="dialog" id="modal_excluir_jogo{{ $jogo->id }}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">EXCLUIR JOGO</h4>
            </div>

            <div class="modal-body">
                <p><b><h4 style="color: red">Deseja realmente excluir este jogo?</h4></b></p>

                <div class="row vertical-align">
                    <div class="col-xs-5">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-6 col-sm-3">
                                    <img src='{{ $jogo->time1->logo }}' class="img-responsive"/>
                                </div>

                                <div class="col-xs-6 col-sm-9">
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
                                <div class="col-xs-6 col-sm-9 text-right">
                                    <div class="hidden-xs">
                                        <h4><label>{{ $jogo->time2->nome }}</label></h4>
                                    </div>
                                    <div class="hidden-sm hidden-md hidden-lg">
                                        <h4><label>{{ $jogo->time2->sigla }}</label></h4>
                                    </div>
                                </div>

                                <div class="col-xs-6 col-sm-3">
                                    <img src='{{ $jogo->time2->logo }}' class="img-responsive"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="modal-footer">

                <form method="POST" action="/rodada/{{ $jogo->rodada_id }}/excluir/jogo/{{ $jogo->id }}" class="hidden" id="excluir_jogo_form{{ $jogo->id }}">

                    {{ csrf_field() }}

                    {{ method_field('DELETE') }}

                </form>

                <button type="button" class="btn btn-default" data-dismiss="modal">CANCELAR</button>
                <button type="submit" class="btn btn-danger" form="excluir_jogo_form{{ $jogo->id }}">EXCLUIR JOGO</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endforeach

@endif

<div class="modal fade" tabindex="-1" role="dialog" id="modal_pesquisa_time">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">PESQUISAR TIME DA CASA</h4>
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
                <h4 class="modal-title">PESQUISAR TIME VISITANTE</h4>
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
        $('#input_pesquisa_time').keyup(function (e) {
            e.preventDefault();
            pesquisa_time();
        });

        $('#input_pesquisa_time2').keyup(function (e) {
            e.preventDefault();
            pesquisa_time2();
        });

    });

    function atualiza_time_selecionado(url) {
        $('#ajax_time_selecionado_rodada').load(url, function () {
            $('#ajax_time_selecionado_rodada').fadeIn();
            $('.modal').modal('hide');
        });
    }

</script>
@endsection

@endsection

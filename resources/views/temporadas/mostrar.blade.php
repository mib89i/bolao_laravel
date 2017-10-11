@extends ('layouts.master')

@section('content')

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

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
            @if (Auth::user()->id === $temporada->usuario_id)
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal_pesquisa_usuario">ENVIAR CONVITE</a>
                <a href="/rodada/criar/t/{{ $temporada->id }}" class="btn btn-default">CRIAR RODADA</a>
            @else

                @if ($tem_temporada_usuario === NULL)
                    @if ($temporada->publica)
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal_entrar_temporada">PARTICIPAR</a>
                    @else
                        @if ($tem_convite_pendente === NULL)
                            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal_entrar_temporada">ENVIAR SOLICITAÇÃO</a>
                        @else
                            <a href="#" class="btn btn-warning">AGUARDANDO RESPOSTA ...</a>
                        @endif
                    @endif
                @else
                    <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#modal_sair_temporada">SAIR DESTA TEMPORADA</a>
                @endif
            @endif
            
            </div>
            
        </div>
    </div>

</div>

<div class="row">
    <div class="col-lg-12">
        <a href="/temporadas/{{ $temporada->id }}/lista_rodadas" class="open_loading" style="text-decoration: none">
            <div class="panel panel-default no-padding">
                <div class="panel-body">
                    VER RODADAS
                </div>
            </div>
        </a>
    </div>
</div>

<br />

<div class="modal fade" tabindex="-1" role="dialog" id="modal_entrar_temporada">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Entrar nessa temporada</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <h3>Quero participar da temporada <b>{{ $temporada->nome }}</b></h3>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">FECHAR</button>
                <a href="/convites/t/{{ $temporada->id }}/tipo/convidado" class="btn btn-primary open_loading">ENTRAR</a>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="modal_sair_temporada">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Sair dessa temporada</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <h3>Quero sair da temporada <b>{{ $temporada->nome }}</b></h3>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">FECHAR</button>
                <a href="/temporadas/{{ $temporada->id }}/sair/temporada" class="btn btn-danger">SAIR</a>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="modal_pesquisa_usuario">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Pesquisar um Jogador</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-8 col-md-9">
                        <div class="form-group">
                            <input id="input_pesquisa_usuario" type="text" class="form-control" name="pesquisa_usuario" placeholder="NOME DO JOGADOR">
                        </div>
                    </div>

                    <div class="col-xs-4 col-md-3">
                        <div class="hidden-xs">
                            <button id="btn_pesquisa_usuario" type="button" class="btn btn-primary btn-block"><i class="fa fa-search" aria-hidden="true"></i> PESQUISAR</button>
                        </div>
                        <div class="hidden-sm hidden-md hidden-lg">
                            <button id="btn_pesquisa_usuario" type="button" class="btn btn-primary btn-block"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </div>

                <div id="ajax_load_usuario"></div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">FECHAR</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@if (!$temporada->temporada_divisao()->get()->isEmpty())

@foreach($temporada->temporada_divisao()->get() AS $temporada_divisao)

<div class="panel panel-default no-padding">
    <div class="panel-body">
        <a href="/temporadas/{{ $temporada->id }}/{{ str_slug($temporada->nome, '-') }}/divisao/{{ $temporada_divisao->divisao->id }}" style="text-decoration: none" class="open_loading">
            <div class="panel-body text-center  vertical-align">
                <i class="fa fa-list fa-2x" aria-hidden="true" style="margin-right: 15px"></i> <h4>{{ $temporada_divisao->divisao->nome }}</h4>
            </div>
        </a>
    </div>
</div>

@endforeach

@endif

<br />

@if (Auth::user()->id === $temporada->usuario_id)

<div class="row">
    <div class="col-lg-12">
        Lista de Jogadores sem Divisão
    </div>

    @if ($lista_temporada_usuario->isEmpty())
    <div class="col-lg-12">
        <div class="panel panel-default no-padding">
            <div class="panel-body">
                <h5>NENHUM JOGADOR</h5>
            </div>
        </div>
    </div>
    @else

    @foreach($lista_temporada_usuario as $temporada_usuario)
    <div class="col-lg-12">
        <div class="panel panel-default no-padding">
            <div class="panel-body">
                <div class="row vertical-align">
                    <div class="col-xs-2 col-md-1">
                        <img src='{{ $temporada_usuario->usuario->avatar }}' class="img-responsive img-rounded" style="width: 40px"/>
                    </div>

                    <div class="col-xs-7 col-md-10">
                        <h4>{{ $temporada_usuario->usuario->nome }}</h4>
                    </div>

                    <div class="col-xs-3 col-md-1">

                        <div class="btn-group">
                            <button class="btn btn-default btn-md dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-cog" aria-hidden="true"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li style="padding: 5px">Adicionar Para:</li>
                                <li role="separator" class="divider"></li>
                                @if (!$temporada->temporada_divisao()->get()->isEmpty())

                                @foreach($temporada->temporada_divisao()->get() AS $temporada_divisao)

                                <li><a href="#" data-toggle="modal" data-target="#modal_adicionar_divisao{{ $temporada_divisao->divisao->id }}_u{{ $temporada_usuario->usuario->id }}">{{ $temporada_divisao->divisao->nome }}</a></li>
                                <li role="separator" class="divider"></li>

                                @endforeach

                                @endif
                            </ul>
                        </div>

                        @if (!$temporada->temporada_divisao()->get()->isEmpty())

                        @foreach($temporada->temporada_divisao()->get() AS $temporada_divisao)

                        <div class="modal fade" role="dialog" id="modal_adicionar_divisao{{ $temporada_divisao->divisao->id }}_u{{ $temporada_usuario->usuario->id }}">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">Definir uma Divisão</h4>
                                    </div>

                                    <div class="modal-body">
                                        <h3>{{ $temporada->nome }}</h3>
                                        <h4>Adicionar <b>{{ $temporada_usuario->usuario->nome }}</b> para <b>{{ $temporada_divisao->divisao->nome }}</b></h4>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">FECHAR</button>
                                        <a href="/temporadas/add_para_divisao/{{ $temporada_divisao->id }}/usuario/{{ $temporada_usuario->usuario->id }}" class="btn btn-success open_loading">ADICIONAR</a>
                                    </div>

                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                        @endforeach

                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
    @endforeach
    @endif
</div>
@endif

@section('script-add')
<script type="text/javascript">
    function pesquisa_usuario() {
        $.ajax({
        type: "GET",
                url: '{{URL::to("temporadas/ajax/get_lista_usuario")}}',
                data: {nome_usuario: $('#input_pesquisa_usuario').val(), temporada_id: {{ $temporada->id }} }
        }).done(function (data) {
        }).fail(function (data) {
            alert('FAIL');
        }).always(function (data) {
            $('#ajax_load_usuario').html(data);
        });
    }

    $(document).ready(function () {
        $('#input_pesquisa_usuario').keyup(function (e) {
            e.preventDefault();
            pesquisa_usuario();
        });
    });

</script>
@endsection

@endsection
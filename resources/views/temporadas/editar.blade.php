@extends ('layouts.master')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h6>EDITAR UMA TEMPORADA</h6>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">

        <div class="panel panel-default">
            <div class="panel-body">
                <h6>Configurações</h6>
                <hr />
                <form method="POST" action="/temporadas/{{ $temporada->id }}/editar">

                    {{ csrf_field() }}

                    {{ method_field('PATCH') }}

                    <div class="form-group">
                        <label for="nome">Nome da Temporada</label>
                        <input type="text" class="form-control" id="nome" name="nome" value="{{ $temporada->nome }}">
                    </div>

                    <label>Tipo de Temporada</label>

                    <div class="btn-group btn-block" data-toggle="buttons">
                        <label class="btn btn-warning {{ $temporada->publica === TRUE ? 'active' : '' }}" title="Todos os jogadores poderam ver e solicitar convite para participar desta temporada">
                            <input type="radio" name="opcoes_publica" id="opcao_1" autocomplete="off" value="publica" {{ $temporada->publica === TRUE ? 'checked' : '' }}><i class="fa fa-unlock" aria-hidden="true"></i> Pública
                        </label>

                        <label class="btn btn-warning {{ $temporada->publica === FALSE ? 'active' : '' }}" title="Apenas jogadores convidados poderão participar desta temporada">
                            <input type="radio" name="opcoes_publica" id="opcao_2" autocomplete="off" value="nao_publica" {{ $temporada->publica === FALSE ? 'checked' : '' }}><i class="fa fa-lock" aria-hidden="true"></i> Privada
                        </label>
                    </div>

                    <hr />

                    <div class="form-group">
                        <div class="row hidden-xs">
                            <div class="col-lg-9">
                                <button class="btn btn-success open_loading">ATUALIZAR</button>
                                <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#modal_delete">EXCLUIR</a>
                            </div>
                            <div class="col-lg-3">
                                <a href="#" class="btn btn-danger btn-block" data-toggle="modal" data-target="#modal_terminar_temporada">TERMINAR TEMPORADA</a>
                            </div>
                        </div>
                        
                        <div class="row hidden-sm hidden-md hidden-lg">
                            <div class="col-xs-6">
                                <button class="btn btn-success open_loading btn-block">ATUALIZAR</button>
                            </div>
                            <div class="col-xs-6">
                                <a href="#" class="btn btn-danger btn-block" data-toggle="modal" data-target="#modal_delete">EXCLUIR</a>
                            </div>
                            <hr />
                            <br />
                            <div class="col-xs-12">
                                <a href="#" class="btn btn-danger btn-block" data-toggle="modal" data-target="#modal_terminar_temporada">TERMINAR TEMPORADA</a>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="modal fade" tabindex="-1" role="dialog" id="modal_delete">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Excluir Temporada</h4>
                            </div>

                            <div class="modal-body">
                                <p><b><h4>Deseja realmente excluir esta temporada?</h4></b></p>

                                <p><h3>{{ $temporada->nome }}</h3></p>

                                <p style="color: red">Atenção: Todos os dados serão perdidos e não poderão ser recuperados!</p>
                            </div>

                            <div class="modal-footer">

                                <form method="POST" action="/temporadas/{{ $temporada->id }}/excluir" class="hidden" id="delete_form">

                                    {{ csrf_field() }}

                                    {{ method_field('PATCH') }}

                                </form>

                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-danger" form="delete_form">Excluir</button>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                
                <div class="modal fade" tabindex="-1" role="dialog" id="modal_terminar_temporada">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Terminar Temporada</h4>
                            </div>

                            <div class="modal-body">
                                <p><b><h4>Deseja realmente terminar esta temporada?</h4></b></p>

                                <p><h3>{{ $temporada->nome }}</h3></p>

                                <p style="color: red">Atenção: Temporada não poderá ser reaberta após seu término!</p>
                            </div>

                            <div class="modal-footer">

                                <form method="POST" action="/temporadas/{{ $temporada->id }}/terminar" class="hidden" id="terminar_form">

                                    {{ csrf_field() }}

                                    {{ method_field('PATCH') }}

                                </form>

                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-danger" form="delete_form">Terminar Temporada</button>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
            </div>
        </div>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-body">
        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal_add_divisao"><i class="fa fa-plus" aria-hidden="true"></i> Adicionar uma Divisão</a>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modal_add_divisao">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Adicionar uma Divisão a Temporada <b>{{ $temporada->nome }}</b></h4>
                </div>
                              
                <form method="POST" action="/temporadas/{{ $temporada->id }}/adicionar_divisao">

                    {{ csrf_field() }}

                    {{ method_field('POST') }}

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="rodadas">Nível</label>
                            <select class="form-control" name="divisao">
                                @foreach($lista_divisao AS $divisao)
                                <option value="{{ $divisao->id }}">{{ $divisao->nome }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="rodadas">Quantidade de Rodadas</label>
                            <input type="text" class="form-control" id="rodadas" name="rodadas">
                        </div>

                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn btn-default" data-dismiss="modal">CANCELAR</button>
                        <button type="submit" class="btn btn-primary">CRIAR</button>

                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>

@if (!$temporada->temporada_divisao()->get()->isEmpty())

@foreach($temporada->temporada_divisao()->get() AS $temporada_divisao)

<div class="panel panel-default">
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

@endsection
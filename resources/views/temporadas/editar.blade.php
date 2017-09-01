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
                <h6>Configurações da Temporada</h6>
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
                        <button class="btn btn-primary">Atualizar</button>
                        <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#modal_delete">Excluir</a>
                        <a href="{{ URL::previous() }}" style="margin-left: 20px">Voltar</a>
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

                                    {{ method_field('DELETE') }}
                                    
                                </form>
                                
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-danger" form="delete_form">Excluir</button>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
            </div>
        </div>
    </div>
</div>

@endsection
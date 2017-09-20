@extends ('layouts.master')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h3><b>MENSAGENS</b></h3>
    </div>
</div>

<div class="row">

    @if (!$lista_mensagem->isEmpty())

    @foreach($lista_mensagem as $mensagem)

    <div class="col-lg-12">
        <div class="panel panel-default no-padding">
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-3 col-md-1 no-padding">
                        <img src='{{ $mensagem->do_usuario->avatar }}' class="img-responsive" style="width: 50px">
                    </div>

                    <div class="col-xs-9 col-md-8 no-padding vertical-align">
                        <div class="row">
                            <div class="col-lg-12 no-padding ">
                                <h5 class="no-padding">
                                    <b><a href="/perfil">{{ $mensagem->do_usuario->nome }}</a></b>
                                    {{ $mensagem->descricao }}
                                </h5>
                            </div>
                            <div class="col-lg-12 no-padding">
                                <h6>{{ $mensagem->created_at->diffForHumans() }}</h6>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-3 no-padding">

                        @if ($mensagem->convite->aceito === null)
                        <div class="btn-group btn-group-justified" role="group" aria-label="...">
                            @if ($mensagem->convite->temporada !== null)
                            <a href="/temporadas/{{ $mensagem->convite->temporada->id }}/status_convite/{{ $mensagem->id }}/aceito" class="btn btn-success open_loading">Aceitar</a>
                            <a href="/temporadas/{{ $mensagem->convite->temporada->id }}/status_convite/{{ $mensagem->id }}/rejeitado" class="btn btn-danger open_loading">Rejeitar</a>
                            @else
                            <a href="/ligas/request_accepted" class="btn btn-success open_loading">Aceitar</a>
                            <a href="/ligas/request_denied" class="btn btn-danger open_loading">Rejeitar</a>
                            @endif

                        </div>
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </div>

    @endforeach

    @else
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body vertical-align">
                <i class="fa fa-frown-o fa-4x" aria-hidden="true" style="margin-right: 15px"></i>
                <h3><b>Opa! Não tenho nenhuma mensagem.</b></h3>
            </div>
        </div>
    </div>
    @endif
</div>


@endsection
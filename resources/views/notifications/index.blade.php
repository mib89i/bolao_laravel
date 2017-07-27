@extends ('layouts.master')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h3><b>MENSAGENS</b></h3>
    </div>
</div>

<div class="row">

    @if (!$notifications->isEmpty())

    @foreach($notifications as $notification)

    <div class="col-lg-12">
        <div class="panel panel-default no-padding">
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-3 col-md-1 no-padding">
                        <img src='{{ $notification->from_user->avatar }}' class="img-responsive" style="width: 50px">
                    </div>

                    <div class="col-xs-9 col-md-8 no-padding vertical-align">
                        <div class="row">
                            <div class="col-lg-12 no-padding ">
                                <h5 class="no-padding">
                                    <b><a href="/profile">{{ $notification->from_user->name }}</a></b>
                                    {{ $notification->description }}
                                </h5>
                            </div>
                            <div class="col-lg-12 no-padding">
                                <h6>{{ $notification->created_at->diffForHumans() }}</h6>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-3 no-padding">
                        @if ($notification->temporada_usuario != NULL and $notification->temporada_usuario->aceito == FALSE)
                        <div class="btn-group btn-group-justified" role="group" aria-label="...">
                            <a href="/temporadas/{{ $notification->temporada_usuario->id }}/request_accepted" class="btn btn-default">Aceitar</a>
                            <a href="/temporadas/{{ $notification->temporada_usuario->id }}/request_denied" class="btn btn-danger">Rejeitar</a>
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
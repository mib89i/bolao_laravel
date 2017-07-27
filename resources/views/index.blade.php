@extends ('layouts.master')

@section('content')

@if (!Auth::check())
<div class="row" style="text-align: center; margin: 0 auto">
    <div class="col-lg-12">

        <a href="login/facebook" class="btn btn-primary btn-lg">
            <div class="vertical-align">
                <i class="fa fa-facebook-square fa-2x" aria-hidden="true" style="margin-right: 15px"></i> Entrar com Facebook
            </div>
        </a>

    </div>
</div>

@else

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default no-padding">
            <a href="/seasons" style="text-decoration: none">
                <div class="panel-body vertical-align">
                    <i class="fa fa-search" aria-hidden="true" style="margin-right: 15px"></i>
                    <h5><b>ENCONTRAR UMA TEMPORADA</b></h5>
                </div>
            </a>
        </div>
    </div>
</div>

<h3><b>MEUS JOGOS</b></h3>

@if (!$season_users->isEmpty())

<div class="row">
    <div class="col-lg-12">
        <h6>TEMPORADAS EM ANDAMENTO</h6>
    </div>
</div>

<div class="row">
    @foreach($season_users as $season_user)

    <div class="col-lg-12">
        <div class="panel panel-default no-padding">
            <div class="row">
                <div class="col-xs-9 col-md-11">
                    <a href="/seasons/{{ $season_user->temporada->id }}" style="text-decoration: none">
                        <div class="panel-body vertical-align">
                            <i class="fa fa-list" aria-hidden="true" style="margin-right: 15px"></i>
                            <h5><b>{{ $season_user->temporada->nome }}</b></h5>
                        </div>
                    </a>
                </div>

                <div class="col-xs-3 col-md-1">
                    @if (Auth::user()->id === $season_user->temporada->usuario_id)
                    <a href="/seasons/{{ $season_user->temporada->id }}/edit" style="text-decoration: none">
                        <div class="panel-body text-center  vertical-align">
                            <i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i>
                        </div>
                    </a>
                    @endif
                </div>
            </div>

        </div>
    </div>

    @endforeach
</div>

@endif
<div class="row">
    <div class="col-lg-12">
        <hr />
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <a href="/seasons/create" style="text-decoration: none">
                <div class="panel-body vertical-align">
                    <span class="fa fa-plus-square-o fa-4x fa-fw" aria-hidden="true"></span>
                    <h5><b>CRIAR TEMPORADA</b></h5>
                </div>
            </a>    
        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <a href="/seasons/create" style="text-decoration: none">
                <div class="panel-body vertical-align">
                    <span class="fa fa-plus-square-o fa-4x fa-fw" aria-hidden="true"></span>
                    <h5><b>CRIAR COPA</b></h5>
                </div>
            </a>    
        </div>
    </div>
</div>


@endif

@endsection
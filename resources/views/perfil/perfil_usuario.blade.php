@extends ('layouts.master')

@section('content')    

<div class="panel panel-default ">
    <div class="panel-body">
        <div class="row vertical-align">
            <div class="col-xs-3 col-sm-2 col-md-1">
                <img src='{{ $usuario->avatar }}' class="img-responsive img-rounded" />
            </div>
            
            <div class="col-xs-9 col-sm-10 col-md-11">
                <h3><a href="/perfil/{{ $usuario->id }}/{{ str_slug($usuario->nome, '-') }}">{{ $usuario->nome }}</a></h3>
            </div>
        </div>
    </div>
</div>

@endsection
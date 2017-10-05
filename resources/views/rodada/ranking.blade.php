@extends ('layouts.master')

@section('content')
<div class="panel panel-default">
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h3><b>{{ $rodada->nome }}</b></h3>
                <h4>{{ $rodada->temporada->nome }}</h4>
            </div>
        </div>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-body">
        <div class="row">
            @if ($lista_melhores != null)
            <div class="col-lg-12">
                <h5>20 MELHORES</h5>
            </div>

            @foreach($lista_melhores as $melhores)
            <div class="col-lg-12">

                <div class="row">

                    <div class="col-xs-4 col-lg-2">
                        <img src='{{ $melhores->avatar }}' class="img-responsive img-rounded">
                    </div>

                    <div class="col-xs-6 col-lg-8">
                        <h4><b><a href="/perfil/{{ $melhores->id }}/{{ str_slug($melhores->nome, '-') }}">{{ $melhores->nome }}</a></b></h4>
                        <h3>{{ $melhores->pontos }} pts</h3>
                        <a href="/rodada/{{ $rodada->id }}/palpites/{{ $melhores->id  }}">VER PALPITES</a>
                    </div>

                    <div class="col-xs-2 col-lg-2 text-right">
                        <h3><b>{{ $melhores->rank }}°</b></h3>
                    </div>

                </div>
                <hr />
            </div>
            @endforeach
            @endif
        </div>
    </div>
</div>
@endsection
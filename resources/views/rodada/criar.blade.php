@extends ('layouts.master')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h3><b>CRIAR RODADA DE JOGOS</b></h3>
    </div>
</div>



@if(!$lista_temporada->isEmpty())
<div class="row">
    <div class="col-lg-12">
        <h5><b>SELECIONE UMA TEMPORADA</b></h5>
    </div>
</div>

<div class="row">
    @foreach($lista_temporada as $temporada)

    <div class="col-lg-12">
        <div class="panel panel-default no-padding">
            <div class="row">
                <div class="col-xs-9 col-md-11">
                    <a href="/rodada/criar/t/{{ $temporada->id }}" style="text-decoration: none">
                        <div class="panel-body">
                            <div class="vertical-align">
                                @if($temporada->publica === TRUE)
                                <i class="fa fa-unlock fa-2x" aria-hidden="true" style="color: black; margin-right: 10px"></i>
                                @else
                                <i class="fa fa-lock fa-2x" aria-hidden="true" style="color: red; margin-right: 10px"></i>
                                @endif
                                <i class="fa fa-list" aria-hidden="true" style="margin-right: 15px"></i>
                                <h4><b>{{ $temporada->nome }}</b></h4>
                            </div>
                            
                            <div class="vertical-align">
                                <h6 style="color: black">Presidente: <b>{{ $temporada->usuario->nome }}</b></h6>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xs-3 col-md-1">
                    @if (Auth::user()->id === $temporada->usuario_id)
                    <a href="/temporadas/{{ $temporada->id }}/editar" style="text-decoration: none">
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
@else
<div class="row">
    <div class="col-lg-12">
        <h5><b>VOCÊ AINDA NÃO CRIOU NENHUMA TEMPORADA</b></h5>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <a href="/temporadas/criar" style="text-decoration: none; color: black">
                <div class="panel-body vertical-align">
                    <span class="fa fa-plus-square-o fa-4x fa-fw" aria-hidden="true"></span>
                    <h5><b>CRIAR TEMPORADA</b></h5>
                </div>
            </a>    
        </div>
    </div>
</div>
@endif


@endsection
@extends ('layouts.master')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h6>PESQUISAR UMA TEMPORADA</h6>
    </div>
</div>

<form method="POST" action="/temporadas">
    {{ csrf_field() }}
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-10">
                        <input type="text" class="form-control" id="search" placeholder="DIGITE O NOME DA TEMPORADA" name="search" autocomplete="off" autofocus/>
                    </div>

                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary">PESQUISAR</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@if(isset($temporadas))

<div class="row">
    @foreach($temporadas as $temporada)

    <div class="col-lg-12">
        <div class="panel panel-default no-padding">
            <div class="row">
                <div class="col-xs-9 col-md-11">
                    <a href="/temporadas/{{ $temporada->id }}" style="text-decoration: none">
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
@endif

@endsection
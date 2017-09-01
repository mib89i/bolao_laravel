@extends ('layouts.master')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h6>PESQUISAR UMA TEMPORADA</h6>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        
        <div class="panel panel-default">
            <div class="panel-body">

                <form method="POST" action="/temporadas">

                    {{ csrf_field() }}
                    
                    <div class="form-group">
                        <label for="title">Pesquisar Temporadas</label>
                        <input type="text" class="form-control input-lg" id="search" name="search" autofocus/>
                    </div>
                    
                    <button class="btn btn-default btn-lg"><b>PESQUISAR<br /></button>
                </form>
                
            </div>
        </div>
    </div>
</div>

@if(isset($temporadas))

<div class="row">
    @foreach($temporadas as $temporada)

    <div class="col-lg-12">
        <div class="panel panel-default no-padding">
            <div class="row">
                <div class="col-xs-10 col-md-11">
                    <a href="/temporadas/{{ $temporada->id }}" style="text-decoration: none">
                        <div class="panel-body vertical-align">
                            <i class="fa fa-list" aria-hidden="true" style="margin-right: 15px"></i>
                            <h5><b>{{ $temporada->nome }}</b></h5>
                        </div>
                    </a>
                </div>

                <div class="col-xs-2 col-md-1">
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
<div class="row">
    @foreach($lista_usuario as $usuario)
    <div class="col-lg-12">
        <div class="row vertical-align">
            <div class="col-xs-2 col-md-1">
                <img src='{{ $usuario->avatar }}' class="img-rounded" style="width: 40px"/>
            </div>
            
            <div class="col-xs-7 col-md-9">
                <h4>{{ $usuario->nome }}</h4>
            </div>
            
            <div class="col-xs-3 col-md-2">
                <a href="/convites/t/{{ $temporada->id }}/tipo/convidando/{{ $usuario->id }}" class="btn btn-success btn-xs btn-block">Convidar</a>
            </div>
        </div>
        <hr />
    </div>
    @endforeach
</div>

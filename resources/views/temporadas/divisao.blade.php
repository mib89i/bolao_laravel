@extends ('layouts.master')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h3><b>RANKING</b></h3>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        
                        <h3>{{ $temporada_divisao->divisao->nome }}</h3>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="row">

    @if (!empty($ranking))
        @if (isset($my_rank))
        <div class="col-lg-12">
            <div class="panel panel-default no-padding" style="border-color: gray; border-width: 4px">
                <div class="panel-body">

                    <div class="row">

                        <div class="col-xs-3 col-md-1">
                            <img src='{{ $my_rank->avatar }}' class="img-responsive img-circle">
                        </div>

                        <div class="col-xs-6 col-md-9">
                            <h4><b><a href="/perfil/{{ $my_rank->id }}/{{ str_slug($my_rank->nome, '-') }}">{{ $my_rank->nome }}</a></b></h4>
                            <h3>{{ $my_rank->pontos }} pts</h3>
                        </div>

                        <div class="col-xs-3 col-md-2 text-right">
                            @if ($my_rank->variacao == 0)
                            <h3><b>{{ $my_rank->rank }}°</b></h3>
                            @elseif ($my_rank->variacao > 0)
                            <h3><i class="fa fa-arrow-up" aria-hidden="true" style="color: #5ce936"></i><b>{{ $my_rank->rank }}°</b></h3>
                            @else
                            <h3><i class="fa fa-arrow-down" aria-hidden="true" style="color: red"></i><b>{{ $my_rank->rank }}°</b></h3>
                            @endif
                        </div>

                    </div>

                </div>
            </div>
            <hr style="border-color: black; border-width: 2px 0;" />
        </div>
        @endif

        @foreach($ranking as $rank)
        <div class="col-lg-12">
            <div class="panel panel-default no-padding">
                <div class="panel-body">

                    <div class="row">

                        <div class="col-xs-3 col-md-1">
                            <img src='{{ $rank->avatar }}' class="img-responsive img-circle">
                        </div>

                        <div class="col-xs-6 col-md-9">
                            <h4><b><a href="/perfil/{{ $rank->id }}/{{ str_slug($rank->nome, '-') }}">{{ $rank->nome }}</a></b></h4>
                            <h3>{{ $rank->pontos }} pts</h3>
                        </div>

                        <div class="col-xs-3 col-md-2 text-right">
                            @if ($rank->variacao == 0)
                            <h3><b>{{ $rank->rank }}°</b></h3>
                            @elseif ($rank->variacao > 0)
                            <h3><i class="fa fa-arrow-up" aria-hidden="true" style="color: #5ce936"></i><b>{{ $rank->rank }}°</b></h3>
                            @else
                            <h3><i class="fa fa-arrow-down" aria-hidden="true" style="color: red"></i><b>{{ $rank->rank }}°</b></h3>
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
            <div class="panel-body">
                <h4>NENHUM JOGADOR ADICIONADO PARA ESTA DIVISÃO</h4>
            </div>
        </div>
    </div>
    @endif
</div>

@endsection
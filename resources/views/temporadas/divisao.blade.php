@extends ('layouts.master')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row vertical-align">
                    <div class="col-xs-12">
                        <h3>{{ $temporada->nome }}</h3>

                        <h4>{{ $temporada_divisao->nome }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<h3><b>RANKING</b></h3>

<div class="row">
    @if (isset($my_rank))
    <div class="col-lg-12">
        <div class="panel panel-default no-padding" style="border-color: gray; border-width: 4px">
            <div class="panel-body">

                <div class="row">

                    <div class="col-xs-3 col-md-1">
                        <img src='{{ $my_rank->avatar }}' class="img-responsive img-circle">
                    </div>

                    <div class="col-xs-6 col-md-9">
                        <h4><b><a href="#">{{ $my_rank->nome }}</a></b></h4>
                        <h3>870 pts</h3>
                    </div>

                    <div class="col-xs-3 col-md-2 text-right">
                        <h3><i class="fa fa-arrow-up" aria-hidden="true" style="color: #5ce936"></i><b>{{ $my_rank->rank }}°</b></h3>
                    </div>

                </div>

            </div>
        </div>
        <hr />
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
                        <h4><b><a href="#">{{ $rank->nome }}</a></b></h4>
                        <h3>870 pts</h3>
                    </div>

                    <div class="col-xs-3 col-md-2 text-right">
                        <h3><i class="fa fa-arrow-down" aria-hidden="true" style="color: red"></i><b>{{ $rank->rank }}°</b></h3>
                    </div>

                </div>

            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection
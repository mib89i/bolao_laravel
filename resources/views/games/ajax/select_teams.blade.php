<div class="row">
    <div class="col-xs-5">
        <h5><b>Time Casa</b></h5>
        @if ($team1 === NULL)
        <a href="#" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modal_team_home">
            <i class="fa fa-users" aria-hidden="true"></i>
            <b>TIME</b>
        </a>
        @else

        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-2">
                        <img src='{{ Auth::user()->avatar }}' class="img-responsive img-rounded" />
                    </div>
                    <div class="col-xs-10">
                        <h4>{{ $team1->name }}</h4>
                    </div>
                </div>

            </div>
        </div>

        @endif
    </div>
    <div class="col-xs-2 text-center" style="margin-top: 40px"><b>X</b></div>
        <div class="col-xs-5">
        <h5><b>Time Visitante</b></h5>
        @if ($team2 === NULL)
        <a href="#" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modal_team_visitor">
            <i class="fa fa-users" aria-hidden="true"></i>
            <b>TIME</b>
        </a>
        @else

        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-2">
                        <img src='{{ Auth::user()->avatar }}' class="img-responsive img-rounded" />
                    </div>
                    <div class="col-xs-10">
                        <h4>{{ $team2->name }}</h4>
                    </div>
                </div>

            </div>
        </div>

        @endif
    </div>
</div>
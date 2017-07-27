<div class="row">


    @foreach($teams as $team)
    <div class="col-lg-12">

        <div class="panel panel-default" style="border-color: gray; border-width: 2px">
            @if ($type_team == 1)
            <a onclick="get_select_teams({{ $team->id }}, null)" href="#" style="color: black; text-decoration: none" data-dismiss="modal">
            @else
            <a onclick="get_select_teams(null, {{ $team->id }})" href="#" style="color: black; text-decoration: none" data-dismiss="modal">
            @endif
                <div class="panel-body">
                    <div class="row vertical-align">
                        <div class="col-xs-2">
                            <img src='{{ Auth::user()->avatar }}' class="img-responsive img-rounded" />
                        </div>
                        <div class="col-xs-10">
                            <h3>{{ $team->name }}</h3>
                        </div>
                    </div>

                </div>
            </a>
        </div>
    </div>
    @endforeach
</div>

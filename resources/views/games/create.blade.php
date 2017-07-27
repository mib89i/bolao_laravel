@extends ('layouts.master')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h3><b>JOGOS DO BOLÃO</b></h3>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12 vertical-align">
                <h3><a href="/temporadas/{{ $temporada->id }}" style="color: black">{{ $temporada->nome }}</a><i class="fa fa-pencil-square-o" aria-hidden="true" style="margin-left: 10px"></i></h3>
            </div>
            <div class="col-lg-12">
                <h4 style="color: red"><b>Rodada {{ $round_game }}</b></h4>
            </div>
        </div>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-body">
        <form method="POST" action="/games/s/{{ $temporada->id }}/criar">

            {{ csrf_field() }}                    

            <div class="row">
                <div class="col-xs-12 col-md-7">
                    <div class="form-group">
                        <label for="place">Local do Jogo</label>
                        <input type="text" class="form-control" id="place" name="place" placeholder="Em que estádio vai ser a partida">
                    </div>
                </div>

                <div class="col-xs-6 col-md-2">
                    <div class="form-group">
                        <label for="date">Data</label>
                        <input type="text" class="form-control mask_date text-center" id="date" name="date" placeholder="Data">
                    </div>
                </div>

                <div class="col-xs-3 col-md-1 no-padding">
                    <div class="form-group">
                        <label for="hour">Hora</label>
                        <input type="text" class="form-control mask_hour text-center" id="hour" name="hour" placeholder="Hora">
                    </div>
                </div>

                <div class="col-xs-3 col-md-2">
                    <div class="form-group">
                        <label for="importance">Rel (x2)</label>
                        <input type="text" class="form-control text-center" id="importance" name="importance" placeholder="( x2 )" value="1">
                    </div>
                </div>
            </div>

            <div id="ajax_load_select_teams"></div>

            <hr />

            <div class="row">
                <div class="col-lg-12">

                    <button type="submit" class="btn btn-default"><i class="fa fa-plus" aria-hidden="true" style="margin-right: 10px"></i>Adicionar Jogo</button>

                </div>
            </div>
        </form>

        <div class="modal fade" id="modal_team_home" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"><b>PESQUISAR TIME DA CASA</b></h4>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xs-8 col-md-9">
                                <div class="form-group">
                                    <input id="search_team1_input" type="text" class="form-control" name="search_team" placeholder="NOME DO TIME">
                                </div>
                            </div>

                            <div class="col-xs-4 col-md-3">
                                <button id="search_team1" type="button" class="btn btn-default btn-block">Pesquisar</button>
                            </div>
                        </div>

                        <div id="ajax_load_teams1"></div>

                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="modal_team_visitor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"><b>PESQUISAR TIME VISITANTE</b></h4>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xs-8 col-md-9">
                                <div class="form-group">
                                    <input id="search_team2_input" type="text" class="form-control" name="search_team" placeholder="NOME DO TIME">
                                </div>
                            </div>

                            <div class="col-xs-4 col-md-3">
                                <button id="search_team2" type="button" class="btn btn-default btn-block">Pesquisar</button>
                            </div>
                        </div>

                        <div id="ajax_load_teams2"></div>

                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('script-add')

<script type="text/javascript">
    function search_team1() {
        $.ajax({
            type: "GET",
            url: '{{URL::to("games/ajax/get_list_teams")}}',
            data: {search_params: $('#search_team1_input').val(), team_params: 1}
        }).done(function (data) {
        }).fail(function (data) {
            alert('FAIL');
        }).always(function (data) {
            $('#ajax_load_teams1').html(data);
        });
    }
    
    function search_team2() {
        $.ajax({
            type: "GET",
            url: '{{URL::to("games/ajax/get_list_teams")}}',
            data: {search_params: $('#search_team2_input').val(), team_params: 2}
        }).done(function (data) {
        }).fail(function (data) {
            alert('FAIL');
        }).always(function (data) {
            $('#ajax_load_teams2').html(data);
        });
    }

    function get_select_teams(team1_idx, team2_idx) {
        $.ajax({
            type: "GET",
            url: '{{URL::to("games/ajax/get_select_teams")}}',
            data: {team1_id : team1_idx, team2_id : team2_idx}
        }).done(function (data) {
        }).fail(function (data) {
            alert('FAIL');
        }).always(function (data) {
            $('#ajax_load_select_teams').html(data);
        });
    }

    $(document).ready(function () {

        $('#search_team1').click(function (e) {
            e.preventDefault();
            search_team1();
        });
        
        $('#search_team2').click(function (e) {
            e.preventDefault();
            search_team2();
        });

        $('#search_team1_input').keyup(function (e) {
            e.preventDefault();
            search_team1();
        });
        
        $('#search_team2_input').keyup(function (e) {
            e.preventDefault();
            search_team2();
        });

        get_select_teams();

    });
</script>
<!--
VIA POST FUNCIONA, OLHAR EM web ( routes )
<script type="text/javascript">
    $(document).ready(function () {

        $('#search_team').click(function (e) {

            $.ajax({
                type: "POST",
                url: '{{URL::to("games/search_team")}}',
                data: {param_search: $('#search_team_input').val(), _token: '{{ csrf_token() }}'}
            }).done(function (data) {
                alert(data.data);
            }).fail(function (data) {
                alert('FAIL');
            }).always(function (data) {

            });

        });
    });
</script>
-->

@endsection

@endsection

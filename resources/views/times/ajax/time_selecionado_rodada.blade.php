<div class="row vertical-align">
    <div class="col-xs-5">
        <div class="form-group">
            <label for="input_time1">Time 1</label><br />
            @if(!Session::has('time1_selecionado'))
            <a href="#" class="btn btn-success btn-block" data-toggle="modal" data-target="#modal_pesquisa_time">CASA</a>
            @else
            <div class="row">
                <div class="col-xs-5 col-sm-2">
                    <img src='{{ Session::get('time1_selecionado')->logo }}' class="img-responsive"/>
                </div>

                <div class="col-xs-7 col-sm-10">
                    <div class="hidden-xs">
                        <h4><label data-toggle="modal" data-target="#modal_pesquisa_time">{{ Session::get('time1_selecionado')->nome }}</label></h4>
                    </div>
                    <div class="hidden-sm hidden-md hidden-lg">
                        <h4><label data-toggle="modal" data-target="#modal_pesquisa_time">{{ Session::get('time1_selecionado')->sigla }}</label></h4>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

    <div class="col-xs-2 text-center">
        <label style="font-weight: bold">X</label>
    </div>

    <div class="col-xs-5">
        <div class="form-group">
            <label for="input_time2">Time 2</label>
            @if(!Session::has('time2_selecionado'))
            <a href="#" class="btn btn-success btn-block" data-toggle="modal" data-target="#modal_pesquisa_time2">VISITANTE</a>
            @else
            <div class="row">
                <div class="col-xs-7 col-sm-10 text-right">
                    <div class="hidden-xs">
                        <h4><label data-toggle="modal" data-target="#modal_pesquisa_time2">{{ Session::get('time2_selecionado')->nome }}</label></h4>
                    </div>
                    <div class="hidden-sm hidden-md hidden-lg">
                        <h4><label data-toggle="modal" data-target="#modal_pesquisa_time2">{{ Session::get('time2_selecionado')->sigla }}</label></h4>
                    </div>
                </div>

                <div class="col-xs-5 col-sm-2">
                    <img src='{{ Session::get('time2_selecionado')->logo }}' class="img-responsive"/>
                </div>
            </div>
            @endif                                
        </div>
    </div>
</div>
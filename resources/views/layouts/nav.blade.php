@if (Auth::check())

<!-- Fixed navbar -->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            
            <a class="navbar-brand open_loading" href="/"><i class="fa fa-futbol-o" aria-hidden="true"></i> BOLÃO</a>
            @if(Request::path() == '/')
            @else
            @endif
            
        </div>

        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                @if (Auth::user()->admin)
                <li><a href="/rodada" class="open_loading"><i class="fa fa-plus-circle" aria-hidden="true" style="margin-right: 10px"></i>CRIAR RODADA</a></li>
                @endif
                <li><a href="/" class="open_loading"><i class="fa fa-list-ol" aria-hidden="true" style="margin-right: 10px"></i>TEMPORADAS</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                @if (Auth::check())
                <li><a href="/perfil/{{ Auth::user()->id }}/{{ str_slug(Auth::user()->nome, '-') }}" class="open_loading"><i class="fa fa-user-circle" aria-hidden="true" style="margin-right: 10px"></i>PERFIL</a></li>
                <li>
                    <a href="/mensagens" class="open_loading"><i class="fa fa-envelope-o" aria-hidden="true" style="margin-right: 10px"></i> MENSAGENS 
                        @if($quantidade_mensagem > 0)
                        <span class="badge">{{ $quantidade_mensagem }}</span>
                        @endif
                    </a>
                </li>
                <li>
                    <a href="/logout" class="open_loading">
                        SAIR
                    </a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

@endif
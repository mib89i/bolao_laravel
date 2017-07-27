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
            <a class="navbar-brand" href="/">BOLÃO</a>
        </div>

        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <!-- <li class="active"><a href="#">Home</a></li> -->
            </ul>

            <ul class="nav navbar-nav navbar-right">
                @if (Auth::check())
                <li>
                    <img src='{{ Auth::user()->avatar }}' class="img-responsive" style="width: 45px" />
                </li>

                <li>
                    <a href="/">
                        {{ Auth::user()->name }}
                    </a>
                </li>
                <li>
                    <a href="/notifications">Mensagens 
                        @if($notification_count > 0)
                        <span class="badge">{{ $notification_count }}</span>
                        @endif
                    </a>
                </li>
                <li>
                    <a href="/logout">
                        Sair
                    </a>
                </li>
                @endif
            </ul>
        </div>

    </div>
</nav>

@endif
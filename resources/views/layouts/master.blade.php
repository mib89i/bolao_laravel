<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <meta name="description" content="">

        <meta name="author" content="">

        <link rel="icon" href="https://s3-sa-east-1.amazonaws.com/bolaolaravel/logobolao.png">

        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous" />-->

        <!-- <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/flatly/bootstrap.min.css" rel="stylesheet" integrity="sha384-+ENW/yibaokMnme+vBLnHMphUYxHs34h9lpdbSLuAwGkOKFRl4C34WkjazBtb7eT" crossorigin="anonymous"> -->

        <!-- <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/paper/bootstrap.min.css" rel="stylesheet" integrity="sha384-awusxf8AUojygHf2+joICySzB780jVvQaVCAt1clU3QsyAitLGul28Qxb2r1e5g+" crossorigin="anonymous"> -->

        <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/united/bootstrap.min.css" rel="stylesheet" integrity="sha384-pVJelSCJ58Og1XDc2E95RVYHZDPb9AVyXsI8NoVpB2xmtxoZKJePbMfE4mlXw7BJ" crossorigin="anonymous">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />

        <link href="/css/styles.css" rel="stylesheet">

        <link href="/css/sticky_footer.css" rel="stylesheet">
        
        <link href='https://fonts.googleapis.com/css?family=Annie Use Your Telescope' rel='stylesheet'>
        
        <style type="text/css">
            body {
                padding-top: 70px;
                background: #eaeaea;
            }

            #overlay {
                background-color: #ffffff;
                z-index: 9999;
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                display: none;
                opacity: .8;
            }
        </style>

        <title>Bolão Bocaneiros</title>

    </head>

    <body>
        <div id="overlay" class="text-center">
            <i class="fa fa-spinner fa-pulse fa-3x fa-fw" style="position: fixed; top:50%; left:50%; margin-top:-50px; margin-left:-50px"></i>
        </div>
        
        @include('layouts.nav')
        
        
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    @if ($flash = session('message'))

                    <div class="alert alert-success" role="alert">

                        {{ $flash }}

                    </div>

                    @endif
                </div>
            </div>
            @yield('content')

        </div><!-- /.container -->

        @include('layouts.footer')

    </body>
</html>
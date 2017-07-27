@if (Auth::check())
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">

                <p>Versão Teste</p>

            </div>
        </div>
    </div>
</footer>
@endif

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script src="/js/jquery.mask.min.js"></script>

<script src="/js/scripts.js"></script>

@yield('script-add')
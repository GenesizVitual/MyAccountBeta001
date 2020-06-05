<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel <br>
                    <small><label style="font-weight: bold">Beta Version :</label>1.0.0</small>
                </div>

                <div class="links">
                    <a href="{{ url('jurnal-umum') }}">Jurnal Umum</a>
                    <a href="{{ url('buku-besar') }}">Buku Besar</a>
                    <a href="{{ url('neraca-saldo') }}">Neraca Saldo</a>
                    <a href="{{ url('jurnal-penyesuian') }}">Jurnal Penyesuaian</a>
                    <a href="{{ url('buku-besar-penyesuaian') }}">Buku Besar Penyesuaian</a>
                    <a href="{{ url('laba-rugi') }}">Laba Rugi</a>
                    <a href="{{ url('neraca-saldo-penyesuaian') }}">Neraca Saldo Penyesuaian</a>
                    <a href="{{ url('neraca') }}">Neraca</a>
                </div>
            </div>
        </div>
    </body>
</html>

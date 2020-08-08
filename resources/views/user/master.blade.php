<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/55459eaf06.js" crossorigin="anonymous"></script>
    <style>
        a{
            text-decoration: none;
        }
        a:hover{
            text-decoration: none;
        }
        a:transition{
            text-decoration: none;
        }
        .resaltar:hover{
            background-color: #D4E6F1;
        }
        .fot{
            background-color: #212529;
        }
    </style>
</head>
<body>
    <div id="app">
        
        @include('user.navbar')

        <div class="container-xl">
            <router-view></router-view>
                <!--<div class="col-md-9">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio natus nobis deserunt voluptas consequatur cumque laborum rem dignissimos cum, blanditiis dicta ad maxime velit aliquam doloribus iure quia. Eligendi, id.
                </div>-->
        </div>

        <!--<footer class="fot fixed-bottom" style="height:40px">
            <div class="container-xl">
                <p class="mt-2 text-muted">Repository Web - 2020</p>
            </div>
        </footer>-->
    </div>

</body>
</html>
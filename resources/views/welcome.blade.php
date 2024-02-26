<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])

        <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <script src="{{ asset('js/app.js') }}"></script> -->
    </head>
    <body class="">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-3" style="border: 1px solid red;">
                    This is test Element
                </div>
                <div class="col-sm-12 col-md-3" style="border: 1px solid red;">
                    This is test Element
                </div>
                <div class="col-sm-12 col-md-3" style="border: 1px solid red;">
                    This is test Element
                </div>
                <div class="col-sm-12 col-md-3" style="border: 1px solid red;">
                    This is test Element
                </div>
            </div>
        </div>
    </body>
</html>

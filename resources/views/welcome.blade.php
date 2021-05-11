<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ImgHashtag</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <style>
            body{
                background-color: #eee;
            }
        </style>
    </head>
    <body class="antialiased">
        <div id="app">
            <landing-page session={{ base64_encode(Request::ip()) }} ></landing-page>
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>

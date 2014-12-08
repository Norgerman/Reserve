<html>
    <head>
        <meta charset="utf-8">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
        @section('meta')

        @show
        @section('css')
            {{HTML::style('lib/bootstrap/css/bootstrap.css')}}
        @show
        @section('js')
            {{HTML::script('lib/jquery.js')}}
            {{HTML::script('lib/bootstrap/js/bootstrap.js')}}
        @show
    </head>
    <body>
        @yield('body')
    </body>
</html>
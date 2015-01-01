<!DOCTYPE html>
<html style="background: url('/img/bglogin.png')" ng-app="app">
    <head>
        <meta charset="UTF-8">
        <title>Gruik. - @yield('title')</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link rel="Shortcut Icon" type="image/png" href="/img/gruik-black.png" />

        <link href="/vendor/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="/vendor/smoke.js/smoke.css" rel="stylesheet" type="text/css" />
        <link href="/css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <script src="/vendor/angular/angular.min.js" type="text/javascript"></script>
    </head>

    <body style="background: url('/img/bglogin.png')" @yield('controller')>

        @yield('content')

        <script src="/vendor/jquery/jquery.min.js"></script>
        <script src="/vendor/checklist-model/checklist-model.js"></script>
        <script src="/vendor/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="/vendor/smoke.js/smoke.min.js" type="text/javascript"></script>
        <script src="/js/angular/main.js" type="text/javascript"></script>

    </body>
</html>

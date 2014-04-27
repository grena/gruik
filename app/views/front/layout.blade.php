<!DOCTYPE html>
<html ng-app="app">
    <head>
        <meta charset="UTF-8">
        <title>Gruiiiiik.</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

        <link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="/css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <link href="/vendor/highlightjs/styles/github.css" rel="stylesheet" type="text/css" />
        <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>
    </head>

    <body class="skin-black">

        <header class="header">
            @include('front.partials.navbar')
        </header>

        <div class="wrapper row-offcanvas row-offcanvas-left">
            <aside class="left-side sidebar-offcanvas">
                @include('front.partials.sidebar')
            </aside>
            <aside class="right-side">
                <section class="content">
                    @yield('content')
                </section>
            </aside>
        </div>

        <script src="/vendor/jquery/jquery.min.js"></script>
        <script src="/vendor/angular/angular.min.js" type="text/javascript"></script>
        <script src="/vendor/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="/js/AdminLTE/app.js" type="text/javascript"></script>
        <script src="/js/angular/front.js" type="text/javascript"></script>

    </body>
</html>
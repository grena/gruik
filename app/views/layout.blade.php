<!DOCTYPE html>
<html ng-app="app">
    <head>
        <meta charset="UTF-8">
        <title>Gruik.</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link rel="Shortcut Icon" type="image/png" href="/img/gruik-black.png" />

        <link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="/vendor/smoke.js/smoke.css" rel="stylesheet" type="text/css" />
        <link href="/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="/css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <link href="/vendor/highlightjs/styles/github.css" rel="stylesheet" type="text/css" />
        <link href="/vendor/selectize/dist/css/selectize.css" rel="stylesheet" type="text/css" />
        <link href="/vendor/selectize/dist/css/selectize.default.css" rel="stylesheet" type="text/css" />
        <link href="/css/gruik.css" rel="stylesheet" type="text/css" />

        <style>
            .selectize-input { box-shadow: none !important; border-radius: 0; border-left:0;border-right:0;border-top:0; border-bottom:1px dotted;}
        </style>

        <script src="/vendor/angular/angular.min.js" type="text/javascript"></script>

    </head>

    <body class="skin-black" @yield('controller')>

        <header class="header">
            @include('partials.navbar')
        </header>

        <div class="wrapper row-offcanvas row-offcanvas-left">
            <aside class="left-side sidebar-offcanvas">
                @include('partials.sidebar')
            </aside>

            <aside class="right-side">
                <section class="content">
                    @yield('content')
                </section>
            </aside>
        </div>

        <!-- View where JS vals are bind from server -->
        @include('jsassets')

        <script src="/vendor/jquery/jquery.min.js"></script>
        <script src="/vendor/selectize/dist/js/standalone/selectize.min.js" type="text/javascript"></script>
        <script src="/vendor/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="/vendor/checklist-model/checklist-model.js"></script>
        <script src="/vendor/angular-ui-select2/src/select2.js" type="text/javascript"></script>
        <script src="/vendor/lodash/dist/lodash.min.js" type="text/javascript"></script>
        <script src="/js/AdminLTE/app.js" type="text/javascript"></script>
        <script src="/js/angular/main.js" type="text/javascript"></script>

        @yield('scripts')

        <input id="csrf" type="hidden" name="csrf_token" value="{% csrf_token() %}">

    </body>
</html>
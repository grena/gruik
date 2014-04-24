<!DOCTYPE html>
<html ng-app="app">
    <head>
        <meta charset="UTF-8">
        <title>Gruiiiiik.</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="/vendor/select2/select2.css" rel="stylesheet" type="text/css" />
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <link href="/vendor/highlightjs/styles/github.css" rel="stylesheet" type="text/css" />
        <link href="/vendor/selectize/dist/css/selectize.css" rel="stylesheet" type="text/css" />
        <link href="/vendor/selectize/dist/css/selectize.default.css" rel="stylesheet" type="text/css" />

        <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>

        <style>
            .selectize-input { box-shadow: none !important; border-radius: 0; border-left:0;border-right:0;border-top:0; border-bottom:1px dotted;}
        </style>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-black" @yield('controller')>
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            @include('admin.partials.navbar')
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->

                @include('admin.partials.sidebar')

                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Main content -->
                <section class="content">

                    @yield('content')

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->


        <script src="/vendor/jquery/jquery.min.js"></script>
        <script src="/vendor/selectize/dist/js/standalone/selectize.min.js" type="text/javascript"></script>
        <script src="/vendor/select2/select2.min.js"></script>
        <script src="/vendor/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="/vendor/angular/angular.min.js" type="text/javascript"></script>
        <script src="/vendor/angular-ui-select2/src/select2.js" type="text/javascript"></script>
        <script src="/js/AdminLTE/app.js" type="text/javascript"></script>

        <script src="/js/angular/admin.js" type="text/javascript"></script>

    </body>
</html>
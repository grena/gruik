<!DOCTYPE html>
<html style="background: url('/img/bglogin.png')" ng-app="app">
    <head>
        <meta charset="UTF-8">
        <title>Gruik. - Reset password</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

        <link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="/vendor/smoke.js/smoke.css" rel="stylesheet" type="text/css" />
        <link href="/css/AdminLTE.css" rel="stylesheet" type="text/css" />
    </head>

    <body style="background: url('/img/bglogin.png')" ng-controller="ResetPasswordCtrl">

        <div class="form-box" id="login-box">
            <div class="header" style="background:#598D8F;">
                <img src="/img/gruik.png" alt=""> <br> Reset my password
            </div>
            <form ng-submit="sendNewPassword('{% $token %}')">
                <div class="body bg-gray">

                    <div class="text-center" ng-show="flash">
                        <small class="label label-danger"><i class="fa fa-times"></i> {{ flash }}</small>
                    </div>

                    <div class="form-group">
                        <input required ng-disabled="loading" ng-model="password" type="text" class="form-control" placeholder="Password"/>
                    </div>
                    <div class="form-group">
                        <input required ng-disabled="loading" ng-model="password_confirmation" type="text" class="form-control" placeholder="Password"/>
                    </div>
                </div>
                <div class="footer">
                    <button ng-disabled="loading" type="submit" class="btn bg-olive btn-block"><i ng-show="loading" class="fa fa-cog fa-spin"></i> Ok</button>
                </div>
            </form>
        </div>

        <script src="/vendor/jquery/jquery.min.js"></script>
        <script src="/vendor/angular/angular.min.js" type="text/javascript"></script>
        <script src="/vendor/checklist-model/checklist-model.js"></script>
        <script src="/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="/vendor/smoke.js/smoke.min.js" type="text/javascript"></script>
        <script src="/js/angular/main.js" type="text/javascript"></script>

    </body>
</html>

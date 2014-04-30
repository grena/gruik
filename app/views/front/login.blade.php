<!DOCTYPE html>
<html style="background: url('/img/bglogin.png')">
    <head>
        <meta charset="UTF-8">
        <title>AdminLTE | Log in</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

        <link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="/css/AdminLTE.css" rel="stylesheet" type="text/css" />
    </head>

    <body style="background: url('/img/bglogin.png')">

        <div class="form-box" id="login-box">
            <div class="header" style="background:#598D8F;">
                <img src="/img/gruik.png" alt=""><br> Sign In
            </div>
            <form action="{% URL::to('login') %}" method="post">
                <div class="body bg-gray">
                    <div class="form-group">
                        <input type="text" name="email" class="form-control" placeholder="Email"/>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password"/>
                    </div>
                    <div class="form-group">
                        <label for="remember" >
                            <input type="checkbox" id="remember" name="remember_me"/> Remember me
                        </label>
                    </div>
                </div>
                <div class="footer">
                    <button type="submit" class="btn bg-olive btn-block">Sign me in</button>

                    <p><a href="#">I forgot my password</a></p>
                </div>
            </form>
        </div>

        <script src="/vendor/jquery/jquery.min.js"></script>
        <script src="/js/bootstrap.min.js" type="text/javascript"></script>

    </body>
</html>
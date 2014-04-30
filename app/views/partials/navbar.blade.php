<a href="{% URL::to('/') %}" class="logo">
    Gruik.
    <img src="/img/gruik.png" alt="Gruik loko" style="height: 40px; margin-top: -10px;">
</a>
<nav class="navbar navbar-static-top" role="navigation">

    <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </a>

    @if(isset($user))
    <div class="navbar-right">
        <ul class="nav navbar-nav">
            <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="glyphicon glyphicon-user"></i>
                    <span>{% $user->email %} <i class="caret"></i></span>
                </a>
                <ul class="dropdown-menu">
                    <li class="user-header bg-light-blue">
                        <img src="{% Gravatar::src( $user->email, 80 ) %}" class="img-circle" alt="User Image" style="box-shadow: 0px 0px 15px #111111;" />
                        <p>
                            {% $user->email %}
                        </p>
                    </li>
                    <li class="user-footer">
                        <div class="pull-left">
                            <a href="{% URL::to('settings') %}" class="btn btn-default btn-flat">Settings</a>
                        </div>
                        <div class="pull-right">
                            <a href="{% URL::to('logout') %}" class="btn btn-default btn-flat">Sign out</a>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </div>

    @else
    <div class="navbar-right">
        <div style="margin-right:30px; margin-top:14px;">
            <a href="{% URL::to('login') %}" class="navbar-btn" role="button">
                Login
            </a>
        </div>
    </div>
    @endif
</nav>
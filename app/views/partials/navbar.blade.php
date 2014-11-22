<a href="{% URL::to('/') %}" class="logo">
    Gruik.
    <img src="/img/gruik-black.png" alt="Gruik loko" style="height: 40px; margin-top: -10px;">
</a>
<nav class="navbar navbar-static-top" role="navigation">

    <div class="navbar-left">
        <div class="gruik-top-menu">
            @if(isset($user))
            <a href="{% URL::to('dashboard') %}">
                <span>My Gruiks</span>
            </a>
            <a href="{% URL::to('tags') %}">
                <span>Tags</span>
            </a>
            @endif
            <a href="{% URL::to('explore') %}">
                <span>Explore</span>
            </a>
            <input type="text" placeholder="Search...">
        </div>
    </div>

    @if(isset($user))
    <div class="navbar-right">
        <ul class="nav navbar-nav">
            <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="{% Gravatar::src( $user->email, 20 ) %}" alt="User Image" style="margin-right:5px;" />
                    <span>{% $user->username %} <i class="caret"></i></span>
                </a>
                <ul class="dropdown-menu">
                    <li class="user-header bg-light-blue">
                        <img src="{% Gravatar::src( $user->email, 80 ) %}" class="img-circle" alt="User Image" style="box-shadow: 0px 0px 15px #111111;" />
                        <p>{% $user->email %}</p>
                    </li>
                    <li class="user-body">
                        <div class="col-xs-12 text-center">
                            <a href="{% route('user_profile', ['username' => $user->username]); %}"><i class="fa fa-user"></i> Profile</a>
                        </div>
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
            or
            <a href="{% URL::to('register') %}" class="navbar-btn" role="button">
                Register
            </a>
        </div>
    </div>
    @endif
</nav>
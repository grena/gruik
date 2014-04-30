<a href="{% URL::to('/admin') %}" class="logo">
    <!-- Add the class icon to your logo image or logo icon to add the margining -->
    Gruik.
    <img src="/img/gruik.png" alt="Gruik loko" style="height: 40px; margin-top: -10px;">
</a>
<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </a>
    <div class="navbar-right">
        <ul class="nav navbar-nav">
            <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="glyphicon glyphicon-user"></i>
                    <span>{% $user->email %} <i class="caret"></i></span>
                </a>
                <ul class="dropdown-menu">
                    <!-- User image -->
                    <li class="user-header bg-light-blue">
                        <img src="{% Gravatar::src( $user->email, 80 ) %}" class="img-circle" alt="User Image" style="box-shadow: 0px 0px 15px #111111;" />
                        <p>
                            {% $user->email %}
                        </p>
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <div class="pull-left">
                            <a href="{% URL::to('admin/settings') %}" class="btn btn-default btn-flat">Settings</a>
                        </div>
                        <div class="pull-right">
                            <a href="{% URL::to('admin/logout') %}" class="btn btn-default btn-flat">Sign out</a>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
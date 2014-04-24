<a href="index.html" class="logo">
    <!-- Add the class icon to your logo image or logo icon to add the margining -->
    Gruiiiiik.
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
    <div class="navbar-left" style="margin-left:25px; margin-top: 2px;">
        <ul class="nav navbar-nav">
            <li>
                <input class="form-control input-sm navbar-btn" style="width:300px;" type="text" placeholder="Search...">
            </li>
            <li style="margin-top:11px; margin-left:5px;">
                <small class="label label-primary"><i class="fa fa-times"></i> Open-Source</small>
                <small class="label label-primary"><i class="fa fa-times"></i> Snippet</small>
                <small class="label label-primary"><i class="fa fa-times"></i> JavaScript</small>
            </li>
        </ul>
    </div>

    <div class="navbar-right">
        <div style="margin-right:30px; margin-top:14px;">
            <a href="{% URL::to('admin/login') %}" class="navbar-btn" role="button">
                Login
            </a>
        </div>
    </div>
</nav>
<a href="{% URL::to('/') %}" class="logo">
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
        <div style="margin-right:30px; margin-top:14px;">
            <a href="{% URL::to('admin/login') %}" class="navbar-btn" role="button">
                Login
            </a>
        </div>
    </div>
</nav>
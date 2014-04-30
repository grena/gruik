<section class="sidebar">
    <ul class="sidebar-menu">
        <li style="margin-bottom:10px; margin-top:10px; text-align:center;">
            <img src="{% Gravatar::src( $user->email, 80 ) %}" class="img-circle" alt="User Image" style="z-index: 5; height: 90px; width: 90px; border: 8px solid; border-color: transparent; border-color: rgba(255, 255, 255, 0.2); box-shadow: 0px 0px 15px #111111;">
        </li>
        <li class="{% Route::getCurrentRoute()->getPath() == 'fail' ? 'active' : '' %}">
            <a href="{% URL::to('admin') %}">
                <i class="fa fa-coffee"></i> <span>My Gruiks</span>
            </a>
        </li>
        <li class="{% Route::getCurrentRoute()->getPath() == 'admin' ? 'active' : '' %}">
            <a href="{% URL::to('admin') %}">
                <i class="fa fa-pencil"></i> <span>Create</span>
            </a>
        </li>
        <li class="{% Route::getCurrentRoute()->getPath() == 'admin/posts' ? 'active' : '' %}">
            <a href="{% URL::to('admin/posts') %}">
                <i class="fa fa-files-o"></i> <span>Manage posts</span>
            </a>
        </li>
        <li class="{% Route::getCurrentRoute()->getPath() == 'admin/tags' ? 'active' : '' %}">
            <a href="{% URL::to('admin/tags') %}">
                <i class="fa fa-tags"></i> <span>Tags</span>
            </a>
        </li>
        <li class="{% Route::getCurrentRoute()->getPath() == 'admin/settings' ? 'active' : '' %}">
            <a href="{% URL::to('admin/settings') %}">
                <i class="fa fa-wrench"></i> <span>Settings</span>
            </a>
        </li>
    </ul>
</section>
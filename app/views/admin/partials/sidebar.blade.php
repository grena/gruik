<section class="sidebar">
    <ul class="sidebar-menu">
        <li class="{% Route::getCurrentRoute()->getPath() == 'admin' ? 'active' : '' %}">
            <a href="{% URL::to('admin') %}">
                <i class="fa fa-coffee"></i> <span>Create</span>
            </a>
        </li>
        <li class="{% Route::getCurrentRoute()->getPath() == 'admin/posts' ? 'active' : '' %}">
            <a href="{% URL::to('admin/posts') %}">
                <i class="fa fa-files-o"></i> <span>Posts</span>
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
<section class="sidebar">
    <ul class="sidebar-menu">

        @if(isset($user))
        <li class="{% Route::getCurrentRoute()->getPath() == 'dashboard' ? 'active' : '' %}">
            <a href="{% URL::to('dashboard') %}">
                <i class="fa fa-coffee"></i> <span>My Gruiks</span>
            </a>
        </li>
        <li class="{% Route::getCurrentRoute()->getPath() == 'create' ? 'active' : '' %}">
            <a href="{% URL::to('create') %}">
                <i class="fa fa-pencil"></i> <span>Create</span>
            </a>
        </li>
        <li class="{% Route::getCurrentRoute()->getPath() == 'tags' ? 'active' : '' %}">
            <a href="{% URL::to('tags') %}">
                <i class="fa fa-tags"></i> <span>Tags</span>
            </a>
        </li>
        <li class="{% Route::getCurrentRoute()->getPath() == 'settings' ? 'active' : '' %}">
            <a href="{% URL::to('settings') %}">
                <i class="fa fa-wrench"></i> <span>Settings</span>
            </a>
        </li>
        @endif

        <li class="{% Route::getCurrentRoute()->getPath() == 'explore' ? 'active' : '' %}">
            <a href="{% URL::to('explore') %}">
                <i class="fa fa-globe"></i> <span>Explore</span>
            </a>
        </li>

    </ul>
</section>
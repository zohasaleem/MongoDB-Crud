<li class="nav-small-cap">
    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
    <span class="hide-menu">Admin</span>
</li>
    

<li class="sidebar-item">
    <a class="sidebar-link justify-content-between" href="{{ route('home')}}" aria-expanded="false">
    <div class="d-flex align-items-center gap-3">
        <span class="d-flex">
        <i class="ti ti-dashboard"></i>
        </span>
        <span class="hide-menu">Dashboard</span>
    </div>
    </a>
</li>


<li class="sidebar-item">
    <a class="sidebar-link" href="{{ route('business-profiles.index') }}" aria-expanded="false">
    <span class="d-flex">
        <i class="ti ti-briefcase"></i>
    </span>
    <span class="hide-menu">Business Profiles</span>
    </a>
</li> 

<li class="sidebar-item">
    <a class="sidebar-link" href="{{ route('users.index') }}" aria-expanded="false">
    <span class="d-flex">
        <i class="ti ti-user"></i>
    </span>
    <span class="hide-menu">Users</span>
    </a>
</li> 

<li class="sidebar-item">
    <a class="sidebar-link" href="{{ route('roles.index') }}" aria-expanded="false">
    <span class="d-flex">
        <i class="ti ti-id"></i>
    </span>
    <span class="hide-menu">Roles</span>
    </a>
</li> 

<li class="sidebar-item">
    <a class="sidebar-link" href="{{ route('permissions.index') }}" aria-expanded="false">
    <span class="d-flex">
        <i class="ti ti-key"></i>
    </span>
    <span class="hide-menu">Permissions</span>
    </a>
</li> 


<li class="sidebar-item">
    <a class="sidebar-link" href="{{ route('blogs.index') }}" aria-expanded="false">
    <span class="d-flex">
        <i class="ti ti-feather"></i>
    </span>
    <span class="hide-menu">Blogs</span>
    </a>
</li> 
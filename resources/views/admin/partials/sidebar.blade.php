<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="app-sidebar__user">
        <div class="text-center ms-lg-4">
            @foreach($users as $user)
            <p class="app-sidebar__user-name fw-bold fs-5">{{$user->name}}</p>
            @endforeach
            <p class="app-sidebar__user-designation fs-6">Developer</p>
        </div>
    </div>
    <ul class="app-menu">
        <li><a class="app-menu__item active" href="{{route('admin.dashboard')}}"><i class="app-menu__icon bi bi-speedometer"></i><span class="app-menu__label">Dashboard</span></a></li>
        <li class="treeview"><a class="app-menu__item" href="" data-toggle="treeview"><i class="app-menu__icon bi bi-laptop"></i><span class="app-menu__label">Users</span><i class="treeview-indicator bi bi-chevron-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="{{route('admin.users')}}"><i class="icon bi bi-circle-fill"></i> Users</a></li>
            </ul>
        </li>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon bi bi-ui-checks"></i><span class="app-menu__label">Forms</span><i class="treeview-indicator bi bi-chevron-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="{{route('admin.categories',['lang'=>'tr']) }}"><i class="icon bi bi-circle-fill"></i> Categories</a></li>
                <li><a class="treeview-item" href="{{route('admin.blogs',['lang'=>'tr']) }}"><i class="icon bi bi-circle-fill"></i> Blogs</a></li>
                <li><a class="treeview-item" href="{{route('admin.teams',['lang'=>'tr']) }}"><i class="icon bi bi-circle-fill"></i> Teams</a></li>
                <li><a class="treeview-item" href="{{route('admin.quotes',['lang'=>'tr']) }}"><i class="icon bi bi-circle-fill"></i> Quotes</a></li>
            </ul>
        </li>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon bi bi-table"></i><span class="app-menu__label">Tables</span><i class="treeview-indicator bi bi-chevron-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="{{route('admin.sponsors')}}"><i class="icon bi bi-circle-fill"></i> Sponsors</a></li>
                <li><a class="treeview-item" href="{{route('admin.youtube')}}"><i class="icon bi bi-circle-fill"></i> Youtube</a></li>
                <li><a class="treeview-item" href="{{route('admin.sliders')}}"><i class="icon bi bi-circle-fill"></i> Sliders</a></li>
                <li><a class="treeview-item" href="{{route('admin.outside-messages')}}"><i class="icon bi bi-circle-fill"></i> Outside Messages</a></li>
                <li><a class="treeview-item" href="{{route('admin.about')}}"><i class="icon bi bi-circle-fill"></i> About</a></li>
                <li><a class="treeview-item" href="{{route('admin.about-menus', ['lang'=>'tr']) }}"><i class="icon bi bi-circle-fill"></i> About Menus</a></li>
                <li><a class="treeview-item" href="{{route('admin.doctor-images')}}"><i class="icon bi bi-circle-fill"></i> Doctor Images</a></li>
                <li><a class="treeview-item" href="{{route('admin.main-doctor')}}"><i class="icon bi bi-circle-fill"></i> Main Doctors</a></li>
                <li><a class="treeview-item" href="{{route('admin.tv-programs')}}"><i class="icon bi bi-circle-fill"></i> TV Programs </a></li>
            </ul>
        </li>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon bi bi-ui-checks"></i><span class="app-menu__label">Settings</span><i class="treeview-indicator bi bi-chevron-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="{{route('admin.settings')}}"><i class="icon bi bi-circle-fill"></i> Settings</a></li>
                <li><a class="treeview-item" href="{{route('admin.language')}}"><i class="icon bi bi-circle-fill"></i>Language</a></li>
                <li><a class="treeview-item" href="{{route('admin.contacts')}}"><i class="icon bi bi-circle-fill"></i> Contact</a></li>
                <li><a class="treeview-item" href="{{route('admin.social-networks')}}"><i class="icon bi bi-circle-fill"></i> Social Network</a></li>

            </ul>
        </li>
    </ul>
</aside>

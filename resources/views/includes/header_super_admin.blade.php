<!-- BEGIN: Header-->
<!-- fixed-top-->
<nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow navbar-static-top navbar-light navbar-brand-center">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
            <li class="nav-item"><a class="navbar-brand" href="index.html"><img class="brand-logo" alt="creaative admin logo" src="{{asset('admin-theme/app-assets/images/logo/logo.png')}}">
                    <h3 class="brand-text">Chameleon</h3>
                </a></li>
            <li class="nav-item d-md-none"><a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a></li>
        </ul>
    </div>
    <div class="navbar-wrapper">
        <div class="navbar-container content">
            <div class="collapse navbar-collapse" id="navbar-mobile">
                <ul class="nav navbar-nav mr-auto float-left">
                    <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu"></i></a></li>
                    <li class="nav-item d-none d-md-block"><a class="nav-link nav-link-expand" href="#"><i class="ficon ft-maximize"></i></a></li>
                </ul>
                <ul class="nav navbar-nav float-right">
                    <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon ft-bell bell-shake" id="notification-navbar-link"></i><span class="badge badge-pill badge-sm badge-danger badge-up badge-glow">5</span></a>
                        <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                            <div class="arrow_box_right">
                                <li class="dropdown-menu-header">
                                    <h6 class="dropdown-header m-0"><span class="grey darken-2">Notifications</span></h6>
                                </li>
                                <li class="scrollable-container media-list w-100"><a href="javascript:void(0)">
                                        <div class="media">
                                            <div class="media-left align-self-center"><i class="ft-share info font-medium-4 mt-2"></i></div>
                                            <div class="media-body">
                                                <h6 class="media-heading info">New Order Received</h6>
                                                <p class="notification-text font-small-3 text-muted text-bold-600">Lorem ipsum dolor sit amet!</p><small>
                                                    <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">3:30 PM</time></small>
                                            </div>
                                        </div>
                                    </a><a href="javascript:void(0)">
                                        <div class="media">
                                            <div class="media-left align-self-center"><i class="ft-save font-medium-4 mt-2 warning"></i></div>
                                            <div class="media-body">
                                                <h6 class="media-heading warning">New User Registered</h6>
                                                <p class="notification-text font-small-3 text-muted text-bold-600">Aliquam tincidunt mauris eu risus.</p><small>
                                                    <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">10:05 AM</time></small>
                                            </div>
                                        </div>
                                    </a><a href="javascript:void(0)">
                                        <div class="media">
                                            <div class="media-left align-self-center"><i class="ft-repeat font-medium-4 mt-2 danger"></i></div>
                                            <div class="media-body">
                                                <h6 class="media-heading danger">New Purchase</h6>
                                                <p class="notification-text font-small-3 text-muted text-bold-600">Lorem ipsum dolor sit ametest?</p><small>
                                                    <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Yesterday</time></small>
                                            </div>
                                        </div>
                                    </a><a href="javascript:void(0)">
                                        <div class="media">
                                            <div class="media-left align-self-center"><i class="ft-shopping-cart font-medium-4 mt-2 primary"></i></div>
                                            <div class="media-body">
                                                <h6 class="media-heading primary">New Item In Your Cart</h6><small>
                                                    <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Last week</time></small>
                                            </div>
                                        </div>
                                    </a><a href="javascript:void(0)">
                                        <div class="media">
                                            <div class="media-left align-self-center"><i class="ft-heart font-medium-4 mt-2 info"></i></div>
                                            <div class="media-body">
                                                <h6 class="media-heading info">New Sale</h6><small>
                                                    <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Last month</time></small>
                                            </div>
                                        </div>
                                    </a></li>
                                <li class="dropdown-menu-footer"><a class="dropdown-item info text-right pr-1" href="javascript:void(0)">Read all</a></li>
                            </div>
                        </ul>
                    </li>
                    <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown"> <span class="avatar avatar-online"><img src="{{asset('super-admin-theme/app-assets/images/portrait/small/avatar-s-19.png')}}" alt="avatar"></span></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="arrow_box_right"><a class="dropdown-item" href="#"><span class="avatar avatar-online"><img src="{{asset('super-admin-theme/app-assets/images/portrait/small/avatar-s-19.png')}}" alt="avatar"><span class="user-name text-bold-700 ml-1">{{ Auth::user()->name }}</span></span></a>
                                <div class="dropdown-divider"></div><a class="dropdown-item" href="user-profile.html"><i class="ft-user"></i> Edit Profile</a><a class="dropdown-item" href="email-application.html"><i class="ft-mail"></i> My Inbox</a><a class="dropdown-item" href="project-summary.html"><i class="ft-check-square"></i> Task</a><a class="dropdown-item" href="chat-application.html"><i class="ft-message-square"></i> Chats</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}"  onclick="event.preventDefault();
                                                                                     document.getElementById('logout-form').submit();">
                                    <i class="ft-power"></i>
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<!-- END: Header-->


<!-- BEGIN: Main Menu-->
<div class="header-navbar navbar-expand-sm navbar navbar-horizontal navbar-fixed navbar-dark navbar-without-dd-arrow navbar-shadow" role="navigation" data-menu="menu-wrapper">
    <div class="navbar-container main-menu-content" data-menu="menu-container">
        <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item"><a class="nav-link" href="{{route('super-admin.home')}}"><i class="ft-home"></i><span>Dashboard</span></a></li>
            <li class="nav-item"><a class="nav-link" href="{{route('super-admin.companies.index')}}"><i class="ft-home"></i><span>Companies</span></a></li>
            <li class="nav-item"><a class="nav-link" href="{{route('super-admin.departments.index')}}"><i class="ft-home"></i><span>Departments</span></a></li>
            <li class="nav-item"><a class="nav-link" href="{{route('super-admin.users.index')}}"><i class="ft-users"></i><span>Users</span></a></li>
{{--            <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="ft-aperture"></i><span>Development</span></a>--}}
{{--                <ul class="dropdown-menu">--}}
{{--                    <div class="arrow_box">--}}
{{--                        <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown">Companies</a>--}}
{{--                            <ul class="dropdown-menu">--}}
{{--                                <div class="arrow_box">--}}
{{--                                    <li data-menu=""><a class="dropdown-item" href="{{route('super-admin.companies.index')}}" data-toggle="dropdown">List</a>--}}
{{--                                    </li>--}}
{{--                                    <li data-menu=""><a class="dropdown-item" href="{{route('super-admin.companies.create')}}" data-toggle="dropdown"> Add New</a>--}}
{{--                                    </li>--}}
{{--                                </div>--}}
{{--                            </ul>--}}
{{--                        </li>--}}

{{--                        <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown">Departments</a>--}}
{{--                            <ul class="dropdown-menu">--}}
{{--                                <div class="arrow_box">--}}
{{--                                    <li data-menu=""><a class="dropdown-item" href="{{route('super-admin.departments.index')}}" data-toggle="dropdown">List</a>--}}
{{--                                    </li>--}}
{{--                                    <li data-menu=""><a class="dropdown-item" href="{{route('super-admin.departments.create')}}" data-toggle="dropdown"> Add New</a>--}}
{{--                                    </li>--}}
{{--                                </div>--}}
{{--                            </ul>--}}
{{--                        </li>--}}

{{--                        <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown">Users</a>--}}
{{--                            <ul class="dropdown-menu">--}}
{{--                                <div class="arrow_box">--}}
{{--                                    <li data-menu=""><a class="dropdown-item" href="{{route('super-admin.users.index')}}" data-toggle="dropdown">List</a>--}}
{{--                                    </li>--}}
{{--                                    <li data-menu=""><a class="dropdown-item" href="{{route('super-admin.users.create')}}" data-toggle="dropdown"> Add New</a>--}}
{{--                                    </li>--}}
{{--                                </div>--}}
{{--                            </ul>--}}
{{--                        </li>--}}
{{--                    </div>--}}
{{--                </ul>--}}
{{--            </li>--}}
        </ul>
    </div>
</div>
<!-- END: Main Menu-->

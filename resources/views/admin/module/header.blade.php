<header class="main-header">
    <!-- Logo -->
    <a href="{{ route('admin.index') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>@lang('admin.header.sort-name')</b>@lang('admin.header.sort-name')</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>@lang('admin.header.left-name')</b>@lang('admin.header.right-name')</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">@lang('admin.header.nav')</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu" style="width: 280px;">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ !empty(Auth::user()->profile->avatar) ? config('define.path.avatar').Auth::user()->profile->avatar : config('define.path.default_avatar') }}" class="user-image" alt="User Image">
                        <span class="hidden-xs">@lang('admin.header.hello') {{ Auth::user()->profile->name }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="{{ !empty(Auth::user()->profile->avatar) ? config('define.path.avatar').Auth::user()->profile->avatar : config('define.path.default_avatar') }}" class="img-circle" alt="User Image">
                            <p>
                                {{ Auth::user()->profile->name }}
                                <small>{{ Auth::user()->created_at }}</small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                        <div class="pull-left">
                            <a href="{{ route('admin.users.show', Auth::user()->id) }}" class="btn btn-default btn-flat">@lang('admin.header.per-info')</a>
                        </div>
                        <div class="pull-right">
                            <a href="{{ route('admin.logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();" class="btn btn-default btn-flat">Đăng xuất</a>
                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>

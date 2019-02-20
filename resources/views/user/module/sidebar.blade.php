<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar p-20">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">{{ \Auth::user()->profile->name}}</li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-users"></i> <span>@lang('user.manage_account')</span>
            </a>
            <ul class="treeview-menu">
                <li class="active"><a href="{{ route('user.profile') }}"><i class="fa fa-circle-o"></i> @lang('user.profile')</a></li>
                <li><a href="{{ route('user.password') }}"><i class="fa fa-circle-o"></i> @lang('user.change_password')</a></li>
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-files-o"></i> <span>@lang('user.manage_order')</span>
            </a>
            <ul class="treeview-menu">
            <li class="active"><a href="{{ route('user.orders')}}"><i class="fa fa-circle-o"></i> @lang('user.order_list')</a></li>
            </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
</aside>
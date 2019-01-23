<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">@lang('admin.sidebar.header')</li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-users"></i> <span>@lang('admin.sidebar.user.title')</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li class="active"><a href="{{ route('admin.users.index') }}"><i class="fa fa-circle-o"></i> @lang('admin.sidebar.user.list')</a></li>
                <li><a href="{{ route('admin.users.create') }}"><i class="fa fa-circle-o"></i> @lang('admin.sidebar.user.add')</a></li>
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-files-o"></i> <span>@lang('admin.sidebar.category.title')</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li class="active"><a href="{{ route('admin.category.index')}}"><i class="fa fa-circle-o"></i> @lang('admin.sidebar.category.list')</a></li>
                <li><a href="{{ route('admin.category.create')}}"><i class="fa fa-circle-o"></i> @lang('admin.sidebar.category.add')</a></li>
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-edit"></i> <span>@lang('admin.sidebar.product.title')</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li class="active"><a href="{{ route('admin.product.index')}}"><i class="fa fa-circle-o"></i> @lang('admin.sidebar.product.list')</a></li>
            <li><a href="{{ route('admin.product.create')}}"><i class="fa fa-circle-o"></i> @lang('admin.sidebar.product.add')</a></li>
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-cart-plus"></i> <span>@lang('admin.sidebar.order.title')</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li class="active"><a href="#"><i class="fa fa-circle-o"></i> @lang('admin.sidebar.order.list')</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i> @lang('admin.sidebar.order.add')</a></li>
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-dashboard"></i> <span>@lang('admin.sidebar.report.title')</span>
            </a>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-codepen"></i> <span>@lang('admin.sidebar.code.title')</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li class="active"><a href="{{ route('admin.codes.index') }}"><i class="fa fa-circle-o"></i> @lang('admin.sidebar.code.list')</a></li>
                <li><a href="{{ route('admin.codes.create') }}"><i class="fa fa-circle-o"></i> @lang('admin.sidebar.code.add')</a></li>
            </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
</aside>

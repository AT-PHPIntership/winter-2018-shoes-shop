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
                <i class="fa fa-bomb"></i> <span>@lang('admin.sidebar.color.title')</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li class="active"><a href="{{ route('admin.colors.index')}}"><i class="fa fa-circle-o"></i> @lang('admin.sidebar.color.list')</a></li>
                <li><a href="{{ route('admin.colors.create')}}"><i class="fa fa-circle-o"></i> @lang('admin.sidebar.color.add')</a></li>
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-asterisk"></i> <span>@lang('admin.sidebar.size.title')</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li class="active"><a href="{{ route('admin.sizes.index')}}"><i class="fa fa-circle-o"></i> @lang('admin.sidebar.size.list')</a></li>
                <li><a href="{{ route('admin.sizes.create')}}"><i class="fa fa-circle-o"></i> @lang('admin.sidebar.size.add')</a></li>
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
                <li class="active"><a href="{{ route('admin.orders.index') }}"><i class="fa fa-circle-o"></i> @lang('admin.sidebar.order.list')</a></li>
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-bell"></i> <span>@lang('admin.sidebar.promotion.title')</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li class="active"><a href="{{ route('admin.promotions.index') }}"><i class="fa fa-circle-o"></i> @lang('admin.sidebar.promotion.list')</a></li>
                <li><a href="{{ route('admin.promotions.create') }}"><i class="fa fa-circle-o"></i> @lang('admin.sidebar.promotion.add')</a></li>
            </ul>
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
        <li class="treeview">
            <a href="#">
                <i class="fa fa-comments"></i> <span>@lang('admin.sidebar.comment.title')</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li class="active"><a href="{{ route('admin.comments.index') }}"><i class="fa fa-circle-o"></i> @lang('admin.sidebar.comment.list')</a></li>
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-dashboard"></i> <span>@lang('admin.sidebar.report.title')</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li class="active"><a href="{{ route('admin.statisticals.revenue') }}"><i class="fa fa-circle-o"></i> Doanh thu</a></li>
                <li><a href="{{ route('admin.statisticals.product') }}"><i class="fa fa-circle-o"></i> @lang('admin.sidebar.statistical.product')</a></li>
            </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
</aside>

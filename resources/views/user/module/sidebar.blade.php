<aside class="main-sidebar">
  <section class="sidebar">
    <h3 class="sidebar-header">{{ __('user.account') }}</h3>
    <ul class="sidebar-menu">
      <li>
        <a href="{{ route('user.profile') }}">
          <i class="fa fa-user"></i> <span>{{ __('user.manage_account') }}</span>
        </a>
      </li>
      <li>
        <a href="{{ route('user.password') }}">
          <i class="fa fa-lock"></i> <span>{{ __('user.change_password') }}</span>
        </a>
      </li>
      <li>
        <a href="{{ route('user.orders') }}">
          <i class="fa fa-list-alt"></i> <span>{{ __('user.order_list') }}</span>
        </a>
      </li>
    </ul>
  </section>
</aside>
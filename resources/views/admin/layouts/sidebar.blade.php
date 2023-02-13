<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-danger elevation-4">
    @php $uri = Request::segment(2) @endphp
    @php $uri2 = Request::segment(3) @endphp
    <a href="#" class="brand-link text-center">
        <!-- <img src="{{ asset('public/img/logo.png') }}" alt="{{ config('app.name', 'Laravel') }} Logo"> -->
        {{ config('app.name', 'Laravel') }}
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                      with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview menu-open">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link @if($uri == '') active theme-color @endif ">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            {{ trans('backend.dashboard') }}
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link @if($uri == 'bookings') active theme-color @endif ">
                        <i class="nav-icon fas fa-calendar-alt"></i>
                        <p>
                            {{ trans('backend.manage_bookings') }}
                        </p>
                        <sup class="right badge badge-danger hide order-new-show" style="float: right;top: 0px;">New</sup>
                    </a>
                </li>
                <li class="nav-item has-treeview @if($uri == 'site-settings') menu-open @endif">
                    <a href="#" class="nav-link @if($uri == 'site-settings') active theme-color @endif">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            {{ trans('backend.site_settings') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('manage-admin.index') }}" class="nav-link @if($uri2 == 'manage-admin') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ trans('backend.manage_admin') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview @if($uri == 'manage-patients') menu-open @endif">
                    <a href="#" class="nav-link @if($uri == 'manage-patients') active theme-color @endif">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            {{ trans('backend.manage_patients') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('manage.patients') }}" class="nav-link  @if($uri == 'manage-patients') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ trans('backend.manage_patients') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('dashboard') }}" class="brand-link">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">Rawiporn MT</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <?php $profile = auth()->guard('user')->user(); ?>
                <a href="{{ url('profile') }}" class="d-block">{{ $profile->name }} {{ $profile->surname }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ url('dashboard') }}" class="nav-link{{ request()->is('dashboard') ? ' active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('order') }}" class="nav-link{{ request()->is('order') ? ' active' : '' }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Order
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('stock') }}" class="nav-link{{ request()->is('stock') ? ' active' : '' }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Stock
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('product') }}" class="nav-link{{ request()->is('product') ? ' active' : '' }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Product
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('customer') }}" class="nav-link{{ request()->is('customer') ? ' active' : '' }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Customer
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

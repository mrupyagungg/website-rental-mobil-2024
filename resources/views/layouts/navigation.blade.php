<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="/" class="brand-link">
        <img src="{{ asset('images/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">ADMIN RENTAL</span>
    </a>
<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex justify-content-center align-items-center bg-warning rounded p-2 shadow-sm" 
        style="height: 100px;">
        <div class="image mr-2">
            <i id="mode-icon" class="fas fa-user fa-3x "></i>
        </div>
        <div class="info text-center">
            <a href="{{ route('admin.profile.show') }}" class="d-block font-weight-bold text-dark">
                {{ Auth::user()->name }}
            </a>
            <span class="badge badge-success">{{ Auth::user()->role }}</span>
        </div>
    </div>
        

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
            data-accordion="false">
            <li class="nav-item">
                <a href="{{ route('home') }}" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        {{ __('Dashboard') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.users.index') }}" class="nav-link">
                    <i class="nav-icon fa fa-address-book"></i>
                    <p>
                        {{ __('Users') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.types.index') }}" class="nav-link">
                    <i class="nav-icon fa fa-inbox"></i>
                    <p>
                        {{ __('Kategori') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.cars.index') }}" class="nav-link">
                    <i class="nav-icon fa fa-car"></i>
                    <p>
                        {{ __('Mobil') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.testimonials.index') }}" class="nav-link">
                    <i class="nav-icon fa fa-quote-left"></i>
                    <p>
                        {{ __('Testimonial') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.blogs.index') }}" class="nav-link">
                    <i class="nav-icon fa fa-rss"></i>
                    <p>
                        {{ __('Blog') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.teams.index') }}" class="nav-link">
                    <i class="nav-icon fa fa-users"></i>
                    <p>
                        {{ __('Team') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.settings.index') }}" class="nav-link">
                    <i class="nav-icon fa fa-cog"></i>
                    <p>
                        {{ __('Setting') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.contacts.index') }}" class="nav-link">
                    <i class="nav-icon fa fa-comments"></i>
                    <p>
                        {{ __('Pesan') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.bookings.index') }}" class="nav-link">
                    <i class="nav-icon fa fa-credit-card"></i>
                    <p>
                        {{ __('Booking') }}
                    </p>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>
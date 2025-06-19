<aside class="main-sidebar sidebar-dark-primary elevation-4">
    {{-- logo --}}
    <a href="" class="brand-link">
        <img src="{{ asset('logo-ctu.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><b>CICT Library</b></span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('student.profile') }}" class="nav-link {{ request()->routeIs('student.profile') ? 'active' : '' }}">
                        <i class="nav-icon fa-sharp fa-solid fa-user"></i>
                        <p>Quản lý thông tin cá nhân</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('student.borrow') }}" class="nav-link {{ request()->routeIs('student.borrow') ? 'active' : '' }}">
                        <i class="nav-icon fa-sharp fa-solid fa-book"></i>
                        <p>Đặt mượn sách</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="nav-icon fa-sharp fa-solid fa-power-off"></i>
                        <p>Đăng xuất</p>
                    </a>
                    <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
    </div>
</aside>

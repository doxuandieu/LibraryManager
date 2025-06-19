<aside class="main-sidebar sidebar-dark-primary elevation-4">
    {{-- logo --}}
    <a href="" class="brand-link">
        <img src="{{ asset('logo-ctu.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light"><b>CICT Library</b></span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="/" class="nav-link {{ request()->is('/') ? 'active' : '' }}">
                        <i class="nav-icon fa-sharp fa-solid fa-gauge-high"></i>
                        <p>Thống kê</p>
                    </a>
                </li>
                <li class="nav-item has-treeview {{ request()->is('book*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa-sharp fa-solid fa-books"></i>
                        <p>
                            Quản lý sách
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/book" class="nav-link {{ request()->routeIs('book.list') ? 'active' : '' }}">
                                <i class="far fa-book nav-icon"></i>
                                <p>Tất cả sách</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/book/borrow_book"
                                class="nav-link {{ request()->routeIs('book.borrow_book') ? 'active' : '' }}">
                                <i class="far fa-list-alt nav-icon"></i>
                                <p>Mượn sách</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/book/receipt"
                                class="nav-link {{ request()->routeIs('book.receipt') ? 'active' : '' }}">
                                <i class="far fa-file-text nav-icon"></i>
                                <p>Nhập sách</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview {{ request()->is('student*') ? 'menu-open' : '' }}">
                    <a href="{{ route('student.index') }}"
                        class="nav-link {{ request()->routeIs('student.index') ? 'active' : '' }}">
                        <i class="fas fa-list nav-icon"></i>
                        <p>Quản lý sinh viên</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dissertation.list') }}"
                        class="nav-link {{ request()->routeIs('dissertation.list') ? 'active' : '' }}">
                        <i class="nav-icon fa-sharp fa-solid fa-bookmark"></i>
                        <p>Luận văn</p>
                    </a>
                </li>
                <li class="nav-item has-treeview {{ request()->is('directory*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa-sharp fa-solid fa-folder-open"></i>
                        <p>
                            Danh mục
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/directory/author"
                                class="nav-link {{ request()->routeIs('directory.author') ? 'active' : '' }}">
                                <i class="fas fa-user nav-icon"></i>
                                <p>Tác giả</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/directory/publisher"
                                class="nav-link {{ request()->routeIs('directory.publisher') ? 'active' : '' }}">
                                <i class="fas fa-book nav-icon"></i>
                                <p>Nhà xuất bản</p>
                            </a>
                        </li>
                    </ul>
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

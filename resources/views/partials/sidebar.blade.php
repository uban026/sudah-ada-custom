<aside class="sidebar shadow h-100 position-fixed" id="sidebar"
    style="width: 16rem; background: #ffffff; z-index: 1040;">
    <div class="d-flex flex-column h-100">
        <!-- Logo -->
        <div class="px-4 py-4 border-bottom">
            <div class="d-flex align-items-center gap-2">
                <div class="rounded-circle d-flex align-items-center justify-content-center"
                    style="width: 40px; height: 40px; background: linear-gradient(45deg, #b324f5, #b247fa);">
                    <i class="bi bi-shop-window text-white fs-5"></i>
                </div>
                <div class="sidebar-text">
                    <h2 class="fs-5 fw-bold mb-0 text-yellow-700">Hercicet</h2>
                    <small class="text-muted">Management Panel</small>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="flex-grow-1 px-3 py-4 overflow-auto">
            <div class="nav flex-column gap-1">
                <a href="{{ route('admin.dashboard') }}"
                    class="nav-link d-flex align-items-center gap-2 px-3 py-2 rounded-2 {{ request()->routeIs('admin.dashboard') ? 'active-nav' : 'text-secondary hover-nav' }}">
                    <i class="bi bi-grid-1x2-fill"></i>
                    <span class="sidebar-text">Dashboard</span>
                </a>

                <div class="mt-4">
                    <p class="px-3 text-uppercase small fw-medium mb-2 text-secondary sidebar-text">Catalog Management
                    </p>

                    <a href="{{ route('admin.categories.index') }}"
                        class="nav-link d-flex align-items-center gap-2 px-3 py-2 rounded-2 {{ request()->routeIs('admin.categories.index') ? 'active-nav' : 'text-secondary hover-nav' }}">
                        <i class="bi bi-collection-fill"></i>
                        <span class="sidebar-text">Categories</span>
                    </a>

                    <a href="{{ route('admin.products.index') }}"
                        class="nav-link d-flex align-items-center gap-2 px-3 py-2 rounded-2 {{ request()->routeIs('admin.products.index') ? 'active-nav' : 'text-secondary hover-nav' }}">
                        <i class="bi bi-box-seam-fill"></i>
                        <span class="sidebar-text">Products</span>
                    </a>
                </div>

                <div class="mt-4">
                    <p class="px-3 text-uppercase small fw-medium mb-2 text-secondary sidebar-text">Sales & Orders</p>
                    <a href="{{ route('admin.coupons.index') }}"
                        class="nav-link d-flex align-items-center gap-2 px-3 py-2 rounded-2 {{ request()->routeIs('admin.coupons.index') ? 'active-nav' : 'text-secondary hover-nav' }}">
                        <i class="bi bi-ticket-perforated"></i>

                        <span class="sidebar-text">Coupons</span>
                    </a>
                    <a href="{{ route('admin.orders.index') }}"
                        class="nav-link d-flex align-items-center gap-2 px-3 py-2 rounded-2 {{ request()->routeIs('admin.orders.index') ? 'active-nav' : 'text-secondary hover-nav' }}">
                        <i class="bi bi-cart-check-fill"></i>
                        <span class="sidebar-text">Orders</span>
                    </a>
                    <a href="{{ route('admin.history.index') }}"
                        class="nav-link d-flex align-items-center gap-2 px-3 py-2 rounded-2 {{ request()->routeIs('admin.history.index') ? 'active-nav' : 'text-secondary hover-nav' }}">
                        <i class="bi bi-clock-history"></i>
                        <span class="sidebar-text">Order History</span>
                    </a>
                </div>

                <div class="mt-4">
                    <p class="px-3 text-uppercase small fw-medium mb-2 text-secondary sidebar-text">User Management</p>

                    <a href="{{ route('admin.users.index') }}"
                        class="nav-link d-flex align-items-center gap-2 px-3 py-2 rounded-2 {{ request()->routeIs('admin.users.index') ? 'active-nav' : 'text-secondary hover-nav' }}">
                        <i class="bi bi-people-fill"></i>
                        <span class="sidebar-text">Users</span>
                    </a>
                </div>
            </div>
        </nav>

        <!-- User Profile -->
        <div class="border-top p-3">
            <div class="d-flex align-items-center gap-3">
                @php
                $initials = collect(explode(' ', Auth::user()->name))
                ->map(fn($segment) => substr($segment, 0, 1))
                ->join('');
                $initials = strtoupper($initials);
                @endphp
                <div class="rounded-circle bg-yellow-500 d-flex align-items-center justify-content-center"
                    style="width: 40px; height: 40px;">
                    <span class="text-white fw-medium">{{ $initials }}</span>
                </div>
                <div class="flex-grow-1 sidebar-text">
                    <h6 class="mb-0 text-dark fw-medium">{{ Auth::user()->name }}</h6>
                    <small class="text-muted">{{ Auth::user()->role }}</small>
                </div>
                <div class="dropdown">
                    <button class="btn btn-link text-secondary p-0" type="button" data-bs-toggle="dropdown">
                        <i class="bi bi-three-dots-vertical"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <form action="{{ route('auth.logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="bi bi-box-arrow-right"></i>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</aside>

<style>
/* Sidebar Styles */
.sidebar {
    transition: all 0.3s ease;
    height: 100vh !important;
    overflow-y: auto;
}

.hover-nav {
    transition: all 0.3s ease;
}

.hover-nav:hover {
    background-color: #f8f9fa;
    color: #a274ec !important;
}

.active-nav {
    background-color: #e9f7ef !important;
    color: #bb3cee !important;
    font-weight: 500;
}

/* Responsive Styles */
@media (max-width: 991.98px) {
    .sidebar {
        transform: translateX(-100%);
    }

    .sidebar.show {
        transform: translateX(0);
    }
}

/* Collapsed Sidebar Styles */
@media (min-width: 992px) {
    .sidebar.collapsed {
        width: 4.5rem !important;
    }

    .sidebar.collapsed .sidebar-text {
        display: none;
    }

    .sidebar.collapsed .nav-link {
        justify-content: center;
        padding: 0.5rem !important;
    }

    .sidebar.collapsed .dropdown {
        display: none;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('sidebar');
    const sidebarToggle = document.getElementById('sidebarToggle');
    const contentWrapper = document.getElementById('contentWrapper');

    // Handle mobile toggle
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('show');
        });
    }

    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function(event) {
        if (window.innerWidth < 992) {
            const isClickInsideSidebar = sidebar.contains(event.target);
            const isClickOnToggle = sidebarToggle && sidebarToggle.contains(event.target);

            if (!isClickInsideSidebar && !isClickOnToggle) {
                sidebar.classList.remove('show');
            }
        }
    });

    // Handle window resize
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 992) {
            sidebar.classList.remove('show');
        }
    });

    // Add desktop toggle functionality with keyboard shortcut
    document.addEventListener('keydown', function(event) {
        // Ctrl + B to toggle sidebar
        if (event.ctrlKey && event.key === 'b') {
            event.preventDefault();
            if (window.innerWidth >= 992) {
                sidebar.classList.toggle('collapsed');
                contentWrapper.classList.toggle('sidebar-collapsed');
            }
        }
    });
});
</script>

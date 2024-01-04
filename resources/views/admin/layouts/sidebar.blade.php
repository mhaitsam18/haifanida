<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
            <img src="/assets/img/logos/logo-lanskap-2.png" class="img-fluid" alt="">
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        @php
            use App\Models\Menu;
            $role['is_superadmin'] = auth()->user()->admin->is_superadmin;
            $role['is_adminkantor'] = auth()->user()->admin->kantor_id;
            $menus = Menu::with([
                'children' => function ($query) {
                    $query->where('is_active', true); // Filter active submenus
                    $query->with([
                        'children' => function ($query) {
                            $query->where('is_active', true); // Filter active submenus
                        },
                    ]); // Filter active submenus
                },
            ])
                ->where('is_active', true)
                ->where('parent_id', null)
                ->orderBy('order')
                ->whereHas('roles', function ($query) use ($role) {
                    if (!$role['is_superadmin']) {
                        $query->whereNot('roles.id', 5);
                    }
                    if (!$role['is_adminkantor']) {
                        $query->whereNot('roles.id', 6);
                    }
                })
                ->whereHas('menuRoles', function ($query) {
                    $query->whereNot('menu_roles.can_view', 0);
                })
                ->get();
        @endphp
        <ul class="nav">
            @foreach ($menus as $menu)
                <li class="nav-item nav-category">
                    {{ $menu->menu }}
                </li>
                @foreach ($menu->children as $submenu1)
                    <li class="nav-item">
                        <a class="nav-link"
                            @if ($submenu1->has_dropdown) data-bs-toggle="collapse" href="#menu_{{ $submenu1->id }}" role="button" aria-expanded="false" aria-controls="menu_{{ $submenu1->id }}" @else href="{{ $submenu1->url }}" @endif>
                            <i class="link-icon {{ $submenu1->icon }}"></i>
                            <span class="link-title">{{ $submenu1->menu }}</span>
                            @if ($submenu1->has_dropdown)
                                <i class="link-arrow" data-feather="chevron-down"></i>
                            @endif
                        </a>
                        @if ($submenu1->has_dropdown)
                            <div class="collapse" id="menu_{{ $submenu1->id }}">
                                <ul class="nav sub-menu">
                                    @foreach ($submenu1->children as $submenu2)
                                        <li class="nav-item">
                                            <a href="{{ $submenu2->url }}" class="nav-link">
                                                {{ $submenu2->menu }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </li>
                @endforeach
            @endforeach
        </ul>
        {{-- <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item">
                <a href="dashboard.html" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item nav-category">web apps</li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#emails" role="button" aria-expanded="false"
                    aria-controls="emails">
                    <i class="link-icon" data-feather="mail"></i>
                    <span class="link-title">Email</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="emails">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="pages/email/inbox.html" class="nav-link">Inbox</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/email/read.html" class="nav-link">Read</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/email/compose.html" class="nav-link">Compose</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul> --}}
    </div>
</nav>
<nav class="settings-sidebar">
    <div class="sidebar-body">
        <a href="#" class="settings-sidebar-toggler">
            <i data-feather="settings"></i>
        </a>
        <h6 class="text-muted mb-2">Sidebar:</h6>
        <div class="mb-3 pb-3 border-bottom">
            <div class="form-check form-check-inline">
                <input type="radio" class="form-check-input" name="sidebarThemeSettings" id="sidebarLight"
                    value="sidebar-light" checked>
                <label class="form-check-label" for="sidebarLight">
                    Light
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input type="radio" class="form-check-input" name="sidebarThemeSettings" id="sidebarDark"
                    value="sidebar-dark">
                <label class="form-check-label" for="sidebarDark">
                    Dark
                </label>
            </div>
        </div>
        <div class="theme-wrapper">
            <h6 class="text-muted mb-2">Light Theme:</h6>
            <a class="theme-item active" href="../demo1/dashboard.html">
                <img src="/assets-nobleui/images/screenshots/light.jpg" alt="light theme">
            </a>
            <h6 class="text-muted mb-2">Dark Theme:</h6>
            <a class="theme-item" href="../demo2/dashboard.html">
                <img src="/assets-nobleui/images/screenshots/dark.jpg" alt="light theme">
            </a>
        </div>
    </div>
</nav>
<!-- partial -->

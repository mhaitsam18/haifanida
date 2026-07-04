@php
    use App\Models\Menu;
    $role['is_superadmin'] = auth()->user()->admin->is_superadmin;
    $role['is_adminkantor'] = auth()->user()->admin->kantor_id;
    $menus = Menu::with([
        'children' => function ($query) {
            $query->where('is_active', true);
            $query->with([
                'children' => function ($query) {
                    $query->where('is_active', true);
                },
            ]);
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

<aside x-data="{ mobileOpen: false }" class="lg:w-64 lg:flex-shrink-0">
    {{-- Mobile toggle bar --}}
    <div class="flex items-center justify-between bg-maroon-900 px-4 py-3 lg:hidden">
        <a href="/admin" class="flex items-center">
            <img src="/assets/img/logos/logo-lanskap-2.png" alt="Haifa Nida Wisata" class="h-8 w-auto">
        </a>
        <button @click="mobileOpen = !mobileOpen" class="rounded-lg p-2 text-cream-100">
            <i class="bx" :class="mobileOpen ? 'bx-x' : 'bx-menu'" style="font-size: 1.5rem;"></i>
        </button>
    </div>

    <nav :class="mobileOpen ? 'block' : 'hidden'" class="min-h-screen bg-maroon-900 px-3 py-4 text-cream-100 lg:block">
        <a href="/admin" class="mb-6 hidden items-center px-2 lg:flex">
            <img src="/assets/img/logos/logo-lanskap-2.png" alt="Haifa Nida Wisata" class="h-10 w-auto">
        </a>

        <ul class="space-y-1">
            @foreach ($menus as $menu)
                <li class="mt-4 px-2 text-xs font-semibold uppercase tracking-wide text-cream-400/70 first:mt-0">
                    {{ $menu->menu }}
                </li>
                @foreach ($menu->children as $submenu1)
                    @if ($submenu1->has_dropdown)
                        <li x-data="{ open: {{ request()->is(ltrim($submenu1->url ?? '', '/').'*') ? 'true' : 'false' }} }">
                            <button @click="open = !open"
                                class="flex w-full items-center justify-between rounded-lg px-3 py-2 text-sm font-medium text-cream-100 hover:bg-maroon-800">
                                <span class="flex items-center gap-2">
                                    <i class="{{ $submenu1->icon }}"></i>
                                    {{ $submenu1->menu }}
                                </span>
                                <i class="bx bx-chevron-down transition" :class="open && 'rotate-180'"></i>
                            </button>
                            <ul x-show="open" x-collapse class="ml-6 mt-1 space-y-1 border-l border-maroon-700 pl-3">
                                @foreach ($submenu1->children as $submenu2)
                                    <li>
                                        <a href="{{ $submenu2->url }}"
                                            class="block rounded-lg px-3 py-1.5 text-sm text-cream-200 hover:bg-maroon-800 hover:text-cream-50">
                                            {{ $submenu2->menu }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @else
                        <li>
                            <a href="{{ $submenu1->url }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-medium text-cream-100 hover:bg-maroon-800">
                                <i class="{{ $submenu1->icon }}"></i>
                                {{ $submenu1->menu }}
                            </a>
                        </li>
                    @endif
                @endforeach
            @endforeach
        </ul>
    </nav>
</aside>

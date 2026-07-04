<header class="flex items-center justify-end gap-4 border-b border-cream-200 bg-cream-50 px-4 py-3 sm:px-6">
    <div x-data="{ open: false }" class="relative">
        <button @click="open = !open" @click.outside="open = false" class="flex items-center gap-2">
            <img class="h-9 w-9 rounded-full object-cover ring-2 ring-maroon-200"
                src="{{ asset('storage/' . auth()->user()->photo) }}" alt="{{ auth()->user()->name }}">
        </button>
        <div x-show="open" x-transition x-cloak
            class="absolute right-0 top-full z-20 mt-2 w-64 overflow-hidden rounded-lg border border-cream-200 bg-cream-50 shadow-lg">
            <div class="flex flex-col items-center border-b border-cream-200 px-5 py-4">
                <img class="mb-2 h-16 w-16 rounded-full object-cover ring-2 ring-maroon-200"
                    src="{{ asset('storage/' . auth()->user()->photo) }}" alt="">
                <p class="text-sm font-semibold text-maroon-900">{{ auth()->user()->name }}</p>
                <p class="text-xs text-stone-500">{{ auth()->user()->email }}</p>
            </div>
            <ul class="p-1 text-sm">
                <li>
                    <a href="/admin/profile" class="flex items-center gap-2 rounded-md px-3 py-2 text-stone-700 hover:bg-maroon-50">
                        <i class="bx bx-user"></i> Profil
                    </a>
                </li>
                <li>
                    <a href="/logout" class="flex items-center gap-2 rounded-md px-3 py-2 text-stone-700 hover:bg-maroon-50">
                        <i class="bx bx-log-out"></i> Log Out
                    </a>
                </li>
            </ul>
        </div>
    </div>
</header>

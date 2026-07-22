{{-- data-premium-nav: resources/js/home-experience.js and the scoped CSS in
     app.css key off this attribute (journey-line hover sweep, stagger-in,
     reading-progress thread). Site-wide by design. --}}
<header x-data="{ mobileOpen: false, scrolled: false }" x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 12)"
    class="sticky top-0 z-40" data-premium-nav>
    {{--
        The social-icon bar used to live in a separate block above this nav,
        collapsing (animated max-height) once the page scrolled past 12px.
        That made the sticky header's rendered height change mid-animation —
        right as the Hero's ScrollTrigger pin engages — causing a document
        reflow that desynced the pin/Lenis scroll position for a few frames
        (visible as a jerk). The header's height must stay perfectly constant
        across the whole scroll range, so the icons now live inline in this
        single nav row instead of a second, size-changing bar. `scrolled` is
        still used below, but only for a box-shadow — a paint-only property
        that never triggers layout.
    --}}
    {{-- Main nav --}}
    <nav class="border-b border-maroon-100 bg-cream-50/95 backdrop-blur transition-shadow" :class="scrolled && 'shadow-md'">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-3">
            <a href="/" class="flex items-center">
                <img src="/assets/img/logos/logo-lanskap-2.png" alt="Haifa Nida Wisata" class="h-12 w-auto">
            </a>

            {{-- Desktop menu --}}
            <ul data-nav-links class="hidden items-center gap-1 lg:flex">
                <li>
                    <a href="/" class="rounded-lg px-3 py-2 text-sm font-medium text-stone-700 hover:bg-maroon-50 hover:text-maroon-800">Beranda</a>
                </li>
                <li class="group relative">
                    <button class="flex items-center gap-1 rounded-lg px-3 py-2 text-sm font-medium text-stone-700 hover:bg-maroon-50 hover:text-maroon-800">
                        Layanan Kami <i class="bx bx-caret-down text-xs"></i>
                    </button>
                    <div class="invisible absolute left-0 top-full z-10 w-56 rounded-lg border border-cream-200 bg-cream-50 p-2 opacity-0 shadow-lg transition group-hover:visible group-hover:opacity-100">
                        <a href="/umroh" class="block rounded-md px-3 py-2 text-sm text-stone-700 hover:bg-maroon-50 hover:text-maroon-800">Umroh</a>
                        <a href="/haji" class="block rounded-md px-3 py-2 text-sm text-stone-700 hover:bg-maroon-50 hover:text-maroon-800">Haji</a>
                        <a href="/wisata-halal" class="block rounded-md px-3 py-2 text-sm text-stone-700 hover:bg-maroon-50 hover:text-maroon-800">Wisata Halal</a>
                        @can('admin')
                            <a href="/admin/index" class="block rounded-md px-3 py-2 text-sm text-stone-700 hover:bg-maroon-50 hover:text-maroon-800">Halaman Admin</a>
                        @endcan
                    </div>
                </li>
                <li class="group relative">
                    <button class="flex items-center gap-1 rounded-lg px-3 py-2 text-sm font-medium text-stone-700 hover:bg-maroon-50 hover:text-maroon-800">
                        Konten Kami <i class="bx bx-caret-down text-xs"></i>
                    </button>
                    <div class="invisible absolute left-0 top-full z-10 w-56 rounded-lg border border-cream-200 bg-cream-50 p-2 opacity-0 shadow-lg transition group-hover:visible group-hover:opacity-100">
                        <a href="/galeri" class="block rounded-md px-3 py-2 text-sm text-stone-700 hover:bg-maroon-50 hover:text-maroon-800">Galeri &amp; Testimoni</a>
                        <a href="/artikel" class="block rounded-md px-3 py-2 text-sm text-stone-700 hover:bg-maroon-50 hover:text-maroon-800">Artikel</a>
                        <a href="https://www.kajiannidaal-islam.com/" target="_blank" class="block rounded-md px-3 py-2 text-sm text-stone-700 hover:bg-maroon-50 hover:text-maroon-800">Kajian</a>
                    </div>
                </li>
                <li class="group relative">
                    <button class="flex items-center gap-1 rounded-lg px-3 py-2 text-sm font-medium text-stone-700 hover:bg-maroon-50 hover:text-maroon-800">
                        Tentang Kami <i class="bx bx-caret-down text-xs"></i>
                    </button>
                    <div class="invisible absolute left-0 top-full z-10 w-56 rounded-lg border border-cream-200 bg-cream-50 p-2 opacity-0 shadow-lg transition group-hover:visible group-hover:opacity-100">
                        <a href="/profil" class="block rounded-md px-3 py-2 text-sm text-stone-700 hover:bg-maroon-50 hover:text-maroon-800">Profil</a>
                        <a href="/sejarah" class="block rounded-md px-3 py-2 text-sm text-stone-700 hover:bg-maroon-50 hover:text-maroon-800">Sejarah</a>
                        <a href="/visi-misi" class="block rounded-md px-3 py-2 text-sm text-stone-700 hover:bg-maroon-50 hover:text-maroon-800">Visi dan Misi</a>
                    </div>
                </li>
                <li class="group relative">
                    <button class="flex items-center gap-1 rounded-lg px-3 py-2 text-sm font-medium text-stone-700 hover:bg-maroon-50 hover:text-maroon-800">
                        Bantuan <i class="bx bx-caret-down text-xs"></i>
                    </button>
                    <div class="invisible absolute right-0 top-full z-10 w-60 rounded-lg border border-cream-200 bg-cream-50 p-2 opacity-0 shadow-lg transition group-hover:visible group-hover:opacity-100">
                        <a href="/kontak-kami" class="block rounded-md px-3 py-2 text-sm text-stone-700 hover:bg-maroon-50 hover:text-maroon-800">Kontak Kami</a>
                        <a href="/kuesioner" class="block rounded-md px-3 py-2 text-sm text-stone-700 hover:bg-maroon-50 hover:text-maroon-800">Kuesioner Kepuasan Jema'ah</a>
                        <a href="/keluhan" class="block rounded-md px-3 py-2 text-sm text-stone-700 hover:bg-maroon-50 hover:text-maroon-800">Pengaduan &amp; Keluhan</a>
                        <a href="/faq" class="block rounded-md px-3 py-2 text-sm text-stone-700 hover:bg-maroon-50 hover:text-maroon-800">FAQ</a>
                        <a href="/panduan" class="block rounded-md px-3 py-2 text-sm text-stone-700 hover:bg-maroon-50 hover:text-maroon-800">Panduan</a>
                        <a href="/syarat-ketentuan" class="block rounded-md px-3 py-2 text-sm text-stone-700 hover:bg-maroon-50 hover:text-maroon-800">Syarat &amp; Ketentuan</a>
                        <a href="/kebijakan-privasi" class="block rounded-md px-3 py-2 text-sm text-stone-700 hover:bg-maroon-50 hover:text-maroon-800">Kebijakan Privasi</a>
                    </div>
                </li>
                @auth
                    <li>
                        <a href="{{ route('member.daftar-keberangkatan') }}" class="rounded-lg px-3 py-2 text-sm font-medium text-stone-700 hover:bg-maroon-50 hover:text-maroon-800">Daftar Keberangkatan</a>
                    </li>
                @endauth
            </ul>

            {{-- Right side: social + auth --}}
            <div class="hidden items-center gap-3 lg:flex">
                <div class="flex items-center gap-3 border-r border-cream-200 pr-3 text-stone-400">
                    <a href="https://www.tiktok.com/@haifanidaofficial" target="_blank" aria-label="TikTok" class="hover:text-maroon-700"><i class="bx bxl-tiktok"></i></a>
                    <a href="https://www.facebook.com/haifanidaofficial" target="_blank" aria-label="Facebook" class="hover:text-maroon-700"><i class="bx bxl-facebook"></i></a>
                    <a href="https://x.com/haifanidaoffice" target="_blank" aria-label="Twitter/X" class="hover:text-maroon-700"><i class="bx bxl-twitter"></i></a>
                    <a href="https://www.linkedin.com/company/pt-haifa-nida-wisata/" target="_blank" aria-label="LinkedIn" class="hover:text-maroon-700"><i class="bx bxl-linkedin-square"></i></a>
                    <a href="https://instagram.com/haifanidaofficial" target="_blank" aria-label="Instagram" class="hover:text-maroon-700"><i class="bx bxl-instagram"></i></a>
                </div>
                @guest
                    <x-button href="/login" variant="primary">Login <i class="bx bx-chevron-right"></i></x-button>
                @endguest
                @auth
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" @click.outside="open = false" class="block">
                            <img
                                src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : asset('storage/user-photo/not-found.jpg') }}"
                                alt="Profile" class="h-10 w-10 rounded-full object-cover ring-2 ring-maroon-200">
                        </button>
                        <div x-show="open" x-transition x-cloak
                            class="absolute right-0 top-full z-10 mt-2 w-48 rounded-lg border border-cream-200 bg-cream-50 p-2 shadow-lg">
                            @can('admin')
                                <a href="/admin/profile" class="block rounded-md px-3 py-2 text-sm text-stone-700 hover:bg-maroon-50">Profile</a>
                            @endcan
                            @can('member')
                                <a href="/member/profile" class="block rounded-md px-3 py-2 text-sm text-stone-700 hover:bg-maroon-50">Profile</a>
                                <a href="{{ route('member.riwayat-perjalanan') }}" class="block rounded-md px-3 py-2 text-sm text-stone-700 hover:bg-maroon-50">Riwayat Perjalanan</a>
                            @endcan
                            <a href="/logout" class="block rounded-md px-3 py-2 text-sm text-stone-700 hover:bg-maroon-50">Logout</a>
                        </div>
                    </div>
                @endauth
            </div>

            {{-- Mobile toggle --}}
            <button @click="mobileOpen = !mobileOpen" :aria-expanded="mobileOpen ? 'true' : 'false'" aria-controls="mobile-menu"
                aria-label="Buka menu navigasi" class="lg:hidden rounded-lg p-2 text-maroon-800 hover:bg-maroon-50">
                <i class="bx" :class="mobileOpen ? 'bx-x' : 'bx-menu'" style="font-size: 1.75rem;" aria-hidden="true"></i>
            </button>
        </div>

        {{-- Reading-progress thread: absolutely positioned so it adds zero
             height; starts scale-x-0 so it's invisible without JS. --}}
        <div data-nav-progress class="absolute bottom-0 left-0 h-0.5 w-full origin-left scale-x-0 bg-linear-to-r from-cream-500 via-cream-400 to-maroon-700"></div>

        {{-- Mobile menu --}}
        <div id="mobile-menu" x-show="mobileOpen" x-cloak x-transition class="border-t border-cream-200 bg-cream-50 lg:hidden">
            <div class="space-y-1 px-4 py-3">
                <a href="/" class="block rounded-md px-3 py-2 text-sm font-medium text-stone-700 hover:bg-maroon-50">Beranda</a>
                <a href="/umroh" class="block rounded-md px-3 py-2 text-sm text-stone-700 hover:bg-maroon-50">Umroh</a>
                <a href="/haji" class="block rounded-md px-3 py-2 text-sm text-stone-700 hover:bg-maroon-50">Haji</a>
                <a href="/wisata-halal" class="block rounded-md px-3 py-2 text-sm text-stone-700 hover:bg-maroon-50">Wisata Halal</a>
                <a href="/galeri" class="block rounded-md px-3 py-2 text-sm text-stone-700 hover:bg-maroon-50">Galeri &amp; Testimoni</a>
                <a href="/profil" class="block rounded-md px-3 py-2 text-sm text-stone-700 hover:bg-maroon-50">Profil</a>
                <a href="/kontak-kami" class="block rounded-md px-3 py-2 text-sm text-stone-700 hover:bg-maroon-50">Kontak Kami</a>
                <a href="/faq" class="block rounded-md px-3 py-2 text-sm text-stone-700 hover:bg-maroon-50">FAQ</a>
                @auth
                    <a href="{{ route('member.daftar-keberangkatan') }}" class="block rounded-md px-3 py-2 text-sm text-stone-700 hover:bg-maroon-50">Daftar Keberangkatan</a>
                    <a href="/logout" class="block rounded-md px-3 py-2 text-sm text-stone-700 hover:bg-maroon-50">Logout</a>
                @else
                    <a href="/login" class="block rounded-md bg-maroon-700 px-3 py-2 text-sm font-medium text-cream-50">Login</a>
                @endauth
            </div>
        </div>
    </nav>
</header>

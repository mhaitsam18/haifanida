@extends('agen.layouts.app')

@section('content')
    <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
        <h1 class="text-xl font-bold text-maroon-900">Selamat datang, {{ auth()->user()->name }}</h1>
        <span class="rounded-lg border border-cream-300 bg-cream-50 px-3 py-1.5 text-sm text-stone-600">
            {{ now()->translatedFormat('d F Y') }}
        </span>
    </div>

    @if (! $agen)
        <x-card>
            <p class="text-sm text-stone-500">Akun Anda belum terhubung ke data agen. Hubungi admin untuk mengaktifkan akses agen Anda.</p>
        </x-card>
    @else
        @if ($agen->kode_referral)
            <x-card class="mb-4">
                <h3 class="mb-1 text-sm font-semibold text-stone-600">Kode Referral Anda</h3>
                <p class="text-sm text-stone-500">Bagikan kode ini agar calon jemaah mendapat atribusi ke Anda saat mendaftar.</p>
                <div class="mt-2 flex items-center gap-2">
                    <code class="rounded-lg bg-cream-100 px-3 py-2 text-lg font-bold tracking-wide text-maroon-800">{{ $agen->kode_referral }}</code>
                </div>
            </x-card>
        @endif

        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
            <x-card>
                <h3 class="mb-2 text-sm font-semibold text-stone-600">Jema'ah yang Ditangani</h3>
                <p class="text-2xl font-bold text-maroon-900">{{ $jumlahJemaah }}</p>
            </x-card>
            <x-card>
                <h3 class="mb-2 text-sm font-semibold text-stone-600">Jumlah Pemesanan</h3>
                <p class="text-2xl font-bold text-maroon-900">{{ $jumlahPemesanan }}</p>
            </x-card>
            <x-card>
                <h3 class="mb-2 text-sm font-semibold text-stone-600">Total Poin / Komisi</h3>
                <p class="text-2xl font-bold text-maroon-900">{{ $totalPoin }}</p>
            </x-card>
        </div>

        <div class="mt-4">
            <x-card title="Pemasukan Per Bulan (Tahun Ini)">
                <div id="pemasukanChart"></div>
            </x-card>
        </div>
    @endif
@endsection

@section('script')
    @if ($agen)
        <script src="https://cdn.jsdelivr.net/npm/apexcharts@3"></script>
        <script>
            const bulanSingkat = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
            const pemasukanData = {!! json_encode($pemasukanPerBulan) !!};
            new ApexCharts(document.querySelector('#pemasukanChart'), {
                chart: { type: 'bar', height: 300, toolbar: { show: false } },
                plotOptions: { bar: { borderRadius: 4, columnWidth: '50%' } },
                colors: ['#800020'],
                series: [{ name: 'Pemasukan', data: pemasukanData.map(item => item.total) }],
                xaxis: { type: 'category', categories: pemasukanData.map(item => bulanSingkat[item.month - 1]) },
            }).render();
        </script>
    @endif
@endsection

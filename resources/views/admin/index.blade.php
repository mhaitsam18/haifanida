@extends('admin.layouts.app')

@section('content')
    @php
        use Carbon\Carbon;

        $trendClass = fn($v) => $v > 0 ? 'text-emerald-600' : ($v < 0 ? 'text-red-600' : 'text-maroon-700');
        $trendIcon = fn($v) => $v > 0 ? 'bx-up-arrow-alt' : ($v < 0 ? 'bx-down-arrow-alt' : 'bx-right-arrow-alt');
    @endphp

    <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
        <h1 class="text-xl font-bold text-maroon-900">Selamat datang di Dashboard</h1>
        <span class="rounded-lg border border-cream-300 bg-cream-50 px-3 py-1.5 text-sm text-stone-600">
            {{ Carbon::now()->translatedFormat('d F Y') }}
        </span>
    </div>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
        <x-card>
            <h3 class="mb-2 text-sm font-semibold text-stone-600">Jema'ah yang mendaftar Bulan Ini</h3>
            <div class="flex items-end justify-between gap-3">
                <div>
                    <p class="text-2xl font-bold text-maroon-900">{{ $jemaah_daftar_bulan_ini }}</p>
                    <p class="mt-1 flex items-center gap-1 text-sm {{ $trendClass($persentase_peningkatan) }}">
                        <i class="bx {{ $trendIcon($persentase_peningkatan) }}"></i>
                        {{ $persentase_peningkatan }}%
                    </p>
                </div>
                <div id="jemaahsChart" class="w-1/2"></div>
            </div>
        </x-card>

        <x-card>
            <h3 class="mb-2 text-sm font-semibold text-stone-600">Jumlah Keberangkatan Bulan Ini</h3>
            <div class="flex items-end justify-between gap-3">
                <div>
                    <p class="text-2xl font-bold text-maroon-900">{{ $jumlah_keberangkatan_bulan_ini }}</p>
                    <p class="mt-1 flex items-center gap-1 text-sm {{ $trendClass($selisih_keberangkatan) }}">
                        <i class="bx {{ $trendIcon($selisih_keberangkatan) }}"></i>
                        {{ $selisih_keberangkatan }}
                    </p>
                </div>
                <div id="keberangkatanChart" class="w-1/2"></div>
            </div>
        </x-card>

        <x-card>
            <h3 class="mb-2 text-sm font-semibold text-stone-600">Jumlah Transaksi Bulan Ini</h3>
            <div class="flex items-end justify-between gap-3">
                <div>
                    <p class="text-lg font-bold text-maroon-900">Rp{{ number_format($jumlah_transaksi_bulan_ini, 0, ',', '.') }}</p>
                    <p class="mt-1 flex items-center gap-1 text-sm {{ $trendClass($kenaikan_persentase) }}">
                        <i class="bx {{ $trendIcon($kenaikan_persentase) }}"></i>
                        {{ $kenaikan_persentase }}%
                    </p>
                </div>
                <div id="transaksiChart" class="w-1/2"></div>
            </div>
        </x-card>
    </div>

    <div class="mt-4">
        <x-card title="Jema'ah Per Keberangkatan">
            <div id="jemaahChart"></div>
        </x-card>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3"></script>
    <script>
        const maroon = '#800020';
        const bulanSingkat = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

        @if (isset($jemaah_per_bulan))
            const jemaahsData = {!! json_encode($jemaah_per_bulan) !!};
            if (document.querySelector('#jemaahsChart')) {
                new ApexCharts(document.querySelector('#jemaahsChart'), {
                    chart: { type: 'line', height: 60, sparkline: { enabled: true } },
                    series: [{ name: 'Jumlah Jemaah', data: jemaahsData.map(item => item.jumlah_jemaah) }],
                    xaxis: { type: 'category', categories: jemaahsData.map(item => bulanSingkat[item.month - 1]) },
                    stroke: { width: 2, curve: 'smooth' },
                    markers: { size: 0 },
                    colors: [maroon],
                }).render();
            }
        @endif

        @if (isset($jumlah_keberangkatan_per_bulan))
            const keberangkatanData = {!! json_encode($jumlah_keberangkatan_per_bulan) !!};
            if (document.querySelector('#keberangkatanChart')) {
                new ApexCharts(document.querySelector('#keberangkatanChart'), {
                    chart: { type: 'bar', height: 60, sparkline: { enabled: true } },
                    plotOptions: { bar: { borderRadius: 2, columnWidth: '60%' } },
                    colors: [maroon],
                    series: [{ name: 'Jumlah Keberangkatan', data: keberangkatanData.map(item => item.jumlah_keberangkatan) }],
                    xaxis: { type: 'category', categories: keberangkatanData.map(item => bulanSingkat[item.month - 1]) },
                }).render();
            }
        @endif

        @if (isset($jumlah_transaksi_per_bulan))
            const transaksiData = {!! json_encode($jumlah_transaksi_per_bulan) !!};
            if (document.querySelector('#transaksiChart')) {
                new ApexCharts(document.querySelector('#transaksiChart'), {
                    chart: { type: 'line', height: 60, sparkline: { enabled: true } },
                    series: [{ name: 'Jumlah Transaksi', data: transaksiData.map(item => item.jumlah_transaksi) }],
                    xaxis: { type: 'category', categories: transaksiData.map(item => bulanSingkat[item.month - 1]) },
                    stroke: { width: 2, curve: 'smooth' },
                    markers: { size: 0 },
                    colors: [maroon],
                }).render();
            }
        @endif

        @if (isset($total_jemaah_per_paket_tahun_ini))
            const jemaahChartData = {!! json_encode($total_jemaah_per_paket_tahun_ini) !!};
            const paketData = {!! json_encode($paket_tahun_ini) !!};
            if (document.querySelector('#jemaahChart')) {
                new ApexCharts(document.querySelector('#jemaahChart'), {
                    chart: { type: 'line', height: 350, parentHeightOffset: 0, toolbar: { show: false } },
                    colors: [maroon],
                    series: [{ name: 'Total Jemaah', data: jemaahChartData.map(item => item.total_jemaah) }],
                    xaxis: {
                        type: 'datetime',
                        categories: paketData.map(item => item.tanggal_mulai),
                    },
                    yaxis: {
                        title: { text: "Jumlah jema'ah" },
                        min: 0,
                        labels: { formatter: (val) => val.toFixed(0) },
                    },
                    markers: { size: 0 },
                    stroke: { width: 2, curve: 'straight' },
                }).render();
            }
        @endif
    </script>
@endsection

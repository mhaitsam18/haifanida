@extends('admin.layouts.app')

@section('content')
    @php
        use Carbon\Carbon;
    @endphp

    <x-page-header :title="$title">
        <x-slot:actions>
            <x-button :href="'/admin/paket/' . $paket->id . '/jemaah/create'"><i class="bx bx-plus"></i> Tambah</x-button>
            <button type="button" onclick="printContent()" class="inline-flex items-center gap-1.5 rounded-lg border border-cream-300 bg-white px-4 py-2 text-sm font-medium text-stone-700 hover:bg-cream-50">
                <i class="bx bx-printer"></i> Print
            </button>
            <x-button variant="secondary" :href="'/admin/paket/' . $paket->id"><i class="bx bx-arrow-back"></i> Kembali</x-button>
        </x-slot:actions>
    </x-page-header>

    <div id="konten-yang-ingin-dicetak">
        <p class="mb-4 text-center font-display text-lg font-semibold text-maroon-900">
            Data Jema'ah Keberangkatan {{ Carbon::parse($paket->tanggal_mulai)->isoFormat('LL') }}
        </p>

        <x-data-table searchPlaceholder="Cari jemaah...">
            <table class="w-full text-left text-sm">
                <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                    <tr>
                        <th class="px-4 py-3">#</th>
                        <th class="px-4 py-3">Nama Lengkap</th>
                        <th class="px-4 py-3">Email</th>
                        <th class="px-4 py-3">Nomor Ponsel</th>
                        <th class="px-4 py-3">Foto</th>
                        <th class="px-4 py-3 aksi-kolom">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-cream-200">
                    @foreach ($jemaahs as $jemaah)
                        <tr x-show="q === '' || $el.innerText.toLowerCase().includes(q.toLowerCase())">
                            <td class="px-4 py-3">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3 font-medium text-stone-800">{{ $jemaah->nama_lengkap }}</td>
                            <td class="px-4 py-3">{{ $jemaah->email }}</td>
                            <td class="px-4 py-3">{{ $jemaah->nomor_telepon }}</td>
                            <td class="px-4 py-3"><img src="{{ asset('storage/' . $jemaah->foto) }}" alt="Foto" class="h-12 w-12 rounded-lg object-cover"></td>
                            <td class="px-4 py-3 aksi-kolom">
                                <div class="flex items-center gap-2">
                                    <a href="/admin/paket/{{ $paket->id }}/jemaah/{{ $jemaah->id }}" class="rounded-md bg-maroon-50 px-2.5 py-1 text-xs font-medium text-maroon-700 hover:bg-maroon-100">Detail</a>
                                    <a href="/admin/paket/{{ $paket->id }}/jemaah/{{ $jemaah->id }}/edit" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</a>
                                    <x-delete-form :action="'/admin/jemaah/' . $jemaah->id" />
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-data-table>
    </div>
@endsection

@section('script')
    <style>
        @media print {
            .aksi-kolom {
                display: none !important;
            }
        }
    </style>
    <script>
        function printContent() {
            var printContents = document.getElementById("konten-yang-ingin-dicetak").cloneNode(true);

            var rows = printContents.querySelectorAll('tbody tr');
            rows.forEach(function(row) {
                var actionCell = row.querySelector('td:last-child');
                if (actionCell) {
                    actionCell.style.display = 'none';
                }
            });
            var headRows = printContents.querySelectorAll('thead tr');
            headRows.forEach(function(row) {
                var actionCell = row.querySelector('th:last-child');
                if (actionCell) {
                    actionCell.style.display = 'none';
                }
            });

            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents.outerHTML;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
@endsection

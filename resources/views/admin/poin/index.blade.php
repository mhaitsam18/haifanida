@extends('admin.layouts.app')

@section('content')
    @php use Carbon\Carbon; @endphp

    <div x-data="modalForm()">
        <x-page-header :title="$title">
            <x-slot:actions>
                <button type="button" @click="show()" class="inline-flex items-center gap-1.5 rounded-lg bg-maroon-700 px-4 py-2 text-sm font-semibold text-cream-50 hover:bg-maroon-800">
                    <i class="bx bx-plus"></i> Tambah Penyesuaian
                </button>
            </x-slot:actions>
        </x-page-header>

        <x-modal title="Tambah Penyesuaian Poin" maxWidth="max-w-2xl">
            <form action="{{ route('admin.poin.store') }}" method="post" @submit="submit">
                @csrf

                <div class="mb-4">
                    <label for="user_id" class="mb-1.5 block text-sm font-medium text-stone-700">Agen</label>
                    <select id="user_id" name="user_id"
                        class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                        <option value="" selected disabled>Pilih Agen</option>
                        @foreach ($agens as $agen)
                            <option value="{{ $agen->user_id }}">{{ $agen->user->name ?? '-' }}</option>
                        @endforeach
                    </select>
                    <x-form-error name="user_id" />
                </div>

                <x-form-input label="Jumlah Poin (boleh negatif untuk pengurangan)" name="jumlah_poin" type="number" placeholder="Jumlah Poin" />
                <x-form-error name="jumlah_poin" />

                <x-form-textarea label="Keterangan" name="keterangan" placeholder="Alasan penyesuaian poin" />
                <x-form-error name="keterangan" />

                <div class="mt-4 flex justify-end gap-2">
                    <x-button type="button" variant="secondary" @click="hide()">Batal</x-button>
                    <x-button type="submit">
                        <span x-show="!submitting">Simpan</span>
                        <span x-show="submitting">Menyimpan...</span>
                    </x-button>
                </div>
            </form>
        </x-modal>
    </div>

    <x-data-table searchPlaceholder="Cari poin...">
        <table class="w-full text-left text-sm">
            <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                <tr>
                    <th class="px-4 py-3">Tanggal</th>
                    <th class="px-4 py-3">Agen</th>
                    <th class="px-4 py-3">Tipe</th>
                    <th class="px-4 py-3">Keterangan</th>
                    <th class="px-4 py-3 text-right">Jumlah Poin</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-cream-200">
                @forelse ($poins as $poin)
                    <tr x-show="q === '' || $el.innerText.toLowerCase().includes(q.toLowerCase())">
                        <td class="px-4 py-3">{{ Carbon::parse($poin->created_at)->isoFormat('LL') }}</td>
                        <td class="px-4 py-3 font-medium text-stone-800">{{ $poin->user->name ?? '-' }}</td>
                        <td class="px-4 py-3"><x-badge variant="brand">{{ $poin->tipe }}</x-badge></td>
                        <td class="px-4 py-3">{{ $poin->keterangan ?? '-' }}</td>
                        <td class="px-4 py-3 text-right font-semibold {{ $poin->jumlah_poin >= 0 ? 'text-emerald-700' : 'text-red-700' }}">
                            {{ $poin->jumlah_poin >= 0 ? '+' : '' }}{{ $poin->jumlah_poin }}
                        </td>
                        <td class="px-4 py-3">
                            <x-delete-form :action="route('admin.poin.destroy', $poin->id)" />
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-3 text-stone-500">Belum ada data poin.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </x-data-table>

    <div class="mt-4">{{ $poins->links() }}</div>
@endsection

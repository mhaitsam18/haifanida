@extends('layouts.app')

@section('content')
    <section class="py-10">
        <div class="mx-auto max-w-5xl px-4">
            <div class="mb-6 flex flex-wrap items-center justify-between gap-4">
                <h2 class="font-display text-2xl font-semibold text-maroon-900">Permintaan Kamar</h2>
                <div class="flex gap-2">
                    <x-button href="/tambah-permintaan">
                        <i class="bx bx-plus-circle"></i> Tambah
                    </x-button>
                    <x-button variant="secondary" href="{{ url()->previous() }}">
                        <i class="bx bx-arrow-back"></i> Kembali
                    </x-button>
                </div>
            </div>

            <div class="overflow-x-auto rounded-2xl border border-cream-200 bg-cream-50 shadow-sm">
                <table class="w-full text-left text-sm">
                    <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                        <tr>
                            <th class="px-4 py-3">#</th>
                            <th class="px-4 py-3">Permintaan</th>
                            <th class="px-4 py-3">Tambahan Harga</th>
                            <th class="px-4 py-3">Keterangan</th>
                            <th class="px-4 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-cream-200">
                        <tr>
                            <td class="px-4 py-3">1</td>
                            <td class="px-4 py-3">Kamar View Kakbah</td>
                            <td class="px-4 py-3">Rp 5.000.000</td>
                            <td class="px-4 py-3 text-stone-500">&mdash;</td>
                            <td class="px-4 py-3">
                                <div class="flex gap-2">
                                    <x-button variant="secondary" href="#" class="px-3! py-1.5! text-xs">
                                        <i class="bx bx-edit"></i> Edit
                                    </x-button>
                                    <button class="rounded-md bg-red-50 px-2.5 py-1 text-xs font-medium text-red-700 hover:bg-red-100">
                                        <i class="bx bx-trash"></i> Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection

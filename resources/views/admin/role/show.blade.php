@extends('admin.layouts.app')

@section('content')
    <x-page-header :title="$title">
        <x-slot:actions>
            <x-button variant="secondary" href="/admin/role"><i class="bx bx-arrow-back"></i> Kembali</x-button>
        </x-slot:actions>
    </x-page-header>

    <div x-data="{ saved: false }" @permission-saved.window="saved = true; setTimeout(() => saved = false, 2000)" class="relative">
        <div x-show="saved" x-transition x-cloak class="absolute right-0 top-0 z-10 rounded-lg bg-emerald-100 px-3 py-1.5 text-xs font-medium text-emerald-800">
            <i class="bx bx-check"></i> Tersimpan
        </div>

        <div class="overflow-x-auto rounded-2xl border border-cream-200 bg-cream-50 shadow-sm">
            <table class="w-full text-left text-sm">
                <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                    <tr>
                        <th class="px-4 py-3">#</th>
                        <th class="px-4 py-3">Menu</th>
                        <th class="px-4 py-3 text-center">Dapat Melihat</th>
                        <th class="px-4 py-3 text-center">Dapat Mengedit</th>
                        <th class="px-4 py-3 text-center">Dapat Menghapus</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-cream-200">
                    @foreach ($menus as $menu)
                        <tr data-menu-id="{{ $menu->id }}">
                            <td class="px-4 py-3">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3 font-medium text-stone-800">{{ $menu->menu }}</td>
                            <td class="px-4 py-3 text-center">
                                <input type="checkbox" class="permission-toggle rounded text-maroon-700 focus:ring-maroon-400" data-name="can_view"
                                    value="{{ $menu->id }}" @checked($menu->menuRoles()->where(['role_id' => $role->id, 'can_view' => 1])->exists())>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <input type="checkbox" class="permission-toggle rounded text-maroon-700 focus:ring-maroon-400" data-name="can_edit"
                                    value="{{ $menu->id }}" @checked($menu->menuRoles()->where(['role_id' => $role->id, 'can_edit' => 1])->exists())>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <input type="checkbox" class="permission-toggle rounded text-maroon-700 focus:ring-maroon-400" data-name="can_delete"
                                    value="{{ $menu->id }}" @checked($menu->menuRoles()->where(['role_id' => $role->id, 'can_delete' => 1])->exists())>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.permission-toggle').forEach(function (checkbox) {
                checkbox.addEventListener('change', function () {
                    const menuId = this.value;
                    const roleId = {{ $role->id }};
                    const checkboxName = this.dataset.name;

                    const dataToSend = {
                        menu_id: menuId,
                        role_id: roleId,
                        [checkboxName]: this.checked ? 1 : 0,
                    };

                    fetch('{{ route('admin.menu_roles.store') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        body: JSON.stringify(dataToSend),
                    })
                        .then(response => response.json())
                        .then(() => {
                            window.dispatchEvent(new CustomEvent('permission-saved'));
                        })
                        .catch(error => console.error('Error saving permissions.', error));
                });
            });
        });
    </script>
@endsection

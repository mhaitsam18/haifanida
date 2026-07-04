@extends('admin.layouts.app')

@section('content')
    <x-page-header :title="$title" />

    <x-card class="lg:w-1/2">
        <form action="/admin/role/{{ $role->id }}" method="post">
            @method('put')
            @csrf
            <x-form-input label="Role" name="role" :value="old('role', $role->role)" placeholder="Role" />

            <div class="flex justify-end gap-2">
                <x-button variant="secondary" href="/admin/role">Kembali</x-button>
                <x-button type="submit">Simpan</x-button>
            </div>
        </form>
    </x-card>
@endsection

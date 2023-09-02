@extends('adminlte::page')

@section('title', 'Edit Kontak')

@section('content_header')
    <h1>Edit Kontak</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.kontak.update', $kontak->key) }}" method="post">
                        @method('put')
                        @csrf

                        <x-adminlte-input name="key" label="Nama Kontak" error-key="key" enable-old-support="true" value="{{ $kontak->key }}"></x-adminlte-input>
                        <x-adminlte-input name="value" label="Nilai Kontak" error-key="value" enable-old-support="true" value="{{ $kontak->value }}"></x-adminlte-input>

                        <div>
                            <x-adminlte-button label="Kirim" theme="primary" type="submit" icon="fas fa-paper-plane mr-2"></x-adminlte-button>
                            <a href="{{ route('admin.kontak.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times mr-2"></i>
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

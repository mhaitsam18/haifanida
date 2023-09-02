@extends('adminlte::page')

@section('title', 'Buat FAQ')

@section('content_header')
    <h1>Buat FAQ</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.faq.store') }}" method="post">
                        @csrf

                        <x-adminlte-input name="pertanyaan" label="Pertanyaan yang sering ditanyakan" error-key="pertanyaan" enable-old-support="true"></x-adminlte-input>
                        <x-adminlte-textarea name="jawaban" label="Jawaban" error-key="jawaban" enable-old-support="true" rows="4"></x-adminlte-textarea>

                        <div>
                            <x-adminlte-button label="Kirim" theme="primary" type="submit" icon="fas fa-paper-plane mr-2"></x-adminlte-button>
                            <a href="{{ route('admin.faq.index') }}" class="btn btn-secondary">
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

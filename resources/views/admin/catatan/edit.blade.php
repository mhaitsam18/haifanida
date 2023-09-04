@extends('adminlte::page')

@section('title', 'Edit Catatan')

@section('content_header')
    <h1>Edit Catatan</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.catatan.update', $catatan[0]->kategori->id) }}" method="POST" id="update-catatan">
                        @method('PUT')
                        @csrf

                        <x-adminlte-input name="kategori" class="mb-4" label="Judul Catatan" error-key="kategori" enable-old-support="true" value="{{ $catatan[0]->kategori->nama }}" required></x-adminlte-input>

                        <strong>Daftar:</strong>
                        <div id="container-input">
                            @foreach ($catatan as $c)
                                <div class="form-group mb-1 input-lama" id="input-{{ $loop->iteration }}">
                                    <div class="row">
                                        <div class="col-md-11">
                                            <input type="text" name="catatan[]" class="form-control @error('catatan][]') is-invalid @enderror" value="{{ old('catatan[]', $c->catatan) }}">
                                        </div>
                                        <div class="col-md-1">
                                            <button type="button" class="btn btn-default text-danger" title="Hapus field ini" data-no="{{ $loop->iteration }}" onclick="hapusField(this)">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="form-group mt-4">
                            <button type="button" class="btn btn-default" id="btn-tambah-catatan">
                                <i class="fas fa-plus mr-2"></i>
                                Tambah Catatan
                            </button>
                        </div>
                        {{-- <div class="mt-4">
                        </div> --}}
                    </form>
                </div>
                <div class="card-footer">
                    <x-adminlte-button label="Kirim" theme="primary" type="submit" icon="fas fa-paper-plane mr-2" form="update-catatan"></x-adminlte-button>
                    <a href="{{ route('admin.catatan.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times mr-2"></i>
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </div>

    <template id="input-baru-template">
        <div class="form-group mb-1" id="input-#">
            <div class="row">
                <div class="col-md-11">
                    <input type="text" name="catatan[]" class="form-control">
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-default text-danger" title="Hapus field ini" data-no="#" onclick="hapusField(this)">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>
    </template>
@stop

@section('js')
    <script>
        let jml_data_baru = document.getElementsByClassName('input-lama').length;
        const btnTambah = document.getElementById('btn-tambah-catatan');

        btnTambah.onclick = () => {
            jml_data_baru++;

            const template = document.getElementById('input-baru-template');

            const clone = template.content.cloneNode(true);

            const form_group = clone.querySelectorAll('.form-group')[0];
            form_group.setAttribute('id', 'input-' + jml_data_baru);

            let btn_hapus = clone.querySelectorAll('button')[0];
            btn_hapus.setAttribute('data-no', jml_data_baru);

            const container = document.getElementById('container-input');
            container.append(clone);
        }

		function hapusField(el) {
			const idx = el.getAttribute('data-no');

			const input_baru = document.getElementById('input-' + idx);
			input_baru.remove();
		}

        @if (request()->session()->has('alert'))
            Swal.fire({
                icon: '{{ session('alert-class') }}',
                title: '{{ session('alert')[0] }}',
                text: '{{ session('alert')[1] }}',
            });
        @endif
    </script>
@endsection

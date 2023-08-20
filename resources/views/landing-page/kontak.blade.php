@extends('layouts.landing-page')

@section('title', 'Kontak')

@section('banner', '/img/image.png')

@section('h1', 'Kontak Kami')
{{-- @section('sub-h1', 'Sub Header H1') --}}

@section('content')
    <section class="module">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @foreach ($kontak as $k)
                    <div class="mb-3">
                        <h4 class="mb-0 font-alt">{{ $k->key }}</h4>
                        <p>{{ $k->value }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection

@section('css')

@endsection

@section('js')

@endsection

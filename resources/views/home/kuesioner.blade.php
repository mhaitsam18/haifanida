@extends('layouts.main')

@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    <div class="inner-banner">
        <div class="container">
            <div class="inner-title text-center">
                <h3>{{ $title }}</h3>
                <ul>
                    <li>
                        <a href="/">Beranda</a>
                    </li>
                    <li>
                        <i class='bx bx-chevrons-right'></i>
                    </li>
                    <li>{{ $title }}</li>
                </ul>
            </div>
        </div>
        <div class="inner-shape">
            <img src="/assets-techex-demo/images/shape/inner-shape.png" alt="Images">
        </div>
    </div>

    {{-- <div class="about-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    
                    <div class="" style="min-height: 1000px;">
                        <iframe
                            src="https://docs.google.com/forms/d/e/1FAIpQLSdhyNI6HqR7KCJZrfZ4pSDYisUMrnNJ7uj4cPlgghP00YR33A/viewform?embedded=true"
                            style="width: 100%; height: 1200px; border: none; background-color: #F2E6E6;" height="9025"
                            frameborder="0" marginheight="0" marginwidth="0">Memuat…</iframe>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

        <div class="about-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Embed Google Form -->
                    <div class="form-wrapper">
                        <iframe
                            src="https://docs.google.com/forms/d/e/1FAIpQLSdhyNI6HqR7KCJZrfZ4pSDYisUMrnNJ7uj4cPlgghP00YR33A/viewform?embedded=true"
                            style="width: 100%; min-height: 800px; border: none;" 
                            frameborder="0" 
                            marginheight="0" 
                            marginwidth="0"
                            class="form-iframe"
                        >Memuat…</iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection

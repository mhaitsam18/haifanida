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
                        <a href="/home">Home</a>
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


    <section class="services-widget-area pt-100 pb-70">
        <div class="container">
            <div class="section-title text-center">
                <span class="sp-color2">Our Services</span>
                <h2>We Provide a Wide Variety of It Services</h2>
            </div>
            <div class="row pt-45">
                <div class="col-lg-4 col-md-6">
                    <div class="services-item">
                        <a href="service-details.html">
                            <img src="/assets-techex-demo/images/services/services-img1.jpg" alt="Images" loading="lazy">
                        </a>
                        <div class="content">
                            <i class="flaticon-consultant"></i>
                            <span><a href="service-details.html">IT Solution</a></span>
                            <h3><a href="service-details.html">IT Consulting</a></h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="services-item">
                        <a href="service-details.html">
                            <img src="/assets-techex-demo/images/services/services-img2.jpg" alt="Images" loading="lazy">
                        </a>
                        <div class="content">
                            <i class="flaticon-consulting"></i>
                            <span><a href="service-details.html">Cloud Services</a></span>
                            <h3><a href="service-details.html">Cloud Computing</a></h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="services-item">
                        <a href="service-details.html">
                            <img src="/assets-techex-demo/images/services/services-img3.jpg" alt="Images" loading="lazy">
                        </a>
                        <div class="content">
                            <i class="flaticon-web-development"></i>
                            <span><a href="service-details.html">Web Services</a></span>
                            <h3><a href="service-details.html">Web Development</a></h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="services-item">
                        <a href="service-details.html">
                            <img src="/assets-techex-demo/images/services/services-img4.jpg" alt="Images" loading="lazy">
                        </a>
                        <div class="content">
                            <i class="flaticon-stats"></i>
                            <span><a href="service-details.html">Business</a></span>
                            <h3><a href="service-details.html">Business Reform</a></h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="services-item">
                        <a href="service-details.html">
                            <img src="/assets-techex-demo/images/services/services-img5.jpg" alt="Images" loading="lazy">
                        </a>
                        <div class="content">
                            <i class="flaticon-structure"></i>
                            <span><a href="service-details.html">Planing</a></span>
                            <h3><a href="service-details.html">Infrastructure</a></h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="services-item">
                        <a href="service-details.html">
                            <img src="/assets-techex-demo/images/services/services-img6.jpg" alt="Images" loading="lazy">
                        </a>
                        <div class="content">
                            <i class="flaticon-data-analytics"></i>
                            <span><a href="service-details.html">Analysis</a></span>
                            <h3><a href="service-details.html">Data Analysis</a></h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 text-center">
                    <div class="pagination-area">
                        <a href="services-1.html" class="prev page-numbers">
                            <i class='bx bx-left-arrow-alt'></i>
                        </a>
                        <span class="page-numbers current" aria-current="page">1</span>
                        <a href="services-1.html" class="page-numbers">2</a>
                        <a href="services-1.html" class="page-numbers">3</a>
                        <a href="services-1.html" class="next page-numbers">
                            <i class='bx bx-right-arrow-alt'></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

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
    <section class="content-area pt-30 pb-70">
        <div class="container">
            <div class="section-title text-center">
                <span class="sp-color2">Our Services</span>
                <h2>We Provide a Wide Variety of It Services</h2>
                <p class="margin-auto">
                    Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id
                    elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam
                    nec
                </p>
            </div>
            <div class="row pt-45">
                <div class="col-lg-3 col-sm-6">
                    <div class="services-card services-style-bg">
                        <i class="flaticon-consultant"></i>
                        <h3><a href="service-details.html">IT Consulting</a></h3>
                        <p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendauctor nisi
                            el.</p>
                        <a href="service-details.html" class="learn-btn">Learn More <i class='bx bx-chevron-right'></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="services-card services-style-bg">
                        <i class="flaticon-consulting"></i>
                        <h3><a href="service-details.html">Cloud Computing</a></h3>
                        <p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendauctor nisi
                            el.</p>
                        <a href="service-details.html" class="learn-btn">Learn More <i class='bx bx-chevron-right'></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="services-card services-style-bg">
                        <i class="flaticon-web-development"></i>
                        <h3><a href="service-details.html">Web Development</a></h3>
                        <p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendauctor nisi
                            el. </p>
                        <a href="service-details.html" class="learn-btn">Learn More <i class='bx bx-chevron-right'></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="services-card services-style-bg">
                        <i class="flaticon-stats"></i>
                        <h3><a href="service-details.html">Business Reform</a></h3>
                        <p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendauctor nisi
                            el.</p>
                        <a href="service-details.html" class="learn-btn">Learn More <i class='bx bx-chevron-right'></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="services-card services-style-bg">
                        <i class="flaticon-structure"></i>
                        <h3><a href="service-details.html">Infrastructure</a></h3>
                        <p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendauctor nisi
                            el.</p>
                        <a href="service-details.html" class="learn-btn">Learn More <i class='bx bx-chevron-right'></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="services-card services-style-bg">
                        <i class="flaticon-data-analytics"></i>
                        <h3><a href="service-details.html">Data Analysis</a></h3>
                        <p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendauctor nisi
                            el.</p>
                        <a href="service-details.html" class="learn-btn">Learn More <i class='bx bx-chevron-right'></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="services-card services-style-bg">
                        <i class="flaticon-computer"></i>
                        <h3><a href="service-details.html">Manage IT Service</a></h3>
                        <p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendauctor nisi
                            el.</p>
                        <a href="service-details.html" class="learn-btn">Learn More <i class='bx bx-chevron-right'></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="services-card services-style-bg">
                        <i class="flaticon-cyber-security"></i>
                        <h3><a href="service-details.html">Business Security</a></h3>
                        <p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendauctor nisi
                            el.</p>
                        <a href="service-details.html" class="learn-btn">Learn More <i class='bx bx-chevron-right'></i></a>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 text-center">
                    <div class="pagination-area">
                        <a href="services-2.html" class="prev page-numbers">
                            <i class='bx bx-left-arrow-alt'></i>
                        </a>
                        <span class="page-numbers current" aria-current="page">1</span>
                        <a href="services-2.html" class="page-numbers">2</a>
                        <a href="services-2.html" class="page-numbers">3</a>
                        <a href="services-2.html" class="next page-numbers">
                            <i class='bx bx-right-arrow-alt'></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

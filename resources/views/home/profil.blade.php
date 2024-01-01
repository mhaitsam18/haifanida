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
    <div class="about-area ptb-100">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="about-play">
                        <img src="/assets-techex-demo/images/about/about-img1.jpg" alt="About Images" loading="lazy">
                        <div class="about-play-content">
                            <span>Watch Our Intro Video</span>
                            <h2>Perfect Solution for It Services!</h2>
                            <div class="play-on-area">
                                <a href="https://www.youtube.com/watch?v=tUP5S4YdEJo" class="play-on popup-btn"><i
                                        class='bx bx-play'></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-content ml-25">
                        <div class="section-title">
                            <span class="sp-color2">15 Years of Experience</span>
                            <h2>Right Partner for Software Innovation</h2>
                            <p>
                                Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem
                                nibh id elit. Duis sed odio sit amet.
                            </p>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <ul class="about-list text-start">
                                    <li><i class='bx bxs-check-circle'></i>Cost of Supplies and Equipment</li>
                                    <li><i class='bx bxs-check-circle'></i>Bribed Autor Nisi Elit Volume</li>
                                    <li><i class='bx bxs-check-circle'></i>Cost of Supplies and Equipment</li>
                                </ul>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <ul class="about-list about-list-2 text-start">
                                    <li><i class='bx bxs-check-circle'></i>Change the Volume of Expected</li>
                                    <li><i class='bx bxs-check-circle'></i>Easy to Customer Services</li>
                                    <li><i class='bx bxs-check-circle'></i>Good Quality Products Services</li>
                                </ul>
                            </div>
                        </div>
                        <p class="about-content-text">Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat
                            ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet
                            mauris. Morbi accumsan ipsum velit.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="choose-area pt-100 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="choose-content mr-20">
                        <div class="section-title">
                            <span class="sp-color1">Why Choose Us</span>
                            <h2>We Provide Truly Prominent It Solutions.</h2>
                            <p>
                                Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem
                                nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan
                                ipsum auctor a ornare odio.
                            </p>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-6">
                                <div class="choose-content-card">
                                    <div class="content">
                                        <i class="flaticon-practice"></i>
                                        <h3>Experience</h3>
                                    </div>
                                    <p>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet</p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-6">
                                <div class="choose-content-card">
                                    <div class="content">
                                        <i class="flaticon-help"></i>
                                        <h3>Quick Support</h3>
                                    </div>
                                    <p>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="choose-img">
                        <img src="/assets-techex-demo/images/choose-img.jpg" alt="Images" loading="lazy">
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="security-area pt-100 pb-70">
        <div class="container">
            <div class="section-title text-center">
                <span class="sp-color2">IT Security & Computing</span>
                <h2>Searching for a Solution! We Provide Truly Prominent IT Solutions</h2>
            </div>
            <div class="row pt-45">
                <div class="col-lg-4 col-sm-6">
                    <div class="security-card">
                        <i class="flaticon-cyber-security"></i>
                        <h3><a href="case-details.html">Business Security</a></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam blandit scelerisque ullamcorper
                            proin scelerisque tortor odio.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="security-card">
                        <i class="flaticon-computer"></i>
                        <h3><a href="case-details.html">Manage IT Service</a></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam blandit scelerisque ullamcorper
                            proin scelerisque tortor odio.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="security-card">
                        <i class="flaticon-effective"></i>
                        <h3><a href="case-details.html">Product Analysis</a></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam blandit scelerisque ullamcorper
                            proin scelerisque tortor odio.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="security-card">
                        <i class="flaticon-implement"></i>
                        <h3><a href="case-details.html">Analytic Solution</a></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam blandit scelerisque ullamcorper
                            proin scelerisque tortor odio.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="security-card">
                        <i class="flaticon-consulting"></i>
                        <h3><a href="case-details.html">Finest Quality</a></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam blandit scelerisque ullamcorper
                            proin scelerisque tortor odio.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="security-card">
                        <i class="flaticon-consultant"></i>
                        <h3><a href="case-details.html">Risk Management</a></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam blandit scelerisque ullamcorper
                            proin scelerisque tortor odio.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="brand-area-two ptb-100">
        <div class="container">
            <div class="brand-slider owl-carousel owl-theme">
                <div class="brand-item">
                    <img src="/assets-techex-demo/images/brand-logo/brand-style1.png" alt="Images" loading="lazy">
                </div>
                <div class="brand-item">
                    <img src="/assets-techex-demo/images/brand-logo/brand-style2.png" alt="Images" loading="lazy">
                </div>
                <div class="brand-item">
                    <img src="/assets-techex-demo/images/brand-logo/brand-style3.png" alt="Images" loading="lazy">
                </div>
                <div class="brand-item">
                    <img src="/assets-techex-demo/images/brand-logo/brand-style4.png" alt="Images" loading="lazy">
                </div>
                <div class="brand-item">
                    <img src="/assets-techex-demo/images/brand-logo/brand-style5.png" alt="Images" loading="lazy">
                </div>
                <div class="brand-item">
                    <img src="/assets-techex-demo/images/brand-logo/brand-style3.png" alt="Images" loading="lazy">
                </div>
            </div>
        </div>
    </div>


    <div class="counter-area pt-100 pb-70">
        <div class="container">
            <div class="section-title text-center">
                <span class="sp-color2">Numbers Are Talking</span>
                <h2>Let’s Check Our Business Growth and Success Story</h2>
                <p>Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id
                    elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris Morbi accumsan ipsum velit. </p>
            </div>
            <div class="row pt-45">
                <div class="col-lg-3 col-6 col-md-3">
                    <div class="counter-another-content">
                        <i class="flaticon-web-development"></i>
                        <h3>4205+</h3>
                        <span>Delivered Goods</span>
                    </div>
                </div>
                <div class="col-lg-3 col-6 col-md-3">
                    <div class="counter-another-content">
                        <i class="flaticon-consulting-1"></i>
                        <h3>245+</h3>
                        <span>IT Consulting</span>
                    </div>
                </div>
                <div class="col-lg-3 col-6 col-md-3">
                    <div class="counter-another-content">
                        <i class="flaticon-startup"></i>
                        <h3>3550+</h3>
                        <span>Fully Launched</span>
                    </div>
                </div>
                <div class="col-lg-3 col-6 col-md-3">
                    <div class="counter-another-content">
                        <i class="flaticon-tick"></i>
                        <h3>6545+</h3>
                        <span>Project Completed</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="counter-shape">
            <div class="shape1">
                <img src="/assets-techex-demo/images/shape/shape1.png" alt="Images" loading="lazy">
            </div>
            <div class="shape2">
                <img src="/assets-techex-demo/images/shape/shape2.png" alt="Images" loading="lazy">
            </div>
        </div>
    </div>
@endsection

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

    <div class="blog-area pt-100 pb-70">
        <div class="container">
            <div class="section-title text-center">
                <span class="sp-color2">Paket Pilihan</span>
                <h2>Pilih Paket Haji Anda</h2>
            </div>
            <div class="row pt-45">
                <div class="col-lg-4 col-md-6">
                    <div class="blog-card">
                        <div class="blog-img">
                            <a href="blog-details.html">
                                <img src="/assets-techex-demo/images/blog/blog-img1.jpg" alt="Blog Images" loading="lazy">
                            </a>
                            <div class="blog-tag">
                                <h3>11</h3>
                                <span>Dec</span>
                            </div>
                        </div>
                        <div class="content">
                            <ul>
                                <li>
                                    <a href="blog-1.html"><i class='bx bxs-user'></i> By Admin</a>
                                </li>
                                <li>
                                    <a href="blog-1.html"><i class='bx bx-purchase-tag-alt'></i>Business</a>
                                </li>
                            </ul>
                            <h3>
                                <a href="blog-details.html">Product Idea Solution for New Generation</a>
                            </h3>
                            <p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum
                                auctor, nisi elit consequat ipsum.</p>
                            <a href="blog-details.html" class="read-btn">Read More <i class='bx bx-chevron-right'></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="blog-card">
                        <div class="blog-img">
                            <a href="blog-details.html">
                                <img src="/assets-techex-demo/images/blog/blog-img2.jpg" alt="Blog Images" loading="lazy">
                            </a>
                            <div class="blog-tag">
                                <h3>14</h3>
                                <span>Dec</span>
                            </div>
                        </div>
                        <div class="content">
                            <ul>
                                <li>
                                    <a href="blog-1.html"><i class='bx bxs-user'></i> By Admin</a>
                                </li>
                                <li>
                                    <a href="blog-1.html"><i class='bx bx-purchase-tag-alt'></i>Invention</a>
                                </li>
                            </ul>
                            <h3>
                                <a href="blog-details.html">New Device Invention for Digital Platform</a>
                            </h3>
                            <p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum
                                auctor, nisi elit consequat ipsum.</p>
                            <a href="blog-details.html" class="read-btn">Read More <i class='bx bx-chevron-right'></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 offset-lg-0 offset-md-3">
                    <div class="blog-card">
                        <div class="blog-img">
                            <a href="blog-details.html">
                                <img src="/assets-techex-demo/images/blog/blog-img3.jpg" alt="Blog Images" loading="lazy">
                            </a>
                            <div class="blog-tag">
                                <h3>17</h3>
                                <span>Dec</span>
                            </div>
                        </div>
                        <div class="content">
                            <ul>
                                <li>
                                    <a href="blog-1.html"><i class='bx bxs-user'></i> By Admin</a>
                                </li>
                                <li>
                                    <a href="blog-1.html"><i class='bx bx-purchase-tag-alt'></i>Achive</a>
                                </li>
                            </ul>
                            <h3>
                                <a href="blog-details.html">Business Strategy Make His Goal Acheive </a>
                            </h3>
                            <p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum
                                auctor, nisi elit consequat ipsum.</p>
                            <a href="blog-details.html" class="read-btn">Read More <i class='bx bx-chevron-right'></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

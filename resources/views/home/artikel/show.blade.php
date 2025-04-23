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
    <div class="blog-details-area pt-100 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="blog-article">
                        <div class="blog-article-img">
                            <img src="/assets-techex-demo/images/blog/blog-details.jpg" alt="Images" loading="lazy">
                            <div class="blog-article-tag">
                                <h3>04</h3>
                                <span>Nov</span>
                            </div>
                        </div>
                        <div class="blog-article-title">
                            <ul>
                                <li><i class='bx bxs-user'></i> By Admin</li>
                                <li><i class='bx bx-show-alt'></i>322 View</li>
                                <li><i class='bx bxs-conversation'></i>2 Comments</li>
                            </ul>
                            <h2>10 Ways to Get Efficient Result and Benefits</h2>
                        </div>
                        <div class="article-content">
                            <p>
                                Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.
                                Aenean massa. cu
                                sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam
                                felis, ultricies ne,
                                pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo,
                                fringilla vel, aliquet n,
                                vu eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum
                                felis eu pede mollis
                                pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate
                                eleifend tellus. Aen
                                li, porttitor eu, consequat vitae, eleifend ac, enim.
                            </p>
                            <p>
                                Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum
                                auctor, nisi elit consequat ipsum.
                                gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor,
                                Proin gravida nibh vel velit nisi
                                elit consequat ipsum.Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem
                                quis bibendum auctor, nisi
                                elit consequat ipsum. Proin gravida nibh vel velit.
                            </p>
                            <blockquote class="blockquote">
                                <p>
                                    Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum
                                    auctor, nisi elit consequat ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean
                                    sollicitudin, lorem quis bibendum auctor, Proin gravida nibh vel velit nisi elit.
                                </p>
                                <span>- Albedin Simanth</span>
                                <i class='bx bxs-quote-alt-left'></i>
                            </blockquote>
                            <p>
                                Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.
                                Aenean massa. cu
                                sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam
                                felis, ultricies ne,
                                pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo,
                                fringilla vel, aliquet n,
                                vu eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum
                                felis eu pede mollis
                                pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate
                                eleifend tellus. Aen
                                li, porttitor eu, consequat vitae, eleifend ac, enim.
                            </p>
                            <p>
                                It is a long established fact that a reader will be distracted by the readable content of a
                                page when looking at its layout. The point of using Lorem Ipsum is that it has a
                                more-or-less normal distribution of letters, as opposed to using 'Content here, content
                                here',
                                making it look like readable English.
                            </p>
                        </div>
                        <div class="blog-article-share">
                            <div class="row align-items-center">
                                <div class="col-lg-7 col-sm-7 col-md-7">
                                    <div class="blog-tag">
                                        <ul>
                                            <li><i class='bx bx-purchase-tag-alt'></i> Tags:</li>
                                            <li><a href="blog-details.html">Android</a></li>
                                            <li><a href="blog-details.html">Creative</a></li>
                                            <li><a href="blog-details.html">App</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-sm-5 col-md-5">
                                    <ul class="social-icon">
                                        <li>
                                            <a href="https://www.facebook.com/" target="_blank">
                                                <i class='bx bxl-facebook'></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://twitter.com/?lang=en" target="_blank">
                                                <i class='bx bxl-twitter'></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://www.linkedin.com/" target="_blank">
                                                <i class='bx bxl-linkedin-square'></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://www.instagram.com/" target="_blank">
                                                <i class='bx bxl-instagram'></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="comments-wrap">
                            <div class="comment-title">
                                <h3 class="title">Comments (02)</h3>
                            </div>
                            <ul class="comment-list">
                                <li>
                                    <img src="/assets-techex-demo/images/blog/blog-profile1.png" alt="Image"
                                        loading="lazy">
                                    <h3>Medison Decros</h3>
                                    <span>On September 18,2020 at 4.30 pm</span>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget
                                        dolor.
                                        Aenean massa. cu sociis natoque penatibus et magnis dis parturient montes, nascetur
                                        ridicule
                                        us mus. Donec quam felis, ultricies ne, pellentesque.
                                    </p>
                                    <a href="blog-details.html"> Reply</a>
                                </li>
                                <li>
                                    <img src="/assets-techex-demo/images/blog/blog-profile2.png" alt="Image"
                                        loading="lazy">
                                    <h3>Jekson Albin</h3>
                                    <span>On September 18,2020 at 4.30 pm</span>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget
                                        dolor.
                                        Aenean massa. cu sociis natoque penatibus et magnis dis parturient montes, nascetur
                                        ridicule
                                        us mus. Donec quam felis, ultricies ne, pellentesque.
                                    </p>
                                    <a href="blog-details.html"> Reply</a>
                                </li>
                                <li>
                                    <img src="/assets-techex-demo/images/blog/blog-profile3.png" alt="Image"
                                        loading="lazy">
                                    <h3>Bentham Debid</h3>
                                    <span>On September 18,2020 at 4.30 pm</span>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget
                                        dolor.
                                        Aenean massa. cu sociis natoque penatibus et magnis dis parturient montes, nascetur
                                        ridicule
                                        us mus. Donec quam felis, ultricies ne, pellentesque.
                                    </p>
                                    <a href="blog-details.html">Reply</a>
                                </li>
                            </ul>
                        </div>
                        <div class="comments-form">
                            <h3 class="title">Leave A Comment</h3>
                            <div class="contact-form">
                                <form id="contactForm">
                                    <div class="row">
                                        <div class="col-lg-6 col-sm-6">
                                            <div class="form-group">
                                                <label>Your Name <span>*</span></label>
                                                <input type="text" name="name" id="name" class="form-control"
                                                    required data-error="Please enter your name" placeholder="Your Name">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-6">
                                            <div class="form-group">
                                                <label>Your Email <span>*</span></label>
                                                <input type="email" name="email" id="email" class="form-control"
                                                    required data-error="Please enter your email" placeholder="Your Email">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-sm-12">
                                            <div class="form-group">
                                                <label>Your website <span>*</span></label>
                                                <input type="text" name="websit" class="form-control" required
                                                    data-error="Your website" placeholder="Your website">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <label>Your website <span>*</span></label>
                                                <textarea name="message" class="form-control" id="message" cols="30" rows="8" required
                                                    data-error="Write Your Review" placeholder="Your Review"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group checkbox-option">
                                                <input type="checkbox" id="chb2">
                                                <p>
                                                    Save my name, email, and website in this browser for the next time I
                                                    comment.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <button type="submit" class="default-btn btn-bg-two border-radius-50">
                                                Post A Comment
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="side-bar-area">
                        <div class="search-widget">
                            <form class="search-form">
                                <input type="search" class="form-control" placeholder="Search...">
                                <button type="submit">
                                    <i class="bx bx-search"></i>
                                </button>
                            </form>
                        </div>
                        <div class="side-bar-widget">
                            <h3 class="title">Blog Categories</h3>
                            <div class="side-bar-categories">
                                <ul>
                                    <li>
                                        <div class="line-circle"></div>
                                        <a href="blog-details.html" target="_blank">IT Services<span>[70]</span></a>
                                    </li>
                                    <li>
                                        <div class="line-circle"></div>
                                        <a href="blog-details.html" target="_blank">Business<span>[24]</span></a>
                                    </li>
                                    <li>
                                        <div class="line-circle"></div>
                                        <a href="blog-details.html" target="_blank">Creative
                                            Invention<span>[08]</span></a>
                                    </li>
                                    <li>
                                        <div class="line-circle"></div>
                                        <a href="blog-details.html" target="_blank">Technology <span>[17]</span></a>
                                    </li>
                                    <li>
                                        <div class="line-circle"></div>
                                        <a href="blog-details.html" target="_blank">IT Consulting <span>[20]</span></a>
                                    </li>
                                    <li>
                                        <div class="line-circle"></div>
                                        <a href="blog-details.html" target="_blank">Marketing Growth <span>[13]</span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="side-bar-widget">
                            <h3 class="title">Latest Blog</h3>
                            <div class="widget-popular-post">
                                <article class="item">
                                    <a href="blog-details.html" target="_blank" class="thumb">
                                        <span class="full-image cover bg1" role="img"></span>
                                    </a>
                                    <div class="info">
                                        <h4 class="title-text">
                                            <a href="blog-details.html" target="_blank">
                                                10 Ways to Get Efficient Result & Benefits
                                            </a>
                                        </h4>
                                        <p>Nov 05, 2020</p>
                                    </div>
                                </article>
                                <article class="item">
                                    <a href="blog-details.html" target="_blank" class="thumb">
                                        <span class="full-image cover bg2" role="img"></span>
                                    </a>
                                    <div class="info">
                                        <h4 class="title-text">
                                            <a href="blog-details.html" target="_blank">
                                                New Device Invention for Digital Platform
                                            </a>
                                        </h4>
                                        <p>13 October, 2020</p>
                                    </div>
                                </article>
                                <article class="item">
                                    <a href="blog-details.html" target="_blank" class="thumb">
                                        <span class="full-image cover bg3" role="img"></span>
                                    </a>
                                    <div class="info">
                                        <h4 class="title-text">
                                            <a href="blog-details.html" target="_blank">
                                                Idea For New 5 App Design
                                            </a>
                                        </h4>
                                        <p>17 October, 2020</p>
                                    </div>
                                </article>
                                <article class="item">
                                    <a href="blog-details.html" target="_blank" class="thumb">
                                        <span class="full-image cover bg4" role="img"></span>
                                    </a>
                                    <div class="info">
                                        <h4 class="title-text">
                                            <a href="blog-details.html" target="_blank">
                                                Product Idea Solution For New Generation
                                            </a>
                                        </h4>
                                        <p>17 October, 2020</p>
                                    </div>
                                </article>
                            </div>
                        </div>
                        <div class="side-bar-widget">
                            <h3 class="title">Tag Cloud</h3>
                            <ul class="side-bar-widget-tag">
                                <li><a href="blog-details.html" target="_blank">Android</a></li>
                                <li><a href="blog-details.html" target="_blank">Creative</a></li>
                                <li><a href="blog-details.html" target="_blank">App</a></li>
                                <li><a href="blog-details.html" target="_blank">IOS</a></li>
                                <li><a href="blog-details.html" target="_blank">Business</a></li>
                                <li><a href="blog-details.html" target="_blank">Consulting</a></li>
                            </ul>
                        </div>
                        <div class="side-bar-widget">
                            <h3 class="title">Gallery</h3>
                            <ul class="blog-gallery">
                                <li>
                                    <a href="https://www.instagram.com/" target="_blank">
                                        <img src="/assets-techex-demo/images/blog/blog-small-img1.jpg" alt="image"
                                            loading="lazy">
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.instagram.com/" target="_blank">
                                        <img src="/assets-techex-demo/images/blog/blog-small-img2.jpg" alt="image"
                                            loading="lazy">
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.instagram.com/" target="_blank">
                                        <img src="/assets-techex-demo/images/blog/blog-small-img3.jpg" alt="image"
                                            loading="lazy">
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.instagram.com/" target="_blank">
                                        <img src="/assets-techex-demo/images/blog/blog-small-img4.jpg" alt="image"
                                            loading="lazy">
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.instagram.com/" target="_blank">
                                        <img src="/assets-techex-demo/images/blog/blog-small-img5.jpg" alt="image"
                                            loading="lazy">
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.instagram.com/" target="_blank">
                                        <img src="/assets-techex-demo/images/blog/blog-small-img6.jpg" alt="image"
                                            loading="lazy">
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="side-bar-widget">
                            <h3 class="title">Archive</h3>
                            <div class="side-bar-categories">
                                <ul>
                                    <li>
                                        <div class="line-circle"></div>
                                        <a href="blog-details.html" target="_blank">Design<span>[70]</span></a>
                                    </li>
                                    <li>
                                        <div class="line-circle"></div>
                                        <a href="blog-details.html" target="_blank">Business<span>[24]</span></a>
                                    </li>
                                    <li>
                                        <div class="line-circle"></div>
                                        <a href="blog-details.html" target="_blank">Development<span>[08]</span></a>
                                    </li>
                                    <li>
                                        <div class="line-circle"></div>
                                        <a href="blog-details.html" target="_blank">Technology <span>[17]</span></a>
                                    </li>
                                    <li>
                                        <div class="line-circle"></div>
                                        <a href="blog-details.html" target="_blank">Startup <span>[20]</span></a>
                                    </li>
                                    <li>
                                        <div class="line-circle"></div>
                                        <a href="blog-details.html" target="_blank">Marketing Growth <span>[13]</span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

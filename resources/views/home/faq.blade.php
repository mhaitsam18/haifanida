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
    <div class="faq-area pt-100 pb-70">
        <div class="container">
            <div class="section-title text-center">
                <h2>Frequently Asked Questions</h2>
                <p class="margin-auto">We are the agency who always gives you a priority on the free of question and you can
                    easily make a question on the bunch.</p>
            </div>
            {{-- ada bagian dimana poin ke 3 malah terbuka pertama, lalu tombol di poin 1 menjadi minus tanpa terbuka dan stuck di tanda minus --}}
            <div class="row pt-45">
                <div class="col-lg-6">
                    <div class="faq-content">
                        <div class="faq-accordion">
                            <ul class="accordion">
                                <li class="accordion-item">
                                    <a class="accordion-title" href="javascript:void(0)">
                                        <i class='bx bx-minus'></i>
                                        What is a Managed Security Services?
                                    </a>
                                    <div class="accordion-content">
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam at diam leo.
                                            Mauris a ante placerat,
                                            dignissim orci eget, viverra ante. Mauris ornare pellentesque augue.
                                        </p>
                                    </div>
                                </li>
                                <li class="accordion-item">
                                    <a class="accordion-title" href="javascript:void(0)">
                                        <i class='bx bx-plus'></i>
                                        What is a Data Analysis?
                                    </a>
                                    <div class="accordion-content">
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam at diam leo.
                                            Mauris a ante placerat,
                                            dignissim orci eget, viverra ante. Mauris ornare pellentesque augue.
                                        </p>
                                    </div>
                                </li>
                                <li class="accordion-item">
                                    <a class="accordion-title" href="javascript:void(0)">
                                        <i class='bx bx-plus'></i>
                                        How Can Make Secure My Website?
                                    </a>
                                    <div class="accordion-content">
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam at diam leo.
                                            Mauris a ante placerat,
                                            dignissim orci eget, viverra ante. Mauris ornare pellentesque augue.
                                        </p>
                                    </div>
                                </li>
                                <li class="accordion-item">
                                    <a class="accordion-title active" href="javascript:void(0)">
                                        <i class='bx bx-plus'></i>
                                        What is a Infrastructure?
                                    </a>
                                    <div class="accordion-content show">
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam at diam leo.
                                            Mauris a ante placerat,
                                            dignissim orci eget, viverra ante. Mauris ornare pellentesque augue.
                                        </p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="faq-content">
                        <div class="faq-accordion">
                            <ul class="accordion">
                                <li class="accordion-item">
                                    <a class="accordion-title" href="javascript:void(0)">
                                        <i class='bx bx-plus'></i>
                                        How Can We Help Your Business?
                                    </a>
                                    <div class="accordion-content">
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam at diam leo.
                                            Mauris a ante placerat,
                                            dignissim orci eget, viverra ante. Mauris ornare pellentesque augue.
                                        </p>
                                    </div>
                                </li>
                                <li class="accordion-item">
                                    <a class="accordion-title" href="javascript:void(0)">
                                        <i class='bx bx-plus'></i>
                                        Why It Staff Management?
                                    </a>
                                    <div class="accordion-content">
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam at diam leo.
                                            Mauris a ante placerat,
                                            dignissim orci eget, viverra ante. Mauris ornare pellentesque augue.
                                        </p>
                                    </div>
                                </li>
                                <li class="accordion-item">
                                    <a class="accordion-title" href="javascript:void(0)">
                                        <i class='bx bx-plus'></i>
                                        How Working Process Is Simplified?
                                    </a>
                                    <div class="accordion-content">
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam at diam leo.
                                            Mauris a ante placerat,
                                            dignissim orci eget, viverra ante. Mauris ornare pellentesque augue.
                                        </p>
                                    </div>
                                </li>
                                <li class="accordion-item">
                                    <a class="accordion-title active" href="javascript:void(0)">
                                        <i class='bx bx-plus'></i>
                                        Product Engineering & Services?
                                    </a>
                                    <div class="accordion-content show">
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam at diam leo.
                                            Mauris a ante placerat,
                                            dignissim orci eget, viverra ante. Mauris ornare pellentesque augue.
                                        </p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

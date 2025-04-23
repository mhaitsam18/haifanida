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
    <div class="privacy-policy-area pt-100 pb-70">
        <div class="container">
            <div class="section-title text-center">
                <span class="sp-color2">Privacy Policy</span>
                <h2>Techex Privacy Policy</h2>
            </div>
            <div class="row pt-45">
                <div class="col-lg-12">
                    <div class="single-content">
                        <h3>Information Collection</h3>
                        <p>
                            Maecenas non sem ex. Nullam ac augue vel turpis fringilla maximus. Vivamus commodo laoreet augue
                            non porta. Nam egestas dui turpis, non pulvinar nisi
                            rhoncus eu. Phasellus et sollicitudin nulla, at efficitur nunc. Quisque et neque commodo,
                            blandit lacus malesuada, scelerisque ante. Suspendisse lacinia
                            tristique justo, vitae ornare ipsum interdum sed. Vestibulum porttitor urna eget nunc porttitor
                            rutrum. Aliquam tempor sapien orci, quis mollis velit laoreet
                            sit amet. Morbi luctus magna tellus, quis accumsan nisi cursus id. Lorem ipsum dolor sit amet,
                            consectetur adipiscing elit. Sed varius convallis massa, sed
                            ultrices dolor fermentum id. Nunc vel ex sed sapien hendrerit consequat pharetra a metus.
                        </p>
                        <p>
                            Vestibulum eu aliquet justo. Aenean at mauris leo. Etiam placerat ac turpis ac feugiat.
                            Pellentesque habitant morbi tristique senectus et netus et
                            malesuada fames ac turpis egestas. Fusce velit nibh, consequat sed mi in, consectetur posuere
                            erat. Ut mauris arcu, finibus quis lectus et, hendrerit
                            rutrum erat. Integer varius pharetra arcu, et rhoncus leo commodo sed. Nullam sollicitudin
                            pulvinar pharetra. In ut lacinia sem.
                        </p>
                    </div>
                    <div class="single-content">
                        <h3>Privacy Policy Techex</h3>
                        <p>
                            Maecenas non sem ex. Nullam ac augue vel turpis fringilla maximus. Vivamus commodo laoreet augue
                            non porta. Nam egestas dui turpis, non pulvinar nisi
                            rhoncus eu. Phasellus et sollicitudin nulla, at efficitur nunc. Quisque et neque commodo,
                            blandit lacus malesuada, scelerisque ante. Suspendisse lacinia
                            tristique justo, vitae ornare ipsum interdum sed. Vestibulum porttitor urna eget nunc porttitor
                            rutrum. Aliquam tempor sapien orci, quis mollis velit laoreet
                            sit amet. Morbi luctus magna tellus, quis accumsan nisi cursus id. Lorem ipsum dolor sit amet,
                            consectetur adipiscing elit. Sed varius convallis massa, sed
                            ultrices dolor fermentum id. Nunc vel ex sed sapien hendrerit consequat pharetra a metus.
                        </p>
                        <p>
                            Vestibulum eu aliquet justo. Aenean at mauris leo. Etiam placerat ac turpis ac feugiat.
                            Pellentesque habitant morbi tristique senectus et netus et
                            malesuada fames ac turpis egestas. Fusce velit nibh, consequat sed mi in, consectetur posuere
                            erat. Ut mauris arcu, finibus quis lectus et, hendrerit
                            rutrum erat. Integer varius pharetra arcu, et rhoncus leo commodo sed. Nullam sollicitudin
                            pulvinar pharetra. In ut lacinia sem.
                        </p>
                    </div>
                    <div class="single-content">
                        <h3>The Collection, Process and Use of Personal Data</h3>
                        <p>
                            Maecenas non sem ex. Nullam ac augue vel turpis fringilla maximus. Vivamus commodo laoreet augue
                            non porta. Nam egestas dui turpis, non pulvinar nisi
                            rhoncus eu. Phasellus et sollicitudin nulla, at efficitur nunc. Quisque et neque commodo,
                            blandit lacus malesuada, scelerisque ante. Suspendisse lacinia
                            tristique justo, vitae ornare ipsum interdum sed. Vestibulum porttitor urna eget nunc porttitor
                            rutrum. Aliquam tempor sapien orci, quis mollis velit laoreet
                            sit amet. Morbi luctus magna tellus, quis accumsan nisi cursus id. Lorem ipsum dolor sit amet,
                            consectetur adipiscing elit. Sed varius convallis massa, sed
                            ultrices dolor fermentum id. Nunc vel ex sed sapien hendrerit consequat pharetra a metus.
                        </p>
                        <p>
                            Vestibulum eu aliquet justo. Aenean at mauris leo. Etiam placerat ac turpis ac feugiat.
                            Pellentesque habitant morbi tristique senectus et netus et
                            malesuada fames ac turpis egestas. Fusce velit nibh, consequat sed mi in, consectetur posuere
                            erat. Ut mauris arcu, finibus quis lectus et, hendrerit
                            rutrum erat. Integer varius pharetra arcu, et rhoncus leo commodo sed. Nullam sollicitudin
                            pulvinar pharetra. In ut lacinia sem.
                        </p>
                    </div>
                    <div class="single-content">
                        <h3>Disclaimers</h3>
                        <p>
                            Maecenas non sem ex. Nullam ac augue vel turpis fringilla maximus. Vivamus commodo laoreet augue
                            non porta. Nam egestas dui turpis, non pulvinar nisi
                            rhoncus eu. Phasellus et sollicitudin nulla, at efficitur nunc. Quisque et neque commodo,
                            blandit lacus malesuada, scelerisque ante. Suspendisse lacinia
                            tristique justo, vitae ornare ipsum interdum sed. Vestibulum porttitor urna eget nunc porttitor
                            rutrum. Aliquam tempor sapien orci, quis mollis velit laoreet
                            sit amet. Morbi luctus magna tellus, quis accumsan nisi cursus id. Lorem ipsum dolor sit amet,
                            consectetur adipiscing elit. Sed varius convallis massa, sed
                            ultrices dolor fermentum id. Nunc vel ex sed sapien hendrerit consequat pharetra a metus.
                        </p>
                        <p>
                            Vestibulum eu aliquet justo. Aenean at mauris leo. Etiam placerat ac turpis ac feugiat.
                            Pellentesque habitant morbi tristique senectus et netus et
                            malesuada fames ac turpis egestas. Fusce velit nibh, consequat sed mi in, consectetur posuere
                            erat. Ut mauris arcu, finibus quis lectus et, hendrerit
                            rutrum erat. Integer varius pharetra arcu, et rhoncus leo commodo sed. Nullam sollicitudin
                            pulvinar pharetra. In ut lacinia sem.
                        </p>
                    </div>
                    <div class="single-content">
                        <h3> Data Protection</h3>
                        <p>
                            Maecenas non sem ex. Nullam ac augue vel turpis fringilla maximus. Vivamus commodo laoreet augue
                            non porta. Nam egestas dui turpis, non pulvinar nisi
                            rhoncus eu. Phasellus et sollicitudin nulla, at efficitur nunc. Quisque et neque commodo,
                            blandit lacus malesuada, scelerisque ante. Suspendisse lacinia
                            tristique justo, vitae ornare ipsum interdum sed. Vestibulum porttitor urna eget nunc porttitor
                            rutrum. Aliquam tempor sapien orci, quis mollis velit laoreet
                            sit amet. Morbi luctus magna tellus, quis accumsan nisi cursus id. Lorem ipsum dolor sit amet,
                            consectetur adipiscing elit. Sed varius convallis massa, sed
                            ultrices dolor fermentum id. Nunc vel ex sed sapien hendrerit consequat pharetra a metus.
                        </p>
                        <p>
                            Vestibulum eu aliquet justo. Aenean at mauris leo. Etiam placerat ac turpis ac feugiat.
                            Pellentesque habitant morbi tristique senectus et netus et
                            malesuada fames ac turpis egestas. Fusce velit nibh, consequat sed mi in, consectetur posuere
                            erat. Ut mauris arcu, finibus quis lectus et, hendrerit
                            rutrum erat. Integer varius pharetra arcu, et rhoncus leo commodo sed. Nullam sollicitudin
                            pulvinar pharetra. In ut lacinia sem.
                        </p>
                    </div>
                    <div class="single-content">
                        <h3>How We Use Cookies</h3>
                        <p>
                            Maecenas non sem ex. Nullam ac augue vel turpis fringilla maximus. Vivamus commodo laoreet augue
                            non porta. Nam egestas dui turpis, non pulvinar nisi
                            rhoncus eu. Phasellus et sollicitudin nulla, at efficitur nunc. Quisque et neque commodo,
                            blandit lacus malesuada, scelerisque ante. Suspendisse lacinia
                            tristique justo, vitae ornare ipsum interdum sed. Vestibulum porttitor urna eget nunc porttitor
                            rutrum. Aliquam tempor sapien orci, quis mollis velit laoreet
                            sit amet. Morbi luctus magna tellus, quis accumsan nisi cursus id. Lorem ipsum dolor sit amet,
                            consectetur adipiscing elit. Sed varius convallis massa, sed
                            ultrices dolor fermentum id. Nunc vel ex sed sapien hendrerit consequat pharetra a metus.
                        </p>
                        <p>
                            Vestibulum eu aliquet justo. Aenean at mauris leo. Etiam placerat ac turpis ac feugiat.
                            Pellentesque habitant morbi tristique senectus et netus et
                            malesuada fames ac turpis egestas. Fusce velit nibh, consequat sed mi in, consectetur posuere
                            erat. Ut mauris arcu, finibus quis lectus et, hendrerit
                            rutrum erat. Integer varius pharetra arcu, et rhoncus leo commodo sed. Nullam sollicitudin
                            pulvinar pharetra. In ut lacinia sem.
                        </p>
                    </div>
                    <div class="single-content">
                        <h3> The Collection, Process, and Use of Personal Data</h3>
                        <p>
                            Maecenas non sem ex. Nullam ac augue vel turpis fringilla maximus. Vivamus commodo laoreet augue
                            non porta. Nam egestas dui turpis, non pulvinar nisi
                            rhoncus eu. Phasellus et sollicitudin nulla, at efficitur nunc. Quisque et neque commodo,
                            blandit lacus malesuada, scelerisque ante. Suspendisse lacinia
                            tristique justo, vitae ornare ipsum interdum sed. Vestibulum porttitor urna eget nunc porttitor
                            rutrum. Aliquam tempor sapien orci, quis mollis velit laoreet
                            sit amet. Morbi luctus magna tellus, quis accumsan nisi cursus id. Lorem ipsum dolor sit amet,
                            consectetur adipiscing elit. Sed varius convallis massa, sed
                            ultrices dolor fermentum id. Nunc vel ex sed sapien hendrerit consequat pharetra a metus.
                        </p>
                        <p>
                            Vestibulum eu aliquet justo. Aenean at mauris leo. Etiam placerat ac turpis ac feugiat.
                            Pellentesque habitant morbi tristique senectus et netus et
                            malesuada fames ac turpis egestas. Fusce velit nibh, consequat sed mi in, consectetur posuere
                            erat. Ut mauris arcu, finibus quis lectus et, hendrerit
                            rutrum erat. Integer varius pharetra arcu, et rhoncus leo commodo sed. Nullam sollicitudin
                            pulvinar pharetra. In ut lacinia sem.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

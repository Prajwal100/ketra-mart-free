@extends('frontend.layouts.master')
@section('meta_title', get_settings('site_title') . ' || Terms & Conditions')
@section('content')
    <main class="main-content">
        <div class="container">
            <!-- BreadCrumb Area -->
            <div class="page-title-area d-none d-md-block">
                <div class="page-title-content">
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>Terms & Conditions</li>
                    </ul>
                </div>
            </div>
            <!-- BreadCrumb Area  Ends-->
            <div class="row">
                <!-- Sidebar Tab -->
                <div class="col-md-4 col-lg-3 d-none d-md-block">
                    <div class="nav flex-column nav-pills sidebar-tabs" id="v-pills-tab" role="tablist"
                        aria-orientation="vertical">
                        <h6 class="nav-link font-weight-bold">Terms & Conditions</h6>
                        <a class="nav-link" id="about-us-tab" data-toggle="pill" href="#about-us-content" role="tab"
                            aria-controls="about-us-content" aria-selected="true">About BigDay</a>

                        <a class="nav-link " id="return-policy-tab" data-toggle="pill" href="#return-policy-content"
                            role="tab" aria-controls="return-policy-content" aria-selected="false">Return Policy</a>

                        <a class="nav-link " id="ship_payment-tab" data-toggle="pill" href="#ship_payment-content"
                            role="tab" aria-controls="ship_payment-content" aria-selected="false">Shipping & Payment</a>

                        <a class="nav-link" id="privacy-tab" data-toggle="pill" href="#privacy-content" role="tab"
                            aria-controls="privacy-content" aria-selected="false">Privacy Policy</a>

                        <a class="nav-link active" id="terms-tab" data-toggle="pill" href="#terms-content" role="tab"
                            aria-controls="terms-content" aria-selected="false">Terms and Conditions</a>

                        <a class="nav-link" id="cancellation-tab" data-toggle="pill" href="#cancellation-content"
                            role="tab" aria-controls="cancellation-content" aria-selected="false">Cancellation
                            Policy</a>

                        <a class="nav-link" id="faq-tab" data-toggle="pill" href="#faq-content" role="tab"
                            aria-controls="faq-content" aria-selected="false">FAQ</a>
                    </div>
                </div>

                <!-- Sidebar Tab Content -->
                <div class="col-md-8 col-lg-9">
                    <div class="tab-content sidebar-tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade " id="about-us-content" role="tabpanel" aria-labelledby="about-us-tab">
                            <h1 class="title">Terms & Conditions</h1>
                            @php($aboutUs = json_decode(\App\Models\Setting::value('about_us')))
                            <!-- About Us Top Image -->

                            @if ($aboutUs != null)
                                <div class="about-img">
                                    <img src="{{ asset($aboutUs->image1_path) }}" alt="About BigDay">
                                </div>
                                <!-- About US Description -->
                                <div class="desc-content mt-3 mb-5">
                                    {!! html_entity_decode($aboutUs->description1) !!}
                                </div>

                                @if (\App\Models\WhyChoose::where('status', 'active')->count() > 0)
                                    <!-- Why Choose US -->
                                    <div class="why-choose-us">
                                        <h6>Why Choose US?</h6>
                                        <ul>
                                            @foreach (\App\Models\WhyChoose::where('status', 'active')->get() as $item)
                                                <li> <span><img src="{{ asset('frontend/assets/images/about/marker.svg') }}"
                                                            alt="Marker SVG"></span>
                                                    {{ $item->description }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif


                                <div class="about-img my-4">
                                    <img src="{{ asset($aboutUs->image2_path) }}" alt="About BigDay">
                                </div>

                                <div class="desc-content mb-5">
                                    {!! html_entity_decode($aboutUs->description2) !!}

                                </div>

                            @endif
                        </div>

                        <!-- Return Policy -->
                        <div class="tab-pane fade " id="return-policy-content" role="tabpanel"
                            aria-labelledby="return-policy-tab">
                            <h1 class="title">Return Policy</h1>
                            {!! html_entity_decode(\App\Models\Setting::value('return_policy')) !!}

                        </div>

                        <!-- Shipping & Payment -->
                        <div class="tab-pane fade " id="ship_payment-content" role="tabpanel"
                            aria-labelledby="ship_payment-tab">
                            <h1 class="title">Shipping & Payment</h1>

                            <div class="desc-content mt-3 mb-5">
                                {!! html_entity_decode(\App\Models\Setting::value('shipping_payment')) !!}

                            </div>
                        </div>
                        <div class="tab-pane fade" id="privacy-content" role="tabpanel" aria-labelledby="privacy-tab">
                            <h1 class="title">Privacy policy </h1>
                            {!! html_entity_decode(\App\Models\Setting::value('privacy_policy')) !!}

                        </div>

                        <div class="tab-pane fade show active" id="terms-content" role="tabpanel"
                            aria-labelledby="terms-tab">
                            <h1 class="title">Terms and Conditions</h1>
                            {!! html_entity_decode(\App\Models\Setting::value('terms_conditions')) !!}

                        </div>

                        <div class="tab-pane fade" id="cancellation-content" role="tabpanel"
                            aria-labelledby="terms-tab">
                            <h1 class="title">Cancellation Policy</h1>
                            {!! html_entity_decode(\App\Models\Setting::value('cancellation_policy')) !!}

                        </div>


                        <!-- FAQS -->
                        <div class="tab-pane fade" id="faq-content" role="tabpanel" aria-labelledby="faq-tab">
                            <h1 class="title">FAQ</h1>
                            <!-- FAQs Accordion -->
                            <div class="faq-accordion mt-3 mb-5">
                                <ul class="accordion">
                                    @if (\App\Models\FAQ::where('status', 'active')->count() > 0)
                                        @foreach (\App\Models\FAQ::where('status', 'active')->orderBy('id', 'DESC')->get() as $item)
                                            <li class="accordion-item">
                                                <a class="accordion-title active" href="javascript:void(0)">
                                                    {{ $item->question }}
                                                    <i class='bx bx-plus float-right'></i>
                                                </a>
                                                <div class="accordion-content show">
                                                    {!! html_entity_decode($item->answer) !!}
                                                </div>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection

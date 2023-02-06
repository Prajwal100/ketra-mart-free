@extends('frontend.layouts.master')
@section('meta_title', get_settings('site_title') . ' || Contact Page')
@section('content')
    <main class="main-content">
        <!-- Login Area -->
        <section class="login-area">
            <div class="container">
                <div class="form-content">
                    <div class="form-title text-center">
                        <h2><strong>Contact US</strong></h2>
                    </div>
                    <form class="form-wrapper" action="{{ route('contact.submit') }}" method="post" id="contact-form">
                        @csrf
                        <div class="form-group">
                            <label for="">Name <span class="text-danger">*</span> </label>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                                placeholder="Alex Smith" required>
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Your E-mail <span class="text-danger">*</span></label>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control"
                                placeholder="mygmail@gmail.com" required>
                            @error('email')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Phone</label>
                            <input type="text" name="phone" value="{{ old('phone') }}" class="form-control"
                                placeholder="(555) 555-1234" required>
                            @error('phone')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Message <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="message" placeholder="Leave your message here" required>{{ old('message') }}</textarea>
                            @error('message')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            {!! \Anhskohbo\NoCaptcha\Facades\NoCaptcha::renderJs() !!}
                            {!! \Anhskohbo\NoCaptcha\Facades\NoCaptcha::display() !!}
                            @error('g-recaptcha-response')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" id="contact-btn" class="default-btn primary-btn mt-5">Send Message <span
                                class="bx bx-right-arrow-alt float-right ml-3"></span></button>
                    </form>
                </div>
            </div>
        </section>
        <!-- Login Area Ends-->

    </main>
@endsection

@push('scripts')
    <script>
        $('#contact-btn').click(function(e) {
            e.preventDefault();
            $('#contact-btn').html('<i class="fas fa-spinner fa-spin"></i> Loading....');
            $('#contact-form').submit();
        });
    </script>
@endpush

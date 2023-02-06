@extends('frontend.layouts.master')

@section('content')
    <main class="main checkout">

        <!-- End PageHeader -->
        <div class="page-content pt-5 pb-5">

            <div class="container mt-8">
                <div class="row">
                    <div class="col-md"></div>
                    <div class="col-md-7">
                        @if (session('status'))
                            <div class=" text-info" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>
                    <div class="col-md"></div>

                </div>
                <form action="{{ route('password.update') }}" class="form" method="post">
                    @csrf

                    <div class="row gutter-lg form-lh">
                        <div class="col"></div>
                        <div class="col-lg-7 mb-6">
                            <div class="wao-fro">
                                <h3 class="title title-simple text-left">Forgot your password</h3>


                                <input type="hidden" name="token" value="{{ $token }}">

                                <div class="form-group row">
                                    <label for="email" class="col-md-2 col-form-label text-md-left">{{ __('E-Mail Address') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-2 col-form-label text-md-left">{{ __('Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-2 col-form-label text-md-left">{{ __('Confirm Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-2">
                                        <button type="submit" class="btn btn-dark btn-order ">
                                            {{ __('Reset Password') }}
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col"></div>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script>
        $('#login_btn').click(function () {
            $('#login_btn').html('<i class="fas fa-spinner fa-spin"></i> Loading...');
            $('#login_form').submit();
        });
    </script>
@endsection


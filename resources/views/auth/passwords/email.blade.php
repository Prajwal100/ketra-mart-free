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
                <form action="{{ route('password.email') }}" class="form" method="post">
                    @csrf

                    <div class="row gutter-lg form-lh">
                        <div class="col-lg-7 mb-6 mx-auto">
                            <div class="wao-fro">
                                <h3 class="title title-simple text-left">Forgot your password</h3>


                                <div class="row">
                                    <div class="col-12">
                                        <label>Email *</label>
                                        <input required placeholder="Enter your email address" type="email" class="form-control" name="email" value="{{ old('email') }}"  />
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <!-- <div class="col-12">
                                        <label>Password *</label>
                                        <input type="password" class="form-control" name="password" required="" />
                                    </div> -->
                                </div>

                                <button type="submit" class="btn btn-dark btn-order mt-3">Submit</button>

                            </div>

                        </div>
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


@extends('frontend.layouts.master')
@section('title','Order Status || Bigday')
@section('content')
    <main class="main-content">
        <!-- Login Area -->
        <section class="login-area">
            <div class="container">
                <div class="form-content">
                    <div class="form-title text-center">
                        <h2 class="mb-0">Look Up a Single Order</h2>
                        <p>Please enter your Order Number and Email Address to see the details for your order.</p>
                    </div>
                    <form class="order-status-form form-wrapper mt-4" method="post" action="{{route('order.track')}}">
                        @csrf

                        @if(session()->has('Error'))
                            <div class="alert alert-danger alert-block">
                                <span type="" class="closet " data-dismiss="alert">×</span>
                                <strong>{{ session()->get('Error') }}</strong>
                            </div>
                        @endif
                        @if(session()->has('Success'))
                            <div class="alert alert-success alert-block">
                                <span type="" class="closet " data-dismiss="alert">×</span>
                                <strong>{{ session()->get('Success') }}</strong>
                            </div>
                        @endif

                        @if(session()->has('Warning'))
                            <div class="alert alert-warning alert-block">
                                <span type="" class="closet " data-dismiss="alert">×</span>
                                <strong>{{ session()->get('Warning') }}</strong>
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="">Order Number <span class="text-danger">*</span></label>
                            <input type="text"required name="order_number" class="form-control" placeholder="12345677899">
                        </div>
                        <div class="form-group">
                            <label for="">E-mail <span class="text-danger">*</span></label>
                            <input type="email" required name="email" class="form-control" placeholder="mygmail@gmail.com">
                        </div>

                        <button type="submit" class="default-btn secondary-btn mt-5">View Order <span
                                class="bx bx-right-arrow-alt float-right ml-3"></span></button>

                        <div class="my-4 text-center">
                            <a class="default-link" href="{{route('user.dashboard',['active'=>'order'])}}">View Order History</a>
                        </div>

                    </form>
                </div>
            </div>
        </section>
        <!-- Login Area Ends-->

    </main>
@endsection

@extends('frontend.layouts.master')

@section('content')

    <!-- Breadcumb Area -->
    <div class="breadcumb_area d-none">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <h5>My Account</h5>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active">My Account</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcumb Area -->

    <!-- My Account Area -->
    <section class="my-account-area section_padding_100_50">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-3">
                    <div class="my-account-navigation mb-50">
                        <div class="row">
                            @include('frontend.user.sidebar')
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-9">
                    <div class="my-account-content mb-50">
                        <h5 class="mb-3">Account Details</h5>

                        <form action="{{route('update.account',$user->id)}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="firstName">First Name *</label>
                                        <input type="text" class="form-control" id="firstName" name="full_name" value="{{$user->full_name}}" placeholder="eg. Prajwal Rai">
                                        @error('full_name')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="displayName">Display Name</label>
                                        <input type="text" class="form-control" id="displayName" value="{{$user->username}}" name="username" placeholder="eg. Raidai">
                                        @error('username')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="displayName">Phone Number</label>
                                        <input type="text" class="form-control" id="displayName" placeholder="eg. 9807009889" name="phone" value="{{$user->phone}}">
                                        @error('phone')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="emailAddress">Email Address *</label>
                                        <input type="email" class="form-control" id="emailAddress" name="email" placeholder="eg. prajwal.iar@gmail.com" value="{{$user->email}}" disabled>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="currentPass">Current Password (Leave blank to leave unchanged)</label>
                                        <input type="password" class="form-control" id="currentPass" name="oldpassword">

                                        @error('oldpassword')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror</div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="newPass">New Password (Leave blank to leave unchanged)</label>
                                        <input type="password" class="form-control" id="newPass" name="newpassword">
                                        @error('newpassword')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- My Account Area -->

@endsection

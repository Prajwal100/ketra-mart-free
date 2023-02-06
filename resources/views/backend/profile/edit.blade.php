
@extends('backend.layouts.master')

@section('content')
    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Profile Details</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->
                <div class="row mb-4">
                    <div class="col-md-12">
                        @include('layouts._error_notify')
                    </div>
                </div>
                <!-- ROW-1 OPEN -->
                <div class="row">
                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Edit Password</div>
                            </div>
                            <div class="card-body">
                                <div class="text-center chat-image mb-5">
                                    <div class="avatar avatar-xxl chat-profile mb-3 brround">
                                        <a class="" href="javascript:;"><img alt="avatar" src="{{Helper::defaultImage('male')}}" class="brround"></a>
                                    </div>
                                    <div class="main-chat-msg-name">
                                        <a href="profile.html">
                                            <h5 class="mb-1 text-dark fw-semibold">{{$admin->name}}</h5>
                                        </a>
                                        <p class="text-muted mt-0 mb-0 pt-0 fs-13">Admin</p>
                                    </div>
                                </div>

                                <div class="info-table table-responsive">
                                    <table class="table text-nowrap">
                                        <tbody>
                                        <tr>
                                            <td>Email:</td>
                                            <td class="font-medium text-dark-medium">{{auth('admin')->user()->email}}</td>
                                        </tr>
                                        <tr>
                                            <td>Status:</td>
                                            <td class="font-medium text-dark-medium">
                                                @if(auth('admin')->user()->status=='active')
                                                    <i class="fe fe-check-circle text-success" data-bs-toggle="tooltip" data-bs-original-title="verified" data-bs-placement="right"></i>
                                                @else
                                                    <i class="fe fe-times-circle text-danger" data-bs-toggle="tooltip" data-bs-original-title="unverified" data-bs-placement="right"></i>
                                                @endif
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>


                            </div>

                        </div>
                    </div>
                    <div class="col-xl-8">
                        <form class="card"  action="{{route('profile.update',$admin->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <div class="card-header">
                                <h3 class="card-title">Edit Profile</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label>Full Name</label>
                                            <input type="text" class="form-control" placeholder="Full Name" name="name" value="{{$admin->name}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label>Email address</label>
                                            <input readonly type="email" class="form-control" placeholder="Email address" name="email" value="{{$admin->email}}">
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-6 form-group">
                                        <label>New Password </label>
                                        <input type="password" placeholder="Enter atleast 6 character" class="form-control" name="new_password">
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-6 form-group">
                                        <label>Confirm Password </label>
                                        <input type="password" placeholder="Repeat same password" class="form-control" name="confirm_password">
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn-success my-1">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- ROW-1 CLOSED -->
            </div>
            <!--CONTAINER CLOSED -->

        </div>
    </div>
    <!--app-content open-->
@endsection

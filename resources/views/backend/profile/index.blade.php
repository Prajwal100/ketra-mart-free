@extends('backend.layouts.master')

@section('content')
    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Profile</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Profile</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->
                <!-- Admin Details Area Start Here -->
                <div class="card height-auto">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>About Me</h3>
                            </div>

                        </div>
                        <div class="single-info-details">
                            <div class="item-img text-center pb-5">
                                <img style="width:100px" src="{{Helper::defaultImage('male')}}" alt="{{auth('admin')->user()->name}}">
                            </div>
                            <div class="item-content mt-5">
                                <div class="info-table table-responsive">
                                    <table class="table text-nowrap">
                                        <tbody>
                                        <tr>
                                            <td>Name:</td>
                                            <td class="font-medium text-dark-medium">{{ucfirst(auth('admin')->user()->name)}}</td>
                                        </tr>
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
                </div>

            </div>
            <!-- CONTAINER CLOSED -->
        </div>
    </div>
    <!--app-content closed-->
@endsection


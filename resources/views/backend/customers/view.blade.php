@extends('backend.layouts.master')

@section('content')
    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">All Customers</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Customers</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- Admin Details Area Start Here -->
                <div class="card height-auto">
                    <div class="card-header">
                        <h1 class="page-title">
                            <a href="{{route('customers.index')}}" class="btn btn-primary me-2"><i class="fe fe-arrow-left"></i> Go Back</a>
                        </h1>
                    </div>
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>About Me</h3>
                            </div>

                        </div>
                        <div class="single-info-details">
                            <div class="item-img m-auto text-center pb-5">
                                <img style="width: 100px;height: 100px" src="{{$customer->photo !=null ? asset($customer->photo) : Helper::defaultImage('male')}}" alt="{{$customer->full_name}}">
                            </div>
                            <div class="item-content mt-5">
                                <div class="info-table table-responsive">
                                    <table class="table text-nowrap">
                                        <tbody>
                                        <tr>
                                            <td>Name:</td>
                                            <td class="font-medium text-dark-medium">{{ucfirst($customer->full_name)}}</td>
                                        </tr>
                                        <tr>
                                            <td>Username:</td>
                                            <td class="font-medium text-dark-medium">{{ucfirst($customer->username)}}</td>
                                        </tr>
                                        <tr>
                                            <td>Email:</td>
                                            <td class="font-medium text-dark-medium">{{$customer->email}}</td>
                                        </tr>
                                        <tr>
                                            <td>Phone:</td>
                                            <td class="font-medium text-dark-medium">{{$customer->phone ?? 'N/A'}}</td>
                                        </tr>
                                        <tr>
                                            <td>Status:</td>
                                            <td class="font-medium text-dark-medium">
                                                @if($customer->status=='active')
                                                    <i class="fa fa-check-circle text-success" data-bs-toggle="tooltip" title="active"></i>
                                                @else
                                                    <i class="fa fa-times-circle text-danger" data-bs-toggle="tooltip" title="inactive"></i>
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


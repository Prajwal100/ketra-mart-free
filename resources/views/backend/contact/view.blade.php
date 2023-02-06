@extends('backend.layouts.master')
@section('content')
    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Contact Messages</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Contact Messages</li>
                        </ol>
                    </div>
                </div>
                <div class="row justify-content-between">
                    <div class="col-lg-12 col-md-12">
                        <div class="card card-static-2 mb-30">
                            <div class="card-header">
                                <form class="mg-b-20">
                                    <div class="float-end my-1">
                                        <a href="{{route('contact.message')}}" class="btn btn-primary me-2"><i class="fe fe-arrow-left"></i> Go Back</a>
                                    </div>
                                </form>
                            </div>
                            <div class="card-body mt-3 ml-4">
                                <div class="row">
                                    <div class=" col-md-9 col-lg-9 hidden-xs hidden-sm">
                                        <table class="table table-bordered table-user-information">
                                            <tbody>
                                                <tr>
                                                    <td>Full name:</td>
                                                    <td>{{ucfirst($contact->name)}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Mobile No:</td>
                                                    <td>{{$contact->phone}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Email:</td>
                                                    <td>{{$contact->email}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Messages:</td>
                                                    <td><p style="font-width:16px;">{{$contact->message}}</p></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@extends('backend.layouts.master')

@section('content')
    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">All Attributes</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Product Attributes</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->
                <div class="row clearfix">
                <div class="col-md-12">
                    @include('layouts._error_notify')
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card p-4">
                        <div class="body">
                            <form action="{{route('attributes.update',$attribute->id)}}" method="post" >
                                @csrf
                                @method('patch')
                                <div class="row clearfix">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="name">Name<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" placeholder="Name" id="name" name="name" value="{{$attribute->name}}">
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-info"><i class="fas fa-paper-plane"></i> Update Changes</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>

@endsection

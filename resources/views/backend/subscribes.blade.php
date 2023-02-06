@extends('backend.layouts.master')
@section('content')
    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">All Subscribers</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Subscribers</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->
                <div class="row justify-content-between">
                    <div class="col-lg-12 col-md-12">
                        <div class="card mb-30 p-4">
                            <div class="card-header">
                                <form class="mg-b-20">
                                    <div class="float-end ">
                                        <a href="{{route('dashboard')}}" class="btn btn-primary me-2"><i class="fe fe-arrow-left"></i> Go Back</a>
                                        <a href="#" class="btn btn-danger delete_all" data-url="{{route('subscriber.delete.all')}}"><i class="fe fe-trash-2"></i> Clear All</a>
                                    </div>
                                </form>
                            </div>
                            <div class="card-body-table">
                                <div class="table-responsive">
                                    <table class="table ucp-table table-hover js-basic-example dataTable" id="example">
                                        <thead>
                                        <tr>
                                            <th>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input checkAll" id="check_box">
                                                </div>
                                            </th>
                                            <th style="width:60px">S.N.</th>
                                            <th>Email</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($subscribes as $key=>$item)
                                            <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input check_item" data-id="{{$item->id}}">
                                                    </div>
                                                </td>
                                                <td>#{{$loop->index+1}}</td>
                                                <td>{{$item->email}}</td>
                                                <td>
                                                    <div class="g-2 d-flex">
                                                        <form action="{{route('subscribe.destroy',$item->id)}}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn text-danger btn-sm show_confirm" data-bs-toggle="tooltip" data-bs-original-title="Delete"><span class="fe fe-trash-2 fs-14"></span></button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
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

@endsection

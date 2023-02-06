@extends('backend.layouts.master')

@section('content')
    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">All Orders</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Orders</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- ROW-4 -->
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <form class="mg-b-20">
                                    <div class="float-end my-1">
                                        <a href="#" class="btn btn-danger delete_all" data-url="{{route('banner.delete.all')}}"><i class="fe fe-trash-2"></i> Clear All</a>
                                    </div>
                                </form>
                            </div>
                            <div class="card-body pt-4">
                                <div class="grid-margin">
                                    <div class="table-responsive">
                                        <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom">
                                            <thead class="border-top">
                                            <tr>
                                                <th>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input checkAll" id="check_box">
                                                    </div>
                                                </th>
                                                <th >Order ID</th>
                                                <th style="width:150px">Ordered By</th>
                                                <th style="width:200px">Email</th>
                                                <th style="width:170px">Payment Status</th>
                                                <th style="width:230px">Payment Method</th>
                                                <th style="width:100px">Status</th>
                                                <th style="width:100px">Total</th>
                                                <th style="width:100px">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($orders as $item)
                                                <tr>
                                                    <td>
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input check_item" data-id="{{$item->id}}">
                                                        </div>
                                                    </td>
                                                    <td>#{{$item->order_number}}</td>
                                                    <td>
                                                        {{ucfirst($item->first_name)}} {{ucfirst($item->last_name)}}
                                                    </td>
                                                    <td>
                                                        {{$item->email}}
                                                    </td>
                                                    <td>
                                                        {{ucfirst($item->payment_status)}}
                                                    </td>
                                                    <td>{{$item->payment_method=='cod' ? 'Cash on Delivery' : ucfirst($item->payment_method)}}</td>
                                                    <td>
                                                        <div class="mt-sm-1 d-block">
                                                            <span class="badge bg-{{$item->order_status=='active' ? 'success' : 'warning'}} rounded-pill">{{ucfirst($item->order_status)}}</span>
                                                        </div>
                                                    </td>
                                                    <td>{{Helper::currency_converter($item->total_amount)}}</td>


                                                    <td>
                                                        <div class="g-2 d-flex">
                                                            <a href="{{route('invoice.download',$item->id)}}" class="btn text-info btn-sm" data-bs-toggle="tooltip" data-bs-original-title="download"><span class="fe fe-download fs-14"></span></a>

                                                            <a href="{{route('orders.show',$item->id)}}" class="btn text-primary btn-sm" data-bs-toggle="tooltip" data-bs-original-title="detail"><span class="fe fe-eye fs-14"></span></a>
                                                            <form action="{{route('orders.destroy',$item->id)}}" method="post">
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
                <!-- ROW-4 END -->

            </div>
            <!-- CONTAINER CLOSED -->
        </div>
    </div>
    <!--app-content closed-->
@endsection

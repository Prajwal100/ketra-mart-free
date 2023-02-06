@extends('backend.layouts.master')

@section('content')
<div class="container-fluid">
    <h2 class="mt-30 page-title">Dashboard</h2>
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="dashboard-report-card purple">
                <div class="card-content">
                    <span class="card-title">Total Products</span>
                    <span class="card-count">{{\App\Models\Product::where('status','active')->count()}}</span>
                </div>
                <div class="card-media">
                    <i class="fas fa-boxes"></i>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="dashboard-report-card info">
                <div class="card-content">
                    <span class="card-title">Total Category</span>
                    <span class="card-count">{{\App\Models\Category::where('status','active')->where('is_parent',1)->count()}}</span>
                </div>
                <div class="card-media">
                    <i class="fas fa-sitemap"></i>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="dashboard-report-card orange">
                <div class="card-content">
                    <span class="card-title">Total Order</span>
                    <span class="card-count">{{\App\Models\Order::count()}}</span>
                </div>
                <div class="card-media">
                    <i class="fas fa-sync-alt rpt_icon"></i>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="dashboard-report-card success">
                <div class="card-content">
                    <span class="card-title">Monthly Income</span>
                    <span class="card-count">{{Helper::currency_converter(Helper::getMonthlySum())}}</span>
                </div>
                <div class="card-media">
                    <i class="fas fa-money-bill rpt_icon"></i>
                </div>
            </div>
        </div>

        <div class="col-xl-12 col-md-12">
            <div class="card card-static-2 mb-30">
                <div class="card-title-2">
                    <h4>Recent Orders</h4>
                    <a href="{{route('orders.index')}}" class="view-btn hover-btn">View All</a>
                </div>
                <div class="card-body-table px-4">
                    <table class="table ucp-table table-hover">
                        <thead>
                        <tr>
                            <th style="width:130px">Order ID</th>
                            <th style="width:150px">Ordered By</th>
                            <th style="width:200px">Email</th>
                            <th style="width:230px">Payment Status</th>
                            <th style="width:230px">Payment Method</th>
                            <th style="width:100px">Status</th>
                            <th style="width:100px">Total</th>
                            <th style="width:100px">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($orders)>0)

                            @foreach($orders as $order)
                                <tr>
                                    <td>{{$order->order_number}}</td>
                                    <td>
                                        {{ucfirst($order->first_name)}} {{ucfirst($order->last_name)}}
                                    </td>
                                    <td>
                                        {{$order->email}}
                                    </td>

                                    <td>
                                        {{ucfirst($order->payment_status)}}
                                    </td>
                                    <td>{{$order->payment_method=='cod' ? 'Cash on Delivery' : ucfirst($order->payment_method)}}</td>
                                    <td>
                                        <span class="badge-item
                                        @if($order->order_status=='pending')
                                            badge-info
                                            @elseif($order->order_status=='process')
                                            badge-status
                                            @elseif($order->order_status=='delivered')
                                            badge-success
@else
                                            badge-danger
                                            @endif
                                            ">{{ucfirst($order->order_status)}}</span>
                                    </td>
                                    <td>{{Helper::currency_converter($order->total_amount)}}</td>
                                    <td class="d-flex">
                                        <a href="{{route('invoice.download',$order->id)}}" class="btn btn-outline-warning btn-sm mr-1" data-toggle="tooltip" data-placement="left" title="detail"><i class="fas fa-download"></i></a>
                                        <a href="{{route('orders.show',$order->id)}}" class="btn btn-outline-info btn-sm mr-1" data-toggle="tooltip" data-placement="bottom" title="view"><i class="fas fa-eye"></i></a>
                                        <form action="{{route('orders.destroy',$order->id)}}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <a href="javascript:void(0);" class="btn btn-sm btn-outline-danger dltBtn" data-id='{{$order->id}}' data-toggle="tooltip" data-placement="right" title="delete"><i class="fas fa-trash-alt"></i></a>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

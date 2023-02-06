@extends('backend.layouts.master')

@section('content')
    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Welcome, {{auth()->guard('admin')->user()->name}}!</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->
                <!-- ROW OPEN -->
                <div class="row">

                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                        <div class="card bg-secondary img-card box-secondary-shadow">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="text-white">
                                        <h2 class="mb-0 number-font">{{\App\Models\Banner::where(['status'=>'active'])->count()}}</h2>
                                        <p class="text-white mb-0">Total Banners</p>
                                    </div>
                                    <div class="ms-auto"> <i class="fe fe-image text-white fs-30 me-2 mt-2"></i> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- COL END -->
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                        <div class="card  bg-success img-card box-success-shadow">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="text-white">
                                        <h2 class="mb-0 number-font">{{\App\Models\Category::where(['status'=>'active'])->count()}}</h2>
                                        <p class="text-white mb-0">Total Categories</p>
                                    </div>
                                    <div class="ms-auto"> <i class="fa fa-sitemap text-white fs-30 me-2 mt-2"></i> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- COL END -->
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                        <div class="card bg-info img-card box-info-shadow">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="text-white">
                                        <h2 class="mb-0 number-font">{{\App\Models\Product::where(['status'=>'active'])->count()}}</h2>
                                        <p class="text-white mb-0">Total Products</p>
                                    </div>
                                    <div class="ms-auto"> <i class="fe fe-shopping-bag text-white fs-30 me-2 mt-2"></i> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- COL END -->
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                        <div class="card  bg-indigo img-card box-indigo-shadow">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="text-white">
                                        <h2 class="mb-0 number-font">{{\App\Models\User::count()}}</h2>
                                        <p class="text-white mb-0">Total Users </p>
                                    </div>
                                    <div class="ms-auto"> <i class="fe fe-users text-white fs-30 me-2 mt-2"></i> </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <!-- ROW CLOSED -->

                <!-- ROW2 OPEN -->
                <div class="row">

                    <!-- COL END -->

                    <!-- COL END -->
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                        <div class="card bg-cyan img-card box-cyan-shadow">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="text-white">
                                        <h2 class="mb-0 number-font">{{get_settings('visitors')}}</h2>
                                        <p class="text-white mb-0">Total Visitors</p>
                                    </div>
                                    <div class="ms-auto"> <i class="fa fa-eye text-white fs-30 me-2 mt-2"></i> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- COL END -->


                    <!-- COL END -->
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                        <div class="card bg-lime img-card box-lime-shadow">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="text-white">
                                        <h2 class="mb-0 number-font">{{\App\Models\Order::where(['order_status'=>'pending'])->count()}}</h2>
                                        <p class="text-white mb-0">Total Orders</p>
                                    </div>
                                    <div class="ms-auto"> <i class="fe fe-layers text-white fs-30 me-2 mt-2"></i> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- COL END -->
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                        <div class="card bg-primary img-card box-primary-shadow">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="text-white">
                                        <h2 class="mb-0 number-font">{{get_settings('currency')}}{{$data['total_earning_per_month']}}</h2>
                                        <p class="text-white mb-0">Earning Per Month </p>
                                    </div>
                                    <div class="ms-auto"> <i class="fe fe-dollar-sign text-white fs-30 me-2 mt-2"></i> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                        <div class="card  bg-warning img-card box-warning-shadow">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="text-white">
                                        <h2 class="mb-0 number-font">{{get_settings('currency')}}{{$data['total_earning']}}</h2>
                                        <p class="text-white mb-0">Total Earnings</p>
                                    </div>
                                    <div class="ms-auto"> <i class="fa fa-money text-white fs-30 me-2 mt-2"></i> </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- ROW CLOSED -->
                <!-- ROW-4 -->
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title mb-0">Product Sales</h3>
                            </div>
                            <div class="card-body pt-4">
                                <div class="grid-margin">
                                    <div class="">
                                        <div class="panel panel-primary">
                                            <div class="tab-menu-heading border-0 p-0">
                                                <div class="tabs-menu1">
                                                    <!-- Tabs -->
                                                    <ul class="nav panel-tabs product-sale">
                                                        <li><a href="#tab5" class="active" data-bs-toggle="tab">All Orders</a></li>
                                                        <li><a href="#tab6" data-bs-toggle="tab" class="text-dark">Pending</a></li>
                                                        <li><a href="#tab7" data-bs-toggle="tab" class="text-dark">Processing</a></li>
                                                        <li><a href="#tab8" data-bs-toggle="tab" class="text-dark">Delivered</a></li>
                                                        <li><a href="#tab9" data-bs-toggle="tab" class="text-dark">Cancelled</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="panel-body tabs-menu-body border-0 pt-0">
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="tab5">
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered text-nowrap mb-0 basic-datatable">
                                                                <thead class="border-top">
                                                                <tr>
                                                                    <th class="bg-transparent border-bottom-0" style="width: 5%;">Tracking Id</th>
                                                                    <th class="bg-transparent border-bottom-0">Customer</th>
                                                                    <th class="bg-transparent border-bottom-0">Date</th>
                                                                    <th class="bg-transparent border-bottom-0">Amount</th>
                                                                    <th class="bg-transparent border-bottom-0">Payment Mode</th>
                                                                    <th class="bg-transparent border-bottom-0" style="width: 10%;">Status</th>
                                                                    <th class="bg-transparent border-bottom-0" style="width: 5%;">Action</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach(\App\Models\Order::all() as $item)
                                                                    <tr class="border-bottom">
                                                                    <td class="text-center">
                                                                        <div class="mt-0 mt-sm-2 d-block">
                                                                            <h6 class="mb-0 fs-14 fw-semibold">#{{$item->order_number}}</h6>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="d-flex">
                                                                            <div class="mt-0 mt-sm-3 d-block">
                                                                                <h6 class="mb-0 fs-14 fw-semibold">
                                                                                    {{$item->first_name}} {{$item->last_name}}</h6>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td><span class="mt-sm-2 d-block">{{\Illuminate\Support\Carbon::parse($item->created_at)->format('d M Y')}}</span></td>
                                                                    <td><span class="fw-semibold mt-sm-2 d-block">{{get_settings('currency')}}{{number_format($item->total_amount,2)}}</span></td>
                                                                    <td>
                                                                        <div class="d-flex">
                                                                            <div class="mt-0 mt-sm-3 d-block">
                                                                                <h6 class="mb-0 fs-14 fw-semibold">
                                                                                    {{$item->payment_method=="cod" ? 'Cash on Delivery' : $item->payment_method}}</h6>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="mt-sm-1 d-block">
                                                                            @if($item->order_status=='pending')
                                                                                <span class="badge bg-info-transparent rounded-pill text-success p-2 px-3">{{ucfirst($item->order_status)}}</span>
                                                                            @elseif($item->order_status=='process')
                                                                                <span class="badge bg-primary-transparent rounded-pill text-success p-2 px-3">{{ucfirst($item->order_status)}}</span>
                                                                            @elseif($item->order_status=='delivered')
                                                                                <span class="badge bg-success-transparent rounded-pill text-success p-2 px-3">{{ucfirst($item->order_status)}}</span>
                                                                            @else
                                                                                <span class="badge bg-warning-transparent rounded-pill text-success p-2 px-3">{{ucfirst($item->order_status)}}</span>
                                                                            @endif
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="g-2">
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
                                                    <div class="tab-pane" id="tab6">
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered text-nowrap mb-0 basic-datatable">
                                                                <thead class="border-top">
                                                                <tr>
                                                                    <th class="bg-transparent border-bottom-0" style="width: 5%;">Tracking Id</th>
                                                                    <th class="bg-transparent border-bottom-0">Customer</th>
                                                                    <th class="bg-transparent border-bottom-0">Date</th>
                                                                    <th class="bg-transparent border-bottom-0">Amount</th>
                                                                    <th class="bg-transparent border-bottom-0">Payment Mode</th>
                                                                    <th class="bg-transparent border-bottom-0" style="width: 10%;">Status</th>
                                                                    <th class="bg-transparent border-bottom-0" style="width: 5%;">Action</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach(\App\Models\Order::where('order_status','pending')->get() as $item)
                                                                        <tr class="border-bottom">
                                                                            <td class="text-center">
                                                                                <div class="mt-0 mt-sm-2 d-block">
                                                                                    <h6 class="mb-0 fs-14 fw-semibold">#{{$item->order_number}}</h6>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="d-flex">
                                                                                    <div class="mt-0 mt-sm-3 d-block">
                                                                                        <h6 class="mb-0 fs-14 fw-semibold">
                                                                                            {{$item->first_name}} {{$item->last_name}}</h6>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td><span class="mt-sm-2 d-block">{{\Illuminate\Support\Carbon::parse($item->created_at)->format('d M Y')}}</span></td>
                                                                            <td><span class="fw-semibold mt-sm-2 d-block">{{get_settings('currency')}}{{number_format($item->total_amount,2)}}</span></td>
                                                                            <td>
                                                                                <div class="d-flex">
                                                                                    <div class="mt-0 mt-sm-3 d-block">
                                                                                        <h6 class="mb-0 fs-14 fw-semibold">
                                                                                            {{$item->payment_method=="cod" ? 'Cash on Delivery' : $item->payment_method}}</h6>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="mt-sm-1 d-block">
                                                                                    @if($item->order_status=='pending')
                                                                                        <span class="badge bg-info-transparent rounded-pill text-success p-2 px-3">{{ucfirst($item->order_status)}}</span>
                                                                                    @elseif($item->order_status=='process')
                                                                                        <span class="badge bg-primary-transparent rounded-pill text-success p-2 px-3">{{ucfirst($item->order_status)}}</span>
                                                                                    @elseif($item->order_status=='delivered')
                                                                                        <span class="badge bg-success-transparent rounded-pill text-success p-2 px-3">{{ucfirst($item->order_status)}}</span>
                                                                                    @else
                                                                                        <span class="badge bg-warning-transparent rounded-pill text-success p-2 px-3">{{ucfirst($item->order_status)}}</span>
                                                                                    @endif
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="g-2">
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
                                                    <div class="tab-pane" id="tab7">
                                                        <div class="table-responsive">
                                                            <table  class="table table-bordered text-nowrap mb-0 basic-datatable">
                                                                <thead class="border-top">
                                                                <tr>
                                                                    <th class="bg-transparent border-bottom-0" style="width: 5%;">Tracking Id</th>
                                                                    <th class="bg-transparent border-bottom-0">Customer</th>
                                                                    <th class="bg-transparent border-bottom-0">Date</th>
                                                                    <th class="bg-transparent border-bottom-0">Amount</th>
                                                                    <th class="bg-transparent border-bottom-0">Payment Mode</th>
                                                                    <th class="bg-transparent border-bottom-0" style="width: 10%;">Status</th>
                                                                    <th class="bg-transparent border-bottom-0" style="width: 5%;">Action</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach(\App\Models\Order::where('order_status','process')->get() as $item)
                                                                        <tr class="border-bottom">
                                                                            <td class="text-center">
                                                                                <div class="mt-0 mt-sm-2 d-block">
                                                                                    <h6 class="mb-0 fs-14 fw-semibold">#{{$item->order_number}}</h6>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="d-flex">
                                                                                    <div class="mt-0 mt-sm-3 d-block">
                                                                                        <h6 class="mb-0 fs-14 fw-semibold">
                                                                                            {{$item->first_name}} {{$item->last_name}}</h6>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td><span class="mt-sm-2 d-block">{{\Illuminate\Support\Carbon::parse($item->created_at)->format('d M Y')}}</span></td>
                                                                            <td><span class="fw-semibold mt-sm-2 d-block">{{get_settings('currency')}}{{number_format($item->total_amount,2)}}</span></td>
                                                                            <td>
                                                                                <div class="d-flex">
                                                                                    <div class="mt-0 mt-sm-3 d-block">
                                                                                        <h6 class="mb-0 fs-14 fw-semibold">
                                                                                            {{$item->payment_method=="cod" ? 'Cash on Delivery' : $item->payment_method}}</h6>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="mt-sm-1 d-block">
                                                                                    @if($item->order_status=='pending')
                                                                                        <span class="badge bg-info-transparent rounded-pill text-success p-2 px-3">{{ucfirst($item->order_status)}}</span>
                                                                                    @elseif($item->order_status=='process')
                                                                                        <span class="badge bg-primary-transparent rounded-pill text-success p-2 px-3">{{ucfirst($item->order_status)}}</span>
                                                                                    @elseif($item->order_status=='delivered')
                                                                                        <span class="badge bg-success-transparent rounded-pill text-success p-2 px-3">{{ucfirst($item->order_status)}}</span>
                                                                                    @else
                                                                                        <span class="badge bg-warning-transparent rounded-pill text-success p-2 px-3">{{ucfirst($item->order_status)}}</span>
                                                                                    @endif
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="g-2">
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
                                                    <div class="tab-pane" id="tab8">
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered text-nowrap mb-0 basic-datatable">
                                                                <thead class="border-top">
                                                                <tr>
                                                                    <th class="bg-transparent border-bottom-0" style="width: 5%;">Tracking Id</th>
                                                                    <th class="bg-transparent border-bottom-0">Customer</th>
                                                                    <th class="bg-transparent border-bottom-0">Date</th>
                                                                    <th class="bg-transparent border-bottom-0">Amount</th>
                                                                    <th class="bg-transparent border-bottom-0">Payment Mode</th>
                                                                    <th class="bg-transparent border-bottom-0" style="width: 10%;">Status</th>
                                                                    <th class="bg-transparent border-bottom-0" style="width: 5%;">Action</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach(\App\Models\Order::where('order_status','delivered')->get() as $item)
                                                                        <tr class="border-bottom">
                                                                            <td class="text-center">
                                                                                <div class="mt-0 mt-sm-2 d-block">
                                                                                    <h6 class="mb-0 fs-14 fw-semibold">#{{$item->order_number}}</h6>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="d-flex">
                                                                                    <div class="mt-0 mt-sm-3 d-block">
                                                                                        <h6 class="mb-0 fs-14 fw-semibold">
                                                                                            {{$item->first_name}} {{$item->last_name}}</h6>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td><span class="mt-sm-2 d-block">{{\Illuminate\Support\Carbon::parse($item->created_at)->format('d M Y')}}</span></td>
                                                                            <td><span class="fw-semibold mt-sm-2 d-block">{{get_settings('currency')}}{{number_format($item->total_amount,2)}}</span></td>
                                                                            <td>
                                                                                <div class="d-flex">
                                                                                    <div class="mt-0 mt-sm-3 d-block">
                                                                                        <h6 class="mb-0 fs-14 fw-semibold">
                                                                                            {{$item->payment_method=="cod" ? 'Cash on Delivery' : $item->payment_method}}</h6>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="mt-sm-1 d-block">
                                                                                    @if($item->order_status=='pending')
                                                                                        <span class="badge bg-info-transparent rounded-pill text-success p-2 px-3">{{ucfirst($item->order_status)}}</span>
                                                                                    @elseif($item->order_status=='process')
                                                                                        <span class="badge bg-primary-transparent rounded-pill text-success p-2 px-3">{{ucfirst($item->order_status)}}</span>
                                                                                    @elseif($item->order_status=='delivered')
                                                                                        <span class="badge bg-success-transparent rounded-pill text-success p-2 px-3">{{ucfirst($item->order_status)}}</span>
                                                                                    @else
                                                                                        <span class="badge bg-warning-transparent rounded-pill text-success p-2 px-3">{{ucfirst($item->order_status)}}</span>
                                                                                    @endif
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="g-2">
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
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>

                                                    <div class="tab-pane" id="tab9">
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered text-nowrap mb-0 basic-datatable">
                                                                <thead class="border-top">
                                                                <tr>
                                                                    <th class="bg-transparent border-bottom-0" style="width: 5%;">Tracking Id</th>
                                                                    <th class="bg-transparent border-bottom-0">Customer</th>
                                                                    <th class="bg-transparent border-bottom-0">Date</th>
                                                                    <th class="bg-transparent border-bottom-0">Amount</th>
                                                                    <th class="bg-transparent border-bottom-0">Payment Mode</th>
                                                                    <th class="bg-transparent border-bottom-0" style="width: 10%;">Status</th>
                                                                    <th class="bg-transparent border-bottom-0" style="width: 5%;">Action</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach(\App\Models\Order::where('order_status','cancelled')->get() as $item)
                                                                    <tr class="border-bottom">
                                                                        <td class="text-center">
                                                                            <div class="mt-0 mt-sm-2 d-block">
                                                                                <h6 class="mb-0 fs-14 fw-semibold">#{{$item->order_number}}</h6>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <div class="d-flex">
                                                                                <div class="mt-0 mt-sm-3 d-block">
                                                                                    <h6 class="mb-0 fs-14 fw-semibold">
                                                                                        {{$item->first_name}} {{$item->last_name}}</h6>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td><span class="mt-sm-2 d-block">{{\Illuminate\Support\Carbon::parse($item->created_at)->format('d M Y')}}</span></td>
                                                                        <td><span class="fw-semibold mt-sm-2 d-block">{{get_settings('currency')}}{{number_format($item->total_amount,2)}}</span></td>
                                                                        <td>
                                                                            <div class="d-flex">
                                                                                <div class="mt-0 mt-sm-3 d-block">
                                                                                    <h6 class="mb-0 fs-14 fw-semibold">
                                                                                        {{$item->payment_method=="cod" ? 'Cash on Delivery' : $item->payment_method}}</h6>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <div class="mt-sm-1 d-block">
                                                                                @if($item->order_status=='pending')
                                                                                    <span class="badge bg-info-transparent rounded-pill text-success p-2 px-3">{{ucfirst($item->order_status)}}</span>
                                                                                @elseif($item->order_status=='process')
                                                                                    <span class="badge bg-primary-transparent rounded-pill text-success p-2 px-3">{{ucfirst($item->order_status)}}</span>
                                                                                @elseif($item->order_status=='delivered')
                                                                                    <span class="badge bg-success-transparent rounded-pill text-success p-2 px-3">{{ucfirst($item->order_status)}}</span>
                                                                                @else
                                                                                    <span class="badge bg-warning-transparent rounded-pill text-success p-2 px-3">{{ucfirst($item->order_status)}}</span>
                                                                                @endif
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <div class="g-2">
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
                    </div>
                </div>
                <!-- ROW-4 END -->

            </div>
            <!-- CONTAINER END -->
        </div>
    </div>
    <!--app-content close-->
    <!-- Country-selector modal-->
{{--    <div class="modal fade" id="country-selector">--}}
{{--        <div class="modal-dialog modal-dialog-centered" role="document">--}}
{{--            <div class="modal-content country-select-modal">--}}
{{--                <div class="modal-header">--}}
{{--                    <h6 class="modal-title">Choose Country</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>--}}
{{--                </div>--}}
{{--                <div class="modal-body">--}}
{{--                    <div class="row p-3">--}}
{{--                        @foreach(\App\Models\Language::where('status','active')->get() as $key=>$lang)--}}
{{--                            <div class="col-lg-6">--}}
{{--                                <label class="btn btn-country btn-lg btn-block" for="btnradio1">--}}
{{--                                    <span class="country-selector" data-lang="{{$lang->lang_code}}"><img alt="" src="{{$lang->flat_path}}" class="me-3 language"></span>{{$lang->name}}--}}
{{--                                </label>--}}
{{--                            </div>--}}
{{--                        @endforeach--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <!-- Country-selector modal-->

@endsection

@push('styles')

@endpush

@push('scripts')
    <script>
        //______Basic Data Table
        $('.basic-datatable').DataTable({
            language: {
                searchPlaceholder: 'Search...',
                sSearch: '',
            }
        });

    </script>
    <script>
        /*-------------------------------------
                   Line Chart
               -------------------------------------*/
        if ($("#earning-line-chart").length) {

            var lineChartData = {
                labels: ["", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun", ""],
                datasets: [{
                    data: [0, 5e4, 1e4, 5e4, 14e3, 7e4, 5e4, 75e3, 5e4],
                    backgroundColor: '#ff0000',
                    borderColor: '#ff0000',
                    borderWidth: 1,
                    pointRadius: 0,
                    pointBackgroundColor: '#ff0000',
                    pointBorderColor: '#ffffff',
                    pointHoverRadius: 6,
                    pointHoverBorderWidth: 3,
                    fill: 'origin',
                    label: "Total Collection"
                },
                    {
                        data: [0, 3e4, 2e4, 6e4, 7e4, 5e4, 5e4, 9e4, 8e4],
                        backgroundColor: '#417dfc',
                        borderColor: '#417dfc',
                        borderWidth: 1,
                        pointRadius: 0,
                        pointBackgroundColor: '#304ffe',
                        pointBorderColor: '#ffffff',
                        pointHoverRadius: 6,
                        pointHoverBorderWidth: 3,
                        fill: 'origin',
                        label: "Fees Collection"
                    }
                ]
            };
            var lineChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                animation: {
                    duration: 2000
                },
                scales: {

                    xAxes: [{
                        display: true,
                        ticks: {
                            display: true,
                            fontColor: "#222222",
                            fontSize: 16,
                            padding: 20
                        },
                        gridLines: {
                            display: true,
                            drawBorder: true,
                            color: '#cccccc',
                            borderDash: [5, 5]
                        }
                    }],
                    yAxes: [{
                        display: true,
                        ticks: {
                            display: true,
                            autoSkip: true,
                            maxRotation: 0,
                            fontColor: "#646464",
                            fontSize: 16,
                            stepSize: 25000,
                            padding: 20,
                            callback: function (value) {
                                var ranges = [{
                                    divider: 1e6,
                                    suffix: 'M'
                                },
                                    {
                                        divider: 1e3,
                                        suffix: 'k'
                                    }
                                ];

                                function formatNumber(n) {
                                    for (var i = 0; i < ranges.length; i++) {
                                        if (n >= ranges[i].divider) {
                                            return (n / ranges[i].divider).toString() + ranges[i].suffix;
                                        }
                                    }
                                    return n;
                                }
                                return formatNumber(value);
                            }
                        },
                        gridLines: {
                            display: true,
                            drawBorder: false,
                            color: '#cccccc',
                            borderDash: [5, 5],
                            zeroLineBorderDash: [5, 5],
                        }
                    }]
                },
                legend: {
                    display: false
                },
                tooltips: {
                    mode: 'index',
                    intersect: false,
                    enabled: true
                },
                elements: {
                    line: {
                        tension: .35
                    },
                    point: {
                        pointStyle: 'circle'
                    }
                }
            };
            var earningCanvas = $("#earning-line-chart").get(0).getContext("2d");
            var earningChart = new Chart(earningCanvas, {
                type: 'line',
                data: lineChartData,
                options: lineChartOptions
            });
        }

        /*-------------------------------------
              Bar Chart
          -------------------------------------*/
        if ($("#expense-bar-chart").length) {

            var barChartData = {
                labels: ['January', 'Febuary', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                datasets: [{
                    backgroundColor: ["#B96D40", "#40dfcd", "#DCB8CB","#828A95","#D5C9DF","#CEEAF7","#E5C3D1","#7D82B8","#EF798A","#F7A9A8","#FFCF9C","#F20604"],
                    data: [{{$monthlyUsers[0]}},{{$monthlyUsers[1]}},{{$monthlyUsers[2]}},{{$monthlyUsers[3]}},{{$monthlyUsers[4]}},{{$monthlyUsers[4]}},{{$monthlyUsers[5]}},{{$monthlyUsers[6]}},{{$monthlyUsers[7]}},{{$monthlyUsers[8]}},{{$monthlyUsers[9]}},{{$monthlyUsers[10]}},{{$monthlyUsers[11]}}],
                    label: "Monthly registered users"
                }, ]
            };
            var barChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                animation: {
                    duration: 2000
                },
                scales: {
                    xAxes: [{
                        display: true,
                        maxBarThickness: 100,
                        ticks: {
                            display: true,
                            padding: 0,
                            fontColor: "#646464",
                            fontSize: 14,
                        },
                        gridLines: {
                            display: true,
                            color: '#e1e1e1',
                        }
                    }],
                    yAxes: [{
                        display: true,
                        ticks: {
                            display: true,
                            autoSkip: false,
                            fontColor: "#646464",
                            fontSize: 14,
                            stepSize: 10,
                            padding: 20,
                            beginAtZero: true,
                            callback: function (value) {
                                var ranges = [{
                                    divider: 1e6,
                                    suffix: 'M'
                                },
                                    {
                                        divider: 1e3,
                                        suffix: 'k'
                                    }
                                ];

                                function formatNumber(n) {
                                    for (var i = 0; i < ranges.length; i++) {
                                        if (n >= ranges[i].divider) {
                                            return (n / ranges[i].divider).toString() + ranges[i].suffix;
                                        }
                                    }
                                    return n;
                                }
                                return formatNumber(value);
                            }
                        },
                        gridLines: {
                            display: true,
                            drawBorder: true,
                            color: '#e1e1e1',
                            zeroLineColor: '#e1e1e1'

                        }
                    }]
                },
                legend: {
                    display: false
                },
                tooltips: {
                    enabled: true
                },
                elements: {}
            };
            var expenseCanvas = $("#expense-bar-chart").get(0).getContext("2d");
            var expenseChart = new Chart(expenseCanvas, {
                type: 'bar',
                data: barChartData,
                options: barChartOptions
            });
        }

        /*-------------------------------------
              Doughnut Chart
          -------------------------------------*/
        if ($("#country-doughnut-chart").length) {

            var doughnutChartData = {
                labels: ["Female Students", "Male Students"],
                datasets: [{
                    backgroundColor: ["#304ffe", "#ffa601"],
                    data: [45000, 105000],
                    label: "Total Students"
                }, ]
            };
            var doughnutChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                cutoutPercentage: 65,
                rotation: -9.4,
                animation: {
                    duration: 2000
                },
                legend: {
                    display: false
                },
                tooltips: {
                    enabled: true
                },
            };
            var countryCanvas = $("#country-doughnut-chart").get(0).getContext("2d");
            var countryChart = new Chart(countryCanvas, {
                type: 'doughnut',
                data: doughnutChartData,
                options: doughnutChartOptions
            });
        }
        if ($("#browser-doughnut-chart").length) {

            var doughnutChartData = {
                labels: ["Female Students", "Male Students"],
                datasets: [{
                    backgroundColor: ["#304ffe", "#ffa601"],
                    data: [45000, 105000],
                    label: "Total Students"
                }, ]
            };
            var doughnutChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                cutoutPercentage: 65,
                rotation: -9.4,
                animation: {
                    duration: 2000
                },
                legend: {
                    display: false
                },
                tooltips: {
                    enabled: true
                },
            };
            var browserCanvas = $("#browser-doughnut-chart").get(0).getContext("2d");
            var browserChart = new Chart(browserCanvas, {
                type: 'doughnut',
                data: doughnutChartData,
                options: doughnutChartOptions
            });
        }

        if ($("#os-doughnut-chart").length) {

            var doughnutChartData = {
                labels: ["Female Students", "Male Students"],
                datasets: [{
                    backgroundColor: ["#304ffe", "#ffa601"],
                    data: [450, 105],
                    label: "Total Students"
                }, ]
            };
            var doughnutChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                cutoutPercentage: 65,
                rotation: -9.4,
                animation: {
                    duration: 2000
                },
                legend: {
                    display: false
                },
                tooltips: {
                    enabled: true
                },
            };
            var osCanvas = $("#os-doughnut-chart").get(0).getContext("2d");
            var osChart = new Chart(osCanvas, {
                type: 'doughnut',
                data: doughnutChartData,
                options: doughnutChartOptions
            });
        }

    </script>
@endpush

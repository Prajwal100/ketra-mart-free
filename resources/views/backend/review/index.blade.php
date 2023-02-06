@extends('backend.layouts.master')

@section('content')
    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">All Reviews</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Reviews</li>
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
                                        <a href="#" class="btn btn-danger delete_all" data-url="{{route('review.delete.all')}}"><i class="fe fe-trash-2"></i> Clear All</a>
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
                                                <th>S.N.</th>
                                                <th>Full name</th>
                                                <th>Product name</th>
                                                <th>Rate</th>
                                                <th>Reason</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($reviews as $item)
                                                @php
                                                    $product=\App\Models\Product::where('id',$item->product_id)->first();
                                                    $user=\App\Models\User::where('id',$item->user_id)->first();
                                                @endphp
                                                <tr>
                                                    <td>
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input check_item" data-id="{{$item->id}}">
                                                        </div>
                                                    </td>
                                                    <td>#{{$loop->iteration}}</td>
                                                    <td>{{ucfirst($item->name)}}</td>
                                                    <td><a href="{{route('product.detail',$product->slug)}}" target="_blank">{{ucfirst($product->title)}}</a></td>
                                                    <td>
                                                        @php
                                                            $rate = ceil($item->rate);
                                                        @endphp
                                                        @for ($i = 0; $i < 5; $i++)
                                                            @if ($i < $rate)
                                                                <i class="fa fa-star text-warning"></i>
                                                            @else
                                                                <i class="fa fa-star-o text-warning"></i>
                                                    @endif
                                                    @endfor
                                                    <td>{{\Illuminate\Support\Str::limit($item->review,30)}}...</td>

                                                    <td>
                                                        <div class="mt-sm-1 d-block">
                                                            @if($item->status=='pending')
                                                                <span class="badge bg-info rounded-pill p-2 px-3">{{ucfirst($item->status)}}</span>
                                                            @elseif($item->status=='accept')
                                                                <span class="badge bg-success rounded-pill p-2 px-3">{{ucfirst($item->status)}}</span>
                                                            @else
                                                                <span class="badge bg-danger rounded-pill p-2 px-3">{{ucfirst($item->status)}}</span>
                                                            @endif

                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="g-2 d-flex">
                                                            <a href="{{route('reviews.show',$item->id)}}" class="btn text-primary btn-sm" data-bs-toggle="tooltip" data-bs-original-title="details"><span class="fe fe-eye fs-14"></span></a>
                                                            <form action="{{route('reviews.destroy',$item->id)}}" method="post">
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


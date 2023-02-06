@extends('backend.layouts.master')

@section('content')
    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">All Products</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Products</li>
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
                                        <a href="{{route('product.create')}}" class="btn btn-primary me-2"><i class="fe fe-plus-circle"></i> Add Product</a>
                                        <a href="#" class="btn btn-danger delete_all" data-url="{{route('product.delete.all')}}"><i class="fe fe-trash-2"></i> Clear All</a>
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
                                                <th>Image</th>
                                                <th>Product Detail</th>
                                                <th>Price</th>
                                                <th>Categories</th>
                                                <th>Featured</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($products as $item)
                                                <tr>
                                                    <td>
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input check_item" data-id="{{$item->id}}">
                                                        </div>
                                                    </td>
                                                    <td>#{{$loop->iteration}}</td>
                                                    <td><img src="{{asset($item->thumbnail_image)}}"
                                                             style="width: 100px;"
                                                             alt="{{$item->title}}">
                                                    </td>
                                                    <td>
                                                        {{ucfirst($item->title)}}<br>
                                                    </td>

                                                    <td>
                                                        <strong>Unit Price: </strong>{{get_settings('currency')}}{{$item->unit_price}}<br>
                                                        <strong>Selling Price: </strong>{{get_settings('currency')}}{{$item->purchase_price}}
                                                    </td>

                                                    <td>
                                                        {{$item->category->title}}
                                                    </td>

                                                    <td>
                                                        @if($item->is_featured==1)
                                                            <i class="fa fa-check-circle text-success" data-bs-toggle="tooltip" title="Yes">
                                                        @else
                                                            <i class="fa fa-times-circle text-danger" data-bs-toggle="tooltip" title="No">
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="mt-sm-1 d-block">
                                                            <span class="badge bg-{{$item->status=='active' ? 'success' : 'warning'}}-transparent rounded-pill text-{{$item->status=='active' ? 'success' : 'warning'}} p-2 px-3">{{ucfirst($item->status)}}</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="g-2 d-flex">
                                                            <a href="{{route('product.edit',$item->id)}}" class="btn text-primary btn-sm" data-bs-toggle="tooltip" data-bs-original-title="Edit"><span class="fe fe-edit fs-14"></span></a>
                                                            <form action="{{route('product.destroy',$item->id)}}" method="post">
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


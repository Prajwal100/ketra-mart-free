@extends('backend.layouts.master')

@section('content')
    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">All Attributes Value <a href="{{route('attributes.index')}}" class="btn btn-primary me-2"><i class="fe fe-arrow-left"></i> Go Back</a>
                    </h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Product Attribute Value</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <div class="row clearfix">
                <div class="col-md-12">
                    @include('layouts._error_notify')
                </div>
                <div class="col-lg-8 col-md-12 col-sm-12">
                    <div class="card p-4">
                        <div class="card-body-table px-4">
                            <div class="card-body-table">
                                <div class="table-responsive  p-3">
                                    <table class="table ucp-table table-hover">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Attribute Value</th>
                                            <th>Color Code</th>
                                            <th>Attribute</th>
                                            <th >Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($attribute_values)>0)
                                            @foreach($attribute_values as $item)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{ucfirst($item->name)}}</td>

                                                <td style="display:flex;"><span style="display: block;
                                                width: 26px;
                                                height: 26px;
                                                background-color:{{$item->color_code}};
                                                border: 1px solid #fff;"></span>&nbsp;{{$item->color_code}}</td>
                                                    <td>{{ucfirst($item->attribute->name)}}</td>
                                                    <td class="d-flex">
                                                        <form action="{{route('attribute_values.destroy',$item->id)}}" method="POST">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="btn text-danger btn-sm show_confirm" data-bs-toggle="tooltip" data-bs-original-title="Delete"><span class="fe fe-trash-2 fs-14"></span></button>
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
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="card p-4">
                        <div class="card-header">
                            <h5 class="mb-0 h6">Add New Values</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('attribute_values.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="name">Attribute</label>
                                    <input type="hidden" name="attribute_id" value="{{ $attribute->id }}" class="form-control" >
                                    <div class="form-control" readonly>{{ $attribute->name }}</div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="name">Attribute Value Name</label>
                                    <input type="text" placeholder="Name" id="name" name="name" class="form-control" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="color_code">Color Code(Optional)</label>
                                    <input type="text" placeholder="#ffffff" id="color_code" name="color_code" class="form-control">
                                </div>

                                <div class="form-group mb-3 text-right">
                                    <button type="submit" class="btn btn-info"><i class="fas fa-paper-plane"></i> Add Values</button>
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

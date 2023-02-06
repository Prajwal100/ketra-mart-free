@extends('backend.layouts.master')

@section('content')
    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">All Banners</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Banners</li>
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
                                        <a href="{{route('banner.create')}}" class="btn btn-primary me-2"><i class="fe fe-plus-circle"></i> Add Banner</a>
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
                                                <th>S.N.</th>
                                                <th>Image</th>
                                                <th>Banner Type</th>
{{--                                                <th>Slider Content</th>--}}
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($banners as $item)
                                                    <tr>
                                                        <td>
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input check_item" data-id="{{$item->id}}">
                                                            </div>
                                                        </td>
                                                        <td>#{{$loop->iteration}}</td>
                                                        <td>
                                                            <img src="{{asset($item->image)}}"
                                                                 style="height:50px;width: 120px;"
                                                                 alt="banner{{$item->id}}"></td>
                                                        <td>
                                                            <div class="d-flex">
                                                                <div class="mt-0 mt-sm-3 d-block">
                                                                    <h6 class="mb-0 fs-14 fw-semibold">
                                                                        @if($item->banner_type=='home')
                                                                            Home
                                                                        @elseif($item->banner_type=='popup')
                                                                            Popup
                                                                        @else
                                                                            Promotion
                                                                        @endif
                                                                    </h6>
                                                                </div>
                                                            </div>
                                                        </td>
{{--                                                        <td>--}}
{{--                                                            <small>--}}
{{--                                                                @if($item->url !=null)--}}
{{--                                                                    <span class="fw-semibold mt-sm-2 d-block">URL: {{$item->url}}</span>--}}
{{--                                                                @endif--}}
{{--                                                                @if($item->heading !=null)--}}

{{--                                                                    <p><strong>Heading: {{$item->heading}}</strong></p>--}}
{{--                                                                @endif--}}

{{--                                                                @if($item->subheading !=null)--}}

{{--                                                                    <p><strong>Subheading: {{$item->subheading}}</strong></p>--}}
{{--                                                                @endif--}}

{{--                                                                @if($item->btn_text !=null)--}}

{{--                                                                    <p><strong>Btn Txt: {{$item->btn_text}}</strong></p>--}}
{{--                                                                @endif--}}

{{--                                                            </small>--}}
{{--                                                        </td>--}}

                                                        <td>
                                                            <div class="mt-sm-1 d-block">
                                                                <span class="badge bg-{{$item->status=='active' ? 'success' : 'warning'}}-transparent rounded-pill text-{{$item->status=='active' ? 'success' : 'warning'}} p-2 px-3">{{ucfirst($item->status)}}</span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="g-2 d-flex">
                                                                <a href="{{route('banner.edit',$item->id)}}" class="btn text-primary btn-sm" data-bs-toggle="tooltip" data-bs-original-title="Edit"><span class="fe fe-edit fs-14"></span></a>
                                                                <form action="{{route('banner.destroy',$item->id)}}" method="post">
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

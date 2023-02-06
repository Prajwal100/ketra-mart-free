@extends('backend.layouts.master')
@section('content')
    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">FAQ</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">FAQ</li>
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
                                        <a href="{{route('faq.create')}}" class="btn btn-primary me-2"><i class="fe fe-plus-circle"></i> Add New</a>
                                    </div>
                                </form>
                            </div>
                            <div class="card-body pt-4">
                                <div class="grid-margin">
                                    <div class="table-responsive">
                                        <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom">
                                            <thead class="border-top">
                                            <tr>
                                                <th style="width:60px">S.N.</th>
                                                <th style="width:100px">Question</th>
                                                <th>Answer</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @foreach($faqs as $key=>$item)
                                                <tr>

                                                    <td>{{$loop->index+1}}</td>
                                                    <td>
                                                        {{$item->question}}
                                                    </td>
                                                    <td>{!! html_entity_decode($item->answer) !!}</td>
                                                    <td>
                                                        <div class="mt-sm-1 d-block">
                                                            <span class="badge bg-{{$item->status=='active' ? 'success' : 'warning'}}-transparent rounded-pill text-{{$item->status=='active' ? 'success' : 'warning'}} p-2 px-3">{{ucfirst($item->status)}}</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="g-2 d-flex">
                                                            <a href="{{route('faq.edit',$item->id)}}" class="btn text-primary btn-sm" data-bs-toggle="tooltip" data-bs-original-title="Edit"><span class="fe fe-edit fs-14"></span></a>
                                                            <form action="{{route('faq.destroy',$item->id)}}" method="post">
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

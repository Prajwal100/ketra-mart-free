@extends('backend.layouts.master')

@section('content')
    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">All Categories</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Categories</li>
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
                                        <a href="{{route('categories.create')}}" class="btn btn-primary me-2"><i class="fe fe-plus-circle"></i> Add Category</a>
                                        <a href="#" class="btn btn-danger delete_all" data-url="{{route('category.delete.all')}}"><i class="fe fe-trash-2"></i> Clear All</a>
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
                                                <th>Name</th>
                                                <th>Parent Category</th>
                                                <th>Level</th>
                                                <th>Position</th>
                                                <th>Image</th>
                                                <th>Icon</th>
                                                <th>Featured</th>
                                                <th>Is Menu</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($categories as $item)
                                                <tr>
                                                    <td>
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input check_item" data-id="{{$item->id}}">
                                                        </div>
                                                    </td>
                                                    <td>#{{$loop->iteration}}</td>
                                                    <td>{{$item->title}}</td>
                                                    <td>
                                                        @php
                                                            $parent = \App\Models\Category::where('id', $item->parent_id)->first();
                                                        @endphp
                                                        @if ($parent != null)
                                                            {{ $parent->title }}
                                                        @else
                                                            —
                                                        @endif
                                                    </td>
                                                    <td>{{$item->level}}</td>
                                                    <td>{{$item->position}}</td>
                                                    <td><img src="{{$item->banner !=null ? asset($item->banner) : Helper::defaultImage()}}"
                                                             style="width: 80px;"
                                                             alt="{{$item->title}}"></td>

                                                    <td><img src="{{$item->icon !=null ? asset($item->icon) : Helper::defaultImage()}}"
                                                             style="width: 40px;"
                                                             alt="icon{{$item->id}}"></td>

                                                    <td>{{$item->featured==1 ? 'Yes' : 'No'}}</td>
                                                    <td>{{$item->is_menu==1 ? 'Yes' : 'No'}}</td>
                                                    <td>
                                                        <div class="mt-sm-1 d-block">
                                                            <span class="badge bg-{{$item->status=='active' ? 'success' : 'warning'}}-transparent rounded-pill text-{{$item->status=='active' ? 'success' : 'warning'}} p-2 px-3">{{ucfirst($item->status)}}</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="g-2 d-flex">
                                                            <a href="{{route('categories.edit',$item->id)}}" class="btn text-primary btn-sm" data-bs-toggle="tooltip" data-bs-original-title="Edit"><span class="fe fe-edit fs-14"></span></a>
                                                            <form action="{{route('categories.destroy',$item->id)}}" method="post">
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

@push('scripts')

@endpush

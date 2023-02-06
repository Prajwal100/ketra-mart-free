    @extends('backend.layouts.master')

@section('content')
    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">All Attributes</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Product Attributes</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->
                <div class="row mt-4">

            <div class="col-lg-6 col-md-6 ">
                <div class="card card-static-2 mb-30">
                    <div class="card-body-table px-4">
                        <div class="card-body-table">
                            <div class="table-responsive  p-3">
                                <table class="table ucp-table table-hover">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Values</th>
                                        <th >Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($attributes)>0)
                                        @foreach($attributes as $item)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{ucfirst($item->name)}}</td>
                                                <td>
                                                    @foreach($item->attribute_values as $key => $value)
                                                        <span class="badge bg-lime ">{{ $value->name }}</span>
                                                    @endforeach
                                                </td>

                                                <td>
                                                    <div class="g-2 d-flex">
                                                        <a href="{{route('attributes.edit',$item->id)}}" class="btn text-primary btn-sm" data-bs-toggle="tooltip" data-bs-original-title="Edit"><span class="fe fe-edit fs-14"></span></a>
                                                        <a href="{{route('attributes.show',$item->id)}}" class="btn text-success btn-sm" data-bs-toggle="tooltip" data-bs-original-title="Details"><span class="fe fe-eye fs-14"></span></a>
                                                        <form action="{{route('attributes.destroy',$item->id)}}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn text-danger btn-sm show_confirm" data-bs-toggle="tooltip" data-bs-original-title="Delete"><span class="fe fe-trash-2 fs-14"></span></button>
                                                        </form>
                                                    </div>
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
            <div class="col-lg-6 col-md-6">
                <div class="card card-static-2 mb-30">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0 h6">Add New Attribute</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('attributes.store') }}" method="POST">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" placeholder="Name" id="name" name="name" class="form-control" required>
                                </div>
                                <div class="form-group mb-3 text-right">
                                    <button type="submit" class="btn btn-info"><i class="fas fa-paper-plane"></i> Add Attribute</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            </div>
        </div>

    </div>
@endsection

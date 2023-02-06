@extends('backend.layouts.master')
@section('content')
    <div class="container-fluid">
        <h2 class="mt-30 page-title text-uppercase">Promo Banners
        </h2>
        <div class="row justify-content-between">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="body p-4">
                        <form action="{{route('promo.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row clearfix">

                                <div class="col-lg-6 col-md-12 mt-3">
                                    <div class="form-group">
                                        <label for="">Promo name</label>
                                        <input type="text" class="form-control" placeholder="Promo name" name="title" value="{{old('title')}}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 mt-3">
                                    <div class="form-group">
                                        <label for="">URL</label>
                                        <input type="text" class="form-control" placeholder="URL" name="slug" value="{{old('slug')}}">
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for="">Banner Image <span class="text-danger">*</span></label>
                                        <input required type="file" name="image" class="dropify" id="input-file-now" data-height="100" data-default-file="{{old('image')}}">
                                    </div>
                                </div>

                                <div class="col-lg-12 col-sm-12" >
                                    <div class="form-group">
                                        <label for="status">Status <span class="text-danger">*</span></label>
                                        <select name="status" class="form-control show-tick">
                                            <option value="active" {{old('status')=='active' ? 'selected' : ''}}>Active</option>
                                            <option value="inactive" {{old('status') == 'inactive' ? 'selected' : ''}} >Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-info create-btn">Create Banner</button>
                                        <button type="reset" class="btn btn-outline-danger cancel-btn">Cancel</button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>

                <div class="card card-static-2 mb-30 mt-3">
                    <div class="card-body-table p-4">
                        <div class="table-responsive">
                            <table class="table ucp-table table-hover js-basic-example dataTable" id="example">
                                <thead>
                                <tr>
                                    <th style="width:60px">S.N.</th>
                                    <th style="width:100px">Image</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($promo as $key=>$item)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>
                                            <img src="{{asset($item->image_path)}}" alt="Banner Image" style="max-width: 150px">
                                        </td>
                                        <td>{{$item->title}}</td>
                                        <td>
                                            <label  class="switch">
                                                <input  class="status" type="checkbox" name="toogle" value="{{$item->id}}" {{$item->status=='active' ? 'checked' : ''}}>
                                                <span
                                                    class="slider round"></span>
                                            </label>
                                        </td>
                                        <td class="d-flex">
                                            <form action="{{route('promo.delete',$item->id)}}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <a href="javascript:void(0);" class="btn btn-sm btn-outline-danger dltBtn" data-id='{{$item->id}}' title="delete" data-toggle="tooltip" data-placement="right" title="delete"><i class="fas fa-trash-alt"></i></a>
                                            </form>
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

@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.dltBtn').click(function(e){
                var form=$(this).closest('form');
                var dataID=$(this).data('id');
                e.preventDefault();
                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this data!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            form.submit();
                        } else {
                            swal({
                                title:"Your data is safe!",
                                icon:'info',
                            });
                        }
                    });
            })
        })
    </script>
    <script>
        $('input[name=toogle]').change(function () {
            var mode=$(this).prop('checked');
            var id=$(this).val();
            // alert(id);
            $.ajax({
                url:"{{route('promo.status')}}",
                type:"POST",
                data:{
                    _token:'{{csrf_token()}}',
                    mode:mode,
                    id:id,
                },
                success:function (response) {
                    if(response.status){
                        $.notify({
                                title:'<strong>Success,</strong>',
                                message:response.msg
                            },
                            {
                                z_index: 9999,
                                animate: {
                                    enter: 'animated fadeInRight',
                                    exit: 'animated fadeOutRight'
                                },
                            },
                        );
                    }
                    else{
                        $.notify({
                                title:'<strong>Sorry,</strong>',
                                message:"Something went wrong, Please try again"
                            },
                            {
                                z_index: 9999,
                                animate: {
                                    enter: 'animated fadeInRight',
                                    exit: 'animated fadeOutRight'
                                },
                            },
                        );
                    }
                }
            })
        });
    </script>
@endsection

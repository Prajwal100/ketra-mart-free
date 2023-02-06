@extends('backend.layouts.master')

@section('content')
    <div class="container-fluid">
        <h5 class="mt-30 page-title text-uppercase">All Customers</h5>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card card-static-2 p-4 mb-30">
                    <div class="card-body-table">
                        <div class="table-responsive">
                            <table class="table ucp-table table-hover" id="example">
                                <thead>
                                <tr>
                                    <th style="width:60px">ID</th>
                                    <th style="width:100px">Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Register Via</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($users)>0)
                                    @foreach($users as $item)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>
                                                <div class="cate-img-6">
                                                    <img src="{{Helper::userProfile()}}" alt="">
                                                </div>
                                            </td>
                                            <td>{{ucfirst($item->full_name)}}</td>
                                            <td>{{$item->email}}</td>
                                            <td>{{$item->phone ?? 'N/A'}}</td>
                                            <td>{{$item->provider ?? 'Email/Password'}}</td>
                                            <td>
                                                <label  class="switch">
                                                    <input  class="status" type="checkbox" name="toogle" value="{{$item->id}}" {{$item->status=='active' ? 'checked' : ''}}>
                                                    <span
                                                        class="slider round"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <form action="{{route('user.destroy',$item->id)}}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <a href="javascript:void(0);" class="btn btn-sm btn-outline-danger dltBtn" data-id='{{$item->id}}'  data-toggle="tooltip" data-placement="right" title="delete"><i class="fas fa-trash-alt"></i></a>
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
    </div>
@endsection

@section('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.dltBtn').click(function (e) {
            var form=$(this).closest('form');
            var dataID=$(this).data('id');
            e.preventDefault();
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                        swal("Poof! Your imaginary file has been deleted!", {
                            icon: "success",
                        });
                    } else {
                        swal("Your imaginary file is safe!");
                    }
                });

        });
    </script>
    <script>
        $('input[name=toogle]').change(function () {
            var mode=$(this).prop('checked');
            var id=$(this).val();
            // alert(id);
            $.ajax({
                url:"{{route('user.status')}}",
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

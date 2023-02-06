@extends('backend.layouts.master')

@section('content')
    <div class="container-fluid">
        <h5 class="mt-30 page-title text-uppercase">Currencies
            <a href="{{route('currency.create')}}" class="btn btn-outline-info btn-sm"><i class="fas fa-plus-circle"></i> Add New</a>
        </h5>
        <div class="row justify-content-between">
            <div class="col-lg-12 col-md-12">
                <div class="card card-static-2 mb-30">
                    <div class="card-title-2">
                        <h4 >All Currencies</h4>
                    </div>
                    <div class="card-body-table p-4">
                        <div class="table-responsive">
                            <table class="table ucp-table table-hover" id="example">
                                <thead>
                                <tr>
                                    <th style="width:60px">ID</th>
                                    <th style="width:130px">Flag</th>
                                    <th>Name</th>
                                    <th>Symbol</th>
                                    <th>Code</th>
                                    <th>Exchange Rate(1 USD=?)</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($currencies)>0)
                                    @foreach($currencies as $item)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>
                                                <div class="cate-img">
                                                    <img src="{{$item->flag_path ? asset($item->flag_path) : Helper::DefaultImage()}}" alt="Flag Image">
                                                </div>
                                            </td>
                                            <td>{{ucfirst($item->name)}}</td>
                                            <td>{{$item->symbol}}</td>
                                            <td>{{$item->code}}</td>
                                            <td>{{$item->exchange_rate}}</td>
                                            <td>
                                                <label  class="switch">
                                                    <input  class="status" type="checkbox" name="toogle" value="{{$item->id}}" {{$item->status=='active' ? 'checked' : ''}}>
                                                    <span
                                                        class="slider round"></span>
                                                </label>
                                            </td>
                                            <td class="d-flex">
                                                <a href="{{route('currency.edit',$item->id)}}" class="mr-1 btn btn-sm btn-outline-info" data-toggle="tooltip" data-placement="left" title="edit"><i class="fas fa-edit"></i></a>
                                                <form action="{{route('currency.destroy',$item->id)}}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <a href="javascript:void(0);" class="btn btn-sm btn-outline-danger view-shop-btn dltBtn" data-id='{{$item->id}}' data-toggle="tooltip" data-placement="right" title="delete"><i class="fas fa-trash-alt"></i></a>
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
                        swal({
                            title:"Your data is safe!",
                            icon:'info',
                        });
                    }
                });

        });
    </script>
    <script>
        $('input[name=toogle]').change(function () {

            var id = $(this).attr("id");
            if ($(this).prop("checked") == true) {
                var status = 1;
            } else if ($(this).prop("checked") == false) {
                var status = 0;
            }
            var mode=$(this).prop('checked');
            var id=$(this).val();
            // alert(id);
            $.ajax({
                url:"{{route('category.status')}}",
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

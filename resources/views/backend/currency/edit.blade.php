@extends('backend.layouts.master')

@section('content')
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header pt-3">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h5 class="text-uppercase"><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"></a>Edit Currency</h5>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-md-12">
                    @include('backend.layouts._error_notify')
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card p-4">
                        <div class="body">
                            <form action="{{route('currency.update',$currency->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('patch')
                                <div class="row clearfix">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="">Currency name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" placeholder="US dollar" name="name" value="{{$currency->name}}" >
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="">Currency Symbol <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" placeholder="$" name="symbol" value="{{$currency->symbol}}" >
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="">Currency Code <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" placeholder="USD" name="code" value="{{$currency->code}}" >
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="">Exchange Rate <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" placeholder="100" name="exchange_rate" value="{{$currency->exchange_rate}}" >
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="">Flag</label>
                                            <input type="file" name="flag" class="dropify" data-height="100" data-default-file="{{$currency->flag_path ? asset($currency->flag_path) : ''}}" value="{{$currency->flag}}">
                                        </div>
                                    </div>


                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-info create-btn">Update Currency</button>
                                            <button type="reset" class="btn btn-outline-danger cancel-btn">Cancel</button>
                                        </div>
                                    </div>
                               </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
@section('styles')
    <style>
        label{
            font-weight: bold;
        }
    </style>
@endsection
@section('scripts')
    <script>
        // $('#lfm').filemanager('image');
        $("#title").focusout(function(e){
            var title = $("#title").val();
            var createdSlug = convertToSlug(title.trim());
            var blogSlug = $("#slug").val(createdSlug);
        });

        function convertToSlug(Text){
            return Text
                .toLowerCase()
                .replace(/[^\w ]+/g,'')
                .replace(/ +/g,'-')
                ;
        }
    </script>

    <script>
        $(document).ready(function() {
            $('#description').summernote({
                height:150
            });
        });
    </script>
    <script>
        $('#is_parent').change(function(e){
            e.preventDefault();
            var is_checked=$('#is_parent').prop('checked');
            // alert(is_checked);
            if(is_checked){
                $('#parent_cat_div').addClass('d-none');
                $('#parent_cat').val('');
            }
            else{
                $('#parent_cat_div').removeClass('d-none');
            }
        })
    </script>
@endsection

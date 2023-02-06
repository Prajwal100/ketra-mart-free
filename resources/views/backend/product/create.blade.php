@extends('backend.layouts.master')
@section('content')
    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @include('layouts._error_notify')
                    </div>
                </div>
                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">
                        <a href="{{route('product.index')}}" class="btn btn-primary me-2"><i class="fe fe-arrow-left"></i> Go Back</a>
                    </h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add Product</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- ROW-1 OPEN -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Add New Product</div>
                            </div>
                            <form class="new-added-form" action="{{route('product.store')}}" method="post" enctype="multipart/form-data" id="choice_form">
                                @csrf
                                <div class="card-body">
                                    <div class="row mb-4">
                                        <div class="col-6">
                                            <label class="form-label">Name * :</label>
                                            <input type="text" placeholder="Enter name" class="form-control" name="title" value="{{old('title')}}" id="title">
                                        </div>
                                        <div class="col-6">
                                            <label>Slug *</label>
                                            <input type="text" placeholder="Enter slug" class="form-control" name="slug" value="{{old('slug')}}" id="slug">
                                        </div>
                                    </div>

                                    <div class="row mb-4">

                                        <div class="col-6">
                                            <label class="form-label">Product Condition:</label>
                                            <select  name="product_label" class="form-control form-select select2" data-bs-placeholder="Select Label">
                                                <option value="">None</option>
                                                <option value="sale">Sale</option>
                                                <option value="new">New</option>
                                                <option value="hot">Hot</option>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label">Category:</label>
                                            <select name="cat_ids" class="form-control form-select select2" data-bs-placeholder="Select Category">
                                                <option value="0">No Parent</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                                    @foreach($category->childrenCategories as $childCategory)
                                                        @include('backend.category.child_category', ['child_category' => $childCategory])                                @endforeach
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>


{{--                                    <div class="row mb-4">--}}
{{--                                        <div class="col-6">--}}
{{--                                            <label>Min Qty *</label>--}}
{{--                                            <input type="number" placeholder="Enter min qty" class="form-control" name="min_qty" value="1" >--}}
{{--                                        </div>--}}
{{--                                        <div class="col-6">--}}
{{--                                            <label>Unit </label>--}}
{{--                                            <select name="unit"  class="form-control form-select select2" data-bs-placeholder="Select Unit">--}}
{{--                                                @foreach(Helper::units() as $item)--}}
{{--                                                    <option value="{{$item}}">{{$item}}</option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                    @if (\App\Models\Attribute::count() > 0)

                                    <div class="row ">
                                        <div class="col-6">
                                            <div class="d-flex">
                                                <label for="">Color : </label>

                                                <label class="custom-switch form-switch mb-0">
                                                    <input type="checkbox" class="custom-switch-input" name="colors_active" checked>
                                                    <span class="custom-switch-indicator"></span>
                                                </label>

                                            </div>
                                            <select  name="colors[]" class="form-control select2 color-var-select" id="colors-selector" multiple >
                                                @if(\App\Models\Attribute::where(['has_color'=>1])->count()>0)
                                                    @foreach(\App\Models\Attribute::where(['has_color'=>1])->first()->attribute_values as $color)
                                                        <option value={{$color->color_code}} @isset($product['colors']) {{in_array($color->color_code,$product['colors'])?'selected':''}} @endisset>{{$color['name']}}</option>
                                                    @endforeach
                                                @endif

                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <div class="d-flex">
                                                    <label for="">Attribute : </label>
                                                </div>
                                                <select  name="choice_attributes[]" class="form-control select2 color-var-select" id="choice_attributes" multiple >
                                                    @foreach(\App\Models\Attribute::where('has_color',0)->orderBy('name','ASC')->get() as $attribute)
                                                        <option value="{{$attribute->id}}" >{{ucfirst($attribute['name'])}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    @endif

                                    <div class="row mb-4">
                                        <div class="col-md-12 mb-2">
                                            <div class="customer_choice_options" id="customer_choice_options">

                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-3 col-md-12 mt-3">
                                                    <div class="form-group">
                                                        <label for="">Quantity <span class="text-danger">*</span></label>
                                                        <input required  type="number" class="form-control" placeholder="Quantity" name="current_stock" value="{{old('current_stock')}}">
                                                    </div>
                                                </div>

                                                <div class="col-lg-3 col-md-12 mt-3">
                                                    <div class="form-group">
                                                        <label for="">Unit Price <span class="text-danger">*</span></label>
                                                        <input required type="number" step="any" class="form-control" placeholder="Unit Price" name="unit_price" value="{{old('unit_price')}}">
                                                    </div>
                                                </div>

                                                <div class="col-lg-3 col-md-12 mt-3">
                                                    <div class="form-group">
                                                        <label for="">Discount</label>
                                                        <input type="number" min="0"  step="any" class="form-control" placeholder="Discount" name="discount" value="{{old('discount')}}">
                                                    </div>
                                                </div>

                                                <div class="col-lg-3 col-md-12 mt-3">
                                                    <div class="form-group">
                                                        <label for="">Discount Type</label>
                                                        <select class="form-control select2" name="discount_type" id="">
                                                            <option value="amount">Amount</option>
                                                            <option value="percent">Percent</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <div class="sku_combination" id="sku_combination">

                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>



                                    <div class="row mb-4">
                                        <div class="col-lg-12 col-md-12 mt-3">
                                            <div class="form-group">
                                                <label for="">Summary</label>
                                                <textarea id="summernote" class="form-control summernote" placeholder="Write some text..." name="summary">{{old('summary')}}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-md-12 mt-3">
                                            <div class="form-group">
                                                <label for="">Description</label>
                                                <textarea id="description" class="form-control summernote" placeholder="Write some text..." name="description">{{old('description')}}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-md-12 mt-3">
                                            <div class="form-group">
                                                <label for="">Features</label>
                                                <textarea id="features" class="form-control summernote" placeholder="Write some text..." name="features">{{old('features')}}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-12  mt-3">
                                            <div class="form-group">
                                                <label for="">Is featured : </label>
                                                <input type="checkbox" name="is_featured" value="1" data-toggle="switchbutton"  data-size="sm">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-12  mt-3">
                                            <div class="form-group">
                                                <label for="">Is Refundable : </label>
                                                <input type="checkbox" name="refundable" value="1"  data-toggle="switchbutton"  data-size="sm">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-12  mt-3">
                                            <div class="form-group">
                                                <label for="">Allow Estimated Shipping Time: : </label>
                                                <input type="checkbox"  value="1"  data-toggle="switchbutton"  data-size="sm" id="allowProductShipping">
                                            </div>
                                        </div>

                                        <div class="row mb-4 d-none"  id="shipping_div">
                                            <div class="col-6">
                                                <label >Processing Time :</label>
                                                <input type="text" class="form-control" name="processing_time" placeholder="4-5 days" value="{{old('processing_time')}}">
                                            </div>
                                            <div class="col-6">
                                                <label >Shipping Time </label>
                                                <input type="text" placeholder="7-10 days" class="form-control" name="shipping_time" value="{{old('shipping_time')}}" >
                                            </div>
                                        </div>
                                    </div>
                                   <div class="row mb-4">
                                       <div class="col-lg-12 col-md-12 mt-3">
                                           <div class="form-group">


                                            <label for="">Thumbnail Image  <span class="text-danger">*</span></label>
                                               <!-- add img -->
                                               <div class="position-relative ">
                                                   <div class="row">
                                                       <div class="col-2">
                                                           <a href="javascript:void(0)" data-target-id="f" id="thumb-image"  class="img-thumbnail button-image">
                                                               <div id="input-image-f" class="display-imput-image">
                                                                   <img src="{{Helper::DefaultImage()}}">
                                                               </div>
                                                           </a>
                                                           <div class="custom-image-f">
                                                           </div>
                                                       </div>
                                                   </div>

                                                   <input required type="hidden" name="thumbnail_image" value="" id="input-image-name-f" />
                                               </div>
                                           </div>
                                       </div>
                                       <div class="col-lg-12 col-md-12 ">
                                           <div class="form-group">
                                               <!-- /add img -->
                                               <div class="additional-images">
                                                   <div class="panel panel-default">
                                                       <div class="panel-heading">
                                                           <div class="card-header" style="margin:10px 0;" ><i class="fa fa-file-image-o" aria-hidden="true"></i> Additional Images <small style="font-size: 10px">[Recommend image size 288*345]</small></div>
                                                       </div>
                                                       <div class="row">

                                                           <div class="col-2 additional_image mt-3">

                                                               <a href="javascript:void(0)" data-target-id="1" id="thumb-image" class="img-thumbnail button-image">
                                                                   <div id="input-image-1" class="display-imput-image">
                                                                       <img src="{{Helper::DefaultImage()}}">
                                                                   </div>
                                                               </a>
                                                               <div class="custom-image-1">
                                                               </div>
                                                               <input type="hidden" name="images[]" value="" id="input-image-name-1" />
                                                           </div>
                                                           <div class="col-2 additional_image mt-3">

                                                               <a href="javascript:void(0)" data-target-id="2" id="thumb-image"class="img-thumbnail button-image">
                                                                   <div id="input-image-2" class="display-imput-image">
                                                                       <img src="{{Helper::DefaultImage()}}">
                                                                   </div>
                                                               </a>
                                                               <div class="custom-image-2">
                                                               </div>
                                                               <input type="hidden" name="images[]" value="" id="input-image-name-2" />
                                                           </div>
                                                           <div class="col-2 additional_image mt-3">

                                                               <a href="javascript:void(0)" data-target-id="3" id="thumb-image" class="img-thumbnail button-image">
                                                                   <div id="input-image-3" class="display-imput-image">
                                                                       <img src="{{Helper::DefaultImage()}}">
                                                                   </div>
                                                               </a>
                                                               <div class="custom-image-3">
                                                               </div>
                                                               <input id="input-image-name-3"  type="hidden" name="images[]" value="" />
                                                           </div>
                                                           <div class="col-2 additional_image mt-3">

                                                               <a href="javascript:void(0)" data-target-id="4" id="thumb-image"class="img-thumbnail button-image">
                                                                   <div id="input-image-4" class="display-imput-image">
                                                                       <img src="{{Helper::DefaultImage()}}">
                                                                   </div>
                                                               </a>
                                                               <div class="custom-image-4">
                                                               </div>
                                                               <input id="input-image-name-4"  type="hidden" name="images[]" value="" />
                                                           </div>
                                                           <div class="col-2 additional_image mt-3">

                                                               <a href="javascript:void(0)" data-target-id="5" id="thumb-image" class="img-thumbnail button-image">
                                                                   <div id="input-image-5" class="display-imput-image">
                                                                       <img src="{{Helper::DefaultImage()}}">
                                                                   </div>
                                                               </a>
                                                               <div class="custom-image-5">
                                                               </div>
                                                               <input id="input-image-name-5"  type="hidden" name="images[]" value="" />
                                                           </div>
                                                           <div class="col-2 additional_image mt-3">

                                                               <a href="javascript:void(0)" data-target-id="6" id="thumb-image" class="img-thumbnail button-image">
                                                                   <div id="input-image-6" class="display-imput-image">
                                                                       <img src="{{Helper::DefaultImage()}}">
                                                                   </div>
                                                               </a>
                                                               <div class="custom-image-6">
                                                               </div>
                                                               <input id="input-image-name-6"  type="hidden" name="images[]" value="" />
                                                           </div>
                                                           <div class="col-12">
                                                               <label for=""><small class="text-danger"><strong>Note: </strong>Minimum one image is required.</small></label>
                                                           </div>


                                                       </div>
                                                   </div>

                                               </div>
                                           </div>
                                       </div>
                                   </div>

                                    <div class="row">
                                        <div class="col-lg-12 col-md-12  mt-4 ">
                                            <div class="form-group">
                                                <div class="row pb-3">
                                                    <div class="col-6">
                                                        <label for="">Product attributes</label>
                                                    </div>
                                                    <div class="col-6 ">
                                                        <button class="btn btn-secondary float-end" type="button"
                                                                onclick="add_new_attribute()"><i class="fas fa-plus-circle"></i> Add new attribute</button>
                                                    </div>
                                                </div>

                                                <div class="alert alert-info">
                                                    These attributes will be used only for filtering.</div>
                                                <div class="all-attributes">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-4">

                                        <div class="col-lg-6 col-md-12 ">
                                            <div class="form-group">
                                                <label for="">Meta Title</label>
                                                <input type="text" name="meta_title" placeholder="Meta Title" class="form-control" value="{{old('meta_title')}}">
                                            </div>
                                        </div>


                                        <div class="col-lg-6 col-md-12 ">
                                            <div class="form-group">
                                                <label for="">Meta Keywords</label>
                                                <input type="text" name="meta_keywords" placeholder="Meta Keywords" class="form-control" value="{{old('meta_keywords')}}">
                                            </div>
                                        </div>


                                        <div class="col-lg-12 col-md-12 ">
                                            <div class="form-group">
                                                <label for="">Meta Description</label>
                                                <textarea name="meta_description" class="form-control" placeholder="Write meta description..." id="" rows="4">{{old('meta_description')}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-xl-12 col-lg-12 col-12 form-group">
                                            <label>Status *</label>
                                            <select name="status" class="form-control select2 form-select" data-placeholder="Choose one">
                                                <option value="active" {{old('status')=='active' ? 'selected' : ''}}>Active</option>
                                                <option value="inactive" {{old('status')=='inactive' ? 'selected' : ''}}>Inactive</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="card-footer">
                                    <!--Row-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary"><i class="fe fe-plus-circle"></i> Add Product</button>
                                        </div>
                                    </div>
                                    <!--End Row-->
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /ROW-1 CLOSED -->
            </div>
            <!-- CONTAINER CLOSED -->
        </div>
    </div>
    <!--app-content closed-->
@endsection

@push('styles')

    <style>
        .bs-popover-right{
            position: absolute;
            transform: translate3d(593px, 701px, 0px);
            top: 31px !important;
            left: 0px;
            will-change: transform;
        }
        .arrow{
            top:12px !important;
        }

        .select2-container--default .color-preview {
            height: 12px;
            width: 12px;
            display: inline-block;
            margin-right: 5px;
            margin-left: 3px;
            margin-top: 2px;
        }
        .select2-container .select2-selection--single {
            height: 26px;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 26px;
            font-size: 15px;
        }
        label{
            font-weight: bold;
        }

    </style>

    <style>
        label{
            font-weight: bold;
        }

        .switch-group .btn{
            border: 1px solid #ddd !important;
        }
    </style>

@endpush

@push('scripts')
    <!-- Latest compiled and minified JavaScript -->

    <script>
        $("#allowProductShipping").change(function (e) {
            e.preventDefault();
            if(this.checked){
                $("#shipping_div").removeClass('d-none');
            }
            else{
                $("#shipping_div").addClass('d-none');
            }
        })
    </script>

    {{--  attribute section   --}}
    <script>
        $('#choice_attributes').on('change', function () {
            $('#customer_choice_options').html(null);
            $.each($("#choice_attributes option:selected"), function () {
                //console.log($(this).val());
                add_more_customer_choice_option($(this).val(), $(this).text());
            });
            update_sku();
        });

        function add_more_customer_choice_option(i, name){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:"POST",
                url:'{{ route('products.add-more-choice-option') }}',
                data:{
                    attribute_id: i
                },
                success: function(data) {
                    var obj = JSON.parse(data);
                    $('.select2').select2({
                    });
                    $('#customer_choice_options').append('\
                        <div class="row">\
                            <div class="col-md-2">\
                                <input type="hidden" name="choice_no[]" value="'+i+'">\
                                <input type="text" class="form-control" name="choice[]" value="'+name+'" placeholder="Choice Title" readonly>\
                            </div>\
                            <div class="col-md-10">\
                                <select class="form-control select2 attribute_choice" data-live-search="true" name="choice_options_'+ i +'[]" multiple>\
                                    '+obj+'\
                                </select>\
                            </div>\
                        </div>');
                    $('.select2').select2({
                    });
                }
            });
        }
        $(document).on("change", ".attribute_choice",function() {
            update_sku();
        });
        function add_new_attribute(){
            $.ajax({
                type:"POST",
                data:$("#choice_form").serialize(),
                url:'{{route('product.new_attribute')}}',
                success:function (data) {
                    if(data.count==-1){
                        notify('warning','Please select an attribute.')
                    }
                    else if(data.count >0){
                        $('.all-attributes').append(data.view);
                        $('.select2').select2({
                        });
                    }
                    else{
                        notify('warning','No more arrtribute found.')
                    }
                }
            })
        }
        function get_attributes_values(e){
            $.ajax({
                url:"{{route('product.get_attribute.values')}}",
                type:"POST",
                data:{
                    attribute_id:$(e).val(),
                    _token:"{{csrf_token()}}",
                },
                success:function (data) {
                    $(e).closest('.row').find('.attr-values').html(data);
                    $('.select2').select2({
                    });
                }
            });
        }
        $(document).on(
            "click",
            '[data-toggle="remove-parent"]',
            function () {
                var $this = $(this);
                var parent = $this.data("parent");
                $this.closest(parent).remove();
            }
        );
        function add_new_option(){
            $.ajax({
                type: "POST",
                data: $('#choice_form').serialize(),
                url: '{{ route('product.new_option') }}',
                success: function(data) {
                    if (data.count == -2) {
                        notify('warning','Maximum option limit reached.')
                    } else if (data.count == -1) {
                        notify('warning','Please select an option.')
                    } else if (data.count > 0) {
                        $('.customer_choice_options').find('.attr-names').find('.aiz-selectpicker').siblings(
                            '.dropdown-toggle').addClass("disabled");
                        $('.customer_choice_options').append(data.view);
                        $('.select2').select2({
                        });
                    } else {
                        notify('warning','No more option found.')
                    }
                }
            })
        }
        $("#allowProductSEO").change(function (e) {
            e.preventDefault();
            if(this.checked){
                $("#seo-div").removeClass('d-none');
            }
            else{
                $("#seo-div").addClass('d-none');
            }
        });
        $("#allowProductShipping").change(function (e) {
            e.preventDefault();
            if(this.checked){
                $("#shipping_div").removeClass('d-none');
            }
            else{
                $("#shipping_div").addClass('d-none');
            }
        })
    </script>


    <script>
        $("form").bind("keypress", function (e) {
            if (e.keyCode == 13) {
                return false;
            }
        });
    </script>


    {{--    select2 initilize  --}}
    <script>
        $(document).ready(function () {
            // color select select2
            $('.color-var-select').select2({
                templateResult: colorCodeSelect,
                templateSelection: colorCodeSelect,
                escapeMarkup: function (m) {
                    return m;
                }
            });
            $('.demo-select2').select2({
            });
            function colorCodeSelect(state) {
                var colorCode = $(state.element).val();
                if (!colorCode) return state.text;
                return "<span class='color-preview' style='background-color:" + colorCode + ";'></span>" + state.text;
            }
        });
    </script>


    {{--  update sku combo  --}}
    <script>
        $('#colors-selector').on('change', function () {
            update_sku();
        });
        $('input[name="unit_price"]').on('keyup', function () {
            update_sku();
        });
        $('input[name="current_stock"]').on('keyup', function () {
            update_sku();
        });
        function update_sku() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: '{{route('product.sku-combination')}}',
                data: $('#choice_form').serialize(),
                success: function (data) {
                    $('#sku_combination').html(data.view);
                    if (data.length > 1) {
                        $('#quantity').hide();
                    } else {
                        $('#quantity').show();
                    }
                }
            });
        }
    </script>

    {{--Color enable & disabled--}}
    <script>
        $('input[name="colors_active"]').on('change',function () {
            if($('input[name="colors_active"]').is(':checked')){
                $('#colors-selector').prop('disabled',false);
                $('#sku_combination').show();
            }
            else{
                $('#colors-selector').prop('disabled',true);
                $('#sku_combination').hide();
            }
        });
    </script>

@endpush

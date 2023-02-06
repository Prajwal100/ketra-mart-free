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
                            <li class="breadcrumb-item active" aria-current="page">Update Product</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->
                <!-- ROW-1 OPEN -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Edit Product</div>
                            </div>
                        <form class="new-added-form" action="{{route('products.update',$product->id)}}" method="post" enctype="multipart/form-data" id="choice_form">
                            @csrf
                            <div class="card-body">
                                <input type="hidden" name="id" value="{{$product->id}}">

                                <div class="row">

                                    <div class="row mb-4">
                                        <div class="col-6">
                                            <label class="form-label">Name * :</label>
                                            <input type="text" placeholder="Enter name" class="form-control" name="title" value="{{$product->title}}" id="title">
                                        </div>
                                        <div class="col-6">
                                            <label  class="form-label">Slug *</label>
                                            <input type="text" placeholder="Enter slug" class="form-control" name="slug" value="{{$product->slug}}" id="slug">
                                        </div>

                                        <div class="col-6">
                                            <label class="form-label">Brand:</label>

                                        </div>
                                        <div class="col-6">
                                            <label class="form-label">Category:</label>
                                            <select name="cat_ids" class="form-control form-select select2" data-bs-placeholder="Select Category">
                                                <option value="0">No Parent</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" {{$category->id==$product->cat_ids ? 'selected' : ''}}>{{ $category->title }}</option>
                                                    @foreach($category->childrenCategories as $childCategory)
                                                        @include('backend.category.child_category', ['child_category' => $childCategory])
                                                    @endforeach
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <label  class="form-label">Min Qty *</label>
                                            <input type="number"  placeholder="Enter min qty" class="form-control" name="min_qty" value="{{$product->min_qty}}" >
                                        </div>
                                        <div class="col-6">
                                            <label  class="form-label">Unit </label>
                                            <select name="unit"  class="form-control form-select select2" data-bs-placeholder="Select Unit">
                                                @foreach(Helper::units() as $item)
                                                    <option value="{{$item}}" {{$item==$product->unit ? 'selected' : ''}}>{{$item}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        @if (\App\Models\Attribute::count() > 0)
                                             <div class="col-6">
                                                    <div class="d-flex">
                                                        <label  class="form-label" for="">Color : </label>

                                                        <label class="custom-switch form-switch mb-0">
                                                            <input type="checkbox" class="custom-switch-input" name="colors_active"  {{count($product->colors)>0 ? 'checked' : ''}}>
                                                            <span class="custom-switch-indicator"></span>
                                                        </label>

                                                    </div>
                                                    <select  name="colors[]" class="form-control select2 color-var-select" id="colors-selector" multiple  {{count($product['colors'])>0?'':'disabled'}} >
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
                                                        <label  class="form-label">Attribute : </label>
                                                    </div>
                                                    <select  name="choice_attributes[]" class="form-control select2 color-var-select" id="choice_attributes" multiple >
                                                        @foreach(\App\Models\Attribute::where('has_color',0)->orderBy('name','ASC')->get() as $attribute)
                                                            @isset($product['attributes'])
                                                                <option value="{{$attribute->id}}"  @if($attribute !=null && json_decode($product["attributes"])){{in_array($attribute->id,json_decode($product['attributes'],true))?'selected':''}} @endif>{{ucfirst($attribute['name'])}}</option>
                                                            @else
                                                                <option value="{{$attribute->id}}">{{ucfirst($attribute['name'])}}</option>

                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        @endif

                                    </div>


                                    <div class="row mb-4">
                                        <div class="col-md-12 mt-2 mb-2">
                                            <div class="customer_choice_options" id="customer_choice_options">
                                                @foreach (json_decode($product->choice_options) as $key => $choice_option)
                                                    <div class="row">
                                                        <div class="col-lg-2">
                                                            <input type="hidden" name="choice_no[]" value="{{ $choice_option->attribute_id }}">
                                                            <input type="text"  class="form-control" name="choice[]" value="{{ optional(\App\Models\Attribute::find($choice_option->attribute_id))->name }}" placeholder="Choice Title" disabled>
                                                        </div>
                                                        <div class="col-lg-10">
                                                            <select class="form-control select2 attribute_choice" data-live-search="true" name="choice_options_{{ $choice_option->attribute_id }}[]" multiple>
                                                                @foreach (\App\Models\AttributeValue::where('attribute_id', $choice_option->attribute_id)->get() as $row)
                                                                    <option value="{{ $row->name }}" @if( in_array($row->name, $choice_option->values)) selected @endif>
                                                                        {{ $row->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-12 mt-3">
                                                <div class="form-group">
                                                    <label for="">Quantity <span class="text-danger">*</span></label>
                                                    <input required  type="number" class="form-control" placeholder="Quantity" name="current_stock" value="{{$product->current_stock}}">
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-md-12 mt-3">
                                                <div class="form-group">
                                                    <label for="">Unit Price <span class="text-danger">*</span></label>
                                                    <input required type="number" step="any" class="form-control" placeholder="Unit Price" name="unit_price" value="{{$product->unit_price}}">
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-md-12 mt-3">
                                                <div class="form-group">
                                                    <label for="">Discount</label>
                                                    <input type="number" min="0"  step="any" class="form-control" placeholder="Discount" name="discount" value="{{$product->discount}}">
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-md-12 mt-3">
                                                <div class="form-group">
                                                    <label for="">Discount Type</label>
                                                    <select class="form-control select2" name="discount_type" id="">
                                                        <option value="amount" {{$product->discount_type=='amount' ? 'selected' : ''}}>Amount</option>
                                                        <option value="percent" {{$product->discount_type=='percent' ? 'selected' : ''}}>Percent</option>
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
                                                <textarea id="summernote" class="form-control summernote" placeholder="Write some text..." name="summary">{{$product->summary}}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-md-12 mt-3">
                                            <div class="form-group">
                                                <label for="">Description</label>
                                                <textarea id="description" class="form-control summernote" placeholder="Write some text..." name="description">{{$product->description}}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-md-12 mt-3">
                                            <div class="form-group">
                                                <label for="">Features</label>
                                                <textarea id="features" class="form-control summernote" placeholder="Write some text..." name="features">{{$product->features}}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-12  mt-3">
                                            <div class="form-group">
                                                <label for="">Is featured : </label>
                                                <input type="checkbox" name="is_featured" value="1" @if($product->is_featured==1) checked @endif data-toggle="switchbutton"  data-size="sm">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-12  mt-3">
                                            <div class="form-group">
                                                <label for="">Is Refundable : </label>
                                                <input type="checkbox" name="refundable" value="1" @if($product->refundable==1) checked  @endif data-toggle="switchbutton"  data-size="sm">
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-12  mt-3">
                                            <div class="form-group">
                                                <label for="">Allow Estimated Shipping Time: : </label>
                                                <input type="checkbox"  value="1"  data-toggle="switchbutton"  data-size="sm" id="allowProductShipping"   @if ($product->processing_time || $product->shipping_time ) checked @endif>
                                            </div>
                                        </div>

                                        <div class="row mb-4 {{ $product->processing_time || $product->shipping_time ? '' : 'd-none' }}"  id="shipping_div">
                                            <div class="col-6">
                                                <label >Processing Time :</label>
                                                <input type="text" class="form-control" name="processing_time" placeholder="4-5 days" value="{{ $product->processing_time }}">
                                            </div>
                                            <div class="col-6">
                                                <label >Shipping Time </label>
                                                <input type="text" placeholder="7-10 days" class="form-control" name="shipping_time" value="{{ $product->processing_time }}" >
                                            </div>
                                        </div>
                                    </div>


                                <div class="col-lg-12 col-md-12 mt-3">
                                    <div class="form-group">


                                        <label for="">Thumbnail Image  <span class="text-danger">*</span></label><br>
                                        <!-- add img -->

                                        <div class="position-relative">
                                            <div class="row">
                                                <div class="col-2">
                                                    <a href="javascript:void(0)" data-target-id="f" id="thumb-image" class="img-thumbnail  button-image">
                                                        <div id="input-image-f" class="display-imput-image">
                                                            <img src="{{asset($product->thumbnail_image)}}" alt="">
                                                        </div>
                                                    </a>
                                                    <div class="custom-image-f">
                                                        <a href='javascript:;' class="position-absolute button-clear" data-target-id='f' style='left: 20px; top:10px;' id='button-clear'><i class='fe fe-trash-2 position-absolute text-danger'></i></a>
                                                    </div>
                                                    <input type="hidden" name="thumbnail_image" value="{{asset($product->thumbnail_image)}}" id="input-image-name-f" />
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 ">
                                    <div class="form-group">
                                        <!-- /add img -->
                                        <div class="additional-images">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <div class="card-header" style="margin:10px 0;" ><i class="fa fa-file-image-o" aria-hidden="true"></i> Additional Images <small style="font-size: 10px">[Recommend image size 640*960]</small></div>
                                                </div>
                                                <div class="row">

                                                    @foreach($product->images as $key=>$data)
                                                        <div class="col-2 additional_image mt-3">
                                                            <a href="javascript:void(0)" data-target-id="{{$key}}" id="thumb-image" class="img-thumbnail  button-image">
                                                                <div id="input-image-{{$key}}" class="display-imput-image">
                                                                    <img src="{{$data==null ? Helper::DefaultImage() : asset($data)}}" alt="">
                                                                </div>
                                                            </a>
                                                            <div class="custom-image-{{$key}}">
                                                                @if($data!=null)
                                                                    <a href='javascript:;' class="position-absolute button-clear" data-target-id='{{$key}}' style='left: 20px; top:10px;'><i class='fe fe-trash-2 position-absolute text-danger'></i></a>
                                                                @endif
                                                            </div>
                                                            <input type="hidden" name="image[]" value="{{$data==null ? null :asset($data)}}" id="input-image-name-{{$key}}" />
                                                        </div>
                                                    @endforeach
                                                    <div class="col-12">
                                                        <label for=""><small class="text-danger"><strong>Note: </strong>Minimum one image is required.</small></label>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                    <div class="col-lg-12 col-md-12  mt-4">
                                        <div class="form-group">
                                            <div class="row pb-3">
                                                <div class="col-6">
                                                    <h5 class="mb-0 h6">Product attributes</h5>
                                                </div>
                                                <div class="col-6 ">
                                                    <button class="btn btn-secondary float-end" type="button"
                                                            onclick="add_new_attribute()"><i class="fas fa-plus-circle"></i> Add new attribute</button>
                                                </div>
                                            </div>

                                            <div class="alert alert-warning">
                                                These attributes will be used only for filtering.</div>
                                            <div class="all-attributes">
                                                @foreach (\App\Models\ProductAttribute::where('product_id',$product->id)->get() as $product_attribute)

                                                    <div class="row mt-2">
                                                        <div class="col-3  attr-names">
                                                            <select class="form-control select2" name="product_attributes[]"
{{--                                                                    onchange="get_attributes_values(this)"--}}
                                                                    readonly>
                                                                <option value="">Select an attribute</option>
                                                                @foreach ($all_attributes as $key => $attribute)
                                                                    <option value="{{ $attribute->id }}" {{$attribute->id==$product_attribute->attribute_id ? 'selected' : ''}}>{{ $attribute->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-8 attr-values">
                                                            @php
                                                                $attribute_values = \App\Models\AttributeValue::where('attribute_id', $product_attribute->attribute_id)->get();
                                                                $product_attribute_values= $product->attribute_values->where('attribute_id', $product_attribute->attribute_id)->pluck('attribute_value_id')->toArray();
                                                            @endphp
                                                            <select class="form-control select2"
                                                                    name="attribute_{{ $product_attribute->attribute_id }}_values[]"
                                                                    multiple data-live-search="true">
                                                                @foreach ($attribute_values as $key => $attribute_value)
                                                                    <option value="{{ $attribute_value->id }}" @if(in_array($attribute_value->id,$product_attribute_values)) selected @endif>
                                                                        {{ $attribute_value->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-auto">
                                                            <button type="button" data-toggle="remove-parent" class="btn btn-danger"
                                                                    data-parent=".row">
                                                                <i class="fe fe-trash-2 opacity-70"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-4">

                                        <div class="col-lg-6 col-md-12 ">
                                            <div class="form-group">
                                                <label for="">Meta Title</label>
                                                <input type="text" name="meta_title" placeholder="Meta Title" class="form-control" value="{{$product->meta_title}}">
                                            </div>
                                        </div>


                                        <div class="col-lg-6 col-md-12 ">
                                            <div class="form-group">
                                                <label for="">Meta Keywords</label>
                                                <input type="text" name="meta_keywords" placeholder="Meta Keywords" class="form-control" value="{{$product->meta_keywords}}">
                                            </div>
                                        </div>


                                        <div class="col-lg-12 col-md-12 ">
                                            <div class="form-group">
                                                <label for="">Meta Description</label>
                                                <textarea name="meta_description" class="form-control" placeholder="Write meta description..." id="" rows="4">{!! html_entity_decode($product->meta_description) !!}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-xl-12 col-lg-12 col-12 form-group">
                                            <label>Status *</label>
                                            <select name="status" class="form-control select2 form-select" data-placeholder="Choose one">
                                                <option value="active" {{$product->status=='active' ? 'selected' : ''}}>Active</option>
                                                <option value="inactive" {{$product->status=='inactive' ? 'selected' : ''}}>Inactive</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="card-footer">
                                        <!--Row-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary"><i class="fe fe-plus-circle"></i> Update Product</button>
                                            </div>
                                        </div>
                                        <!--End Row-->
                                    </div>
                            </div>
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
    <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/filemanager/custom.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/filemanager/filemanager.css')}}">

{{--    <link rel="stylesheet" href="{{asset('backend/assets/css/tags-input.min.css')}}">--}}
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
@endpush

@push('scripts')


    <script src="{{asset('backend/assets/filemanager/customjs.js')}}"></script>
    <script src="{{asset('backend/assets/filemanager/filemanager.js')}}"></script>


    {{--  attribute section   --}}
    <script>
        $(document).ready(function(){
            update_sku();
        });
        $(document).on("change", ".attribute_choice",function() {
            update_sku();
        });
        $('#choice_attributes').on('change', function () {
            $.each($("#choice_attributes option:selected"), function(j, attribute){
                flag = false;
                $('input[name="choice_no[]"]').each(function(i, choice_no) {
                    if($(attribute).val() == $(choice_no).val()){
                        flag = true;
                    }
                });
                if(!flag){
                    add_more_customer_choice_option($(attribute).val(), $(attribute).text());
                }
            });
            var str = @php echo $product->attributes @endphp;
            $.each(str, function(index, value){
                flag = false;
                $.each($("#choice_attributes option:selected"), function(j, attribute){
                    if(value == $(attribute).val()){
                        flag = true;
                    }
                });
                if(!flag){
                    $('input[name="choice_no[]"][value="'+value+'"]').parent().parent().remove();
                }
            });
            update_sku();
        });
        function add_more_customer_choice_option(i, name) {
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
                    console.log(obj);
                    $('.select2').select2({
                    });
                    $('#customer_choice_options').append('\
                <div class="row mt-2">\
                    <div class="col-md-3">\
                        <input type="hidden" name="choice_no[]" value="'+i+'">\
                        <input type="text" class="form-control" name="choice[]" value="'+name+'" placeholder="Choice Title" readonly>\
                    </div>\
                    <div class="col-md-9">\
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
    </script>

    <script>
        $(document).ready(function() {
            // $('body').addClass('side-menu-closed');
            $('.all-attributes').find('.attr-names').find('.select2').siblings('.dropdown-toggle')
                .addClass("disabled");
            if ($('.customer_choice_options').find('.attr-names').find('.select2').val() !== '') {
                $('.customer_choice_options').find('.attr-names').find('.select2').siblings(
                    '.dropdown-toggle').addClass("disabled");
            }
        });

        function add_new_attribute(){
            $.ajax({
                type:"POST",
                data:$("#choice_form").serialize(),
                url:'{{route('product.new_attribute')}}',
                success:function (data) {
                    if(data.count==-1){
                        notify('warning','Please select an attribute.');
                    }
                    else if(data.count >0){
                        $('.all-attributes').append(data.view);
                        $('.select2').select2({
                        });
                    }
                    else{
                        notify('info','No more arrtribute found.');
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
    </script>

    <script>
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

            function colorCodeSelect(state) {
                var colorCode = $(state.element).val();
                if (!colorCode) return state.text;
                return "<span class='color-preview' style='background-color:" + colorCode + ";'></span>" + state.text;
            }

        });
    </script>

    {{--Color enable & disabled--}}
    <script>
        $('input[name="colors_active"]').on('change',function () {
            if($('input[name="colors_active"]').is(':checked')){
                $('#colors-selector').prop('disabled',false);
                // $('#sku_combination').show();
            }
            else{
                $('#colors-selector').prop('disabled',true);
                // $('#sku_combination').hide();
            }
        });
    </script>


    {{--  update sku combo  --}}
    <script>
        $('#colors-selector').on('change', function () {
            update_sku();
        });
        $('input[name="price"]').on('keyup', function () {
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
                url: '{{route('products.sku_combination_edit')}}',
                data: $('#choice_form').serialize(),
                success: function (data) {
                    console.log(data);
                    $('#sku_combination').html(data);
                    if (data.length > 1) {
                        $('#quantity').hide();
                    } else {
                        $('#quantity').show();
                    }
                }
            });
        }
    </script>

@endpush

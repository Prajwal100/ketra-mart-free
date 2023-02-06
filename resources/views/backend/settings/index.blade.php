@extends('backend.layouts.master')

@section('content')

    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Update Settings</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->
                <div class="row pb-4">
                    <div class="col-md-12">
                        @include('layouts._error_notify')
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card p-4">
                            <form class="new-added-form" method="post" action="{{route('settings.update')}}" enctype="multipart/form-data">
                                @csrf
                                @method('patch')
                                <div class="row">
                                    <div class="row py-2">
                                        <div class="col-xl-6 col-lg-6 col-12 form-group">
                                            <label>Site Title *</label>
                                            <input type="text" placeholder="" class="form-control" name="site_title" value="@isset($settings) {{$settings->site_title}} @else {{old('site_title')}} @endif">
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-12 form-group">
                                            <label>Meta Keywords</label>
                                            <input type="text" placeholder="" class="form-control" name="meta_keywords" value="@isset($settings) {{$settings->site_title}} @else {{old('site_title')}} @endif">
                                        </div>
                                    </div>

                                    <div class="row py-2">
                                        <div class="col-lg-6 col-12 form-group">
                                            <label>Meta Description</label>
                                            <textarea class="textarea form-control" name="meta_description"
                                                      id="form-message" cols="10"
                                                      rows="4">@isset($settings) {!! nl2br($settings->meta_description) !!} @else {{old('meta_description')}} @endif</textarea>
                                        </div>

                                        <div class="col-lg-6 col-12 form-group">
                                            <label>Address *</label>
                                            <textarea class="textarea form-control" name="address" id="form-message"
                                                      cols="10"
                                                      rows="4"> @isset($settings) {!! nl2br($settings->address) !!} @else {{old('address')}} @endif</textarea>
                                        </div>
                                    </div>

                                    <div class="row py-2">
                                        <div class="col-xl-6 col-lg-6 col-12 form-group">
                                            <label>Email * </label>
                                            <input data-role="tagsinput" type="text" placeholder="" class="form-control" name="email" value="@isset($settings) {{$settings->email}} @else {{old('email')}} @endif">
                                            <small class="text-warning"><i class="fa fa-exclamation-circle"></i> first item will show in the site.</small>
                                        </div>

                                        <div class="col-xl-6 col-lg-6 col-12 form-group">
                                            <label>Phone *</label>
                                            <input data-role="tagsinput" type="text" placeholder="" class="form-control" name="phone" value="@isset($settings) {{$settings->phone}} @else {{old('phone')}} @endif">
                                            <small class="text-warning"><i class="fa fa-exclamation-circle"></i> first item will show in the site.</small>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-12 form-group">
                                            <label>Website URL</label>
                                            <input type="text" placeholder="" class="form-control" name="website_url" value="@isset($settings) {{$settings->website_url}} @else {{old('website_url')}} @endif">
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-12 form-group">
                                            <label>System Version *</label>
                                            <input type="text" placeholder="" class="form-control" name="system_version" value="@isset($settings) {{$settings->system_version}} @else {{old('system_version')}} @endif">
                                        </div>
                                    </div>

                                    <div class="row py-2">


                                        <div class="col-xl-6 col-lg-6 col-12 form-group">
                                            <label>Logo *</label>
                                            <input type="file" class="dropify" name="logo" data-default-file="{{asset($settings->logo)}}" data-height="100" value="{{$settings->logo}}"/>
                                        </div>


                                        <div class="col-xl-6 col-lg-6 col-12 form-group">
                                            <label>Favicon </label>
                                            <input type="file" class="dropify" name="favicon" data-default-file="{{asset($settings->favicon)}}" value="{{$settings->favicon}}" data-height="100"/>
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col-xl-6 col-lg-6 col-12 form-group">
                                            <label>Office Time</label>
                                            <input type="text" placeholder="" class="form-control" name="office_time" value="@isset($settings) {{$settings->office_time}} @else {{old('office_time')}} @endif">
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-12 form-group">
                                            <div class="media mb-2">
                                                <label class="col-form-label m-r-10">Enable Captcha</label>
                                                <div class="media-body text-end icon-state">
                                                    <label class="switch">
                                                        <input type="checkbox"  name="recaptcha" value="{{$settings->recaptcha}}" @if($settings->recaptcha==1) checked @endif><span class="switch-state bg-primary"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <small><span class="text-warning fs-7"><i class="fa fa-exclamation-circle"></i>: Turn it OFF </span></small>
                                        </div>


                                    </div>
                                    <div class="row d-none" id="captcha_div">
                                        <div class="col-xl-6 col-lg-6 col-12 form-group">
                                            <label>Recaptcha Key </label>
                                            <input type="text" class="form-control" name="recaptcha_key" value="@isset($settings) {{$settings->recaptcha_key}} @else {{old('recaptcha_key')}} @endif"/>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-12 form-group">
                                            <label>Recaptcha Secret </label>
                                            <input type="text" class="form-control" name="recaptcha_secret" value="@isset($settings) {{$settings->recaptcha_secret}} @else {{old('recaptcha_secret')}} @endif"/>
                                        </div>
                                    </div>
                                    <div class="row py-2">


                                        <div class="col-xl-8 col-lg-8 col-8 form-group">
                                            <label>Copyright Text</label>
                                            <input type="text" class="form-control" name="copyright_text" value="@isset($settings) {{$settings->copyright_text}} @else {{old('copyright_text')}} @endif"/>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-4 form-group">
                                            <label>Currency</label>
                                            <input type="text" class="form-control" name="currency" value="@isset($settings) {{$settings->currency}} @else {{old('currency')}} @endif"/>
                                        </div>
                                    </div>

                                    <div class="row py-2">
                                        <div class="col-xl-6 col-lg-6 col-12 form-group">
                                            <label>Facebook</label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="fa fa-facebook-f"></i>
                                                </span>
                                                <input type="text" placeholder="" class="form-control" name="facebook_url" value="@isset($settings) {{$settings->facebook_url}} @else {{old('facebook_url')}} @endif">
                                            </div>
                                        </div>

                                        <div class="col-xl-6 col-lg-6 col-12 form-group">
                                            <label>Youtube</label>
                                            <div class="input-group"><span class="input-group-text">
                                                    <i class="fa fa-youtube"></i>
                                                </span>
                                                <input type="text" placeholder="" class="form-control" name="youtube_url" value="@isset($settings) {{$settings->youtube_url}} @else {{old('youtube_url')}} @endif">
                                            </div>
                                        </div>

                                        <div class="col-xl-6 col-lg-6 col-12 form-group">
                                            <label>Linkedin</label>

                                            <div class="input-group"><span class="input-group-text">
                                                    <i class="fa fa-instagram"></i>
                                                </span>
                                                <input type="text" placeholder="" class="form-control" name="instagram_url" value="@isset($settings) {{$settings->instagram_url}} @else {{old('instagram_url')}} @endif">
                                            </div>
                                        </div>

                                        <div class="col-xl-6 col-lg-6 col-12 form-group">
                                            <label>Twitter</label>
                                            <div class="input-group"><span class="input-group-text"><i class="fa fa-twitter"></i></span>
                                                <input type="text" placeholder="" class="form-control" name="twitter_url" value="@isset($settings) {{$settings->twitter_url}} @else {{old('twitter_url')}} @endif">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 form-group mg-t-8 mt-2">
                                        <button type="submit" class="btn btn-primary"><i class="fe fe-plus-circle"></i> Update Settings</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>

                </div>

            </div>
            <!-- CONTAINER CLOSED -->
        </div>
    </div>
    <!--app-content closed-->

@endsection

@push('scripts')
    <script>
        $("[name='recaptcha']").click(function(){
            if($(this).is(":checked")==true){
                $('#captcha_div').addClass('d-flex');
                $('#captcha_div').removeClass('d-none');
                $("[name='recaptcha']").val('');
            }
            else{
                $('#captcha_div').addClass('d-none');
                $('#captcha_div').removeClass('d-flex');
                $("[name='recaptcha']").val('');

            }
        })
    </script>


    <script>
        $("input[data-role=tagsinput], select[multiple][data-role=tagsinput]").tagsinput();
    </script>

@endpush

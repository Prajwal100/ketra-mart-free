<!-- META DATA -->
<meta charset="UTF-8">
<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="{{get_settings('meta_description')}}">
<meta name="author" content="ketraitsolution">
<meta name="keywords" content="shopping website, ecommerce web-application">

<!-- FAVICON -->
<link rel="icon" href="{{get_settings('favicon')}}" type="image/x-icon">
<link rel="shortcut icon" href="{{get_settings('favicon')}}" type="image/x-icon">

<!-- TITLE -->

<title>Dashboard || {{get_settings('site_title')}}</title>

<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- BOOTSTRAP CSS -->
<link id="style" href="{{asset('backend')}}/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

<!-- STYLE CSS -->
<link href="{{asset('backend')}}/assets/css/style.css" rel="stylesheet" />
<link href="{{asset('backend')}}/assets/css/dark-style.css" rel="stylesheet" />
<link href="{{asset('backend')}}/assets/css/transparent-style.css" rel="stylesheet">
<link href="{{asset('backend')}}/assets/css/skin-modes.css" rel="stylesheet" />

<!--C3 CHARTS CSS -->
<link href="{{asset('backend')}}/assets/plugins/charts-c3/c3-chart.css" rel="stylesheet" />

<!-- P-scroll bar css-->
<link href="{{asset('backend')}}/assets/plugins/p-scroll/perfect-scrollbar.css" rel="stylesheet" />

<!--- FONT-ICONS CSS -->
<link href="{{asset('backend')}}/assets/css/icons.css" rel="stylesheet" />

<!-- DATA TABLE CSS -->
<link href="{{asset('backend')}}/assets/plugins/datatable/css/dataTables.bootstrap5.css" rel="stylesheet" />
<link href="{{asset('backend')}}/assets/plugins/datatable/css/buttons.bootstrap5.min.css" rel="stylesheet">
<link href="{{asset('backend')}}/assets/plugins/datatable/responsive.bootstrap5.css" rel="stylesheet" />

<!-- INTERNAL WYSIWYG EDITOR CSS -->
<link href="{{asset('backend')}}/assets/plugins/summernote/summernote1.css" rel="stylesheet" />

<!-- Date Picker CSS -->
<link rel="stylesheet" href="{{asset('backend/assets/css/datepicker.min.css')}}">

<!-- INTERNAL Jvectormap css -->
<link href="{{asset('backend')}}/assets/plugins/jvectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />

<!-- SIDEBAR CSS -->
<link href="{{asset('backend')}}/assets/plugins/sidebar/sidebar.css" rel="stylesheet">

<!-- SELECT2 CSS -->
<link href="{{asset('backend')}}/assets/plugins/select2/select2.min.css" rel="stylesheet" />

<!-- MULTI SELECT CSS -->
<link rel="stylesheet" href="{{asset('backend')}}/assets/plugins/multipleselect/multiple-select.css">
<!-- INTERNAL Data table css -->
<link href="{{asset('backend')}}/assets/plugins/datatable/css/dataTables.bootstrap5.css" rel="stylesheet" />
<link href="{{asset('backend')}}/assets/plugins/datatable/responsive.bootstrap5.css" rel="stylesheet" />

<!-- COLOR SKIN CSS -->
<link id="theme" rel="stylesheet" type="text/css" media="all" href="{{asset('backend')}}/assets/colors/color1.css" />

<!-- FILEMANAGER CSS -->
<link rel="stylesheet" type="text/css" href="{{asset('backend/assets/filemanager/filemanager.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('backend/assets/filemanager/custom.css')}}">


<link rel="stylesheet" href="{{asset('backend/assets/css/tags-input.min.css')}}">

{{--Toastr css--}}
<link href="{{ asset('css/iziToast.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
{{--dropify css--}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<style>
    .dropify-wrapper .dropify-message p {
        font-size: 14px;
        margin: 5px 0 0;
    }
</style>
@stack('styles')

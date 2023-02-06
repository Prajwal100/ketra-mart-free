<!doctype html>
<html lang="en" dir="ltr">

<head>

    @include('backend.layouts.head')

</head>

<body class="app sidebar-mini ltr light-mode">

<!-- GLOBAL-LOADER -->
<div id="global-loader">
    <img src="{{asset('backend')}}/assets/images/loader.svg" class="loader-img" alt="Loader">
</div>
<!-- /GLOBAL-LOADER -->

<!-- PAGE -->
<div class="page">
    <div class="page-main">

        <!-- app-Header -->
        <div class="app-header header sticky">
            <div class="container-fluid main-container">
                <div class="d-flex">
                    <a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-bs-toggle="sidebar" href="#"></a>

                    <!-- LOGO -->
                    <div class="main-header-center ms-3 d-none d-lg-block">
                        <input class="form-control" placeholder="Search for results...." type="search" id="menu-search" onkeyup="menuSearch()">
                        <button class="btn px-0 pt-2"><i class="fe fe-search" aria-hidden="true"></i></button>
                    </div>
                    <div class="d-flex order-lg-2 ms-auto header-right-icons">
                        <div class="dropdown d-lg-none d-md-block d-none">
                            <a href="#" class="nav-link icon" data-bs-toggle="dropdown">
                                <i class="fe fe-search"></i>
                            </a>
                            <div class="dropdown-menu header-search dropdown-menu-start">
                                <div class="input-group w-100 p-2">
                                    <input type="text" class="form-control" placeholder="Search...." >
                                    <div class="input-group-text btn btn-primary">
                                        <i class="fe fe-search" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- SEARCH -->
                        <button class="navbar-toggler navresponsive-toggler d-md-none ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent-4" aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon fe fe-more-vertical"></span>
                        </button>
                        <div class="navbar navbar-collapse responsive-navbar p-0">
                            <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
                                <div class="d-flex order-lg-2">
                                    <div class="dropdown d-md-none d-flex">
                                        <a href="#" class="nav-link icon" data-bs-toggle="dropdown">
                                            <i class="fe fe-search"></i>
                                        </a>
                                        <div class="dropdown-menu header-search dropdown-menu-start">
                                            <div class="input-group w-100 p-2">
                                                <input type="text" class="form-control" placeholder="Search....">
                                                <div class="input-group-text btn btn-primary">
                                                    <i class="fa fa-search" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- COUNTRY -->
{{--                                    @php--}}
{{--                                        if(session()->has('locale')){--}}
{{--                                            $locale=session()->get('locale',\Illuminate\Support\Facades\Config::get('app.locale'));--}}
{{--                                        }--}}
{{--                                        else{--}}
{{--                                            $locale=env('DEFAULT_LANGUAGE');--}}
{{--                                        }--}}
{{--                                    @endphp--}}
                                    <div class="d-flex country">
                                        <a href="{{route('home')}}" data-bs-toggle="tooltip" data-bs-original-title="visit store" data-bs-placement="bottom"  target="_blank" class="nav-link icon text-center" >
                                            <i class="fe fe-globe"></i>
                                        </a>
                                    </div>


                                    <!-- Theme-Layout -->
                                    <div class="dropdown  d-flex">
                                        <a class="nav-link icon theme-layout nav-link-bg layout-setting">
                                            <span class="dark-layout"><i class="fe fe-moon"></i></span>
                                            <span class="light-layout"><i class="fe fe-sun"></i></span>
                                        </a>
                                    </div>
                                    <!-- FULL-SCREEN -->
                                    <div class="dropdown d-flex">
                                        <a class="nav-link icon full-screen-link nav-link-bg">
                                            <i class="fe fe-minimize fullscreen-button"></i>
                                        </a>
                                    </div>
                                    <!-- NOTIFICATIONS -->

{{--                                    <div class="dropdown  d-flex notifications">--}}
{{--                                        <a class="nav-link icon" data-bs-toggle="dropdown"><i class="fe fe-bell"></i><span class=" pulse"></span>--}}
{{--                                        </a>--}}
{{--                                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">--}}
{{--                                            <div class="drop-heading border-bottom">--}}
{{--                                                <div class="d-flex">--}}
{{--                                                    <h6 class="mt-1 mb-0 fs-16 fw-semibold text-dark">Notifications</h6>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="notifications-menu">--}}
{{--                                                <a class="dropdown-item d-flex" href="notify-list.html">--}}
{{--                                                    <div class="me-3 notifyimg  bg-primary brround box-shadow-primary">--}}
{{--                                                        <i class="fe fe-mail"></i>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mt-1">--}}
{{--                                                        <h5 class="notification-label mb-1">New Application received</h5>--}}
{{--                                                        <span class="notification-subtext">3 days ago</span>--}}
{{--                                                    </div>--}}
{{--                                                </a>--}}
{{--                                                <a class="dropdown-item d-flex" href="notify-list.html">--}}
{{--                                                    <div class="me-3 notifyimg  bg-secondary brround box-shadow-secondary">--}}
{{--                                                        <i class="fe fe-check-circle"></i>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mt-1">--}}
{{--                                                        <h5 class="notification-label mb-1">Project has been approved</h5>--}}
{{--                                                        <span class="notification-subtext">2 hours ago</span>--}}
{{--                                                    </div>--}}
{{--                                                </a>--}}
{{--                                                <a class="dropdown-item d-flex" href="notify-list.html">--}}
{{--                                                    <div class="me-3 notifyimg  bg-success brround box-shadow-success">--}}
{{--                                                        <i class="fe fe-shopping-cart"></i>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mt-1">--}}
{{--                                                        <h5 class="notification-label mb-1">Your Product Delivered</h5>--}}
{{--                                                        <span class="notification-subtext">30 min ago</span>--}}
{{--                                                    </div>--}}
{{--                                                </a>--}}
{{--                                                <a class="dropdown-item d-flex" href="notify-list.html">--}}
{{--                                                    <div class="me-3 notifyimg bg-pink brround box-shadow-pink">--}}
{{--                                                        <i class="fe fe-user-plus"></i>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mt-1">--}}
{{--                                                        <h5 class="notification-label mb-1">Friend Requests</h5>--}}
{{--                                                        <span class="notification-subtext">1 day ago</span>--}}
{{--                                                    </div>--}}
{{--                                                </a>--}}
{{--                                            </div>--}}
{{--                                            <div class="dropdown-divider m-0"></div>--}}
{{--                                            <a href="notify-list.html" class="dropdown-item text-center p-3 text-muted">View all Notification</a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <!-- MESSAGE-BOX -->--}}

{{--                                    <div class="dropdown  d-flex message">--}}
{{--                                        <a class="nav-link icon text-center" data-bs-toggle="dropdown">--}}
{{--                                            <i class="fe fe-message-square"></i><span class="pulse-danger"></span>--}}
{{--                                        </a>--}}
{{--                                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">--}}
{{--                                            <div class="drop-heading border-bottom">--}}
{{--                                                <div class="d-flex">--}}
{{--                                                    <h6 class="mt-1 mb-0 fs-16 fw-semibold text-dark">You have 5 Messages</h6>--}}
{{--                                                    <div class="ms-auto">--}}
{{--                                                        <a href="#" class="text-muted p-0 fs-12">make all unread</a>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="message-menu">--}}
{{--                                                <a class="dropdown-item d-flex" href="chat.html">--}}
{{--                                                    <span class="avatar avatar-md brround me-3 align-self-center cover-image" data-bs-image-src="../assets/images/users/1.jpg"></span>--}}
{{--                                                    <div class="wd-90p">--}}
{{--                                                        <div class="d-flex">--}}
{{--                                                            <h5 class="mb-1">Peter Theil</h5>--}}
{{--                                                            <small class="text-muted ms-auto text-end">--}}
{{--                                                                6:45 am--}}
{{--                                                            </small>--}}
{{--                                                        </div>--}}
{{--                                                        <span>Commented on file Guest list....</span>--}}
{{--                                                    </div>--}}
{{--                                                </a>--}}
{{--                                                <a class="dropdown-item d-flex" href="chat.html">--}}
{{--                                                    <span class="avatar avatar-md brround me-3 align-self-center cover-image" data-bs-image-src="../assets/images/users/15.jpg"></span>--}}
{{--                                                    <div class="wd-90p">--}}
{{--                                                        <div class="d-flex">--}}
{{--                                                            <h5 class="mb-1">Abagael Luth</h5>--}}
{{--                                                            <small class="text-muted ms-auto text-end">--}}
{{--                                                                10:35 am--}}
{{--                                                            </small>--}}
{{--                                                        </div>--}}
{{--                                                        <span>New Meetup Started......</span>--}}
{{--                                                    </div>--}}
{{--                                                </a>--}}
{{--                                                <a class="dropdown-item d-flex" href="chat.html">--}}
{{--                                                    <span class="avatar avatar-md brround me-3 align-self-center cover-image" data-bs-image-src="../assets/images/users/12.jpg"></span>--}}
{{--                                                    <div class="wd-90p">--}}
{{--                                                        <div class="d-flex">--}}
{{--                                                            <h5 class="mb-1">Brizid Dawson</h5>--}}
{{--                                                            <small class="text-muted ms-auto text-end">--}}
{{--                                                                2:17 pm--}}
{{--                                                            </small>--}}
{{--                                                        </div>--}}
{{--                                                        <span>Brizid is in the Warehouse...</span>--}}
{{--                                                    </div>--}}
{{--                                                </a>--}}
{{--                                                <a class="dropdown-item d-flex" href="chat.html">--}}
{{--                                                    <span class="avatar avatar-md brround me-3 align-self-center cover-image" data-bs-image-src="../assets/images/users/4.jpg"></span>--}}
{{--                                                    <div class="wd-90p">--}}
{{--                                                        <div class="d-flex">--}}
{{--                                                            <h5 class="mb-1">Shannon Shaw</h5>--}}
{{--                                                            <small class="text-muted ms-auto text-end">--}}
{{--                                                                7:55 pm--}}
{{--                                                            </small>--}}
{{--                                                        </div>--}}
{{--                                                        <span>New Product Realease......</span>--}}
{{--                                                    </div>--}}
{{--                                                </a>--}}

{{--                                            </div>--}}
{{--                                            <div class="dropdown-divider m-0"></div>--}}
{{--                                            <a href="" class="dropdown-item text-center p-3 text-muted">See all Messages</a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

                                    <!-- SIDE-MENU -->
                                    <div class="dropdown d-flex profile-1">
                                        <a href="#" data-bs-toggle="dropdown" class="nav-link leading-none d-flex">
                                            <img src="{{Helper::defaultImage('male')}}" alt="profile-user" class="avatar  profile-user brround cover-image">
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                            <div class="drop-heading">
                                                <div class="text-center">
                                                    <h5 class="text-dark mb-0 fs-14 fw-semibold">{{auth('admin')->user()->name}}</h5>
                                                    <small class="text-muted">{{auth('admin')->user()->staff !=null ? auth('admin')->user()->staff->role->name :'Admin'}}</small>
                                                </div>
                                            </div>
                                            <div class="dropdown-divider m-0"></div>
                                            <a class="dropdown-item" href="{{route('profile.index')}}">
                                                <i class="dropdown-icon fe fe-user"></i> Profile
                                            </a>
                                            <a class="dropdown-item" href="{{route('profile.edit',auth('admin')->user()->id)}}">
                                                <i class="dropdown-icon fe fe-settings"></i> Account Settings
                                            </a>

                                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                <i class="dropdown-icon fe fe-alert-circle"></i> Sign out
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /app-Header -->

@include('backend.layouts.sidebar')

<!--APP-SIDEBAR-->
<div class="sticky">
    <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
    <div class="app-sidebar">
        <div class="side-header">
            <a class="header-brand1" href="{{route('dashboard')}}">
                <img src="{{asset(get_settings('logo'))}}" class="header-brand-img desktop-logo" alt="logo">
                <img src="{{asset(get_settings('logo'))}}" class="header-brand-img toggle-logo" alt="logo">
                <img src="{{asset(get_settings('logo'))}}" class="header-brand-img light-logo" alt="logo">
                <img src="{{asset(get_settings('logo'))}}" class="header-brand-img light-logo1" alt="logo">
            </a>
            <!-- LOGO -->
        </div>
        <div class="main-sidemenu">
            <div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"><path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"/></svg></div>
            <ul class="side-menu" id="search-menu"></ul>

            <ul class="side-menu" id="main-menu">
                <li class="sub-category">
                    <h3>Main</h3>
                </li>
                <li class="slide">
                    <a class="side-menu__item {{\Illuminate\Support\Facades\Request::is('dashboard') ? 'active' :''}}" data-bs-toggle="slide" href="{{route('dashboard')}}"><i class="side-menu__icon fe fe-home"></i><span class="side-menu__label">Dashboard</span></a>
                </li>

                @if(Helper::check_permission("banner"))
                    <li class="slide">
                        <a class="side-menu__item {{(request()->is('*/banner/*') || request()->is('*/home-banner') || request()->is('*/popup-banner') || request()->is('*/promo-banner')) ? 'active' :''}}" data-bs-toggle="slide" href="javascript:;"><i class="side-menu__icon fe fe-image"></i><span class="side-menu__label">Banners Management</span><i class="angle fe fe-chevron-right"></i></a>
                        <ul class="slide-menu">
                            <li><a href="{{route('banner.index')}}" class="slide-item">All Banner</a></li>
                            <li><a href="{{route('home.banner')}}" class="slide-item"> Home Banner</a></li>
                            <li><a href="{{route('popup.banner')}}" class="slide-item"> Popup Banner</a></li>
                            <li><a href="{{route('promo.banner')}}" class="slide-item"> Promo Banner</a></li>
                        </ul>
                    </li>
                @endif

                <li class="sub-category">
                    <h3>CATALOG</h3>
                </li>


                <li class="slide">
                    <a class="side-menu__item {{( request()->is('*/categories/*') || request()->is('*/product/*') || request()->is('*/products/*') || request()->is('*/attributes*')) ? 'active' :''}}" data-bs-toggle="slide" href="javascript:;"><i class="side-menu__icon fe fe-shopping-bag"></i><span class="side-menu__label">Product Management</span><i class="angle fe fe-chevron-right"></i></a>
                    <ul class="slide-menu">
                        @if(Helper::check_permission("category"))
                            <li><a href="{{route('categories.index')}}" class="slide-item">Category</a></li>
                        @endif

                        @if(Helper::check_permission("product"))
                                <li><a href="{{route('attributes.index')}}" class="slide-item">Product Attribute</a></li>


                                <li><a href="{{route('product.index')}}" class="slide-item">Product</a></li>
                            <li><a href="{{route('product.create')}}" class="slide-item">Add Product</a></li>



                        @endif

                    </ul>
                </li>

                @if(Helper::check_permission("order"))

                    <li class="slide">
                        <a class="side-menu__item {{request()->is('*/orders*') ? 'active' :''}}" data-bs-toggle="slide" href="#"><i class="side-menu__icon fe fe-layers"></i><span class="side-menu__label">Order Management</span><i class="angle fe fe-chevron-right"></i></a>
                        <ul class="slide-menu">
                            <li><a href="{{route('orders.index')}}" class="slide-item"> All Orders</a></li>
                            <li><a href="{{route('pending.order')}}" class="slide-item"> Pending Order</a></li>
                            <li><a href="{{route('process.order')}}" class="slide-item"> Processing Order</a></li>
                            <li><a href="{{route('delivered.order')}}" class="slide-item"> Delivered Order</a></li>
                            <li><a href="{{route('cancelled.order')}}" class="slide-item">Cancelled Order</a></li>
                        </ul>
                    </li>


                @endif




                <li class="sub-category">
                    <h3>USERS</h3>
                </li>

                @if(Helper::check_permission("customer"))
                    <li class="slide">
                        <a class="side-menu__item {{request()->is('*/customer*') ? 'active' :''}}" data-bs-toggle="slide" href="#"><i class="side-menu__icon fe fe-users"></i><span class="side-menu__label">Customer Management</span><i class="angle fe fe-chevron-right"></i></a>
                        <ul class="slide-menu">
                            <li><a href="{{route('customers.index')}}" class="slide-item">Customer Index</a></li>
                        </ul>
                    </li>
                @endif

                <li class="sub-category">
                    <h3>Pages</h3>
                </li>
                <li class="slide">
                    <a class="side-menu__item {{(request()->is('*/about-us*') || request()->is('*/faq*') || request()->is('*/return-policy*') || request()->is('*/privacy-policy*')|| request()->is('*/shipping-payment*')|| request()->is('*/terms-conditions*')|| request()->is('*/cancellation-policy*')) ? 'active' :''}}" data-bs-toggle="slide" href="#"><i class="side-menu__icon fe fe-list"></i><span class="side-menu__label">Pages Management</span><i class="angle fe fe-chevron-right"></i></a>
                    <ul class="slide-menu">
                        <li><a href="{{route('about-us')}}" class="slide-item">About Us</a></li>
                        <li><a href="{{route('why-choose-us.index')}}" class="slide-item">Why Choose Us</a></li>
                        <li><a href="{{route('faq.index')}}" class="slide-item">FAQs</a></li>
                        <li><a href="{{route('return.policy')}}" class="slide-item">Return Policy</a></li>
                        <li><a href="{{route('privacy.policy')}}" class="slide-item">Privacy Policy</a></li>
                        <li><a href="{{route('shipping.payment')}}" class="slide-item">Shipping & Payment</a></li>
                        <li><a href="{{route('terms.conditions')}}" class="slide-item">Terms and Conditions</a></li>
                        <li><a href="{{route('cancellation.policy')}}" class="slide-item">Cancellation Policy</a></li>
                    </ul>
                </li>

                <li class="sub-category">
                    <h3>General</h3>
                </li>
                @if(Helper::check_permission("settings"))

                    <li class="slide">
                        <a class="side-menu__item {{(request()->is('*/settings*') || request()->is('*/contact-message*') || request()->is('*/subscribers*') || request()->is('*/social-login*') || request()->is('*/payment-method*') || request()->is('*/mail-setting*')) ? 'active' :''}}" data-bs-toggle="slide" href="#"><i class="side-menu__icon fe fe-settings"></i><span class="side-menu__label">General Settings</span><i class="angle fe fe-chevron-right"></i></a>
                        <ul class="slide-menu">
                            <li><a href="{{route('settings')}}" class="slide-item">Site Settings</a></li>
                            <li><a href="{{route('contact.message')}}" class="slide-item">Contact Messages</a></li>
                            <li><a href="{{route('subscribe.index')}}" class="slide-item">Subscribers</a></li>
                            <li><a href="{{route('smtp.settings')}}" class="slide-item">SMTP Settings</a></li>
                        </ul>
                    </li>

                @endif


            </ul>
            <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"><path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"/></svg></div>
        </div>
    </div>
    <!--/APP-SIDEBAR-->
</div>


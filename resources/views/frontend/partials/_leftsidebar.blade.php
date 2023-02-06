<div class="modal left fade mobileMenuModal show" id="mobileMenu" tabindex="-1" role="dialog" aria-modal="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button type="button" class="close d-none" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="bx bx-x"></i></span>
            </button>
            <div class="modal-body">
                <!-- Sign In or Sign Up -->
                <div class="mobile-menu__signin d-flex align-items-center justify-content-between">
                    @auth
                        <button class="btn btn-outline w-50">
                            <a href="{{route('user.dashboard')}}"  class="text-uppercase px-2">
                                Dashboard
                            </a>
                        </button>
                        <button class="btn secondary-btn sign-up-btn m-auto">
                            <a href="{{route('login')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-white text-uppercase">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </button>
                    @else

                    <button class="btn btn-outline">
                        <a href="{{route('login')}}" class="text-uppercase">
                            Sign In
                        </a>
                    </button>
                    <span>or</span>
                    <button class="btn secondary-btn sign-up-btn">
                        <a href="{{route('register')}}" class="text-white text-uppercase">
                            Sign Up
                        </a>
                    </button>
                    @endauth

                </div>


                <!-- Navigation Menu -->
                <div class="mobile-navigation-menu mt-5">
                    <ul>
                        <li>
                            <a href="{{route('home')}}" class="navigation-item">
                                <img src="{{asset('frontend/assets/images/icons/home.svg')}}">
                                <span> Home </span>
                            </a>
                        </li>
                        @php
                            $categories=\App\Models\Category::with('subcategories')->where(['status'=>'active','is_menu'=>1,'level'=>0,'parent_id'=>0])->limit(6)->orderBy('id','DESC')->get()
                        @endphp
                        @if(count($categories)>0)
                            @foreach($categories->sortBy('order') as $key=>$cat)
                                <li>
                                    <a href="{{route('product.category',$cat->slug)}}" class="navigation-item"

                                       @if($cat->subcategories->count()>0)
                                       data-toggle="modal"
                                       data-target="#mobileSubMenu{{$key}}"
                                       @endif
                                    >

                                        <img src="{{asset($cat->icon_path)}}">
                                        <span> {{ucfirst($cat->title)}} </span>
                                        @if($cat->subcategories->count()>0)
                                            <i class='bx bx-chevron-right'></i>
                                        @endif
                                    </a>
                                </li>
                            @endforeach
                        @endif

                        <hr>

                        <li class="accordion">
                            <a class="accordion-item">
                                @php
                                    Helper::currency_load();
                                    $currency_code = session('currency_code');
                                    $currency_symbol= session('currency_symbol');
                                    $currency_img= session('flag_path');

                                    if ($currency_symbol=="")
                                    {
                                        $system_default_currency_info = session('system_default_currency_info');
                                        $currency_symbol = $system_default_currency_info->symbol;
                                        $currency_code = $system_default_currency_info->code;
                                        $currency_img = $system_default_currency_info->flag_path;
                                    }
                                @endphp
                                <a class="accordion-title" href="javascript:void(0)">
                                    <img src="{{asset('frontend/assets/images/icons/USD.svg')}}">
                                    <span>USD</span>
                                    <i class="bx bx-chevron-down float-right"></i>
                                </a>

                                <div class="accordion-content mt-3" style="display: none;">
                                    @foreach(\App\Models\Currency::where('status','active')->orderBy('id','ASC')->get() as $key=>$currency)
                                        <div class="form-check {{$key==0 ? '' : 'mt-2'}}">
                                            <input onclick="currency_change('{{$currency['code']}}')" class="form-check-input" type="radio" name="exampleRadios"
                                                   id="exampleRadios{{$key}}" value="option2">
                                            <label class="form-check-label" for="exampleRadios{{$key}}" style="font-size: 12px;line-height: 1.5;">
                                                {{\Illuminate\Support\Str::upper($currency->name)}} ({{\Illuminate\Support\Str::upper($currency->code)}}) <img style="height: 1rem" src="{{$currency['flag_path']!=null ? asset($currency['flag_path']) : Helper::DefaultImage()}}">
                                            </label>
                                        </div>
                                    @endforeach

                                </div>
                            </a>
                        </li>

                        <li>
                            <a href="javascript:void(0)" class="navigation-item" data-toggle="modal" data-target="#onlineHelpModal">
                                <img src="{{asset('frontend/assets/images/icons/information.svg')}}">
                                <span> Online Help </span> <i class='bx bx-chevron-right'></i>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


<!----====== Mobile Sidebar Menu Starts======-->

<!----====== Mobile Sidebar Sub-Menu Starts======-->
@if(count($categories)>0)
    @foreach($categories as $key=>$cat)
            @if($cat->subcategories->count()>0)
                <div class="modal left fade mobileMenuModal mobile-submenu show" id="mobileSubMenu{{$key}}" tabindex="-1" role="dialog" aria-modal="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="menu-title d-flex align-items-center">
                                    <a href="javascript:void(0)" class="close" data-dismiss="modal" aria-label="Close">
                                        <i class='bx bx-arrow-back bx-tada'></i>
                                    </a>
                                    <h6><a href="{{route('product.category',$cat->slug)}}">{{ucfirst($cat->title)}}</a></h6>
                                </div>
                                @if($cat->subcategories->count()>0)
                                    <ul class="sub-menu mt-4">
                                        @foreach($cat->subcategories as $subCat)
                                            <li>
                                                <a href="{{route('product.category',$subCat->slug)}}">
                                                    {{ucfirst($subCat->title)}}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif
    @endforeach
@endif


<!----====== Mobile Sidebar Online Help Submenu Starts======-->
<div class="modal left fade mobileMenuModal online-help show" id="onlineHelpModal" tabindex="-1" role="dialog" aria-modal="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="menu-title d-flex align-items-center">
                    <a href="javascript:void(0)" class="close" data-dismiss="modal" aria-label="Close">
                        <i class='bx bx-arrow-back bx-tada'></i>
                    </a>
                    <h6>Online Help</h6>
                </div>
                <ul class="sub-menu mt-4" style="list-style: none;">
                    <li>
                        <a href="javascript:;" class="d-flex align-items-center">
                            <img src="{{asset('frontend/assets/images/icons/online-chat.svg')}}">
                            Online Chat
                        </a>
                    </li>
                    <li>
                        <a href="{{route('contact.us')}}" class="d-flex align-items-center">
                            <img src="{{asset('frontend/assets/images/icons/mail.svg')}}">
                            Email
                        </a>
                    </li>
                    <li>
                        <a href="tel:{{get_settings('phone')}}" class="d-flex align-items-center">
                            <img src="{{asset('frontend/assets/images/icons/phone-call.svg')}}">
                            Tollfree Call
                        </a>
                    </li>
                    <li>
                        <a href="{{route('order-status')}}" class="d-flex align-items-center">
                            <img src="{{asset('frontend/assets/images/icons/order-status.svg')}}">
                            Order Status
                        </a>
                    </li>


                </ul>
            </div>
        </div>
    </div>
</div>


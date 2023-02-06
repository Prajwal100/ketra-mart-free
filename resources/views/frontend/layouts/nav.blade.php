<div class="navbar-area">
    <!-- Responsive Nav Menu for Mobile -->
    <div class="responsive-nav">
        <div class="container">
            <div class="row align-items-center justify-content-center position-relative">
                <!-- Search Form For Mobile Menu-->
                <div class="search-container">
                    <form action="{{route('search.products')}}" method="GET">
                        <input type="text" name="q" id="search-terms" autocomplete="off" placeholder="Search dresses..." />
                    </form>
                </div>
                <div class="col-3 col-md-3 d-flex align-items-center justify-content-between">
                    <div class="humberger__open" data-toggle="modal" data-target="#mobileMenu">
                        <i class="ri-menu-2-line"></i>

                    </div>
                    <div class="search-link">
                        <a href="javascript:void(0)" class="search-toggle">
                            <i class="ri-search-line"></i>
                        </a>
                    </div>

                </div>

                <div class="col-6 col-md-6 text-center">
                    <div class="logo">
                        <a href="{{route('home')}}">
                            @if(get_settings('logo'))
                                <img src="{{\Helper::defaultLogo()}}" alt="logo">
                            @else
                                <img src="{{asset(get_settings('logo'))}}" class="responsive-logo">
                            @endif
                        </a>
                    </div>
                </div>
                <div class="col-3 col-md-3 d-flex align-items-center justify-content-between">
                    <a href="tel:{{get_settings('phone')}}" class="contact-link">
                        <i class='bx bx-phone-call'></i>
                    </a>
                    <a href="{{route('cart')}}" class="cart-link">
                        <img src="{{asset('frontend/assets/images/icons/shoppingBag.svg')}}" alt="Shopping Bag Icon" class="img-icon">
                        <span class="count-badge">{{session()->has('cart') ? count(session()->get('cart')) : 0}}</span>
                    </a>
                </div>
            </div>
            <div class="responsive-menu d-none">
            </div>
        </div>
    </div>
    <!-- Responsive Nav Menu for Mobile Ends -->

    <div class="main-nav">
        <div class="container">
            <nav class="navbar navbar-expand-md navbar-light">
                <div class="collapse navbar-collapse mean-menu">
                    <ul class="navbar-nav">
                        @php
                            $categories=\App\Models\Category::with('subcategories')->where(['status'=>'active','is_menu'=>1,'level'=>0,'parent_id'=>0])->limit(6)->orderBy('id','DESC')->get()
                        @endphp
                        @if(count($categories)>0)
                            @foreach($categories->sortBy('order') as $cat)
                                <li class="nav-item">
                                    <a href="{{route('product.category',$cat->slug)}}" class="nav-link">{{ucfirst($cat->title)}}
                                        @if($cat->subcategories->count()>0)
                                            <i class='bx bx-chevron-down'></i>
                                        @endif
                                    </a>
                                    @if($cat->subcategories->count()>0)
                                    <ul class="dropdown-menu">
                                        @foreach($cat->subcategories as $subCat)
                                            <li class="nav-item"><a href="{{route('product.category',$subCat->slug)}}" class="nav-link ">{{ucfirst($subCat->title)}}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                    @endif
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</div>

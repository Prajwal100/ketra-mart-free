<ul>
    <li class="{{\Request::is('user/dashboard')? 'active' : ''}}"><a href="{{route('user.dashboard')}}"><i class="ri-dashboard-fill dashboard-icon"></i> Dashboard</a></li>
    <li class="{{\Request::is('user/order')? 'active' : ''}}"><a href="{{route('user.order')}}"><i class="ri-stack-line dashboard-icon"></i> My Orders</a></li>
    <li class="{{\Request::is('user/address')? 'active' : ''}}"><a href="{{route('user.address')}}"><i class="ri-map-pin-line dashboard-icon"></i> Addresses</a></li>
    <li class="{{\Request::is('user/account-detail')? 'active' : ''}}"><a href="{{route('user.account')}}"><i class="ri-user-line dashboard-icon"></i> Account Details</a></li>
    <li><a href="{{route('logout')}}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="ri-logout-box-r-line dashboard-icon"></i> Logout</a></li>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</ul>


    <aside class="col-lg-4">
        <div class="aside-account wow fadeInUp">
            <div class="txt-aside-account">
                <h5>{{Auth('web')->user()->user_name}}</h5>
                <p>{{Auth('web')->user()->email}}</p>
                <p>{{Auth('web')->user()->mobile}}</p>
            </div>
            <ul class="menu-profile">
                <li class="@if(Route::currentRouteName() == 'my_order.form')  active @endif"
                ><a href="{{route('my_order.form')}}">My Orders</a></li>

                <li class="@if(Route::currentRouteName() == 'my_address.form')  active @endif"
                ><a href="{{route('my_address.form')}}">Address</a></li>

                <li class="@if(Route::currentRouteName() == 'profile')  active @endif">
                    <a href="{{route('profile')}}">Edit Account</a></li>

                <li class="@if(Route::currentRouteName() == 'change_password.form')  active @endif">
                    <a  href="{{route('change_password.form')}}">Change Password</a></li>

                <li class="@if(Route::currentRouteName() == 'logout')  active @endif">
                    <a href="{{route('logout')}}">Logout</a></li>
            </ul>
        </div>
    </aside>


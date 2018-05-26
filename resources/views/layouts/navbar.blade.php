<div class="pre-loader"></div>
<div class="header clearfix">
    <div class="header-right">
        <div class="brand-logo">
            <a href="/">
                <img src="{{ asset('vendors/images/logo.svg') }}" alt="" class="mobile-logo">
            </a>
        </div>
        <div class="menu-icon">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="user-info-dropdown">
            <div class="dropdown">
                <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                    <span class="user-icon"><i class="fa fa-user-o"></i></span>
                    <span class="user-name"> {{ Auth::User()->username }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="#"><i class="fa fa-user-md" aria-hidden="true"></i> Profile</a>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
        </div>

        {{--<div class="user-notification">--}}
        {{--<div class="dropdown">--}}
        {{--<a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">--}}
        {{--<i class="fa fa-bell" aria-hidden="true"></i>--}}
        {{--<span class="badge notification-active"></span>--}}
        {{--</a>--}}
        {{--<div class="dropdown-menu dropdown-menu-right">--}}
        {{--<div class="notification-list mx-h-350 customscroll">--}}
        {{--<ul>--}}
        {{--<li>--}}
        {{--<a href="#">--}}
        {{--<img src="vendors/images/img.jpg" alt="">--}}
        {{--<h3 class="clearfix">John Doe <span>3 mins ago</span></h3>--}}
        {{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>--}}
        {{--</a>--}}
        {{--</li>--}}
        {{--<li>--}}
        {{--<a href="#">--}}
        {{--<img src="vendors/images/img.jpg" alt="">--}}
        {{--<h3 class="clearfix">John Doe <span>3 mins ago</span></h3>--}}
        {{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>--}}
        {{--</a>--}}
        {{--</li>--}}
        {{--<li>--}}
        {{--<a href="#">--}}
        {{--<img src="vendors/images/img.jpg" alt="">--}}
        {{--<h3 class="clearfix">John Doe <span>3 mins ago</span></h3>--}}
        {{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>--}}
        {{--</a>--}}
        {{--</li>--}}
        {{--<li>--}}
        {{--<a href="#">--}}
        {{--<img src="vendors/images/img.jpg" alt="">--}}
        {{--<h3 class="clearfix">John Doe <span>3 mins ago</span></h3>--}}
        {{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>--}}
        {{--</a>--}}
        {{--</li>--}}
        {{--<li>--}}
        {{--<a href="#">--}}
        {{--<img src="vendors/images/img.jpg" alt="">--}}
        {{--<h3 class="clearfix">John Doe <span>3 mins ago</span></h3>--}}
        {{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>--}}
        {{--</a>--}}
        {{--</li>--}}
        {{--<li>--}}
        {{--<a href="#">--}}
        {{--<img src="vendors/images/img.jpg" alt="">--}}
        {{--<h3 class="clearfix">John Doe <span>3 mins ago</span></h3>--}}
        {{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>--}}
        {{--</a>--}}
        {{--</li>--}}
        {{--<li>--}}
        {{--<a href="#">--}}
        {{--<img src="vendors/images/img.jpg" alt="">--}}
        {{--<h3 class="clearfix">John Doe <span>3 mins ago</span></h3>--}}
        {{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>--}}
        {{--</a>--}}
        {{--</li>--}}
        {{--</ul>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}

    </div>
</div>
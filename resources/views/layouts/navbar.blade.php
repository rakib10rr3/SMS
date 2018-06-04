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
                    {{--<span class="user-icon"><i class="fa fa-user-o"></i></span>--}}
                    <span class="user-name"> {{ Auth::User()->getUserDisplayName() }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="#">
                        <i class="fa fa-user-md" aria-hidden="true"></i> Profile
                    </a>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out-alt"></i> Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
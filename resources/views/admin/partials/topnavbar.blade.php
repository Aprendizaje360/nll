<div class="row border-bottom">
    <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
        </div>
        @if (\Auth::guard('web_admin')->check())
        <ul class="nav navbar-top-links navbar-right">
            <li>
                <a href="{{route('admin.profile', \Auth::guard('web_admin')->user())}}">
                    <i class="fa fa-user"></i> Profile
                </a>
            </li>
            <li>
                <a href="{{route('admin.logout')}}">
                    <i class="fa fa-sign-out"></i> Log out
                </a>
            </li>
        </ul>
        @endif
    </nav>
</div>

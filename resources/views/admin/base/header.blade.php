<!-- START HEADER-->
<header class="header">
    <div class="page-brand text-center bg-white">
        <a class="ml-5" href="#">
            <img height="50" src="{{asset('img/utc.png')}}" alt="">
        </a>
    </div>
    <div class="flexbox flex-1">
        <!-- START TOP-LEFT TOOLBAR-->
        <ul class="nav navbar-toolbar">
            <li>
                <a class="nav-link sidebar-toggler js-sidebar-toggler"><i class="ti-menu"></i></a>
            </li>
            <li>
                <form class="navbar-search" action="javascript:;">
                    <div class="rel">
                        <span class="search-icon"><i class="ti-search"></i></span>
                        <input class="form-control" placeholder="Search here...">
                    </div>
                </form>
            </li>
        </ul>
        <!-- END TOP-LEFT TOOLBAR-->
        <!-- START TOP-RIGHT TOOLBAR-->
        <ul class="nav navbar-toolbar">


            <li class="dropdown dropdown-user">

                <a class="nav-link dropdown-toggle link" data-toggle="dropdown">
                    @if (Auth::user()->url_image==="#")
                        <img src="{{asset('img/users/user.png')}}"/>
                    @else
                        <img src="{{ Auth::user()->url_image}}"/>
                    @endif

                    <span></span>{{ Auth::user()->name}}<i class="fa fa-angle-down m-l-5"></i></a>
                <ul class="dropdown-menu dropdown-menu-right">

                    <li class="dropdown-divider"></li>
                    <div aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="fa fa-power-off"></i>
                            {{ __('Logout') }}

                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                     <a class="dropdown-item" href="{{ route('profile') }}"><i class="fa fa-cog"></i>Perfil</a>
                </ul>
            </li>

        </ul>
        <!-- END TOP-RIGHT TOOLBAR-->
    </div>
</header>
<!-- END HEADER-->

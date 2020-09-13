<!-- START SIDEBAR-->
<nav class="page-sidebar" id="sidebar">
    <div id="sidebar-collapse">
        <div class="admin-block d-flex">
            <div>
                @if (Auth::user()->url_image==="#")
                    <img class="img-circle" src="{{asset('img/users/user.png')}}" width="45px"/>
                @else

                    <img src="{{ Auth::user()->url_image}}"/>
                @endif

            </div>
            <div class="admin-info">
                <div class="font-strong">{{Auth::user()->name}} {{Auth::user()->last_name}}</div>
                <small>{{$roles_name = Auth::user()->getRoleNames()->first()}}</small>
            </div>
        </div>
        <ul class="side-menu metismenu">
            <li>
                <a class="active" href="{{route('home')}}"><i class="sidebar-item-icon fa fa-th-large"></i>
                    <span class="nav-label">Panel de control</span>
                </a>
            </li>
            <li class="heading">Mantenimiento</li>
            @can('leer rol')
                <li>
                    <a href="javascript:;"><i class="sidebar-item-icon fa fa-user"></i>
                        <span class="nav-label">Acceso</span><i class="fa fa-angle-left arrow"></i></a>
                    <ul class="nav-2-level collapse">
                        @can('crear rol')
                            <li>
                                <a href="{{route('create-role')}}">Crear rol</a>
                            </li>
                        @endcan
                        <li>
                            <a href="{{route('get-roles')}}">Roles</a>
                        </li>
                    </ul>
                </li>
            @endcan
            @can('leer categoria')
                <li>
                    <a href="javascript:;"><i class="sidebar-item-icon fa fa-bookmark"></i>
                        <span class="nav-label">Categorías</span><i class="fa fa-angle-left arrow"></i></a>
                    <ul class="nav-2-level collapse">

                        <li>
                            <a href="{{route('get-category')}}">Categorias</a>
                        </li>
                    </ul>
                </li>
            @endcan
            @can('leer producto')
                <li>
                    <a href="javascript:;"><i class="sidebar-item-icon fa fa-edit"></i>
                        <span class="nav-label">Productos</span><i class="fa fa-angle-left arrow"></i></a>
                    <ul class="nav-2-level collapse">
                        @can('crear producto')
                           
                        @endcan
                        <li>
                            <a href="{{route('get-product')}}">Lista</a>
                        </li>
                    </ul>
                </li>
            @endcan
            @can('leer usuario')
                <li>
                    <a href="javascript:;"><i class="sidebar-item-icon fa fa-user"></i>
                        <span class="nav-label">Usuarios</span><i class="fa fa-angle-left arrow"></i></a>
                    <ul class="nav-2-level collapse">
                        @can('crear usuario')
                            <li>
                                <a href="{{route('create-user')}}">Crear</a>
                            </li>
                        @endcan
                        <li>
                            <a href="{{route('get-user')}}">Lista</a>
                        </li>
                        <li>
                            <a href="{{route('customers')}}">Clientes</a>
                        </li>
                    </ul>
                </li>
            @endcan
            @can('leer empresa')
                <li>
                    <a href="javascript:;"><i class="sidebar-item-icon fa fa-shopping-bag"></i>
                        <span class="nav-label">Empresas</span><i class="fa fa-angle-left arrow"></i></a>
                    <ul class="nav-2-level collapse">
                        <li>
                            <a href="{{route('get-merchants')}}">Lista</a>
                        </li>
                        @can('leer solicitud')
                            <li>
                                <a href="{{route('get-request-merchants')}}">Solicitudes</a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('leer repartidor')
                <li>
                    <a href="javascript:;"><i class="sidebar-item-icon fa fa-car"></i>
                        <span class="nav-label">Repartidores</span><i class="fa fa-angle-left arrow"></i></a>
                    <ul class="nav-2-level collapse">
                        <li>
                            <a href="{{route('get-deliverymen')}}">Lista</a>
                        </li>
                        @can('leer solicitud')
                            <li>
                                <a href="{{route('get-request-deliverymen')}}">Solicitudes</a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('leer item')
                <li>
                    <a href="javascript:;"><i class="sidebar-item-icon fa fa-file"></i>
                        <span class="nav-label">Convenios</span><i class="fa fa-angle-left arrow"></i></a>
                    <ul class="nav-2-level collapse">
                        <li>
                            <a href="{{route('create-convenios')}}">Nuevo convenio</a>
                        </li>
                        <li>
                            <a href="{{route('index-convenios')}}">Lista de convenios</a>
                        </li>



                    </ul>
                </li>
            @endcan
            @can('leer item')
                <li>
                    <a href="javascript:;"><i class="sidebar-item-icon fa fa-cog"></i>
                        <span class="nav-label">Configuraciones</span><i class="fa fa-angle-left arrow"></i></a>
                    <ul class="nav-2-level collapse">

                        <li>
                            <a href="{{route('web-index')}}">Sliders</a>
                        </li>

                        <li>
                            <a href="{{route('get-company')}}">Tipos de Empresas</a>
                        </li>

                        <li>
                            <a href="{{route('get-vehicle')}}">Tipos de Vehículos</a>
                        </li>


                    </ul>
                </li>
            @endcan
            @can('leer item')
                <li>
                <a href="{{route('get-messages')}}"><i class="sidebar-item-icon fa fa-envelope-o"></i>
                        <span class="nav-label">Mensajes</span></a>

                </li>
            @endcan
            @can('leer item')
                <li>
                <a href="{{route('get-report-orders')}}"><i class="sidebar-item-icon fa fa-file-o"></i>
                        <span class="nav-label">Reportes</span></a>

                </li>
            @endcan
            @can('leer item')
                <li>
                <a href="{{route('get-request-products')}}"><i class="sidebar-item-icon fa fa-image"></i>
                        <span class="nav-label">Solicitud productos</span></a>

                </li>
            @endcan
            
        </ul>
    </div>
</nav>
<!-- END SIDEBAR-->

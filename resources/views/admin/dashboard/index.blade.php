@extends('admin.base.index')
@section('content')
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="ibox bg-success color-white widget-stat">
                <div class="ibox-body">
                    <h2 class="m-b-5 font-strong">{{count($customers)}}</h2>
                    <div class="m-b-5">CLIENTES</div>
                    <i class="ti-user widget-stat-icon"></i>
                    <div><i class="fa fa-level-up m-r-5"></i><small>25% higher</small></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="ibox bg-info color-white widget-stat">
                <div class="ibox-body">
                    <h2 class="m-b-5 font-strong">{{count($merchants)}}</h2>
                    <div class="m-b-5">EMPRESAS</div>
                    <i class="ti-home widget-stat-icon"></i>
                    <div><i class="fa fa-level-up m-r-5"></i><small>17% higher</small></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="ibox bg-warning color-white widget-stat">
                <div class="ibox-body">
                    <h2 class="m-b-5 font-strong">{{count($deliverymen)}}</h2>
                    <div class="m-b-5">REPARTIDORES</div>
                    <i class="fa fa-car widget-stat-icon"></i>
                    <div><i class="fa fa-level-up m-r-5"></i><small>22% higher</small></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="ibox bg-danger color-white widget-stat">
                <div class="ibox-body">
                    <h2 class="m-b-5 font-strong">{{count($orders)}}</h2>
                    <div class="m-b-5">ORDENES</div>
                    <i class="ti-shopping-cart widget-stat-icon"></i>

                    <div><i class="fa fa-level-down m-r-5"></i><small>-12% Lower</small></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        @if(count($request_merchants))
            <div class="col-lg-8">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Solicitudes de empresas</div>
                        <div class="ibox-tools">
                            <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                            <a class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item">option 1</a>
                                <a class="dropdown-item">option 2</a>
                            </div>
                        </div>
                    </div>
                    <div class="ibox-body">
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>DNI</th>
                                <th>RUC</th>
                                <th>Nombres</th>
                                <th>Empresa</th>
                                <th width="91px">Ver</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($request_merchants as $request_merchant)
                                <tr>
                                    <td>{{$request_merchant->ci}}</td>
                                    <td>{{$request_merchant->company_ruc}}</td>
                                    <td>{{$request_merchant->last_name}} {{$request_merchant->name}}</td>
                                    <td>{{$request_merchant->company_name}}</td>
                                    <td>
                                        @can('leer solicitud')
                                            @if ($request_merchant->status !="aprobado")
                                                <a href="{{route('show-request-merchants',$request_merchant->id)}}"
                                                   class="btn btn-default btn-xs"
                                                   title="Ver petición"
                                                   data-toggle="tooltip">
                                                    <i class="fa fa-eye font-14 text-muted"></i>
                                                </a>
                                            @endif

                                        @endcan
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
        
        @if (count($merchants_lasted))
            <div class="col-lg-4">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Nuevos empresarios</div>
                    </div>
                    <div class="ibox-body">
                        <ul class="media-list media-list-divider m-0">
                            @foreach($merchants_lasted as $merchant)

                                <li class="media">
                                    <a class="media-img" href="javascript:;">
                                        @if ($merchant->user->url_image==="#")
                                            <img class="img-circle" src="{{asset('img/users/user.png')}}" width="40"/>
                                        @else
                                            <img class="img-circle" src="{{$merchant->user->url_image}}" width="40"/>
                                        @endif

                                    </a>
                                    <div class="media-body">
                                        <div class="media-heading">{{$merchant->name}} {{$merchant->last_name}} <small
                                                class="float-right text-muted">{{\Carbon\Carbon::parse($merchant->created_at)->diffForHumans()}}</small>
                                        </div>
                                        <div class="font-13">{{$merchant->email}}
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif
        
        @if(count($request_deliverymen))
            <div class="col-lg-8">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Solicitudes de repartidores</div>
                        <div class="ibox-tools">
                            <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                            <a class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item">option 1</a>
                                <a class="dropdown-item">option 2</a>
                            </div>
                        </div>
                    </div>
                    <div class="ibox-body">
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>DNI</th>
                                <th>Nombres</th>
                                <th>Placa</th>
                                <th>Tipo</th>
                                <th width="91px">Ver</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($request_deliverymen as $request_delivery)
                                <tr>
                                    <td>{{$request_delivery->ci}}</td>
                                    <td>{{$request_delivery->last_name}} {{$request_delivery->name}}</td>
                                    <td>{{$request_delivery->vehicle_plate}}</td>
                                    <td>{{$request_delivery->vehicle_type}}</td>
                                    <td>

                                        @can('modificar solicitud')
                                            @if ($request_delivery->status !="aprobado")
                                                <a href="{{route('show-request-delivery',$request_delivery->id)}}"
                                                   class="btn btn-default btn-xs"
                                                   title="Ver petición"
                                                   data-toggle="tooltip">
                                                    <i class="fa fa-eye font-14 text-muted"></i>
                                                </a>
                                            @endif

                                        @endcan
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
        @if (count($deliverymen_lasted))
            <div class="col-lg-4">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Nuevos repartidores</div>
                    </div>
                    <div class="ibox-body table-responsive">
                        <ul class="media-list media-list-divider m-0">
                            @foreach($deliverymen_lasted as $delivery)

                                <li class="media">
                                    <a class="media-img" href="javascript:;">
                                        @if ($delivery->user->url_image==="#")
                                            <img class="img-circle" src="{{asset('img/users/user.png')}}" width="40"/>
                                        @else
                                            <img class="img-circle" src="{{$delivery->user->url_image}}" width="40"/>
                                        @endif
                                    </a>
                                    <div class="media-body">
                                        <div class="media-heading">{{$delivery->name}} {{$delivery->last_name}} <small
                                                class="float-right text-muted">{{\Carbon\Carbon::parse($delivery->created_at)->diffForHumans()}}</small>
                                        </div>
                                        <div class="font-13">{{$delivery->email}}
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif
        @if(count($orders_customers))
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Ordenes</div>
                        <div class="ibox-tools">
                            <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                            <a class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item">option 1</a>
                                <a class="dropdown-item">option 2</a>
                            </div>
                        </div>
                    </div>
                    <div class="ibox-body table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>Empresa</th>
                                <th>Total</th>
                                <th>Registrado</th>
                                <th width="91px">Ver</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($orders_customers as $order)
                                <tr>
                                    <td>{{$order->name_customer}}</td>
                                    <td>{{$order->name_company}}</td>
                                    <td>{{$order->total}}</td>
                                    <td>{{\Carbon\Carbon::parse($order->created_at)->diffForHumans()}}</td>
                                    <td>

                                        @can('modificar solicitud')
                                            <a href="{{route('get-pdf-order',$order->id)}}"
                                               class="btn btn-default btn-xs"
                                               title="Ver petición"
                                               data-toggle="tooltip">
                                                <i class="fa fa-eye font-14 text-muted"></i>
                                            </a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                            {{$orders_customers->render()}}
                        </table>
                    </div>
                </div>
            </div>
        @endif
        @if(count($visits))
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Vistas ({{$total_visits}}) </div>
                        <div class="ibox-tools">
                            <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                            <a class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item">option 1</a>
                                <a class="dropdown-item">option 2</a>
                            </div>
                        </div>
                    </div>
                    <div class="ibox-body table-responsive">
                        <table class="table table-striped table-hover"  id="example-table">
                            <thead>
                            <tr>
                                <th>N°</th>
                                <th>IP</th>
                                <th>VISITAS</th>
                                <th>ÚLTIMA VISITA</th>
                                <th>FECHA</th>
                                <th>HORA</th>
                            </tr>
                            </thead>
                            <tbody>
                                 <small hidden>{{$contador =1}}</small>
                                
                            @foreach ($visits as $visits)
                                <tr>
                                    <td>{{$contador}}</td>
                                    <td>{{$visits->ip}}</td>
                                    <td>{{$visits->hits}}</td>
                                    <td>{{\Carbon\Carbon::parse($visits->updated_at)->diffForHumans()}}</td>
                                    <td>{{$visits->date}}</td>
                                    <td>{{$visits->visit_time}}</td>
                                </tr>
                                 <small hidden>{{$contador++}}</small>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection


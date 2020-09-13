@extends('admin.base.index')
@section('content')

    <div class="row">
        <div class="col-lg-6 col-md-6">
            <div class="ibox bg-success color-white widget-stat">
                <div class="ibox-body">
                    <h2 class="m-b-5 font-strong">$ {{$orders_month_val}}</h2>
                    <div class="m-b-5">Mensual</div>
                    <i class="ti-user widget-stat-icon"></i>
                    <div><i class="fa fa-level-up m-r-5"></i><small>{{$orders_month}} ordenes</small></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="ibox bg-info color-white widget-stat">
                <div class="ibox-body">
                    <h2 class="m-b-5 font-strong">$ {{$orders_year_val}}</h2>
                    <div class="m-b-5">Anual</div>
                    <i class="ti-home widget-stat-icon"></i>
                    <div><i class="fa fa-level-up m-r-5"></i><small>{{$orders_year}} ordenes</small></div>
                </div>
            </div>
        </div>
        
    </div>

    <div class="row">
        <div class="col-lg-12">
            {!! Form::open(['route' => 'get-report-orders', 'method'=>'GET','autocomplete'=>'off','role'=>'search']) !!}
            <div class="row">
                 
                 <div class="col-lg-4 form-group">
                    {{Form::select('month',array(
                                   '0' => 'Anual',
                                   '1' => 'Enero',
                                   '2' => 'Febrero',
                                   '3' => 'Marzo',
                                   '4' => 'Abril',
                                   '5' => 'Mayo',
                                   '6' => 'Junio',
                                   '7' => 'Julio',
                                   '8' => 'Agosto',
                                   '9' => 'Septiembre',
                                   '10' => 'Octubre',
                                   '11' => 'Noviembre',
                                   '12' => 'Diciembre',
                                   ),
                                   $request_month,
                                   ['id'=>'month',
                                   'class'=>'form-control']
                                   )}}
                     
                 </div>
                 <div class="col-lg-2 form-group">
                    {{Form::select('year',array(
                                   '2020' => '2020',
                                   '2021' => '2021',
                                   '2022' => '2022',
                                   '2023' => '2023',
                                   '2024' => '2024',
                                   '2025' => '2025',
                                   '2026' => '2026',
                                   '2027' => '2027',
                                   '2028' => '2028',
                                   '2029' => '2029',
                                   '2030' => '2030',
                                   '2031' => '2031',
                                   '2032' => '2032',
                                   '2033' => '2033',
                                   '2034' => '2034',
                                   '2035' => '2035',
                                   '2036' => '2036',
                                   '2037' => '2037',
                                   '2038' => '2038',
                                   '2039' => '2039',
                                   '2040' => '2040'
                                   ),
                                   $request_year,
                                   ['id'=>'request_year',
                                   'class'=>'form-control']
                                   )}}
                     
                 </div>
                 <div class="col-lg-4 form-group">
                    {{Form::select('company',$companies,
                                   $company,
                                   ['id'=>'month',
                                   'class'=>'form-control']
                                   )}}
                     
                 </div>
                 <div class="col-lg-1 form-group">
                    <button type="submit" class="btn btn-info"><i class="fa fa-search"></i></button>

                     
                 </div>
              </div>
            {!! Form::close() !!}
            
        </div>
        

        @if(count($orders))
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
                    <div class="ibox-body">
                        <div class="ibox-tools">
                                <h5 class="d-none d-lg-block inbox-title">
                                    {!! Form::open(['route' => 'get-pdf-report-orders', 'method'=>'GET','autocomplete'=>'off','role'=>'search']) !!}
                                        <input hidden  type="text" name="month" id="month_id">
                                        <input hidden type="text" name="year" id="year_id">
                                        <input hidden type="text" name="company" id="company_id">
                                        <button type="submit" class="btn btn-success btn-sm pull-right"><i class="fa fa-print"></i></button>
                                     {!! Form::close() !!}
                                    </h5>
                        </div>
                        <table class="table table-striped table-hover"  id="example-table" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>Empresa</th>
                                <th>Total</th>
                                <th>Registrado</th>
                                <th>Estado</th>
                                <th width="91px">Ver</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{$order->name_customer}}</td>
                                    <td>{{$order->name_company}}</td>
                                    <td>{{$order->name_company}}</td>
                                    <td>{{\Carbon\Carbon::parse($order->created_at)->diffForHumans()}}</td>
                                     <td>{{$order->status}}</td>
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
                           
                        </table>
                    </div>
                </div>
            </div>
        @endif

       
    </div>
@endsection

@include('admin.reports.script')


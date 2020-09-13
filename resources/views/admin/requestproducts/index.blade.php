@extends('admin.base.index')
@section('content')
    <div class="row">
        <div class="col-lg-6 col-md-6">
            <div class="ibox bg-success color-white widget-stat">
                <div class="ibox-body">
                    <h2 class="m-b-5 font-strong"></h2>
                    <div class="m-b-5">Mensual</div>
                    <i class="ti-user widget-stat-icon"></i>
                    <div><i class="fa fa-level-up m-r-5"></i><small> ordenes</small></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="ibox bg-info color-white widget-stat">
                <div class="ibox-body">
                    <h2 class="m-b-5 font-strong"></h2>
                    <div class="m-b-5">Anual</div>
                    <i class="ti-home widget-stat-icon"></i>
                    <div><i class="fa fa-level-up m-r-5"></i><small>ordenes</small></div>
                </div>
            </div>
        </div>
        
    </div>

    <div class="row">
       
        

        @if(count($request_products))
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Solicitudes</div>
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
                        
                        <table class="table table-striped table-hover"  id="example-table" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>Motivo</th>
                                <th>Total</th>
                                <th>Registrado</th>
                                <th>Estado</th>
                                <th width="91px">Ver</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($request_products as $request_product)
                                <tr>
                                    <td>{{$request_product->merchant->name}}</td>
                                    <td>{{$request_product->description}}</td>
                                    <td>{{$request_product->created_at}}</td>
                                    <td>{{\Carbon\Carbon::parse($request_product->created_at)->diffForHumans()}}</td>
                                     <td>{{$request_product->status}}</td>
                                    <td>

                                        @can('modificar solicitud')
                                            <a 
                                               class="btn btn-default btn-xs"
                                               type="button" 
                                               data-toggle="collapse" 
                                               data-target="#collapseExample{{$request_product->id}}" 
                                               aria-expanded="false" 
                                               aria-controls="collapseExample{{$request_product->id}}"
                                              
                                              >
                                                <i class="fa fa-eye font-14 text-muted"></i>
                                            </a>
                                        @endcan
                                    </td>
                                </tr>
                                 @foreach ($request_product->details as $detail)
                                   <tr class="collapse" id="collapseExample{{$request_product->id}}">
                                      <td>{{$detail->name}}</td>
                                      <td>{{$detail->description}}</td>
                                      <td>{{$detail->price}}</td>
                                      <td>{{$detail->stock}}</td>
                                      <td><img height="50" src="{{ asset($detail->url_image) }}"></td>
                                      <td><a class="btn btn-success btn-sm" href="{{route('download-image-request-product',$detail->id)}}">Descargar</a></td>
                                   
                                  </tr>
                                 @endforeach
                               
                                
                            @endforeach

                            </tbody>
                           
                        </table>
                    </div>
                </div>
            </div>
        @endif

       
    </div>
@endsection



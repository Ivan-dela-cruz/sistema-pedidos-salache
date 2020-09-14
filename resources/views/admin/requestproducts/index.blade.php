@extends('admin.base.index')
@section('content')

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
                                    <td>{{\Carbon\Carbon::parse($request_product->created_at)->diffForHumans()}}</td>
                                     <td>{{$request_product->status}}</td>
                                    <td>

                                        <a 
                                            href="{{route('show-request-product',$request_product->id)}}"
                                           class="btn btn-default btn-xs">
                                            <i class="fa fa-eye font-14 text-muted"></i>
                                        </a>
                                        <a 
                                            href="{{route('delete-request-product',$request_product->id)}}"
                                           class="btn btn-default btn-xs">
                                            <i class="fa fa-trash font-14 text-muted"></i>
                                        </a>
                                      
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



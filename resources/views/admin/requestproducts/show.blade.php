@extends('admin.base.index')
@section('content')
   

    <div class="row">

            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Solicitudes</div>
                        <div class="ibox-tools">
                            <a href="{{route('get-request-products')}}"  class="ibox-collapse"><i class="fa fa-minus"></i> Atras</a>
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
                                <th>Producto</th>
                                <th>Descripción</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Imagen</th>
                                <th width="91px">Acción</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($request_product->details as $detail)
                                <tr>
                                    <td>{{$detail->name}}</td>
                                    <td>{{$detail->description}}</td>
                                    <td>{{$detail->price}}</td>
                                    <td>{{$detail->stock}}</td>
                                     <td><img src="{{asset($detail->url_image) }}"></td>
                                    <td>
                                        <a 
                                        	href="{{route('download-image-request-product',$detail->id)}}"
                                           class="btn btn-default btn-xs">
                                            <i class="fa fa-download font-14 text-muted"></i>
                                        </a>
                                        <a 
                                            href="{{route('delete-request-item',$detail->id)}}"
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

       
    </div>
@endsection



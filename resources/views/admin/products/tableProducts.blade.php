@if(count($products)>0)
<table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%" >
    <thead>
        <tr>
            <th>Foto</th>

            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio venta</th>
            <th>Categoría</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
        <tr>
            <td><img width="40" height="40" src="{{$product->url_image}}" alt="" class="img-responsive"></td>

            <td>{{$product->name}}</td>
            <td>{{$product->description}}</td>
            <td>{{$product->sale_price}}</td>
            <td>{{$product->category->name}}</td>

            <td>
                @if ($product->status =='activo')
                    <i class="fa fa-check text-success"></i>
                @else
                    <i class="fa fa-close text-warning"></i>
                @endif
            <td>

                @can('modificar producto')
                    <a href="{{route('edit-product',$product->id)}}"
                                            class="btn btn-default btn-xs"
                                            data-toggle="tooltip"
                                            data-original-title="Editar"
                                            data-id-product="{{$product->id}}">
                                            <i class="fa fa-pencil font-14"></i>
                                        </a>
                @endcan
                @can('eliminar producto')
                    <a class="btn btn-default btn-xs btn-delete-product"
                    data-toggle="tooltip"
                    @if ($product->status=="activo")
                        data-original-title="Deshabilitar"
                    @else
                        data-original-title="Habilitar"
                    @endif
                       data-id-company="{{$product->company->id}}"
                    data-id-product="{{$product->id}}">
                        @if ($product->status=="activo")
                        <i class="fa fa-close font-14 text-danger"></i>
                        @else
                        <i class="fa fa-exchange font-14 text-success"></i>
                        @endif

                </a>
                @endcan



            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@else
<div class="text-center">
    <img width="200" height="160" src="{{asset('assets/img/data.png')}}" alt="">
    <h6>No hay datos para mostrar</h6>
</div>

@endif

@extends('admin.base.index')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="ibox">
            <div class="ibox-head bg-info">
                <div class="ibox-title text-white">Lista Productos</div>
                <div class="ibox-tools">
                    @can('create product')
                    <a class="text-white hover" href="{{route('create-product')}}">
                        <i class="fa fa-plus-square"></i>
                            Añadir</a>
                    @endcan

                </div>
            </div>
            <div class="ibox-body">
                <div class="ibox-tools">
                        <h5 class="d-none d-lg-block inbox-title">
                            <a href="{{route('get-pdf-products')}}" class="btn btn-primary btn-sm pull-right">
                                <i class="fa fa-print"></i>
                                Imprimir</a>
                                
                            </h5>
                </div>
                @if (count($products)>0)
                    <div class="table-products table-responsive">
                        @include('admin.products.tableProducts')

                    </div>
                   
                @else
                    <h4 class="text-center"> <i class="fa fa-search font-20 text-info"></i> No hay datos para mostrar </h4>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection

@include('admin.products.script')

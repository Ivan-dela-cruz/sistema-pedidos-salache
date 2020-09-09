@extends('admin.base.index')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="ibox">
            <div class="ibox-head bg-info">
                <div class="ibox-title text-white">Clientes registrados</div>
                
            </div>
            <div class="ibox-body">
                <div class="ibox-tools">
                        <h5 class="d-none d-lg-block inbox-title">
                            <a href="{{route('get-pdf-customers')}}" class="btn btn-primary btn-sm pull-right">
                                <i class="fa fa-print"></i>
                                Imprimir</a>
                            </h5>
                </div>
                @if (count($customers)>0)
                    <div class="table-products table-responsive">
                        @include('admin.customers.table')

                    </div>
                  
                @else
                    <h4 class="text-center"> <i class="fa fa-search font-20 text-info"></i> No hay datos para mostrar </h4>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection


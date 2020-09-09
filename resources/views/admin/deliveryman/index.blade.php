@extends('admin.base.index')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="ibox">
            <div class="ibox-head bg-info">
                <div class="ibox-title text-white">Listado de Repartidores</div>


            </div>
            <div class="ibox-body">
                <div class="ibox-tools">
                        <h5 class="d-none d-lg-block inbox-title">
                            <a href="{{route('get-pdf-deliveryman')}}" class="btn btn-primary btn-sm pull-right">
                                <i class="fa fa-print"></i>
                                Imprimir</a>
                                
                            </h5>
                </div>

                @if (count($deliverymen)>0)
                    <div class="table-users table-responsive">
                        @include('admin.deliveryman.table')

                    </div>

                @else
                <div class="text-center">
                    <img width="300" height="260" src="{{asset('assets/img/data.png')}}" alt="">
                    <h6>No hay datos para mostrar</h6>
                </div>

                @endif

            </div>
        </div>
    </div>
</div>
@endsection

@include('admin.users.script')
